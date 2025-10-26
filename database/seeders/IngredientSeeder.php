<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder {

    public function run(): void {
        Ingredient::create(['name' => 'Tomate', 'unit' => 'kilo']);
        Ingredient::create(['name' => 'Papa', 'unit' => 'kilo']);
        Ingredient::create(['name' => 'Arroz', 'unit' => 'kilo']);
        Ingredient::create(['name' => 'Zanahoria', 'unit' => 'kilo']);
        Ingredient::create(['name' => 'Cebolla', 'unit' => 'kilo']);
    }
}
