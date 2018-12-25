<?php

    use App\Category;
    use App\Product;
    use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //reset category
        Category::truncate();
        $categoryNames = ["火遁", "水遁", "风遁", "土遁", "雷遁", "形态变化", "幻术", "体术", "通灵之术", "封印之术", "仙术", "属性融合", "瞳术", "血继淘汰", "血继钢罗", "无属性"];

        foreach($categoryNames as $name)
        {
            Category::create([
                'name' => $name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        //reset all current real products to their particular category which is previous+1(as we have insert a new default value);
        //but as default category id sets to 16, the code below are unused
//        $products = Product::all();
//
//        foreach ($products as $product)
//        {
//            $product->category_id = $product->category_id-1;
//            $product->save();
//        }
    }
}
