<?php

namespace Database\Seeders\Pages;

use App\Enums\SlideTypes;
use App\Models\MediaVault;
use App\Models\Meta;
use App\Models\Page;
use App\Models\Slide;
use App\Models\Slider;
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

        $icon_card_1 = $vault->addMediaFromDisk('home/icon-1-1.png', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');
        $icon_card_2 = $vault->addMediaFromDisk('home/icon-1-2.webp', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');
        $icon_card_3 = $vault->addMediaFromDisk('home/icon-1-3.webp', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');
        $icon_card_4 = $vault->addMediaFromDisk('home/icon-1-4.webp', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');

        $bg_section = $vault->addMediaFromDisk('home/background-section.webp', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');

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
                [
                    'data' => [
                        'id' => null,
                        'cards' => [
                            [
                                'title' => 'Local Farms',
                                'sub_title' => 'Sourcing',
                                'bg_color' => '#8DC65E',
                                'text_color' => '#FFFFFF',
                                'icon_id' => $icon_card_1->id,
                            ],
                            [
                                'title' => 'Daily on time',
                                'sub_title' => 'Delivery',
                                'bg_color' => '#FFFFFF',
                                'text_color' => '#000000',
                                'icon_id' => $icon_card_2->id,
                            ],
                            [
                                'title' => 'Variety',
                                'sub_title' => '50 Meals +',
                                'bg_color' => '#FFFFFF',
                                'text_color' => '#000000',
                                'icon_id' => $icon_card_3->id,
                            ],
                            [
                                'title' => 'Quality',
                                'sub_title' => 'Always Fresh',
                                'bg_color' => '#FFFFFF',
                                'text_color' => '#000000',
                                'icon_id' => $icon_card_4->id,
                            ],
                        ],
                        'title' => null,
                        'sub_title' => null,
                        'open_in_new_tab' => false,
                        'visible' => true,
                        'bg_type' => 'image',
                        'bg_color' => null,
                        'bg_image_id' => $bg_section->id,
                        'padding_top_mobile' => 6,
                        'padding_top_desktop' => 7,
                        'padding_bottom_mobile' => 6,
                        'padding_bottom_desktop' => 7
                    ],
                    'type' => 'card-list'
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
