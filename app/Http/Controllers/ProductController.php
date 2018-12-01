<?php

namespace App\Http\Controllers;

use App\Category;
use App\Level;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->get();

        $data = [
            'products' => $products,
        ];

        return view('products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $levels = Level::all();

        $data = [
            'categories' => $categories,
            'levels' => $levels,
        ];



        return view('products.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|integer',
            'description' => 'required',
        ]);

        $temProduct = new Product([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'price' => $request->input('price'),
            'level_id' => $request->input('level_id'),
            'description' => $request->input('description'),
        ]);

        $temProduct->save();

        //get the id of current product
        $id = $temProduct->id;
        $file_path = '';


        // do the save process
        if ($request->hasFile('file')) {
            $name = $id;

            $request->file('file')->storeAs('public/products', $name.'.jpg')    ;

            $file_path = 'storage/products/'.$name.'.jpg';
        }


        $tempProduct = Product::find($id);

        $tempProduct->file_path = $file_path;

        $tempProduct->save();



        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        $data = [
            'product' => $product,
            'categories' => $categories,
        ];

        return view('products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|integer',
            'unit' => 'required',
            'description' => 'required',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //delete the image of the products with the path
        Storage::delete('public/products/'.$product->id.'.jpg');

        $product->delete();

        return redirect()->route('products.index');
    }
}
