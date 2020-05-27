<?php

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
            VendorSeeder::class,
            ProductSeeder::class,
            PartnerSeeder::class,
            OrderSeeder::class,
            OrderProductSeeder::class
        ]);
    }
}
