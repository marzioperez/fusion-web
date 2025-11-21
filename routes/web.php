<?php

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;


Route::post('stripe/webhook', [\App\Http\Controllers\Stripe\WebhookController::class, 'handle'])
    ->withoutMiddleware([VerifyCsrfToken::class])
    ->name('stripe.webhook');

Route::middleware('web')->group(function () {

    Route::get('text-email-2', function () {
        $user = \App\Models\User::where('email', 'marzioperez@gmail.com')->first();
        $order = \App\Models\Order::where('user_id', $user->id)->get()->last();
        return view('mail.order.order-paid', ['user' => $user, 'order' => $order]);
    });


    Route::middleware('auth')->group(function () {
        Route::get('/my-account', \App\Livewire\Customer\Index::class)->name('customer.account');
        Route::get('/start-shopping/{code}', \App\Livewire\Order\StartShopping::class)->name('order.start-shopping');
        Route::get('/check-out', \App\Livewire\Order\Checkout\Index::class)->name('order.check-out');
        Route::get('/thank-you', \App\Livewire\Order\Step3::class)->name('order.thank-you');
    });

    Route::get('/{slug?}', \App\Livewire\Page::class)->name('page');
});
