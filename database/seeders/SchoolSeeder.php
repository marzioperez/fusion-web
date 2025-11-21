<?php

namespace Database\Seeders;

use App\Models\LockedDate;
use App\Models\MediaVault;
use App\Models\School;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder {

    public function run(): void {
        $vault = MediaVault::firstOrCreate(['id' => 1], []);

        $holy_family_catholic_school = $vault->addMediaFromDisk('schools/holy-family-catholic-school.jpg', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');
        School::create([
            'name' => 'Holy Family Catholic School',
            'color' => fake()->hexColor(),
            'logo_media_id' => $holy_family_catholic_school->id
        ]);

        $saint_agatha_catholic_school = $vault->addMediaFromDisk('schools/saint-agatha-catholic-school.jpg', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');
        School::create([
            'name' => 'Saint Agatha Catholic School',
            'color' => fake()->hexColor(),
            'logo_media_id' => $saint_agatha_catholic_school->id
        ]);

        $st_rose_school = $vault->addMediaFromDisk('schools/st-rose-school.jpg', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');
        School::create([
            'name' => 'Saint Rose Catholic School',
            'color' => fake()->hexColor(),
            'logo_media_id' => $st_rose_school->id
        ]);

        $st_jhon_the_baptist = $vault->addMediaFromDisk('schools/st-jhon-the-baptist.jpg', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');
        School::create([
            'name' => 'St. John The Baptist School',
            'color' => fake()->hexColor(),
            'logo_media_id' => $st_jhon_the_baptist->id
        ]);

        $international_school = $vault->addMediaFromDisk('schools/international-portland-school.png', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');
        School::create([
            'name' => 'International School Of Portland',
            'color' => fake()->hexColor(),
            'logo_media_id' => $international_school->id
        ]);

        $cedarwood_waldorf = $vault->addMediaFromDisk('schools/cedarwood-waldorf.jpg', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');
        School::create([
            'name' => 'Cedarwood Waldorf School',
            'color' => fake()->hexColor(),
            'logo_media_id' => $cedarwood_waldorf->id
        ]);

        $french_international_school = $vault->addMediaFromDisk('schools/french-international-school.jpg', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');
        School::create([
            'name' => 'French International School of Oregon',
            'color' => fake()->hexColor(),
            'logo_media_id' => $french_international_school->id
        ]);

        $l_etoile_french_immersion_school = $vault->addMediaFromDisk('schools/l-etoile-french-immersion-school.jpg', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');
        School::create([
            'name' => "L'Etoile French Immersion School",
            'color' => fake()->hexColor(),
            'logo_media_id' => $l_etoile_french_immersion_school->id
        ])->each(function ($school) {
            $school->grades()->createMany([
                ['name' => 'Pre-School', 'school_id' => $school->id],
                ['name' => 'Kindergarten', 'school_id' => $school->id],
                ['name' => 'Maternelle', 'school_id' => $school->id],
                ['name' => '1st Grade', 'school_id' => $school->id],
                ['name' => '2nd Grade', 'school_id' => $school->id],
                ['name' => '3rd Grade', 'school_id' => $school->id],
                ['name' => '4th Grade', 'school_id' => $school->id],
                ['name' => '5th Grade', 'school_id' => $school->id],
                ['name' => '6th Grade', 'school_id' => $school->id],
                ['name' => '7th Grade', 'school_id' => $school->id],
                ['name' => '8th Grade', 'school_id' => $school->id],
            ]);

            LockedDate::factory(3)->create(['school_id' => $school->id]);

        });
    }
}
