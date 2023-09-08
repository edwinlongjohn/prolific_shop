<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('user.cart');
    }
    public function addToCart($id)
    {
       $product = Product::findOrFail($id);
       $cart = session()->get('cart', []);

       if(isset($cart[$id])){
            $cart[$id]['quantity']++;
       }else{
            $cart[$id] =[
                'name' => $product->title,
                'image' => $product->image,
                'price' => $product->price,
                'quantity' => 1,
            ];
       }

       session()->put('cart', $cart);
       //dd($cart);
       return back()->with(['success' => 'Product Added to cart successfully']);
    }

    public function removeFromCart(Request $request)
    {
        $id = $request->id;
        $cart = session()->get('cart');
        if(isset($cart[$id])){
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

       session()->flash('success', 'product removed successfully');
    }

    public function updateCart(Request $request)
    {
        $quantity = $request->quantity;
        $id = $request->id;
        $cart = session()->get('cart');
        if(isset($cart[$id])){
            $cart[$id]['quantity'] = $quantity;

            session()->put('cart', $cart);
        }
        session()->flash('cart updated successfully');
    }
}
