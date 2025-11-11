<?php

namespace Database\Seeders\Pages;

use App\Enums\FormFields;
use App\Models\Form;
use App\Models\FormField;
use App\Models\Meta;
use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Contact extends Seeder {

    public function run(): void {
        $bg_section = Media::where('file_name', 'background-section.webp')->first();
        $bg_inner_title = Media::where('file_name', 'bg-inner-title.png')->first();

        $form = Form::create([
            'name' => 'Contact form',
            'text_button' => 'Send'
        ]);

        FormField::create([
            'form_id' => $form->id,
            'name' => 'Name',
            'type' => FormFields::TEXT->value,
            'size' => 'full',
            'required' => true
        ]);

        FormField::create([
            'form_id' => $form->id,
            'name' => 'Phone',
            'type' => FormFields::CELLPHONE->value,
            'size' => 4,
            'required' => true
        ]);

        FormField::create([
            'form_id' => $form->id,
            'name' => 'Email',
            'type' => FormFields::EMAIL->value,
            'size' => 8,
            'required' => true
        ]);

        FormField::create([
            'form_id' => $form->id,
            'name' => 'Subject',
            'type' => FormFields::TEXT->value,
            'size' => 'full',
            'required' => true
        ]);

        FormField::create([
            'form_id' => $form->id,
            'name' => 'Message',
            'type' => FormFields::TEXTAREA->value,
            'size' => 'full',
            'required' => true
        ]);

        FormField::create([
            'form_id' => $form->id,
            'name' => 'Accept terms and conditions',
            'type' => FormFields::CHECKBOX->value,
            'size' => 'full',
            'link' => [
                [
                    'url' => config('app.url') . '/terms-and-conditions',
                    'initial_text' => 'I have read and accept the',
                    'text' => 'terms and conditions'
                ]
            ],
            'required' => true
        ]);

        $page = Page::create([
            'title' => 'Contact Us',
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
                        'visible' => true,
                        'form_id' => $form->id,
                        'map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2795.5229222191656!2d-122.4720973!3d45.519681600000006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5495a26e21720de1%3A0x90bbe5ff62af5f4d!2s458%20SE%20185th%20Ave%2C%20Portland%2C%20OR%2097233%2C%20EE.%20UU.!5e0!3m2!1ses-419!2spe!4v1762449212607!5m2!1ses-419!2spe" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                        'bg_type' => 'image',
                        'bg_color' => null,
                        'bg_image_id' => $bg_section ? $bg_section->id : null,
                        'padding_top_mobile' => 6,
                        'padding_top_desktop' => 6,
                        'padding_bottom_mobile' => 6,
                        'padding_bottom_desktop' => 6
                    ],
                    'type' => 'form-with-map'
                ],
            ]
        ]);

        $meta = new Meta([
            'title' => 'Contact',
            'description' => config('app.name', 'Laravel'),
            'robots' => 'follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large',
        ]);
        $page->meta()->save($meta);
    }
}
