<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings {

    public ?string $logo;
    public ?string $logo_mail;
    public ?string $favicon;
    public ?string $instagram;
    public ?string $youtube;
    public ?string $linkedin;
    public ?string $tiktok;
    public ?string $facebook;
    public ?string $twitter_x;
    public ?string $whatsapp;

    public ?string $email;
    public ?string $phone;
    public ?string $address;

    public static function group(): string {
        return 'general';
    }
}
