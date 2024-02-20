<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OzellikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ozellikler')->insert([
            '0' => [
                'ozellik_adi' => 'Marka',
            ],
            '1' => [
                'ozellik_adi' => 'Model',
            ],
            '2' => [
                'ozellik_adi' => 'Model Yılı',
            ],
            '3' => [
                'ozellik_adi' => 'Tipi',
            ],
            '4' => [
                'ozellik_adi' => 'Kabin',
            ],
            '5' => [
                'ozellik_adi' => 'Vites',
            ],
            '6' => [
                'ozellik_adi' => 'Motor Gücü (HP)',
            ],
            '7' => [
                'ozellik_adi' => 'Çekiş Tipi',
            ],
            '8' => [
                'ozellik_adi' => 'Silindir Sayısı',
            ],
            '9' => [
                'ozellik_adi' => 'Çalışma Saati',
            ],
            '10' => [
                'ozellik_adi' => 'Ön Yükleyici Kepçe',
            ],
            '11' => [
                'ozellik_adi' => 'Ön Lastik (%)',
            ],
            '12' => [
                'ozellik_adi' => 'Arka Lastik (%)',
            ],
            '13' => [
                'ozellik_adi' => 'Türü',
            ],
            '14' => [
                'ozellik_adi' => 'Ürün',
            ],
            '15' => [
                'ozellik_adi' => 'Motor Gücü',
            ],
            '16' => [
                'ozellik_adi' => 'Yakıt Tipi',
            ],
            '17' => [
                'ozellik_adi' => 'Kulak Sayısı',
            ],
            '18' => [
                'ozellik_adi' => 'Tarım Makinesi',
            ],
            '19' => [
                'ozellik_adi' => 'Haşbay',
            ],
            '20' => [
                'ozellik_adi' => 'İp Sayısı',
            ],
            '21' => [
                'ozellik_adi' => 'Makine',
            ],
            '22' => [
                'ozellik_adi' => 'Makine Tipi',
            ],
            '23' => [
                'ozellik_adi' => 'Tekerlek',
            ],
            '24' => [
                'ozellik_adi' => 'Damper (Var/Yok)',
            ],
            '25' => [
                'ozellik_adi' => 'Parça Grubu',
            ],
            '26' => [
                'ozellik_adi' => 'İmar Durumu',
            ],
            '27' => [
                'ozellik_adi' => 'm²',
            ],
            '28' => [
                'ozellik_adi' => 'Ada No',
            ],
            '29' => [
                'ozellik_adi' => 'Parsel No'
            ],
            '31' => [
                'ozellik_adi' => 'Kaks (Emsal)'
            ],
            '32' => [
                'ozellik_adi' => 'Gabari'
            ],
            '33' => [
                'ozellik_adi' => 'Tapu Durumu'
            ],
            '34' => [
                'ozellik_adi' => 'Kat Karşılığı'
            ],
            '35' => [
                'ozellik_adi' => 'Krediye Uygunluk'
            ],
            '36' => [
                'ozellik_adi' => 'Takaslı'
            ],
            '37' => [
                'ozellik_adi' => 'Depozito'
            ],
        ]);

    }
}
