<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\PlantSeeder;
use Database\Seeders\UserPlantSeeder;
use Database\Seeders\PostSeeder;
use Database\Seeders\ReminderSeeder;
use Database\Seeders\GuidesSeeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'User 1',
                'email' => 'user1@email.com',
                'password' => bcrypt('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'User 2',
                'email' => 'user2@email.com',
                'password' => bcrypt('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'User 3',
                'email' => 'user3@email.com',
                'password' => bcrypt('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'User 4',
                'email' => 'user4@email.com',
                'password' => bcrypt('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
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
