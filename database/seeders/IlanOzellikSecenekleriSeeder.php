<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IlanOzellikSecenekleriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ilan_ozellik_secenekleri')->insert([
            0 => [
                'id' => 1,
                'ilan_id' => 1,
                'ozellik_id' => 2,
                'deger' => "TD110 BLUEMASTER"
            ],
            1 => [
                'id' => 2,
                'ilan_id' => 1,
                'ozellik_id' => 3,
                'deger' => "2017"
            ],
            2 => [
                'id' => 3,
                'ilan_id' => 1,
                'ozellik_id' => 4,
                'deger' => "Tarla Tipi"
            ],
            3 => [
                'id' => 4,
                'ilan_id' => 1,
                'ozellik_id' => 5,
                'deger' => "Klimalı Kabin"
            ],
            4 => [
                'id' => 5,
                'ilan_id' => 1,
                'ozellik_id' => 6,
                'deger' => "8 İleri - 8 Geri"
            ],
            5 => [
                'id' => 6,
                'ilan_id' => 1,
                'ozellik_id' => 7,
                'deger' => "800"
            ],
            6 => [
                'id' => 7,
                'ilan_id' => 1,
                'ozellik_id' => 8,
                'deger' => "4x4"
            ],
            7 => [
                'id' => 8,
                'ilan_id' => 1,
                'ozellik_id' => 9,
                'deger' => "6"
            ],
            8 => [
                'id' => 9,
                'ilan_id' => 1,
                'ozellik_id' => 10,
                'deger' => "250"
            ],
            9 => [
                'id' => 10,
                'ilan_id' => 1,
                'ozellik_id' => 11,
                'deger' => "Yok"
            ],
            10 => [
                'id' => 11,
                'ilan_id' => 1,
                'ozellik_id' => 12,
                'deger' => "40"
            ],
            11 => [
                'id' => 12,
                'ilan_id' => 1,
                'ozellik_id' => 13,
                'deger' => "80"
            ],
        ]);
    }
}
