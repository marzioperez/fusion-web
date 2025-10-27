<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder {

    public function run(): void {
        Ingredient::create(['name' => 'Tomate']);
        Ingredient::create(['name' => 'Papa']);
        Ingredient::create(['name' => 'Arroz']);
        Ingredient::create(['name' => 'Zanahoria']);
        Ingredient::create(['name' => 'Cebolla']);
    }
}
