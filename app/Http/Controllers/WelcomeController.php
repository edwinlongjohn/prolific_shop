<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index() {
        //$products = Product::latest()->get();
        //$products = Product::orderBy('name', 'asc')->get();
        //$products = Product::latest()->take(200)->get();
        //$products = Product::first();
        //dd($products);
         //$products = Product::orderBy('name', 'desc')->get();
        //$products = Product::where('category_id', 2)->get();
        $products = Product::latest()->take(200)->get();
        return view('welcome', ['products' => $products]);
    }

    public function viewProduct($id)
    {
        $product = Product::find($id);
        return view('product-details', compact('product'));
    }





}
