<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuidesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('guides')->insert([
            // Steps for Plant ID 1 (Mango Tree)
            [
                'plant_id' => 1,
                'step_order' => 1,
                'instruction' => 'Choose a sunny location with well-drained soil.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'plant_id' => 1,
                'step_order' => 2,
                'instruction' => 'Plant the mango seed or sapling and water it thoroughly.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'plant_id' => 1,
                'step_order' => 3,
                'instruction' => 'Fertilize the tree every few months during the growing season.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Steps for Plant ID 2 (Rose)
            [
                'plant_id' => 2,
                'step_order' => 1,
                'instruction' => 'Prepare the soil by mixing compost and ensuring good drainage.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'plant_id' => 2,
                'step_order' => 2,
                'instruction' => 'Plant the rose bush and water it deeply.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'plant_id' => 2,
                'step_order' => 3,
                'instruction' => 'Prune the rose bush regularly to encourage healthy growth.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Steps for Plant ID 3 (Spinach)
            [
                'plant_id' => 3,
                'step_order' => 1,
                'instruction' => 'Sow spinach seeds in rows in rich, well-drained soil.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'plant_id' => 3,
                'step_order' => 2,
                'instruction' => 'Keep the soil moist but not waterlogged.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'plant_id' => 3,
                'step_order' => 3,
                'instruction' => 'Harvest spinach leaves when they are tender and fully grown.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Steps for Plant ID 4 (Cactus)
            [
                'plant_id' => 4,
                'step_order' => 1,
                'instruction' => 'Use a pot with drainage holes and fill it with cactus soil.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'plant_id' => 4,
                'step_order' => 2,
                'instruction' => 'Plant the cactus and water it sparingly.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'plant_id' => 4,
                'step_order' => 3,
                'instruction' => 'Place the cactus in a sunny location and avoid overwatering.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Steps for Plant ID 5 (Bamboo)
            [
                'plant_id' => 5,
                'step_order' => 1,
                'instruction' => 'Choose a location with plenty of space for bamboo to spread.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'plant_id' => 5,
                'step_order' => 2,
                'instruction' => 'Plant bamboo in well-drained soil and water it regularly.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'plant_id' => 5,
                'step_order' => 3,
                'instruction' => 'Prune bamboo shoots to control its growth and maintain its shape.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}