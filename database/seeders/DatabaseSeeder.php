<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    use WithoutModelEvents;

    public function run(): void {

        $this->call([
            AdminSeeder::class,
            MediaVaultSeeder::class,
            SchoolSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            IngredientSeeder::class,
            ProductSeeder::class,
            MenuEntrySeeder::class,
        ]);
    }
}
