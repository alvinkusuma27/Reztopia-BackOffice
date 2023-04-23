<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class note_cart extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('note_cart')->insert([
            [
                'note' => 'tidak ada'
            ],
            [
                'note' => 'tidak ada'
            ],
        ]);
    }
}
