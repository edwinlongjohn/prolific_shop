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

    public function update(Request $request)
    {
       $id = $request->id;
       $quantity = $request->quantity;
       $cart = session()->get('cart');

       if(isset($cart[$id])){
            $cart[$id]['quantity'] = $quantity;
            session()->put('cart', $cart);
       }
       session()->flash('success','cart updated successfully');
    }

    public function deleteFromCart(Request $request)
    {
        $id = $request->id;
        $cart = session()->get('cart');
        if(isset($cart[$id])){
            unset($cart[$id]);
            session()->put('cart', $cart);
       }
       session()->flash('success','cart updated successfully');
    }

    public function checkout()
    {
        return view('user.checkout');
    }
}
