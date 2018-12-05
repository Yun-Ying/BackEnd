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

    //done
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

    //done test
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
        foreach ($shoppingcarts as $shoppingcart) {
            $shoppingcart->delete();
        }

        return response()->json([
            'message' => 'create order successful',
        ]);
    }

    //done
    public function show($user_id)
    {
        //now you get a order array
        $user_orders = Order::where('user_id', $user_id)->get();
        $orders = array();

        foreach ($user_orders as $order)
        {
            //user email
            $user_email = User::find($order->user_id)->email;

            //user name
            $user_name = User::find($order->user_id)->name;

            //order phone number
            $phone_number = $order->phone_number;

            //order address
            $address = $order->address;

            //is_checked
            $is_check = $order->is_check;

            //order_id
            $order_id = $order->id;

            //created_date
            $created_date = $order->created_at;

            //total_price
            $total_price = $order->total_price;

            //products array
            $products = array();
            $a = 0;
            foreach ($order->product_ids as $product_id)
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
                    "quantity" => $order->quantities[$a],
                    "total_price" => $order->quantities[$a] * $product->price,
                ];

                array_push($products, $temp_product);
                $a++;
            }

            //object created
            $temp_order = [
                'user_name' => $user_name,
                'user_email' => $user_email,
                'address' => $address,
                'phone_number'=> $phone_number,
                'is_checked' => $is_check,
                'order_id' => $order_id,
                'created_date' =>$created_date,
                'total_price' => $total_price,
                'products' => $products,

            ];


            array_push($orders, $temp_order);

        }

        return response()->json([
            'orders' => $orders,
        ]);
    }

    //done test
    public function debug_show($user_id)
    {
        //now you get a order array
        $user_orders = Order::where('user_id', $user_id)->get();

        $orders = array();

        foreach ($user_orders as $order)
        {
            //user email
            $user_email = User::find($order->user_id)->email;

            //user name
            $user_name = User::find($order->user_id)->name;

            //order_id
            $order_id = $order->id;

            //order phone number
            $phone_number = $order->phone_number;

            //order address
            $address = $order->address;

            //is_checked
            $is_check = $order->is_check;


            //created_date
            $created_date = $order->created_at;

            //total_price
            $total_price = $order->total_price;

            //products array
            $products = array();
            $a = 0;
            foreach ($order->product_ids as $product_id)
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
                    "quantity" => $order->quantities[$a],
                    "total_price" => $order->quantities[$a] * $product->price,
                ];

                array_push($products, $temp_product);
                $a++;
            }

            //object created
            $temp_order = [
                'user_name' => $user_name,
                'user_email' => $user_email,
                'address' => $address,
                'phone_number'=> $phone_number,
                'is_checked' => $is_check,
                'order_id' => $order_id,
                'created_date' =>$created_date,
                'total_price' => $total_price,
                'products' => $products,

            ];


            array_push($orders, $temp_order);

        }

        return response()->json([
            'orders' => $orders,
        ]);


    }

    //only for admin
    public function index()
    {
        $all_orders = Order::all();

        $orders = array();

        foreach ($all_orders as $order)
        {
            //user email
            $user_email = User::find($order->user_id)->email;

            //user name
            $user_name = User::find($order->user_id)->name;

            //order_id
            $order_id = $order->id;

            //order phone number
            $phone_number = $order->phone_number;

            //order address
            $address = $order->address;

            //is_checked
            $is_check = $order->is_check;

            //created_date
            $created_date = $order->created_at;

            //total_price
            $total_price = $order->total_price;

            //products array
            $products = array();
            $a = 0;
            foreach ($order->product_ids as $product_id)
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
                    "quantity" => $order->quantities[$a],
                    "total_price" => $order->quantities[$a] * $product->price,
                ];

                array_push($products, $temp_product);
                $a++;
            }

            //object created
            $temp_order = [
                'user_name' => $user_name,
                'user_email' => $user_email,
                'address' => $address,
                'phone_number'=> $phone_number,
                'is_checked' => $is_check,
                'order_id' => $order_id,
                'created_date' =>$created_date,
                'total_price' => $total_price,
                'products' => $products,

            ];


            array_push($orders, $temp_order);

        }

        return response()->json([
            'orders' => $orders,
        ]);
    }

    //only for admin
    //done test
    public function debug_index()
    {

        $all_orders = Order::all();

        $orders = array();

        foreach ($all_orders as $order)
        {
            //user email
            $user_email = User::find($order->user_id)->email;

            //user name
            $user_name = User::find($order->user_id)->name;

            //order_id
            $order_id = $order->id;

            //order phone number
            $phone_number = $order->phone_number;

            //order address
            $address = $order->address;

            //is_checked
            $is_check = $order->is_check;

            //created_date
            $created_date = $order->created_at;

            //total_price
            $total_price = $order->total_price;

            //products array
            $products = array();
            $a = 0;
            foreach ($order->product_ids as $product_id)
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
                    "quantity" => $order->quantities[$a],
                    "total_price" => $order->quantities[$a] * $product->price,
                ];

                array_push($products, $temp_product);
                $a++;
            }

            //object created
            $temp_order = [
                'user_name' => $user_name,
                'user_email' => $user_email,
                'address' => $address,
                'phone_number'=> $phone_number,
                'is_checked' => $is_check,
                'order_id' => $order_id,
                'created_date' =>$created_date,
                'total_price' => $total_price,
                'products' => $products,

            ];


            array_push($orders, $temp_order);

        }

        return response()->json([
            'orders' => $orders,
        ]);
    }

    //not done, since front end request not sure yet
    public function destroy(Order $order)
    {

        $order->delete();

        return response()->json([
            'message' => 'delete order successful',
        ]);
    }

    //done test
    public function debug_destroy($order_id)
    {
        $order = Order::find($order_id);

        $order->delete();

        return response()->json([
            'message' => 'delete order successful',
        ]);
    }
}
