<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IlanResimleriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ilan_resimleri')->insert([
            0 => [
                'id' => 1,
                'ilan_id' => 1,
                'resim_yolu' => 'https://source.unsplash.com/random/?tractor/',
                'sira' => 1,
                'vitrin' => 1,
            ],
            1 => [
                'id' => 2,
                'ilan_id' => 1,
                'resim_yolu' => 'https://source.unsplash.com/random/?land/',
                'sira' => 2,
                'vitrin' => 0,
            ],
            2 => [
                'id' => 3,
                'ilan_id' => 1,
                'resim_yolu' => 'https://source.unsplash.com/random/?village/',
                'sira' => 3,
                'vitrin' => 0,
            ],
            3 => [
                'id' => 4,
                'ilan_id' => 1,
                'resim_yolu' => 'https://source.unsplash.com/random/?horse/',
                'sira' => 4,
                'vitrin' => 0,
            ],
            4 => [
                'id' => 5,
                'ilan_id' => 1,
                'resim_yolu' => 'https://source.unsplash.com/random/?chicken/',
                'sira' => 5,
                'vitrin' => 0,
            ],
            5 => [
                'id' => 6,
                'ilan_id' => 1,
                'resim_yolu' => 'https://source.unsplash.com/random/?chick/',
                'sira' => 6,
                'vitrin' => 0,
            ],
            6 => [
                'id' => 7,
                'ilan_id' => 1,
                'resim_yolu' => 'https://source.unsplash.com/random/?villager/',
                'sira' => 7,
                'vitrin' => 0,
            ],
            7 => [
                'id' => 8,
                'ilan_id' => 1,
                'resim_yolu' => 'https://source.unsplash.com/random/?fruit/',
                'sira' => 8,
                'vitrin' => 0,
            ],
            8 => [
                'id' => 9,
                'ilan_id' => 1,
                'resim_yolu' => 'https://source.unsplash.com/random/?vegetable/',
                'sira' => 9,
                'vitrin' => 0,
            ],
            9 => [
                'id' => 10,
                'ilan_id' => 1,
                'resim_yolu' => 'https://source.unsplash.com/random/?village-house/',
                'sira' => 10,
                'vitrin' => 0,
            ]
        ]);
    }
}
