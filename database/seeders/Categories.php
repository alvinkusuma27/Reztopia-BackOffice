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
                'id_outlet' => 2,
                'name' => 'Jawa',
                'slug' => 'enak',
                'image' => 'jawa.png',
            ],
            [
                'id_outlet' => 2,
                'name' => 'Rasajawa',
                'slug' => 'enak',
                'image' => 'jawa.png',
            ],
        ]);
    }
}
