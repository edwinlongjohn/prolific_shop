<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart($id)
    {
        //dd('i got here');
        $product = Product::find($id);
        $cart = session()->get('cart', []);
       
        
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'identity' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return back()->with(['success' => "product added to cart successfully"]);
    }
    public function viewCartItems()
    {
        return view('user.cart');
    }
}
