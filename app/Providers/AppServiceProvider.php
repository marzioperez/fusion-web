<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Component;

class AppServiceProvider extends ServiceProvider {

    public function register(): void {
        //
    }

    public function boot(): void {
        Component::macro('toast', function ($message, $title = '', $type = 'success') {
            $this->dispatch('toast', message:$message, title: $title, type: $type);
        });
    }
}
