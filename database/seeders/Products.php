<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Products extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert(
            [
                [
                    'id_category' => 1,
                    'name' => 'nabati',
                    // 'slug' => 'link aja',
                    'description' => 'enak tau',
                    'original_price' => 40000,
                    'cost_price' => 50000,
                    'discount' => 1000,
                    'price_final' => 39000,
                    // 'cost' => 10000,
                    'active' => '1',
                    'image' => '1682954223-categories-tes.png',
                    'created_by' => '1',
                ],
                [
                    'id_category' => 2,
                    'name' => 'momogi',
                    // 'slug' => 'link aja',
                    'description' => 'enak tau',
                    'original_prize' => 20000,
                    'cost_prize' => 10000,
                    'discount' => 1000,
                    'price_final' => 19000,
                    // 'cost' => 2000,
                    'active' => '1',
                    'image' => '1682954223-categories-tes.png',
                    'created_by' => '1',
                ],
            ]
        );
    }
}
