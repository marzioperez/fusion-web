<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/my-account', \App\Livewire\Customer\Index::class)->name('customer.account');
        Route::get('/start-shopping/{code}', \App\Livewire\Order\StartShopping::class)->name('customer.start-shopping');
    });

    Route::get('/{slug?}', \App\Livewire\Page::class)->name('page');
});
