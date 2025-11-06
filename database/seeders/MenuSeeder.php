<?php

namespace Database\Seeders;

use App\Enums\MenuItemTypes;
use App\Enums\Positions;
use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder {

    public function run(): void {

        $menu = Menu::create(['name' => 'Menu Principal', 'position' => Positions::HEADER->value]);

        $menu->items()->createMany([
            ['name' => 'Home', 'url' => '/', 'slug' => '/', 'type' => MenuItemTypes::PAGE->value, 'item_id' => 1],
            ['name' => 'About Us', 'url' => 'about-us', 'slug' => 'about-us', 'type' => MenuItemTypes::PAGE->value, 'item_id' => 2],
            ['name' => 'Terms and Conditions', 'url' => 'terms-and-conditions', 'slug' => 'terms-and-conditions', 'type' => MenuItemTypes::PAGE->value, 'item_id' => 3],
            ['name' => 'Contact Us', 'url' => 'contact-us', 'slug' => 'contact-us', 'type' => MenuItemTypes::PAGE->value, 'item_id' => 4],
        ]);

    }
}
