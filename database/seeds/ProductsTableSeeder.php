<?php

use App\Category;
    use App\Level;
    use App\Product;
    use Faker\Factory;
    use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //reset product
        // Product::truncate();

        $faker = Factory::create('zh_TW');
        $total = 20;


        foreach (range(1, $total) as $id) {
            Product::create([
                'name' => $faker->realText(rand(10, 15)),
                'price' => rand(20, 10000),
                'description' => $faker->realText(rand(100, 200)),
                'category_id' => rand(1, Category::all()->count()),
                'level_id' => rand(1, Level::all()->count()),
                'created_at' => now()->subDays($total - $id)->addHours(rand(1, 5))->addMinutes(rand(1, 5)),
                'updated_at' => now()->subDays($total - $id)->addHours(rand(6, 10))->addMinutes(rand(10, 30)),
                ]);
        }
    }
}
