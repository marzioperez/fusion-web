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
    }
}
