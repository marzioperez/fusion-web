<?php

namespace Database\Seeders\Pages;

use App\Models\Meta;
use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ResetPassword extends Seeder {

    public function run(): void {
        $bg_section = Media::where('file_name', 'register-bg.jpg')->first();

        $page = Page::create([
            'title' => 'Reset password',
            'layout' => 'components.layouts.full',
            'content' => [
                [
                    'data' => [
                        'bg_image_id' => $bg_section->id,
                        'login_url' => app('url')->to('/login'),
                    ],
                    'type' => 'reset-password'
                ],
            ]
        ]);

        $meta = new Meta([
            'title' => 'Reset password',
            'description' => config('app.name', 'Laravel'),
            'robots' => 'follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large',
        ]);
        $page->meta()->save($meta);
    }
}
