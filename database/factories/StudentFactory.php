<?php

namespace Database\Factories;

use App\Models\Allergy;
use App\Models\Grade;
use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory {

    public function definition(): array {
        $school = School::all()->random();
        $grade = Grade::where('school_id', $school->id)->get()->random();
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'school_id' => $school->id,
            'grade_id' => $grade->id,
            'allergies' => Allergy::all()->random(3)->pluck('id')->toArray(),
            'birth_of_date' => fake()->date(),
        ];
    }
}
