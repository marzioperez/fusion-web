<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

        <link rel="icon" href="{{asset('img/setup/favicon.png')}}" sizes="32x32" />
        <link rel="icon" href="{{asset('img/setup/favicon.png')}}" sizes="192x192" />
        <link rel="apple-touch-icon" href="{{asset('img/setup/favicon.png')}}" />
        <meta name="msapplication-TileImage" content="{{asset('img/setup/favicon.png')}}" />

        <title>{{config('app.name')}}</title>

        @if(config('app.env') === 'production')
            <!-- GTM Tag -->
        @endif
        <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
        @vite('resources/css/app.css')
        @livewireStyles
    </head>
    <body>
        @if(config('app.env') === 'production')
            <!-- GTM Tag -->
        @endif
        <livewire:common.header :header_position="'sticky'" />

        <main class="relative z-0">
            @yield('content')
        </main>
        <livewire:common.footer />
        @livewireScripts
        @vite('resources/js/app.js')
        @stack('scripts')
    </body>
</html>
