<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function create()
    {
        return view('orders.create');
    }
    
    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->get();

        $data = [
            'orders' => $orders,
        ];

        return view('orders.index', $data);
    }



    public function edit(Order $order)
    {
        $data = [
            'order' => $order,
        ];

        return view('orders.edit', $data);
    }

    public function check(Order $order)
    {
//        $categories = Category::all()
        // dd($order->is_check);
        $user = User::where('id', $order->user_id)->first();
        if($order->is_check === 0) {
            $order->is_check =1;
            $user->exp += $order->total_price;
        }
        else {
            $order->is_check = 0;
            $user->exp -= $order->total_price;
        }
        $user->save();
        $order->save();


        return redirect()->route('orders.index');
    }

    public function destroy(Order $order)
    {
        //delete the image of the products with the path
        $order->delete();

        return redirect()->route('orders.index');
    }

    public function update(Request $request, Order $order)
    {
//        $this->validate($request, [
//            'name' => 'required',
//            'price' => 'required|integer',
//            'unit' => 'required',
//            'description' => 'required',
//        ]);

        $order->update($request->all());

        return redirect()->route('orders.index');
    }
    
    public function store(Request $request)
    {

    }

    public function show(Order $order)
    {
        $items = array();


        for($i=0; $i<count($order->product_ids); $i++)
        {
            $product = Product::find($order->product_ids[$i]);


            $item = [
                'name' => $product->name,
                'id' => $product->id,
                'file_path' => $product->file_path,
                'price' => $product->price,
                'quantity' => $order->quantities[$i],
                'total' => $product->price * $order->quantities[$i],
            ];

            array_push($items, $item);
        }


        $data = [
            'order' => $order,
            'items' => $items,
        ];


        return view('orders.detail', $data);
    }
}
