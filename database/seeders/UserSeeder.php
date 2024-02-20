<?php

namespace Database\Seeders;

use App\Models\Kullanicilar\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            '0' => [
                'name' => 'Admin',
                'email' => 'admin@ciftcibilir.com',
                'tel_no' => '055555555555',
                'password' => Hash::make('12345678'),
            ]
        ]);

        User::find(1)->assignRole('Admin');
    }
}
