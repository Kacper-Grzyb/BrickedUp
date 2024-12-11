<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // To seed the themes and subthemes, run the db-setup scraper program

        $this->call([
            AvailabilitySeeder::class,
            DashboardElementSeeder::class,
            UserSeeder::class
        ]);
    }
}
