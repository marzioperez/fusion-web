<?php

namespace Database\Seeders;

use App\Models\MediaVault;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MediaVaultSeeder extends Seeder {

    public function run(): void {
        $vault = MediaVault::firstOrCreate(['id' => 1], []);
        $vault->addMediaFromDisk('logo.webp', 'seed-assets')->preservingOriginal()->toMediaCollection('assets', 'media-manager');
    }
}
