<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPlantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_plants')->insert([
            // User ID 1 - 2 plants
            [
                'user_id' => 1,
                'plant_id' => 1,
                'area_size' => 10.0,
                'location' => 'Garden A',
                'planting_date' => '2025-05-01',
                'status' => 'ditanam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'plant_id' => 2,
                'area_size' => 15.0,
                'location' => 'Garden B',
                'planting_date' => '2025-04-15',
                'status' => 'panen',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // User ID 2 - 2 plants
            [
                'user_id' => 2,
                'plant_id' => 3,
                'area_size' => 8.0,
                'location' => 'Field C',
                'planting_date' => '2025-03-10',
                'status' => 'mati',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'plant_id' => 4,
                'area_size' => 12.0,
                'location' => 'Field D',
                'planting_date' => '2025-02-20',
                'status' => 'ditanam',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // User ID 3 - 3 plants
            [
                'user_id' => 3,
                'plant_id' => 5,
                'area_size' => 20.0,
                'location' => 'Field E',
                'planting_date' => '2025-01-25',
                'status' => 'panen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'plant_id' => 1,
                'area_size' => 18.0,
                'location' => 'Field F',
                'planting_date' => '2025-01-15',
                'status' => 'ditanam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'plant_id' => 2,
                'area_size' => 25.0,
                'location' => 'Field G',
                'planting_date' => '2025-01-10',
                'status' => 'mati',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // User ID 4 - 3 plants
            [
                'user_id' => 4,
                'plant_id' => 1,
                'area_size' => 30.0,
                'location' => 'Field H',
                'planting_date' => '2025-01-05',
                'status' => 'panen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'plant_id' => 2,
                'area_size' => 22.0,
                'location' => 'Field I',
                'planting_date' => '2025-01-01',
                'status' => 'ditanam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'plant_id' => 3,
                'area_size' => 28.0,
                'location' => 'Field J',
                'planting_date' => '2024-12-25',
                'status' => 'mati',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}