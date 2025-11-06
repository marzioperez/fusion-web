<?php

namespace Database\Seeders;

use App\Models\MediaVault;
use App\Settings\GeneralSettings;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SettingSeeder extends Seeder {

    public function run(): void {
        $vault = MediaVault::firstOrCreate(['id' => 1], []);

        $settings = new GeneralSettings();

        // Logo
        $logo = $vault->addMediaFromDisk('logo-horizontal.png', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');
        if (is_null($logo->uuid)) {
            $logo->uuid = Str::uuid();
            $logo->saveQuietly();
        }
        $settings->logo = $logo->id;
        $settings->logo_mail = $logo->id;

        // Logo Footer
        $logo_footer = $vault->addMediaFromDisk('logo.webp', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');
        if (is_null($logo_footer->uuid)) {
            $logo_footer->uuid = Str::uuid();
            $logo_footer->saveQuietly();
        }
        $settings->logo_footer = $logo_footer->id;

        // Favicon
        $favicon = $vault->addMediaFromDisk('favicon.webp', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');
        if (is_null($favicon->uuid)) {
            $favicon->uuid = Str::uuid();
            $favicon->saveQuietly();
        }
        $settings->favicon = $favicon->id;

        // Avatars
        $boy_1 = $vault->addMediaFromDisk('settings/boy-1.png', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');
        if (is_null($boy_1->uuid)) {
            $boy_1->uuid = Str::uuid();
            $boy_1->saveQuietly();
        }

        $boy_2 = $vault->addMediaFromDisk('settings/boy-2.png', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');
        if (is_null($boy_2->uuid)) {
            $boy_2->uuid = Str::uuid();
            $boy_2->saveQuietly();
        }

        $boy_3 = $vault->addMediaFromDisk('settings/boy-3.png', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');
        if (is_null($boy_3->uuid)) {
            $boy_3->uuid = Str::uuid();
            $boy_3->saveQuietly();
        }

        $girt_1 = $vault->addMediaFromDisk('settings/girl-1.png', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');
        if (is_null($girt_1->uuid)) {
            $girt_1->uuid = Str::uuid();
            $girt_1->saveQuietly();
        }

        $settings->avatars = [
            ['avatar' => $boy_1->id],
            ['avatar' => $boy_2->id],
            ['avatar' => $boy_3->id],
            ['avatar' => $girt_1->id]
        ];

        $settings->save();
    }
}
