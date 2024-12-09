<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Availability;

class AvailabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Availability::firstOrCreate(
        [
            'availability' => 'Retail'
        ]);

        Availability::firstOrCreate(
        [
            'availability' => 'Retired'
        ]);

        Availability::firstOrCreate(
        [
            'availability' => 'Exclusive'
        ]);
    }
}
