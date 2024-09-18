<?php

namespace Database\Seeders;

class ConversionSeeder extends AbstractGuestActivitySeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedGuestActivity(
            'conversions',
            [30, 150],
        );
    }
}
