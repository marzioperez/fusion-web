<?php

namespace Database\Factories;

use App\Models\Allergy;
use App\Models\Grade;
use App\Models\School;
use App\Settings\GeneralSettings;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory {

    public function definition(): array {
        $school = School::all()->random();
        $grade = Grade::where('school_id', $school->id)->get()->random();

        $settings = new GeneralSettings();
        $avatars = $settings->avatars;

        return [
            'code' => Str::uuid(),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'school_id' => $school->id,
            'grade_id' => $grade->id,
            'allergies' => Allergy::all()->random(2)->pluck('name')->toArray(),
            'birth_of_date' => fake()->date(),
            'avatar_media_id' => $avatars[0]['avatar']
        ];
    }
}
