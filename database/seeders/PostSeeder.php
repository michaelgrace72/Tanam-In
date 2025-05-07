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
                'image_path' => 'https://example.com/images/mango_tree_post.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'content' => 'My roses are blooming beautifully this season.',
                'image_path' => 'https://example.com/images/roses_post.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'content' => 'Spinach harvest was successful today!',
                'image_path' => 'https://example.com/images/spinach_harvest.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // User ID 3 - 2 posts
            [
                'user_id' => 3,
                'content' => 'Bamboo is growing fast in my backyard.',
                'image_path' => 'https://example.com/images/bamboo_post.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'content' => 'Cactus is thriving even in this hot weather!',
                'image_path' => 'https://example.com/images/cactus_post.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}