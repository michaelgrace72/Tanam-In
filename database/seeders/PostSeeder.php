<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insert([
            // User ID 1 - 3 posts
            [
                'user_id' => 1,
                'content' => 'Just planted a new mango tree in my garden!',
                'image_path' => 'https://www.marthastewart.com/thmb/yxDOp2BIbwP_iLGN53BYG6MUs-8=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/grow-mang-from-seed-getty-0723-aebdd875c4e141e2b5183f8f4bccda55.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'content' => 'My roses are blooming beautifully this season.',
                'image_path' => 'https://starrosesandplants.com/app/uploads/2024/04/RubyRed_Blooms_033.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'content' => 'Spinach harvest was successful today!',
                'image_path' => 'https://i0.wp.com/pegplant.com/wp-content/uploads/2016/03/spinach.jpg?resize=300%2C225&ssl=1',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // User ID 3 - 2 posts
            [
                'user_id' => 3,
                'content' => 'Bamboo is growing fast in my backyard.',
                'image_path' => 'https://www.parkseed.com/media/catalog/product/2/9/29377.jpg?optimize=medium&bg-color=255,255,255&fit=bounds&height=740&width=740&canvas=740:740',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'content' => 'Cactus is thriving even in this hot weather!',
                'image_path' => 'https://media.houseandgarden.co.uk/photos/65f177973f793999d5fd6559/master/w_1600,c_limit/chuttersnap-BofgeVFG-_w-unsplash.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}