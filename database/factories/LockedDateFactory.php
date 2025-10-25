<?php

namespace Database\Factories;

use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

class LockedDateFactory extends Factory {

    public function definition(): array {
        return [
            'date' => fake()->date(),
            'reason' => fake()->sentence(),
            'school_id' => School::all()->random()->id,
        ];
    }
}
