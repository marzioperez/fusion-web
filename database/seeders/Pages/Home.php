<?php

namespace Database\Seeders\Pages;

use App\Enums\SlideTypes;
use App\Models\MediaVault;
use App\Models\Meta;
use App\Models\Page;
use App\Models\Slide;
use App\Models\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Home extends Seeder {

    public function run(): void {
        $slider = Slider::create(['name' => 'Slider Home']);

        $vault = MediaVault::firstOrCreate(['id' => 1], []);
        $slide_desktop_1 = $vault->addMediaFromDisk('home/banner-3.webp', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');
        $slide_mobile_1 = $vault->addMediaFromDisk('home/banner-3.webp', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');

        Slide::create([
            'title' => 'Slide 1',
            'type' => SlideTypes::BG_IMAGE_AND_TEXT->value,
            'content' => [
                [
                    'type' => SlideTypes::PARAGRAPH->value,
                    'data' => [
                        'text' => '
                            <h1>Fusion School <br>Lunches</h1>
                            <ul>
                                <li>Freshly prepared, delicious and nutritious meals</li>
                                <li>100% recyclable packaging</li>
                                <li>Local product support</li>
                                <li>Stress-free daily deliveries</li>
                                <li>Expertly designed menus for optimal child development</li>
                            </ul>',
                    ]
                ],
                [
                    'type' => SlideTypes::BUTTON->value,
                    'data' => [
                        'text' => 'Create account',
                        'url' => route('page', ['slug' => 'register'])
                    ]
                ]
            ],
            'image_desktop_id' => $slide_desktop_1->id,
            'image_mobile_id' => $slide_mobile_1->id,
            'slider_id' => $slider->id
        ]);

        $slide_desktop_2 = $vault->addMediaFromDisk('home/banner-4.webp', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');
        $slide_mobile_2 = $vault->addMediaFromDisk('home/banner-4.webp', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');
        Slide::create([
            'title' => 'Slide 2',
            'type' => SlideTypes::BG_IMAGE_AND_TEXT->value,
            'content' => [
                [
                    'type' => SlideTypes::PARAGRAPH->value,
                    'data' => [
                        'text' => '
                            <h1>Fusion School <br>Lunches</h1>
                            <ul>
                                <li>Freshly prepared, delicious and nutritious meals</li>
                                <li>100% recyclable packaging</li>
                                <li>Local product support</li>
                                <li>Stress-free daily deliveries</li>
                                <li>Expertly designed menus for optimal child development</li>
                            </ul>',
                    ]
                ],
                [
                    'type' => SlideTypes::BUTTON->value,
                    'data' => [
                        'text' => 'Create account',
                        'url' => route('page', ['slug' => 'register'])
                    ]
                ]
            ],
            'image_desktop_id' => $slide_desktop_2->id,
            'image_mobile_id' => $slide_mobile_2->id,
            'slider_id' => $slider->id
        ]);

        $page = Page::create([
            'title' => 'Home',
            'is_home' => true,
            'content' => [
                [
                    'data' => [
                        'arrows' => false,
                        'slider' => $slider->id,
                        'pagination' => true
                    ],
                    'type' => 'slider'
                ],
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
