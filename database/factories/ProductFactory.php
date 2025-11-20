<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory {

    public function definition(): array {
        return [
            'sku' => 'FSL-' . fake()->unique()->randomNumber(5),
            'name' => fake()->name(),
            'description' => fake()->paragraph,
            'price' => fake()->randomFloat(2, 5, 10),
        ];
    }
}
