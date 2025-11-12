<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory {

    public function definition(): array {
        return [
            'name' => fake()->name(),
            'description' => fake()->paragraph,
            'price' => fake()->randomFloat(2, 5, 10),
        ];
    }
}
