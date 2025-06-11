<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReminderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reminders')->insert([
            // Reminders for user_plant_id 1
            [
                'user_plant_id' => 1,
                'type' => 'penyiraman',
                'remind_at' => '2025-05-08',
                'is_done' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_plant_id' => 2,
                'type' => 'pemupukan',
                'remind_at' => '2025-05-15',
                'is_done' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Reminders for user_plant_id 2
            [
                'user_plant_id' => 3,
                'type' => 'penyiraman',
                'remind_at' => '2025-05-09',
                'is_done' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_plant_id' => 4,
                'type' => 'panen',
                'remind_at' => '2025-05-20',
                'is_done' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Reminders for user_plant_id 3
            [
                'user_plant_id' => 5,
                'type' => 'penyiraman',
                'remind_at' => '2025-05-10',
                'is_done' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_plant_id' => 6,
                'type' => 'pemupukan',
                'remind_at' => '2025-05-18',
                'is_done' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Reminders for user_plant_id 4
            [
                'user_plant_id' => 7,
                'type' => 'penyiraman',
                'remind_at' => '2025-05-11',
                'is_done' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_plant_id' => 8,
                'type' => 'panen',
                'remind_at' => '2025-05-25',
                'is_done' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_plant_id' => 9,
                'type' => 'pemupukan',
                'remind_at' => '2025-05-30',
                'is_done' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_plant_id' => 10,
                'type' => 'penyiraman',
                'remind_at' => '2025-05-12',
                'is_done' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]

            // Add more reminders for other user_plant_ids as needed
        ]);
    }
}