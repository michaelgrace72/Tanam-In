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
                'image_url' => 'https://www.marthastewart.com/thmb/yxDOp2BIbwP_iLGN53BYG6MUs-8=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/grow-mang-from-seed-getty-0723-aebdd875c4e141e2b5183f8f4bccda55.jpg',
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
                'image_url' => 'https://starrosesandplants.com/app/uploads/2024/04/RubyRed_Blooms_033.jpg',
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
                'image_url' => 'https://i0.wp.com/pegplant.com/wp-content/uploads/2016/03/spinach.jpg?resize=300%2C225&ssl=1',
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
                'image_url' => 'https://www.parkseed.com/media/catalog/product/2/9/29377.jpg?optimize=medium&bg-color=255,255,255&fit=bounds&height=740&width=740&canvas=740:740',
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
                'image_url' => 'https://media.houseandgarden.co.uk/photos/65f177973f793999d5fd6559/master/w_1600,c_limit/chuttersnap-BofgeVFG-_w-unsplash.jpg',
                'planting_method' => 'tanah',
                'carbon_absorption_rate' => 30.0,
                'temp_reduction_rate' => 3.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);//
    }
}
