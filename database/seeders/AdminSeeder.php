<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder {

    public function run(): void {
        Admin::create([
            'name' => 'Marzio Perez',
            'email' => 'marzioperez@gmail.com',
            'password' => '47804233'
        ]);

        Admin::create([
            'name' => 'Jaime',
            'email' => 'jaime@soyhumano.pe',
            'password' => 'Jaime2025'
        ]);

        Admin::create([
            'name' => 'Maribel Castaman',
            'email' => 'contact@fusionportland.com',
            'password' => 'Maribel2025'
        ]);
    }
}
