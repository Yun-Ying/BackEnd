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
        // Shoppingcart::truncate();

        $minPrice = 20;
        $maxPrice = 1651684;
        $total = 50;

        foreach (range(1, $total) as $user_id) {
            Shoppingcart::create([
                'user_id' => rand(1, User::all()->count()),
                'product_id' => rand(1, Product::all()->count()),
                'quantity' => rand(1, 100),
                'price' => rand($minPrice, $maxPrice),
                'created_at' => now()->subDays($total - $user_id)->addHours(rand(1, 5))->addMinutes(rand(1, 5))->subDays(rand(0, 10)),
                'updated_at' => now()->subDays($total - $user_id)->addHours(rand(6, 10))->addMinutes(rand(10, 30))->subDays(rand(0, 10)),
            ]);
        }
    }
}
