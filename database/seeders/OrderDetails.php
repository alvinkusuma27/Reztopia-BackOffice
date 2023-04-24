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
                'product' => "nabati",
                // 'id_order' => 2,
                'quantity' => 2,
                'price' => 10000,
                'discount' => 1000,
                'add_on_price' => 1000,
                'varian_price' => 1000,
                'subtotal' => 3000
            ],
            [
                'product' => "momogi",
                // 'id_order' => 2,
                'quantity' => 3,
                'price' => 20000,
                'discount' => 2000,
                'add_on_price' => 2000,
                'varian_price' => 2000,
                'subtotal' => 6000
            ],
        ]);
    }
}
