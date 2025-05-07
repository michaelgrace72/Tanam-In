<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\PlantSeeder;
use Database\Seeders\UserPlantSeeder;
use Database\Seeders\PostSeeder;
use Database\Seeders\ReminderSeeder;
use Database\Seeders\GuidesSeeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
            $this->call([
            PlantSeeder::class,
            UserPlantSeeder::class,
            PostSeeder::class,
            ReminderSeeder::class,
            GuidesSeeder::class,
        ]);



    }
}
