<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
      return view('admin.dashboard');
    }
    public function createProduct()
    {
      $categories = Category::all();
      return view('admin.add-product', compact('categories'));
    }
}
