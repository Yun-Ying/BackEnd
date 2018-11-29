<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Level;
use App\Order;
use App\Product;
use App\Shoppingcart;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    //remain unused?
    public function store(Request $request)
    {
        Log::info($request->all());
        return response()->json([
            'success' => true,
        ]);
    }


    public function create(Request $request)
    {

        //get variable from request parameter

        $user_id = $request->input('user_id');

        $address = $request->input('address');

        $phone_number = $request->input('phone_number');

        $total_price = $request->input('total_price');

        //search the user in shopping cart to get what he has in his shopping cart
        $product_ids = array();

        $shoppingcarts = Shoppingcart::where('user_id', $user_id)->get();

        foreach ($shoppingcarts as $shoppingcart) {
            $temp  = $shoppingcart->product_id;
            array_push($product_ids, $temp);
        }

        //get quantities
        $quantites = array();

        foreach ($shoppingcarts as $shoppingcart) {
            $temp  = $shoppingcart->quantity;
            array_push($quantites, $temp);
        }

        //now we have quantities and product_ids

        //create new order
        //copy all value to order
        $order = new Order([
            'user_id' =>$user_id,
            'address' => $address,
            'phone_number' => $phone_number,
            'is_check' => false,
            'total_price' =>$total_price,
            'product_ids' => $product_ids,
            'quantities' => $quantites,
        ]);

        $order->save();

        //delete shoppingcart move must be done
        foreach ($shoppingcarts as $shoppingcart) {
            $shoppingcart->delete();
        }

        return response()->json([
            'message' => 'create order successful',
        ]);
    }

    //done
    public function debug_create($user_id)
    {

        $request = NULL;

        //get variable from request parameter

        //$user_id = $request->input('user_id');

        //$address = $request->input('address');
        $address = 'address';
        //$phone_number = $request->input('phone_number');
        $phone_number = '0909458930';
        //$total_price = $request->input('total_price');
        $total_price = 500;

        //search the user in shopping cart to get what he has in his shopping cart
        $product_ids = array();
        $shoppingcarts = Shoppingcart::where('user_id', $user_id)->get();

        foreach ($shoppingcarts as $shoppingcart) {
            $temp  = $shoppingcart->product_id;
            array_push($product_ids, $temp);
        }

        //get quantities
        $quantites = array();

        foreach ($shoppingcarts as $shoppingcart) {
            $temp  = $shoppingcart->quantity;
            array_push($quantites, $temp);
        }

        //now we have quantities and product_ids

        //create new order
        //copy all value to order
        $order = new Order([
            'user_id' =>$user_id,
            'address' => $address,
            'phone_number' => $phone_number,
            'is_check' => false,
            'total_price' =>$total_price,
            'product_ids' => $product_ids,
            'quantities' => $quantites,
        ]);

        $order->save();

        //delete shoppingcart move must be done
        //still remain undone as this is a debug mode

        dd($order);


    }


    public function show()
    {
        
    }


    public function debug_show($user_id)
    {
        //now you get a order array
        $user_orders = Order::where('user_id', $user_id)->get();

        $user_email = User::find($user_id)->email;
        $user_name = User::find($user_id)->name;

        $orders = array();

        foreach ($user_orders as $user_order)
        {
            //order_id
            $order_id = $user_order->id;

            //created_date
            $created_date = $user_order->created_at;

            //total_price
            $total_price = $user_order->total_price;

            //products array
            $products = array();
            $a = 0;
            foreach ($user_order->product_ids as $product_id)
            {
                $product = Product::find($product_id);
                $temp_product =[
                    "product_id" => $product->id,
                    "name" => $product->name,
                    "single_price" => $product->price,
                    "description" => $product->description,
                    "category_name" => Category::find($product->category_id)->name,
                    "level_name" => Level::find($product->level_id)->name,
                    "file_path" => $product->file_path,
                    "created_at" => $product->created_at,
                    "updated_at" => $product->updated_at,
                    "quantity" => $user_order->quantities[$a],
                    "total_price" => $user_order->quantities[$a] * $product->price,
                ];

                array_push($products, $temp_product);
                $a++;
            }

            //object created
            $temp_order = [
                'order_id' => $order_id,
                'created_date' =>$created_date,
                'total_price' => $total_price,
                'products' => $products,
            ];


            array_push($orders, $temp_order);

        }

        return response()->json([
            'user_name' => $user_name,
            'user_email' => $user_email,
            'orders' => $orders,
        ]);


    }

    public function index()
    {
        
    }

    public function debug_index()
    {
        
    }

    public function destroy()
    {
        
    }

    public function debug_destroy()
    {
        
    }
}
