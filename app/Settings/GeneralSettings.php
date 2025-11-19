<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings {

    public ?string $logo;
    public ?string $logo_mail;
    public ?string $logo_footer;
    public ?string $favicon;
    public ?string $default_product_image;
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
    public ?array $avatars;
    public ?float $processing_fee;
    public ?int $limit_product_per_student;
    public ?array $units;

    public static function group(): string {
        return 'general';
    }
}
