<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $table->string('name');
        // $table->string('role');
        // $table->string('email')->unique();
        // // $table->timestamp('email_verified_at')->nullable();
        // $table->string('password');
        // $table->string('phone');
        // $table->string('image');
        // $table->string('created_by');
        // $table->rememberToken();
        // $table->timestamps();
        // User::create(
        //     [
        //         'name' => 'Admin',
        //         'sex' => 'l',
        //         'username' => 'admin',
        //         'roles' => 'admin',
        //         'email' => 'admin@admin.com',
        //         'password' => Hash::make('admin'),
        //         'phone' => '081212121212',
        //         'image' => 'gambar.png',
        //         'created_by' => 'admin',
        //         // ''
        //     ],
        //     [
        //         'name' => 'kulon',
        //         'sex' => 'l',
        //         'username' => 'kulon',
        //         'roles' => 'kulon',
        //         'email' => 'kulon@kulon.com',
        //         'password' => Hash::make('kulon'),
        //         'phone' => '081212121212',
        //         'image' => 'gambar.png',
        //         'created_by' => 'kulon',
        //         // ''
        //     ],
        // );

        DB::table('users')->insert([
            [
                'name' => 'admin',
                'sex' => 'l',
                'position' => 'manager',
                'username' => 'admin',
                'roles' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin'),
                'phone' => '081212121212',
                'image' => 'gambar.png',
                'created_by' => 1,
                // ''
            ],
            [
                'name' => 'kulon',
                'sex' => 'l',
                'position' => 'cashier',
                'username' => 'kulon',
                'roles' => 'kantin',
                'email' => 'kulon@kulon.com',
                'password' => Hash::make('kulon'),
                'phone' => '081212121212',
                'image' => 'gambar.png',
                'created_by' => 0,
                // ''
            ],
            [
                'name' => 'tes',
                'sex' => 'l',
                'position' => 'cashier',
                'username' => 'tes',
                'roles' => 'kantin',
                'email' => 'tes@tes.com',
                'password' => Hash::make('tes123123'),
                'phone' => '081212121212',
                'image' => 'gambar.png',
                'created_by' => 0,
                // ''
            ],
        ]);
    }
}
