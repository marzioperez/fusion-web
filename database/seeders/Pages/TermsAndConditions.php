<?php

namespace Database\Seeders\Pages;

use App\Models\Meta;
use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class TermsAndConditions extends Seeder {

    public function run(): void {
        $bg_section = Media::where('file_name', 'background-section.webp')->first();
        $bg_inner_title = Media::where('file_name', 'bg-inner-title.png')->first();

        $page = Page::create([
            'title' => 'Terms And Conditions',
            'header_position' => 'sticky',
            'content' => [
                [
                    'data' => [
                        'id' => null,
                        'title' => 'Terms And Conditions',
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
                        'content' => '
                            <h5>Delivery and Cancellation Policy</h5>
                            <ul>
                                <li>Meals delivered between 10:00 am – 12:00 pm, Monday – Friday<br>Cancellation deadline:</li>
                                <li>For illness/emergencies: by phone (voice message <strong>only</strong>) until 7:00 am on delivery day (refund applicable)</li>
                                <li>For other reasons or for future cancellations : &nbsp;<strong>Only</strong> by email at contact@fusionportland.com</li>
                                <li>Group cancellations (e.g. field trips): at least 1 week advance notice required</li>
                                <li>Refund policy:<br>&nbsp; &nbsp; – Cancellations made before deadline: refund/credit applicable<br>&nbsp; &nbsp; – Cancellations after deadline: no refund/credit</li>
                            </ul>
                            <h5>Meal Packaging and Dietary Restrictions</h5>
                            <ul>
                                <li>Individually packaged with child’s name, grade/classroom, and allergy/food restriction labels</li>
                                <li>100% recyclable packaging</li>
                                <li>Options for gluten-free, vegetarian, and dairy-free meals</li>
                                <li>Allergy Policy: We only accommodate MILD allergies; no meals provided for children with SEVERE allergies</li>
                            </ul>
                            <h5>Delivery and Responsibility</h5>
                            <ul>
                                <li>Meals delivered to designated area; school staff distributes to students</li>
                                <li>Fusion School Lunches not responsible for missing lunches after delivery or handling meals to students</li>
                                <li>School responsible for food warmer upkeep and sanitation</li>
                            </ul>
                            <h5>Food Warmer Provision</h5>
                            <ul>
                                <li>Optional food warmer provision: $80/month</li>
                            </ul>
                            <h5>Safety and Liability</h5>
                            <p><span style="color: #ff0000;"><strong>IMPORTANT:</strong></span> Fusion School Lunches is not responsible for any injuries caused by hot meals or possible choking emergencies. It is the responsibility of the school and/or parents/guardians to ensure that students are supervised while consuming meals and are able to handle food safely. By using our services, you acknowledge that you understand and accept this risk.</p>
                            <h5>Ordering and Calendar</h5>
                            <ul>
                                <li>Online ordering cutoff: 19:00 preceding evening</li>
                                <li>Annual academic calendar required in advance; prompt notification for changes</li>
                            </ul>
                            <h5>Refunds and Weather Conditions</h5>
                            <ul>
                                <li>Discounts applied for extreme weather closures</li>
                                <li>No refunds for unexpected absences without prior notice</li>
                            </ul>
                            <h5>Enrollment and Meal Selection</h5>
                            <ul>
                                <li>Parents select meal options by 20th of each month for upcoming month</li>
                                <li>Separate accounts required for each child; accurate student information essential</li>
                            </ul>
                            <h5>Staff Meal Policies</h5>
                            <p>Our meal portion sizes are standardized for students across all grade levels. Staff members who order meals will receive the same portion size as students. Please note that adults may have different nutritional needs and portion requirements than children, and this should be taken into consideration when ordering.</p>
                            <h5>By using our services, you acknowledge that you have read, understood, and agree to these Terms and Conditions.</h5>
                        ',
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
                    'type' => 'text-content'
                ],
            ]
        ]);

        $meta = new Meta([
            'title' => 'Terms And Conditions',
            'description' => config('app.name', 'Laravel'),
            'robots' => 'follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large',
        ]);
        $page->meta()->save($meta);
    }
}
