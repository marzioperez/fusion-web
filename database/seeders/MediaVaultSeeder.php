<?php

namespace Database\Seeders;

use App\Models\MediaVault;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MediaVaultSeeder extends Seeder {

    public function run(): void {
        MediaVault::firstOrCreate(['id' => 1], []);
    }
}
