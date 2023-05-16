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
        $tgl2 = Carbon::now();
        $date = $tgl->toDateString();
        $yesterday = $tgl->subMonth()->toDateString();
        $tommorow = $tgl2->addMonth()->toDateString();

        DB::table('orders')->insert([
            [
                'id_outlet' => 2,
                'id_order_status' => 1,
                // 'id_order_detail' => 1,
                'id_category' => 1,
                'id_user' => 3,
                'cashier' => 'Indra',
                'payment_method' => 'link aja',
                'order_type' => 'dine_in',
                'payment_code' => "1234123",
                'table_number' => 21,
                'total' => 10000,
                'paid' => 20000,
                'return' => 10000,
                'date_order' => $yesterday,
            ],
            [
                'id_outlet' => 2,
                'id_order_status' => 1,
                // 'id_order_detail' => 2,
                'id_category' => 1,
                'id_user' => 3,
                'cashier' => 'Yanti',
                'payment_method' => 'link aja',
                'order_type' => 'dine_in',
                'payment_code' => "1234123",
                'table_number' => 21,
                'total' => 20000,
                'paid' => 30000,
                'return' => 20000,
                'date_order' => $date,
            ],
            [
                'id_outlet' => 2,
                'id_order_status' => 1,
                // 'id_order_detail' => 3,
                'id_category' => 2,
                'id_user' => 3,
                'cashier' => 'Yanti',
                'payment_method' => 'link aja',
                'order_type' => 'dine_in',
                'payment_code' => "1234123",
                'table_number' => 21,
                'total' => 20000,
                'paid' => 30000,
                'return' => 20000,
                'date_order' => $tommorow,
            ],
            [
                'id_outlet' => 2,
                'id_order_status' => 1,
                // 'id_order_detail' => 4,
                'id_category' => 2,
                'id_user' => 3,
                'cashier' => 'Yanti',
                'payment_method' => 'link aja',
                'order_type' => 'dine_in',
                'payment_code' => "1234123",
                'table_number' => 21,
                'total' => 20000,
                'paid' => 30000,
                'return' => 20000,
                'date_order' => $tommorow,
            ],
            [
                'id_outlet' => 2,
                'id_order_status' => 1,
                // 'id_order_detail' => 5,
                'id_category' => 2,
                'id_user' => 3,
                'cashier' => 'Yanti',
                'payment_method' => 'link aja',
                'order_type' => 'dine_in',
                'payment_code' => "1234123",
                'table_number' => 21,
                'total' => 20000,
                'paid' => 30000,
                'return' => 20000,
                'date_order' => $tommorow,
            ],
        ]);
    }
}
