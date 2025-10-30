<?php

namespace Database\Seeders\Pages;

use App\Models\Meta;
use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermsAndConditions extends Seeder {

    public function run(): void {
        $page = Page::create([
            'title' => 'Terms And Conditions',
            'content' => [

            ]
        ]);

        $meta = new Meta([
            'title' => config('app.name', 'Laravel'),
            'description' => config('app.name', 'Laravel'),
            'robots' => 'follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large',
        ]);
        $page->meta()->save($meta);
    }
}
