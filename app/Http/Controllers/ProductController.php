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

        $data = [
            'category_id' => 0,
            'sortBy' => 'id',
            'sortMethod' => 'ASC',
            'page' => 0
        ];

        //set default
        return $this->pagging($data);
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
        $temProduct->level = $temProduct->Level->name;
        $temProduct->category = $temProduct->Category->name;

        $temProduct->save();



        //get the id of current product
        $id = $temProduct->id;
        $file_path = 'storage/products/default.png';
        // do the save process
        if ($request->hasFile('file')) {
            $name = $id;
            $request->file('file')->storeAs('public/products', $name.'.jpg');
            $file_path = 'storage/products/'.$name.'.jpg';
        }
        $tempProduct = Product::find($id);
        $tempProduct->file_path = $file_path;
        $tempProduct->save();

        $data = [
            'category_id' => 0,
            'sortBy' => 'id',
            'sortMethod' => 'ASC',
            'page' => 0
        ];

        return redirect()->route('products.pagging', $data);
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
        $levels = Level::all();

        $data = [
            'categories' => $categories,
            'levels' => $levels,
            'product' => $product,
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
            'description' => 'required',
        ]);

        //get the id of current product
        $id = $product->id;

        $file_path = $product->file_path;
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        $product->level_id = $request->input('level_id');
        $product->level = $product->Level->name;
        $product->category = $product->Category->name;

        // do the save process
        if ($request->hasFile('file')) {
            $name = $id;

            $request->file('file')->storeAs('public/products', $name.'.jpg');

            $file_path = 'storage/products/'.$name.'.jpg';
        }

        $product->file_path = $file_path;

        $product->save();

        $data = [
            'category_id' => 0,
            'sortBy' => 'id',
            'sortMethod' => 'ASC',
            'page' => 0
        ];

        return redirect()->route('products.pagging', $data);
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

        $data = [
            'category_id' => 0,
            'sortBy' => 'id',
            'sortMethod' => 'ASC',
            'page' => 0
        ];

        return redirect()->route('products.pagging', $data);
}

    //sort and pagging
    public function pagging(Request $request)
    {
        $category_id = $request->input('category_id');
        $sortBy = $request->input('sortBy');
        $sortMethod = $request->input('sortMethod');
        $page = $request->input('page');
        if($category_id == 0) {
            $products = Product::orderBy($sortBy, $sortMethod);
        }
        else {
            $products = Product::orderBy('id', $sortMethod)
                ->where('category_id', $category_id);
        }
        $total_pages = $products->get()->count() / 10;
        $products = $products
            ->skip($page*10)
            ->take(10)
            ->get();
        $categories = Category::all();

        $data = [
            'category_id' => $category_id,
            'sortBy' => $sortBy,
            'sortMethod' => $sortMethod,
            'categories' => $categories,
            'products' => $products,
            'total_pages' => $total_pages,
        ];

        return view('products.index', $data);
    }
}
