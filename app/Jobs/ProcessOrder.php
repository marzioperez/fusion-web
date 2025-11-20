<?php

namespace App\Jobs;

use App\Enums\ProductTypes;
use App\Enums\Status;
use App\Mail\Order\OrderPaid;
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
    public $order_id = null;
    public $payment_intent_id;
    public function __construct($order_id, $payment_intent_id) {
        $this->order_id = $order_id;
        $this->payment_intent_id = $payment_intent_id;
    }

    public function handle(): void {
        $order_id = $this->order_id;
        $payment_intent_id = $this->payment_intent_id;

        DB::transaction(function () use ($order_id, $payment_intent_id) {
            $order = Order::lockForUpdate()
                ->where('code', $order_id)
                ->orWhere('stripe_payment_intent_id', $payment_intent_id)
                ->first();

            if (!$order || $order->payment_status === Status::FINISHED->value) {
                return;
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


            $user = $order->user;
            Mail::to($user['email'])->send(new OrderPaid($order, $user));

        });
    }
}
