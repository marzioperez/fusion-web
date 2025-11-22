<?php

use App\Models\Student;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;


Route::post('stripe/webhook', [\App\Http\Controllers\Stripe\WebhookController::class, 'handle'])
    ->withoutMiddleware([VerifyCsrfToken::class])
    ->name('stripe.webhook');

Route::middleware('web')->group(function () {

    Route::get('test-email-2', function () {
        $user = \App\Models\User::where('email', 'marzioperez@gmail.com')->first();
        $order = \App\Models\Order::where('user_id', $user->id)->get()->last();
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
