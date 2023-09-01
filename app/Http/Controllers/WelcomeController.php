<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index() {
        $products = Product::latest()->take(10)->get();
        return view('welcome', ['products' => $products]);
    }

    public function viewProduct($id)
    {
        $product = Product::find($id);
        return view('product-details', compact('product'));
    }





}
