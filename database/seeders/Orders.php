<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Orders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders')->insert([
            [
                'cashier' => 'Indra',
                'payment_method' => 'link aja',
                'customer' => 'eko',
                'total' => 10000,
                'paid' => 20000,
                'return' => 10000,
            ],
            [
                'cashier' => 'Yanti',
                'payment_method' => 'link aja',
                'customer' => 'bambang',
                'total' => 20000,
                'paid' => 30000,
                'return' => 20000,
            ],

        ]);
    }
}
