<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatus extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('order_status')->insert([
            [
                'name' => 'sukses',
                'created_by' => 0,
            ],
            [
                'name' => 'gagal',
                'created_by' => 0,
            ],
            [
                'name' => 'cart',
                'created_by' => 0
            ],
            [
                'name' => 'proses',
                'created_by' => 0
            ],
        ]);
    }
}
