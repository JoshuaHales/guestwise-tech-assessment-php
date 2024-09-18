<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurantBrands = [
            "Ashwood Taverns",
            "Hearthside Inns",
            "Riverside Taverns",
            "Velvet & Vine",
            "The Ember Collection",
            "The Gilded Fork",
            "Larkstone Dining Group",
            "Silverbirch Grille",
            "The Orchard Collective",
            "Vineyard & Forge"
        ];

        foreach ($restaurantBrands as $brand) {
            \App\Models\Brand::create([
                'name' => $brand
            ]);
        }
    }
}
