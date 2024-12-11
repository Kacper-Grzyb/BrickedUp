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
        Availability::insert(
        [
            'availability' => 'Retail'
        ]);

        Availability::insert(
        [
            'availability' => 'Retired'
        ]);

        Availability::insert(
        [
            'availability' => 'Exclusive'
        ]);
    }
}
