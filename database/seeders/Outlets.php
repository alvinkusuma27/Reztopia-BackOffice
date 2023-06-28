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
                'id_user' => 1,
                // 'id_category' => 1,
                'name' => 'Primarasa',
                'description' => 'enak',
                'phone' => '08123818883',
                'address' => 'surabaya',
                'created_by' => 0,
                'active' => 'active',
                'image' => 'tenant.png'
            ],

            [
                'id_user' => 2,
                // 'id_category' => 2,
                'name' => 'Rasajawa',
                'description' => 'enak',
                'phone' => '08123818883',
                'address' => 'surabaya',
                'created_by' => 0,
                'active' => 'active',
                'image' => 'tenant.png'
            ],
            // [
            // 'id_user' => 3,
            // 'id_category' => 2,
            // 'name' => 'Rajarasa',
            // 'slug' => 'enak',
            // 'phone' => '08123818883',
            // 'address' => 'surabaya',
            // 'created_by' => 0,
            // 'active' => 'deactive'
            // ],
        ]);
    }
}
