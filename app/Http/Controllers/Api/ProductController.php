<?php

namespace App\Http\Controllers\Api;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id','DESC');
        $PP = $products->get();
        return response()->json($PP);
    }

    public function indexCategory($category_id)
    {
        if ($category_id == -7) {
            $products = Product::where('category_id', '<', 7)->get();
        }
        else if($category_id == -11) {
            $products = Product::where('category_id', '>', 11)->get();
        }
        else {
            $products = Product::where('category_id', $category_id)->get();
        }
        return response()->json($products);
    }

    public function indexCategoryPage($category_id, $list, $page, Request $request)
    {
        if($list == 'Grid') $quantity = 9;
        else $quantity = 5;
        $sortBy = $request->input('sortBy');
        $method = $request->input('method');
        $products = Product::orderBY($sortBy, $method);
        if ($category_id == -7) {
            $products = $products->where('category_id', '<', 7);
        }
        else if($category_id == -11) {
            $products = $products->where('category_id', '>', 11);
        }
        else {
            $products = $products->where('category_id', $category_id);
        }

        $products = $products->skip($page * $quantity)->take($quantity)->get();

        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
