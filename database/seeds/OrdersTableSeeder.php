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
        //Order::truncate();
        $total = 50;

        $faker = Factory::create();
        foreach (range(1, $total) as $i) {

            //generate products_ids and quantities array
            $product_ids = array();
            $quantities = array();

            foreach(range(1, rand(1, 20)) as $unused)
            {
                array_push($product_ids, rand(1, 300));
                array_push($quantities, rand(1, 10));
            }

            Order::create([
                'user_id' => rand(1, User::all()->count()),
                'address' => $faker->address,
                'phone_number' => '09' .rand(10000000, 99999999),
                'is_check' => $faker->boolean(50),
                'total_price' => 0,
                'product_ids' => $product_ids,
                'quantities' => $quantities,
                'created_at' => now()->subDays($total - $i)->addHours(rand(1, 5))->addMinutes(rand(1, 5))->subDays(rand(5, 20))->subMonths(rand(0, 12)),
                'updated_at' => now()->subDays($total - $i)->addHours(rand(6, 10))->addMinutes(rand(10, 30))->subDays(rand(6, 12))->subMonths(rand(0, 12)),
            ]);
        }
        $orders = Order::all();
        foreach($orders as $order) {
            $price = 0;
            for($i = 0; $i < Count($order->product_ids); $i++){
                $pro = Product::find($order->product_ids[$i]);
                //$pro = $order->products()->where('id',$order->product_ids[$i])->get();
                $price += $pro->price *  $order->quantities[$i];
            }
            $order->total_price = $price;
            $order->save();
        }
    }
}
