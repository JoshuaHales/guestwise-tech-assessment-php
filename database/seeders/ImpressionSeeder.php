<?php

namespace Database\Seeders;

class ImpressionSeeder extends AbstractGuestActivitySeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedGuestActivity(
            'impressions',
            [3000, 15000],
        );
    }
}
