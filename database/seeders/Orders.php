<?php

namespace Database\Seeders;

use Carbon\Carbon;
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

        $tgl = Carbon::now();
        $date = $tgl->toDateString();
        DB::table('orders')->insert([
            [
                // 'id_outlet' => 1,
                // 'id_order_status' => 1,
                'cashier' => 'Indra',
                'payment_method' => 'link aja',
                'customer' => 'eko',
                'total' => 10000,
                'paid' => 20000,
                'return' => 10000,
                'date_order' => $date,
            ],
            [
                // 'id_outlet' => 2,
                // 'id_order_status' => 1,
                'cashier' => 'Yanti',
                'payment_method' => 'link aja',
                'customer' => 'bambang',
                'total' => 20000,
                'paid' => 30000,
                'return' => 20000,
                'date_order' => $date,
            ],

        ]);
    }
}
