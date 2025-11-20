<?php

namespace Database\Seeders;

use App\Models\LockedDate;
use App\Models\School;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder {

    public function run(): void {
        School::create(['name' => 'Holy Family Catholic School', 'color' => fake()->hexColor()]);
        School::create(['name' => 'Saint Agatha Catholic School', 'color' => fake()->hexColor()]);
        School::create(['name' => 'Saint Rose Catholic School', 'color' => fake()->hexColor()]);
        School::create(['name' => 'St. John The Baptist School', 'color' => fake()->hexColor()]);
        School::create(['name' => 'International School Of Portland', 'color' => fake()->hexColor()]);
        School::create(['name' => 'Cedarwood Waldorf School', 'color' => fake()->hexColor()]);
        School::create(['name' => 'French International School of Oregon', 'color' => fake()->hexColor()])->each(function ($school) {
            $school->grades()->createMany([
                ['name' => '1st Grade', 'school_id' => $school->id],
                ['name' => '2nd Grade', 'school_id' => $school->id],
                ['name' => '3rd Grade', 'school_id' => $school->id],
                ['name' => '4th Grade', 'school_id' => $school->id],
                ['name' => '5th Grade', 'school_id' => $school->id]
            ]);

            LockedDate::factory(3)->create(['school_id' => $school->id]);

        });
    }
}
