@php
    $general_settings = new \App\Settings\GeneralSettings();
    $media_favicon_id = $general_settings->favicon;
    use \Spatie\MediaLibrary\MediaCollections\Models\Media;
    $image = Media::find($media_favicon_id);
    $favicon = null;
    if ($image) {
        $favicon = ($image->hasGeneratedConversion('webp') ? $image->getFullUrl('webp') : $image->getUrl());
    }
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

        {!! \Artesaos\SEOTools\Facades\SEOMeta::generate() !!}

        {!! \Artesaos\SEOTools\Facades\OpenGraph::generate() !!}

        {!! \Artesaos\SEOTools\Facades\TwitterCard::generate() !!}

        {!! \Artesaos\SEOTools\Facades\JsonLd::generate() !!}

        @if($favicon)
            <link rel="icon" href="{{config('url.media.web') . $favicon}}" sizes="32x32" />
            <link rel="icon" href="{{config('url.media.web') . $favicon}}" sizes="192x192" />
            <link rel="apple-touch-icon" href="{{config('url.media.web') . $favicon}}" />
            <meta name="msapplication-TileImage" content="{{config('url.media.web') . $favicon}}" />
        @endif

        @vite('resources/css/app.css')
        @livewireStyles
    </head>
    <body x-data="{scroll: true}" x-on:toggle-scroll.window="scroll = !scroll;" :class="scroll ? '' : 'overflow-hidden'">
        <x-common.top-bar />
        <livewire:common.header :header_position="$header_position" />
        <main>
            {{ $slot }}
        </main>
        <livewire:common.footer />
        <x-common.bot-bar />

        <x-common.toast />

        @livewireScripts
        @vite('resources/js/app.js')
        @stack('scripts')
    </body>
</html>
