<?php

namespace Database\Seeders;

class InteractionSeeder extends AbstractGuestActivitySeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedGuestActivity(
            'interactions',
            [300, 1500],
        );
    }
}
