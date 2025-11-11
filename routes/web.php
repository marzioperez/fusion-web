<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/mi-cuenta', \App\Livewire\Customer\Index::class)->name('customer.account');
});

Route::get('/{slug?}', \App\Livewire\Page::class)->name('page');
