<?php

    use App\Product;
    use App\Shoppingcart;
    use App\User;
    use Illuminate\Database\Seeder;

class ShoppingCartTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        //reset shopping cart
        Shoppingcart::truncate();
        $total = 50;

        foreach (range(1, $total) as $user_id) {
            $quantity = rand(1, 100);
            $product_id = rand(1, 300);
            Shoppingcart::create([
                'user_id' => rand(1, User::all()->count()),
                'product_id' => $product_id,
                'quantity' => $quantity,
                'price' => 0,
                'created_at' => now()->subDays($total - $user_id)->addHours(rand(1, 5))->addMinutes(rand(1, 5))->subDays(rand(0, 10)),
                'updated_at' => now()->subDays($total - $user_id)->addHours(rand(6, 10))->addMinutes(rand(10, 30))->subDays(rand(0, 10)),
            ]);
        }
        $shoppingcarts = Shoppingcart::all();
        foreach($shoppingcarts as $shoppingcart){
            $shoppingcart->price =  $shoppingcart->product->price * $shoppingcart->quantity ;
            $shoppingcart->save();
        }
    }
}
