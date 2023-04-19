<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Categories extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Jawa',
                'slug' => 'enak',
                'image' => 'jawa.png',
            ],
            [
                'name' => 'Rasajawa',
                'slug' => 'enak',
                'image' => 'jawa.png',
            ],
        ]);
    }
}