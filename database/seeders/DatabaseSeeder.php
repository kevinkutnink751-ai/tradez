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
             MarketAssetsSeeder::class,
             TradingPairsSeeder::class,
         ]);

         \App\Models\Adverts::factory(7)->create();
    }
}
