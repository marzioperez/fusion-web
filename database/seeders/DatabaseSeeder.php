<?php

namespace Database\Seeders;

use Database\Seeders\Pages\AboutUs;
use Database\Seeders\Pages\Contact;
use Database\Seeders\Pages\Home;
use Database\Seeders\Pages\Login;
use Database\Seeders\Pages\Register;
use Database\Seeders\Pages\ResetPassword;
use Database\Seeders\Pages\TermsAndConditions;
use Database\Seeders\Pages\UpdatePassword;
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
            // IngredientSeeder::class,
            // ProductSeeder::class,
            // MenuEntrySeeder::class,
            MenuSeeder::class,
        ]);

        $this->call([
            Home::class,
            AboutUs::class,
            TermsAndConditions::class,
            Contact::class,
            Register::class,
            Login::class,
            ResetPassword::class,
            UpdatePassword::class
        ]);
    }
}
