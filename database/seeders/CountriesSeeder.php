<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            0 => [
                'id' => 1,
                'code' => 'TR',
                'country' => 'Türkiye',
                'phonecode' => '+90',
            ]
        ]);
    }
}
