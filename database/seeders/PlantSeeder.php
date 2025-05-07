<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('plants')->insert([
            [
                'name' => 'Mango Tree',
                'scientific_name' => 'Mangifera indica',
                'family' => 'Anacardiaceae',
                'description' => 'A tropical fruit tree known for its sweet and juicy mangoes.',
                'image_url' => 'https://example.com/images/mango_tree.jpg',
                'planting_method' => 'tanah',
                'carbon_absorption_rate' => 20.5,
                'temp_reduction_rate' => 2.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rose',
                'scientific_name' => 'Rosa',
                'family' => 'Rosaceae',
                'description' => 'A flowering plant known for its beauty and fragrance.',
                'image_url' => 'https://example.com/images/rose.jpg',
                'planting_method' => 'pot',
                'carbon_absorption_rate' => 5.0,
                'temp_reduction_rate' => 0.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Spinach',
                'scientific_name' => 'Spinacia oleracea',
                'family' => 'Amaranthaceae',
                'description' => 'A leafy green vegetable rich in nutrients.',
                'image_url' => 'https://example.com/images/spinach.jpg',
                'planting_method' => 'hidroponik',
                'carbon_absorption_rate' => 3.0,
                'temp_reduction_rate' => 0.2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cactus',
                'scientific_name' => 'Cactaceae',
                'family' => 'Cactaceae',
                'description' => 'A drought-resistant plant with spines instead of leaves.',
                'image_url' => 'https://example.com/images/cactus.jpg',
                'planting_method' => 'pot',
                'carbon_absorption_rate' => 1.0,
                'temp_reduction_rate' => 0.1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bamboo',
                'scientific_name' => 'Bambusoideae',
                'family' => 'Poaceae',
                'description' => 'A fast-growing plant used for construction and decoration.',
                'image_url' => 'https://example.com/images/bamboo.jpg',
                'planting_method' => 'tanah',
                'carbon_absorption_rate' => 30.0,
                'temp_reduction_rate' => 3.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);//
    }
}
