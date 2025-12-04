<?php

use App\Mail\Order\OrderPaid;
use App\Models\Student;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;


Route::post('stripe/webhook', [\App\Http\Controllers\Stripe\WebhookController::class, 'handle'])
    ->withoutMiddleware([VerifyCsrfToken::class])
    ->name('stripe.webhook');

Route::middleware('web')->group(function () {

    Route::get('test-export-1', function () {
        $model = \App\Models\ScheduleEntryMenu::query();
        $school_ids = [];
        if ($school_ids) {
            $model->whereIn('school_id', $school_ids);
        }
        $model->whereBetween('date', ['2025-12-04 00:00', '2025-12-04 23:59']);
        $records = $model->get();

        // Se ordenan y mapean agregando el indicador de duplicidad
        /*$records = $records->sortBy([
            ['school', 'asc'],
            ['first_name', 'asc'],
            ['last_name', 'asc']
        ])->groupBy(['school', 'grade'])
        ->flatMap(function ($school_group, $school_name) {
            return $school_group->flatMap(function ($grade_group, $grade_name) use ($school_name) {
                return $grade_group->map(function ($item) use ($school_name, $grade_name) {
                    $dateFormatted = $item->date->format('d/m/Y');
                    $key = $item->student_id . '|' . $dateFormatted;

                    $detail = \App\Models\OrderItem::find($item->order_item_id);
                    $order_code = null;
                    if ($detail) {
                        $order_code = $detail->order->code;
                    }

                    return [
                        'school' => $school_name,
                        'grade' => $grade_name,
                        'first_name' => $item->first_name,
                        'last_name' => $item->last_name,
                        'product' => $item->product,
                        'color' => $item->color,
                        'student_id' => $item->student_id,
                        'date' => $item->date->format('d/m/Y'),
                        'order_code' => $order_code,
                        'allergies' => $item->allergies
                    ];
                });
            });
        })->values();*/

        // 1) Mapeamos a un array base por cada registro
        $records = $records->map(function ($item) {
            $dateFormatted = $item->date->format('d/m/Y');

            $detail = \App\Models\OrderItem::find($item->order_item_id);
            $order_code = null;
            if ($detail) {
                $order_code = $detail->order->code;
            }

            return [
                'school'      => $item->school,
                'grade'       => $item->grade,
                'first_name'  => $item->first_name,
                'last_name'   => $item->last_name,
                'product'     => $item->product,
                'color'       => $item->color,
                'student_id'  => $item->student_id,
                'date'        => $dateFormatted,
                'order_code'  => $order_code,
                'allergies'   => $item->allergies,
                'quantity'    => 1, // valor base
            ];
        });

        // 2) Agrupamos por alumno + fecha + producto + orden
        $records = $records
            ->groupBy(function ($item) {
                return implode('|', [
                    $item['student_id'],
                    $item['date'],
                    $item['product'],
                    $item['order_code'],
                ]);
            })
            ->map(function ($group) {
                $first = $group->first();
                // quantity = cantidad de registros en el grupo
                $first['quantity'] = $group->count();

                return $first;
            })
            // 3) Ordenamos por colegio y nombre como antes
            ->sortBy([
                ['school', 'asc'],
                ['first_name', 'asc'],
                ['last_name', 'asc'],
            ])
            ->values();

        // 4) Total de quantity (todos los almuerzos sumados)
        $total_quantity = $records->sum('quantity');

        return view('exports.schedule-entry-menu', [
            'records' => $records->toArray(),
            'total_quantity'  => $total_quantity,
        ]);
    });

    Route::get('test-email-2', function () {
        $user = \App\Models\User::where('email', 'marzioperez@gmail.com')->first();
        $order = \App\Models\Order::where('user_id', $user->id)->get()->last();
        Mail::to($user['email'])->send(new OrderPaid($order, $user));
        return view('mail.order.order-paid', ['user' => $user, 'order' => $order]);
    });

    Route::get('test-pdf', function () {
        $user = \App\Models\User::where('email', 'marzioperez@gmail.com')->first();
        $order = \App\Models\Order::where('user_id', $user->id)->get()->last();
        $studentItemGroups = $order->items()->whereNotNull('student_id')->get()->groupBy('student_id');

        $data_items = null;
        $student = null;

        foreach ($studentItemGroups as $studentId => $items) {
            // Intentamos obtener el modelo Student desde la relación o por ID
            $student = $items->first()->student ?? Student::find($studentId);

            if (!$student) {
                continue;
            }
            $data_items = $items;
        }

        return view('pdf.order-student-summary', [
            'order'   => $order,
            'student' => $student,
            'items'   => $data_items
        ]);
    });


    Route::middleware('auth')->group(function () {
        Route::get('/my-account', \App\Livewire\Customer\Index::class)->name('customer.account');
        Route::get('/start-shopping/{code}', \App\Livewire\Order\StartShopping::class)->name('order.start-shopping');
        Route::get('/order-detail/{code}', \App\Livewire\Customer\Orders\Detail::class)->name('order.detail');
        Route::get('/check-out', \App\Livewire\Order\Checkout\Index::class)->name('order.check-out');
        Route::get('/thank-you', \App\Livewire\Order\Step3::class)->name('order.thank-you');
    });

    Route::get('/{slug?}', \App\Livewire\Page::class)->name('page');
});
