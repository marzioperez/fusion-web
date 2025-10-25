<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {

    public function run(): void {
        User::factory(10)->create()->each(function ($user) {
            Student::factory(2)->create(['user_id' => $user->id]);
        });
    }
}
