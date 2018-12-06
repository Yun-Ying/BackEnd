<?php

namespace App\Http\Controllers\Api;

use App\Product;
use App\Shoppingcart;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShoppingcartController extends Controller
{
    //
    public function index(Request $request)
    {
        $user_id = $request->input('user_id');
        $shoppingcarts = Shoppingcart::where('user_id', $user_id)->get();
        $products = array();
        foreach ($shoppingcarts as $shoppingcart) {
            $temp  = Product::find($shoppingcart->product_id);
            array_push($products, $temp);
        }
        return response()->json($products);
    }
    public function fake_index($user_id)
    {

        $shoppingcarts = Shoppingcart::where('user_id', $user_id)->get();

        // dd($shoppingcarts[0]->user_id);

        $products = array();

        foreach ($shoppingcarts as $shoppingcart) {
            $temp  = Product::find($shoppingcart->product_id);
            array_push($products, $temp);
        }

        //dd($products);

        return response()->json($products);
    }

    public function store(Request $request)
    {
        $user_id = $request->input('user_id');
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');
        $product_price = Product::where('id', $product_id)->value('price');
        Shoppingcart::create([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'quantity' => $quantity,
            'price' => $product_price * $quantity
        ]);
        return response()->json([
            'success' => true,
        ]);
    }
    public function fake_store(User $user, Product $product, $quantity)
    {
        Shoppingcart::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'price' => $product->price * $quantity
        ]);
        return response()->json([
            'success' => true,
        ]);
    }

    public function destroy(Shoppingcart $shoppingcart)
    {
        //$user_id = $request->input('user_id');
        //$product_id = $request->input('product_id');
        //$shoppingcart_id = Shoppingcart::where('user_id', $user_id)->where('product_id', $product_id)->value('id');
        //$shoppingcart = Shoppingcart::find($shoppingcart_id);
        //$shoppingcart->delete();
        $shoppingcart->delete();
        return response()->json([
            'success' => true,
        ]);
    }
    public function fake_destroy($shoppingcart_id)
    {


        //$shoppingcart_id = Shoppingcart::where('user_id', $user_id)->where('product_id', $product_id)->value('id');
        $shoppingcart = Shoppingcart::find($shoppingcart_id);

        $shoppingcart->delete();

        return response()->json([
            'success' => true,
        ]);
    }

    public function show($user_id)
    {
        $shoppingcarts = Shoppingcart::where('user_id', $user_id)->get();
        $products = array();
        foreach ($shoppingcarts as $shoppingcart) {
            //$temp  = Product::find($shoppingcart->product_id);
            $temp = $shoppingcart->product;
            $temp_product =[
                "id" => $shoppingcart->id,
                "product_id" => $temp->id,
                "product_name" => $temp->name,
                "file_path" => $temp->file_path,
                'quantity' => $shoppingcart->quantity,
                'price' => $temp->price,
                "total_price" => $shoppingcart->price,
            ];
            //$temp  = Product::find($shoppingcart->product_id);
            array_push($products, $temp_product);
        }
        return response()->json($products);
    }
    public function show_debug($user_id)
    {
        $shoppingcarts = Shoppingcart::where('user_id', $user_id)->get();
        $products = array();
        foreach ($shoppingcarts as $shoppingcart) {
            $temp  = Product::find($shoppingcart->product_id);
            $temp_product =[
                "shoppingcart_id" => $shoppingcart->id,
                "product_id" => $temp->id,
                "product_name" => $temp->name,
                "product_description" => $temp->description,
                "category_id" => $temp->category_id,
                "level_id" => $temp->level_id,
                "file_path" => $temp->file_path,
                'quantity' => $shoppingcart->quantity,
                "total_price" => $shoppingcart->price,
            ];
            //$temp  = Product::find($shoppingcart->product_id);
            array_push($products, $temp_product);
        }
        return response()->json($products);
    }

    public function update(Request $request)
    {
        $shoppingcart_id = $request->input('shoppingcart_id');
        $quantity = $request->input('quantity');
        $shoppingcart = Shoppingcart::find($shoppingcart_id);
        $product_price = $shoppingcart->product->price;
        $shoppingcart->update([
            'quantity' => $quantity,
            'price' => $product_price * $quantity
        ]);
        return response()->json($shoppingcart);
    }
    public function fake_update(User $user, Product $product, $quantity)
    {
        $shoppingcart_id = Shoppingcart::where('user_id', $user->id)->where('product_id', $product->id)->value('id');
        $shoppingcart = Shoppingcart::find($shoppingcart_id);
        $shoppingcart->update([
            'quantity' => $quantity,
            'price' => $product->price * $quantity
        ]);
        return response()->json($shoppingcart);
    }
    //delete


    //order
    //post user_id,
    //shopping cart copy information

}
