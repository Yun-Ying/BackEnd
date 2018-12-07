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

        //$allProducts = Product::all();
        //reset product
         //Product::truncate();

//         foreach($allProducts as $product){
//             $product->level = $product->Level->name;
//             $product->category = $product->Category->name;
//             $product->save();
//         }



        $faker = Factory::create('zh_TW');
        $total = 20;

        foreach (range(1, $total) as $id) {
            $category_id = rand(1, Category::all()->count());
            $level_id = rand(1, Level::all()->count());
            $level = Level::find($level_id)->name;
            $category = Category::find($category_id)->name;
            Product::create([
                'name' => $faker->realText(rand(10, 15)),
                'price' => rand(20, 200),
                'description' => $faker->realText(rand(100, 200)),
                'category_id' => $category_id,
                'category' => $category,
                'level_id' => $level_id,
                'level' => $level,
                'file_path' => 'storage/products/default.png',
                'created_at' => now()->subDays($total - $id)->addHours(rand(1, 5))->addMinutes(rand(1, 5)),
                'updated_at' => now()->subDays($total - $id)->addHours(rand(6, 10))->addMinutes(rand(10, 30)),
                ]);
        }


    }
}
