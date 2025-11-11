<?php

namespace Database\Seeders\Pages;

use App\Models\MediaVault;
use App\Models\Meta;
use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Register extends Seeder {

    public function run(): void {
        $vault = MediaVault::firstOrCreate(['id' => 1], []);
        $bg_section = $vault->addMediaFromDisk('authentication/register-bg.jpg', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');

        $page = Page::create([
            'title' => 'Register',
            'layout' => 'components.layouts.full',
            'content' => [
                [
                    'data' => [
                        'title' => 'Register',
                        'bg_image_id' => $bg_section->id,
                        'login_url' => app('url')->to('/login'),
                    ],
                    'type' => 'register'
                ],
            ]
        ]);

        $meta = new Meta([
            'title' => 'Register',
            'description' => config('app.name', 'Laravel'),
            'robots' => 'follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large',
        ]);
        $page->meta()->save($meta);
    }
}
