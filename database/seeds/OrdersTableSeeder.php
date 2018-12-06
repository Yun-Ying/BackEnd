<?php

    use App\Order;
    use App\Product;
    use App\User;
    use Illuminate\Database\Seeder;
use Faker\Factory;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //reset order
        // Order::truncate();

        $minPrice = 200;
        $maxPrice = 16584;
        $total = 50;

        $faker = Factory::create();


        foreach (range(1, $total) as $i) {

            //generate products_ids and quantities array
            $product_ids = array();
            $quantities = array();

            foreach(range(1, rand(1, 20)) as $unused)
            {
                array_push($product_ids, rand(1, Product::all()->count()));
                array_push($quantities, rand(1, 20));
            }

            Order::create([
                'user_id' => rand(1, User::all()->count()),
                'address' => $faker->address,
                'phone_number' => '09' .rand(10000000, 99999999),
                'is_check' => $faker->boolean(50),
                'total_price' => rand($minPrice, $maxPrice),
                'product_ids' => $product_ids,
                'quantities' => $quantities,
                'created_at' => now()->subDays($total - $i)->addHours(rand(1, 5))->addMinutes(rand(1, 5))->subDays(rand(5, 20)),
                'updated_at' => now()->subDays($total - $i)->addHours(rand(6, 10))->addMinutes(rand(10, 30))->subDays(rand(6, 12)),
            ]);
        }

    }
}
