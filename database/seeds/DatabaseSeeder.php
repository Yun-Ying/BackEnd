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
        //$this->call(ProductsTableSeeder::class);
        // $this->call(ShoppingCartTableSeeder::class);
        //$this->call(OrdersTableSeeder::class);
        //$this->call(UsersTableSeeder::class);
        //$this->call(CategoryTableSeeder::class);
        $this->call(AdvertisementTableSeeder::class);
    }
}
