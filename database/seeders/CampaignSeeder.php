<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = \App\Models\Brand::all();

        $brands->each(function ($brand) {
            $campaigns = [
                "Seasonal Tasting Menus",
                "Dine & Unwind: Weekday Specials",
                "Exclusive Member Perks",
                "Wine & Dine Experience",
                "Celebrate in Style: Private Dining Packages",
                "Brunch & Bubbles",
                "Craft Cocktail Nights",
                "Chef’s Table Experience",
                "Family Feast Sundays",
                "Summer Terrace BBQ"
            ];

            foreach ($campaigns as $campaign) {
                $brand->campaigns()->create([
                    'name' => $campaign
                ]);
            }
        });
    }
}
