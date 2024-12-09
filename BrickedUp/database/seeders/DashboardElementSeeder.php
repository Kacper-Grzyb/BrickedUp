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
        DashboardElement::insert(
        [
            'name' => 'set_prices'
        ]);

        DashboardElement::insert(
        [
            'name' => 'theme_prices'
        ]);

        DashboardElement::insert(
        [
            'name' => 'subtheme_prices'
        ]);

        DashboardElement::insert(
        [
            'name' => 'marketshare'
        ]);

        DashboardElement::insert(
        [
            'name' => 'price_updates'
        ]);
    }
}
