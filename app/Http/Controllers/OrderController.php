<?php

namespace App\Http\Controllers;

use App\Order;
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
//        $categories = Category::all();

        // dd($order->is_check);
        if($order->is_check === 0) $order->is_check =1;
        else $order->is_check = 0;

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

    public function show()
    {
        return "show page!\n";
    }
}