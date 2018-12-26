<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Product;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::orderBy('id', 'ASC')->where('id', '>', 16)->get();

        return response()->json($categories);
    }

}
