<?php

namespace Database\Seeders\Pages;

use App\Models\MediaVault;
use App\Models\Meta;
use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AboutUs extends Seeder {

    public function run(): void {
        $bg_section = Media::where('file_name', 'background-section.webp')->first();
        $vault = MediaVault::firstOrCreate(['id' => 1], []);

        $bg_inner_title = $vault->addMediaFromDisk('about-us/bg-inner-title.png', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');
        $about_us = $vault->addMediaFromDisk('about-us/logo-fusion-about.png', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');
        $our_vision = $vault->addMediaFromDisk('about-us/our-vision.png', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');

        $page = Page::create([
            'title' => 'About Us',
            'header_position' => 'sticky',
            'content' => [
                [
                    'data' => [
                        'id' => null,
                        'title' => 'About Us',
                        'sub_title' => null,
                        'visible' => true,
                        'bg_type' => 'image',
                        'bg_color' => null,
                        'bg_image_id' => $bg_section ? $bg_section->id : null,
                        'inner_image_id' => $bg_inner_title->id,
                        'padding_top_mobile' => 6,
                        'padding_top_desktop' => 7,
                        'padding_bottom_mobile' => 6,
                        'padding_bottom_desktop' => 7
                    ],
                    'type' => 'section-title'
                ],
                [
                    'data' => [
                        'id' => null,
                        'image_id' => $our_vision->id,
                        'before_title' => 'History',
                        'title' => 'Our Vision',
                        'time_line_title' => 'Our History',
                        'sub_title' => null,
                        'content' => 'To provide healthy, sustainable, and delicious school lunches, making mealtime easier for parents and nourishing the minds and bodies of future generations.',
                        'items' => [
                            [
                                'year' => '2009',
                                'content' => 'In 2009, Maribel Castaman, the owner, graduated from Le Cordon Bleu Peru. That same year, she reunited with her high school sweetheart, Jose Castaman, and they got married. In February, she relocated to Oregon'
                            ],
                            [
                                'year' => '2010',
                                'content' => 'In 2010, Maribel gained valuable experience and expertise by working in various restaurants and hotels in Oregon. She also started offering catering services as a side job, while Jose worked in the medical field.'
                            ],
                            [
                                'year' => '2012',
                                'content' => 'In 2012, the couple launched a food cart, “LA SANGUCHERIA,” in downtown Portland. They won the Judges’ Choice award at Willamette Week’s annual food cart celebration, Eat Mobile.'
                            ],
                            [
                                'year' => '2014',
                                'content' => 'In 2014, Maribel joined Bon Appetit at the University of Portland, where she built a successful career as a catering chef. Her passion for providing nutritious and sustainable food grew, setting high standards for excellent service, quality, and flavor.'
                            ],
                            [
                                'year' => '2016',
                                'content' => 'In 2016, Jose and Maribel welcomed their first child, Martina, and Maribel took a break from Bon Appetit to care for her daughter.'
                            ],
                            [
                                'year' => '2017',
                                'content' => 'In 2017, Maribel and Jose officially established Fusion International Catering as their business. They quickly began offering services for local weddings, city events, galas, and more.'
                            ],
                            [
                                'year' => '2021',
                                'content' => 'In 2021, they welcomed their second child, Rafela. With two little girls and Martina starting school, Maribel and Jose realized they were struggling to provide healthy and nutritious school lunches for their oldest daughter, like many parents. Juggling a newborn, work, and everyday stress, they felt exhausted and lacked ideas. This sparked the idea to launch Fusion School Lunches, helping thousands of parents offer their children nutritious, delicious, and well-balanced school lunches.'
                            ],
                        ],
                        'button_text' => null,
                        'button_url' => null,
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
                    'type' => 'time-line'
                ],
            ]
        ]);

        $meta = new Meta([
            'title' => 'About Us',
            'description' => config('app.name', 'Laravel'),
            'robots' => 'follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large',
        ]);
        $page->meta()->save($meta);
    }
}
