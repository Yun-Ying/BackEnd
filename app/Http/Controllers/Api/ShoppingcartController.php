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
        Shoppingcart::create([
            'user_id' => $request->input('user_id'),
            'product_id' => $request->input('product_id')
        ]);
        return response()->json([
            'success' => true,
        ]);
    }

    public function fake_store(User $user, Product $product)
    {
        Shoppingcart::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);


        return response()->json([
            'success' => true,
        ]);
    }
    public function destroy(Request $request)
    {
        $user_id = $request->input('user_id');
        $product_id = $request->input('product_id');
        $shoppingcart_id = Shoppingcart::where('user_id', $user_id)->where('product_id', $product_id)->value('id');
        $shoppingcart = Shoppingcart::find($shoppingcart_id);
        $shoppingcart->delete();

        return response()->json([
            'success' => true,
        ]);
    }

    public function fake_destroy($user_id, $product_id)
    {


        $shoppingcart_id = Shoppingcart::where('user_id', $user_id)->where('product_id', $product_id)->value('id');
        $shoppingcart = Shoppingcart::find($shoppingcart_id);

        $shoppingcart->delete();

        return response()->json([
            'success' => true,
        ]);
    }
    //delete


    //order
    //post user_id,
    //shopping cart copy information

}
