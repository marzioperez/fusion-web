<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder {

    public function run(): void {
        Product::factory(10)->create()->each(function ($product) {
            $ingredients = Ingredient::all()->random(3);
            foreach ($ingredients as $ingredient) {
                $product->ingredients()->attach($ingredient['id'], [
                    'quantity' => fake()->randomFloat(2, 1, 10),
                    'unit' => 'kg'
                ]);
            }
        });
    }
}
