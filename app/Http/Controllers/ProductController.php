<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'features' => 'required|string',
            'image' => 'required',
            'category_id' => 'required|integer',
        ]);


        $image = $request->image;
        $ext = $image->extension();
        $imageName = time() . '.' . $ext;
        $image->storeAs('/public/product_display_images', $imageName);

        //dd($request->gallery);
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->image = $imageName;
        $product->features = $request->features;
        $product->category_id = $request->category_id;
        $product->save();

        foreach ($request->gallery as $img) {
            $ext = $img->extension();
            $imageName = time() . uniqid() . '.' . $ext;
            $img->storeAs('/public/product_images', $imageName);

            $productImage = new ProductImage();
            $productImage->name = $imageName;
            $productImage->product_id = $product->id;
            $productImage->save();
        }

        return back()->with(['success' => 'Product Created successfully']);
    }

    public function viewProducts()
    {
        $products = Product::latest()->take(200)->get();
        return view('admin.view-products', ['products' => $products]);
    }

    public function productDetails($id)
    {
        $product = Product::find($id);
        return view('admin.product-details', ['product' => $product]);
    }

    public function edit($name, $id)
    {
        $product = Product::find($id);
        $categories = Category::orderBy('name', 'asc')->get();

        return view('admin.edit-product', compact('product', 'categories'));
    }

    public function submitEdittedProduct(Request $request, Product $product)
    {


        $product->update($request->all());
        if ($request->file('image')) {
            $image = $request->image;
            $ext = $image->extension();
            $imageName = time() . '.' . $ext;
            $image->storeAs('/public/product_display_images', $imageName);
            //removing image from storage folder

            $image_path = public_path().'/storage/product_display_images/'.$product->image;
            unlink($image_path);
            //storing image to database
            $product->image = $imageName;
            $product->save();
        }

        return back()->with(['success' => 'product updated successfully']);
    }
}
