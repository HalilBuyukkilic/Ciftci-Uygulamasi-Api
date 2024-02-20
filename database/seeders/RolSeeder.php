<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            '0' => [
                'name' => 'Admin',
                'guard_name' => 'api'
            ],
            '1' => [
                'name' => 'Kullanici',
                'guard_name' => 'api'
            ]
        ]);
    }
}
