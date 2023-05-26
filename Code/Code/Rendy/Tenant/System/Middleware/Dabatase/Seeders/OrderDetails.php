<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\map;

class OrderDetails extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('order_details')->insert([
            [
                'id_product' => 1,
                'id_order' => 1,
                'quantity' => 2,
                // 'type_order' => 'dine_in'
            ],
            [
                'id_product' => 2,
                'id_order' => 1,
                'quantity' => 3,
                // 'type_order' => 'dine_in'
            ],
            [
                'id_product' => 1,
                'id_order' => 2,
                'quantity' => 2,
                // 'type_order' => 'dine_in'
            ],
            [
                'id_product' => 1,
                'id_order' => 2,
                'quantity' => 3,
                // 'type_order' => 'dine_in'
            ],
            [
                'id_product' => 1,
                'id_order' => 2,
                'quantity' => 2,
                // 'type_order' => 'dine_in'
            ],
        ]);
    }
}
