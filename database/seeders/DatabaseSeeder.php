<?php

namespace Database\Seeders;

use Database\Seeders\Pages\AboutUs;
use Database\Seeders\Pages\Home;
use Database\Seeders\Pages\TermsAndConditions;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    public function run(): void {

        $this->call([
            MediaVaultSeeder::class,
            SettingSeeder::class,
            AdminSeeder::class,
            SchoolSeeder::class,
            AllergySeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            IngredientSeeder::class,
            ProductSeeder::class,
            MenuEntrySeeder::class,
            MenuSeeder::class,
        ]);

        $this->call([
            Home::class,
            AboutUs::class,
            TermsAndConditions::class
        ]);
    }
}
