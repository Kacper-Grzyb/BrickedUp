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
            'name' => 'set-prices'
        ]);

        DashboardElement::insert(
        [
            'name' => 'theme-prices'
        ]);

        DashboardElement::insert(
        [
            'name' => 'subtheme-prices'
        ]);

        DashboardElement::insert(
        [
            'name' => 'theme-marketshare'
        ]);

        DashboardElement::insert(
        [
            'name' => 'set-price-table'
        ]);
    }
}
