<?php

use Illuminate\Support\Facades\Route;

Route::get('/{slug?}', \App\Livewire\Page::class)->name('page');
