<?php

namespace Database\Seeders;

use App\Models\Allergy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllergySeeder extends Seeder {

    public function run(): void {
        Allergy::create(['name' => 'Vegetarian']);
        Allergy::create(['name' => 'Dairy Free']);
        Allergy::create(['name' => 'Gluten Free']);
        Allergy::create(['name' => 'Peanuts']);
        Allergy::create(['name' => 'Walnuts']);
        Allergy::create(['name' => 'Pistachios']);
        Allergy::create(['name' => 'Hazelnuts']);
        Allergy::create(['name' => 'Almonds']);
        Allergy::create(['name' => 'Macadamia']);
        Allergy::create(['name' => 'Cashews']);
        Allergy::create(['name' => 'Tree-nuts']);
        Allergy::create(['name' => 'Seeds']);
        Allergy::create(['name' => 'Sesame']);
        Allergy::create(['name' => 'Pineapple']);
        Allergy::create(['name' => 'Kiwi']);
        Allergy::create(['name' => 'Coconut']);
        Allergy::create(['name' => 'Melon']);
        Allergy::create(['name' => 'Tomatoes']);
        Allergy::create(['name' => 'Carrots']);
        Allergy::create(['name' => 'Lettuce']);
        Allergy::create(['name' => 'Chicken']);
        Allergy::create(['name' => 'Pork']);
        Allergy::create(['name' => 'Beef']);
        Allergy::create(['name' => 'Mayonnaise']);
        Allergy::create(['name' => 'Fruit']);
        Allergy::create(['name' => 'Sandwich cheese']);
        Allergy::create(['name' => 'Meat with cheese ( Kosher)']);
        Allergy::create(['name' => 'Olives']);
        Allergy::create(['name' => 'Fish']);
        Allergy::create(['name' => 'Shellfish']);
    }
}
