<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Outlets extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('outlets')->insert([
            [
                'name' => 'Primarasa',
                'slug' => 'enak',
                'phone' => '08123818883',
                'address' => 'surabaya',
                'created_by' => 0,
            ],
            [
                'name' => 'Rasajawa',
                'slug' => 'enak',
                'phone' => '08123818883',
                'address' => 'surabaya',
                'created_by' => 0,
            ],
        ]);
    }
}
