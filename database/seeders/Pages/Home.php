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

        $about_us = $vault->addMediaFromDisk('home/about-us.webp', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');

        $logo_product_1 = $vault->addMediaFromDisk('home/logo-product-1.webp', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');
        $logo_product_2 = $vault->addMediaFromDisk('home/logo-product-2.webp', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');
        $logo_product_3 = $vault->addMediaFromDisk('home/logo-product-3.webp', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');
        $logo_product_4 = $vault->addMediaFromDisk('home/logo-product-4.webp', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');
        $logo_product_5 = $vault->addMediaFromDisk('home/logo-product-5.webp', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');
        $logo_product_6 = $vault->addMediaFromDisk('home/logo-product-6.webp', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');
        $logo_product_7 = $vault->addMediaFromDisk('home/logo-product-7.webp', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');
        $logo_product_8 = $vault->addMediaFromDisk('home/logo-product-8.webp', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');
        $logo_product_9 = $vault->addMediaFromDisk('home/logo-product-9.webp', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');

        $bg_inner_image = $vault->addMediaFromDisk('home/bg-inner-image.webp', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');

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
                [
                    'data' => [
                        'id' => null,
                        'image_id' => $about_us->id,
                        'before_title' => 'About Us',
                        'title' => 'Fusion School Lunches',
                        'sub_title' => 'Hot lunch program',
                        'content' => 'School lunches made easy!<br>Our sustainable, nutritious, and delicious lunch program is now available. Register for a hassle-free way to provide healthy lunches for your kids',
                        'metrics' => [
                            [
                                'value' => '50+',
                                'title' => 'Different options',
                                'color' => '#FE9E14'
                            ],
                            [
                                'value' => '400+',
                                'title' => 'Daily deliveries',
                                'color' => '#000000'
                            ]
                        ],
                        'button_text' => 'Learn more',
                        'button_url' => route('page', ['slug' => 'about']),
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
                    'type' => 'image-text-and-metrics'
                ],
                [
                    'data' => [
                        'id' => null,
                        'before_title' => null,
                        'title' => 'Schools We Work With',
                        'sub_title' => null,
                        'visible' => true,
                        'button_text' => 'Contact Us',
                        'button_url' => route('page', ['slug' => 'contact-us']),
                        'open_in_new_tab' => false,
                        'bg_type' => 'image',
                        'bg_color' => null,
                        'bg_image_id' => $bg_section->id,
                        'padding_top_mobile' => 7,
                        'padding_top_desktop' => 8,
                        'padding_bottom_mobile' => 7,
                        'padding_bottom_desktop' => 8
                    ],
                    'type' => 'school-carousel'
                ],
                [
                    'data' => [
                        'id' => null,
                        'image_id' => $about_us->id,
                        'before_title' => 'Best Experience',
                        'title' => 'Why Us?',
                        'sub_title' => null,
                        'content' => 'Monthly menus developed to promote optimal growth and development in children',
                        'lists' => [
                            [
                                'content' => '<ul>
                                    <li>Kid-friendly options</li>
                                    <li>100% recyclable packaging</li>
                                    <li>Support for local products</li>
                                    <li>Stress-Free School Lunches for Parents</li>
                                </ul>'
                            ],
                            [
                                'content' => '<ul>
                                    <li>Daily deliveries on time</li>
                                    <li>Nutrition Expertise</li>
                                    <li>Delicious and nutritious meals prepared fresh daily by our chefs</li>
                                </ul>'
                            ],
                        ],
                        'video_title' => 'Know How',
                        'video_iframe' => '<iframe width="100%" height="315" src="https://www.youtube.com/embed/aS4VthftbIU?si=gJjJYRN8BIDlTQv-" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>',
                        'visible' => true,
                        'bg_type' => 'image',
                        'bg_color' => null,
                        'bg_image_id' => $bg_section->id,
                        'padding_top_mobile' => 8,
                        'padding_top_desktop' => 11,
                        'padding_bottom_mobile' => 8,
                        'padding_bottom_desktop' => 11
                    ],
                    'type' => 'text-and-video'
                ],
                [
                    'data' => [
                        'id' => null,
                        'before_title' => null,
                        'title' => 'Products We Work With',
                        'sub_title' => null,
                        'content' => 'We work with the best local products to offer nutritious and fresh lunches',
                        'logos' => [
                            ['logo' => $logo_product_1->id],
                            ['logo' => $logo_product_2->id],
                            ['logo' => $logo_product_3->id],
                            ['logo' => $logo_product_4->id],
                            ['logo' => $logo_product_5->id],
                            ['logo' => $logo_product_6->id],
                            ['logo' => $logo_product_7->id],
                            ['logo' => $logo_product_8->id],
                            ['logo' => $logo_product_9->id],
                        ],
                        'visible' => true,
                        'bg_type' => 'color',
                        'bg_color' => '#FFFFFF',
                        'bg_image_id' => null,
                        'padding_top_mobile' => 12,
                        'padding_top_desktop' => 16,
                        'padding_bottom_mobile' => 12,
                        'padding_bottom_desktop' => 16
                    ],
                    'type' => 'logos-carousel'
                ],
                [
                    'data' => [
                        'id' => null,
                        'before_title' => null,
                        'title' => '¿Have you already chosen your menu?',
                        'sub_title' => null,
                        'content' => 'We are committed to the balanced diet of your children, we work hand in hand with nutrition experts to bring them the best and without stress',
                        'visible' => true,
                        'bg_image_id' => $slide_mobile_1->id,
                        'bg_inner_image_id' => $bg_inner_image->id,
                        'button_text' => 'Create account',
                        'button_url' => route('page', ['slug' => 'register']),
                        'padding_top_mobile' => 8,
                        'padding_top_desktop' => 11,
                        'padding_bottom_mobile' => 8,
                        'padding_bottom_desktop' => 11
                    ],
                    'type' => 'text-with-bg-image'
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
