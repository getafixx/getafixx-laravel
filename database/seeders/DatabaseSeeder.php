<?php

namespace Database\Seeders;

use App\Models\Track;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Track::factory()->count(6)->create();
    }
}
