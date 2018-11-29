<?php

    use App\Shoppingcart;
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
        //
        foreach (range(1, 50) as $user_id) {
            Shoppingcart::create([
                'user_id' => rand(1, 15),
                'product_id' => rand(1, 300),
                'quantity' => rand(1, 10),
            ]);
        }
    }
}
