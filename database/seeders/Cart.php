<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Cart extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cart')->insert([
            [
                'id_product' => 1,
                'id_user' => 3,
                'id_outlet' => 1,
                'note' => '',
                'quantity' => 10,
                'type_order' => 'dine in'
            ],
            [
                'id_product' => 1,
                'id_user' => 3,
                'id_outlet' => 1,
                'note' => '',
                'quantity' => 10,
                'type_order' => 'dine in'
            ],
        ]);
    }
}
