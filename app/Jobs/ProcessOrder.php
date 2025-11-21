<?php

namespace App\Jobs;

use App\Enums\ProductTypes;
use App\Enums\Status;
use App\Mail\Order\OrderPaid;
use App\Models\Cart;
use App\Models\MenuEntry;
use App\Models\Order;
use App\Models\ScheduleEntryMenu;
use App\Models\Student;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ProcessOrder implements ShouldQueue {
    use Queueable;
    public $order_code;

    public function __construct($order_code) {
        $this->order_code = $order_code;
    }

    public function handle(): void {
        DB::transaction(function () {
            $order = Order::lockForUpdate()->where('code', $this->order_code)->first();

            if (!$order || $order->payment_status === Status::FINISHED->value) {
                return;
            }

            // Descontar créditos del usuario (si aplica)
            if ($order->credits > 0) {
                // Bloqueamos también al usuario para evitar condiciones de carrera
                $user = $order->user()->lockForUpdate()->first();

                if ($user) {
                    // Si por alguna razón el usuario tiene menos créditos de los usados en la orden,
                    // descontamos solo lo que tenga disponible y registramos el evento en logs.
                    $creditsToDeduct = $order->credits;

                    if ($user->credits < $creditsToDeduct) {
                        Log::channel('processing-order')->warning(
                            sprintf(
                                'User %d has insufficient credits. Expected to deduct %.2f, available %.2f. Deducting available amount.',
                                $user->id,
                                $creditsToDeduct,
                                $user->credits
                            )
                        );

                        $creditsToDeduct = $user->credits;
                    }

                    if ($creditsToDeduct > 0) {
                        // Usamos decrement para que el cambio quede dentro del lock y la transacción
                        $user->decrement('credits', $creditsToDeduct);
                    }
                }
            }

            $order->update([
                'status' => Status::FINISHED->value,
                'payment_status' => Status::FINISHED->value,
            ]);

            try {
                $detail = $order->items;
                foreach ($detail as $item) {
                    $student = Student::find($item['student_id']);
                    if ($item['type'] === ProductTypes::FOOD->value) {
                        ScheduleEntryMenu::create([
                            'order_item_id' => $item['id'],
                            'school_id' => $student['school_id'],
                            'grade_id' => $student['grade_id'],
                            'date' => $item['date'],
                            'first_name' => $student['first_name'],
                            'last_name' => $student['last_name'],
                            'product' => $item['name'],
                            'school' => ($student['school'] ? $student['school']['name'] : null),
                            'grade' => ($student['grade'] ? $student['grade']['name'] : null),
                            'color' => ($student['school'] ? $student['school']['color'] : null),
                        ]);
                    }
                    if ($item['type'] === ProductTypes::ALL_DAYS->value) {
                        if ($item['data']) {
                            foreach ($item['data'] as $food) {
                                $menu_entry = MenuEntry::find($food['id']);
                                $date = Carbon::parse($food['date'])->toDateString();
                                ScheduleEntryMenu::create([
                                    'order_item_id' => $item['id'],
                                    'school_id' => $student['school_id'],
                                    'grade_id' => $student['grade_id'],
                                    'date' => $date,
                                    'first_name' => $student['first_name'],
                                    'last_name' => $student['last_name'],
                                    'product' => ($menu_entry['product'] ? $menu_entry['product']['name'] : null),
                                    'school' => ($student['school'] ? $student['school']['name'] : null),
                                    'grade' => ($student['grade'] ? $student['grade']['name'] : null),
                                    'color' => ($student['school'] ? $student['school']['color'] : null),
                                ]);
                            }
                        }
                    }
                }
            } catch (\Exception $e) {
                Log::channel('processing-order')->error('Stripe webhook error: ' . $e->getMessage());
            }

            if ($order['cart_id']) {
                $cart = Cart::find($order['cart_id']);
                if ($cart) {
                    $cart->update(['status' => Status::FINISHED->value]);
                }
            }


            $user = $order->user;
            Mail::to($user['email'])->send(new OrderPaid($order, $user));

        });
    }
}
