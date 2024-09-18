<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

abstract class AbstractGuestActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function seedGuestActivity(string $table, array $randRange): void
    {
        $chunkSize = 10000;
        $timeSlots = $this->generateTimeSlots();
        $campaigns = \App\Models\Campaign::get();

        DB::transaction(function () use ($table, $randRange, $campaigns, $chunkSize, $timeSlots) {
            $this->command->withProgressBar($campaigns, function ($campaign) use ($table, $randRange, $chunkSize, $timeSlots) {
                for ($i = 1; $i <= 30; $i++) {
                    $records = [];
                    $day = Carbon::now()->subDays($i)->format('Y-m-d');
                    $activity = rand(...$randRange);

                    for ($j = 0; $j < $activity; $j++) {
                        $occurredAt = $day . ' ' . $timeSlots[array_rand($timeSlots)];

                        $records[] = [
                            'brand_id' => $campaign->brand_id,
                            'campaign_id' => $campaign->id,
                            'occurred_at' => $occurredAt,
                        ];

                        if (count($records) >= $chunkSize) {
                            DB::table($table)->insert($records);
                            $records = [];
                        }
                    }

                    if (!empty($records)) {
                        DB::table($table)->insert($records);
                    }

                    if (app()->environment('local')) {
                        $this->command->info("Inserted {$activity} {$table} for campaign {$campaign->id} on day {$day}");
                    }
                }
            });
        });
    }

    /**
     * Generate all possible time slots for a 24-hour day.
     *
     * @return array
     */
    private function generateTimeSlots(): array
    {
        static $timeSlots = null;

        if (!$timeSlots) {
            $timeSlots = [];

            for ($hour = 0; $hour < 24; $hour++) {
                for ($minute = 0; $minute < 60; $minute++) {
                    for ($second = 0; $second < 60; $second++) {
                        $timeSlots[] = $hour . ':' . $minute . ':' . $second;
                    }
                }
            }
        }

        return $timeSlots;
    }
}