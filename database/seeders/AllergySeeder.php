<?php

namespace Database\Seeders;

use App\Models\Allergy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllergySeeder extends Seeder {

    public function run(): void {
        Allergy::create(['name' => 'Nutella']);
        Allergy::create(['name' => 'Chocolate']);
        Allergy::create(['name' => 'Lactosa']);
        Allergy::create(['name' => 'Gluten']);
    }
}
