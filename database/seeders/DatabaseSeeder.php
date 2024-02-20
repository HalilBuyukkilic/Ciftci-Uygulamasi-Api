<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolSeeder::class,
            UserSeeder::class,
            KategoriSeeder::class,
            OzellikSeeder::class,
            KategoriOzellikSeeder::class,
            OzellikSecenekSeeder::class,
            CountriesSeeder::class,
            CitiesSeeder::class,
            DistrictsSeeder::class,
            IlanSeeder::class,
            IlanResimleriSeeder::class,
            IlanOzellikSecenekleriSeeder::class,
        ]);
    }
}
