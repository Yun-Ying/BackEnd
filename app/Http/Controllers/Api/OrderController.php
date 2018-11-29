<?php

namespace App\Http\Controllers\Api;

use App\Order;
use App\Product;
use App\Shoppingcart;
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
        //still remain undone as this is a debug mode
        
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

    public function debug_show()
    {
        
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
