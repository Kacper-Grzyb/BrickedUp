<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DashboardElement;

class DashboardElementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DashboardElement::firstOrCreate(
        [
            'name' => 'set_prices'
        ]);

        DashboardElement::firstOrCreate(
        [
            'name' => 'theme_prices'
        ]);

        DashboardElement::firstOrCreate(
        [
            'name' => 'subtheme_prices'
        ]);

        DashboardElement::firstOrCreate(
        [
            'name' => 'marketshare'
        ]);

        DashboardElement::firstOrCreate(
        [
            'name' => 'price_updates'
        ]);
    }
}
