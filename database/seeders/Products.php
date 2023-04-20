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
                    'name' => 'nabati',
                    'slug' => 'link aja',
                    'description' => 'enak tau',
                    'original_prize' => 20000,
                    'cost_prize' => 10000,
                    'cost' => 10000,
                    'active' => '1',
                    'image' => 'nabati.png',
                    'created_by' => '1',
                ],
                [
                    'name' => 'momogi',
                    'slug' => 'link aja',
                    'description' => 'enak tau',
                    'original_prize' => 20000,
                    'cost_prize' => 10000,
                    'cost' => 2000,
                    'active' => '1',
                    'image' => 'momogi.png',
                    'created_by' => '1',
                ],
            ]
        );
    }
}
