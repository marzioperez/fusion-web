<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {

    public function run(): void {
        User::factory()->create([
            'first_name' => 'Marzio',
            'last_name' => 'Perez',
            'email' => 'marzioperez@gmail.com',
            'phone' => '981277116',
            'password' => '47804233',
            'credits' => 10,
        ])->each(function ($user) {
            Student::factory(1)->create(['user_id' => $user->id]);
        });
    }
}
