<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
      return view('admin.dashboard');
    }
    public function createProduct()
    {
      return view('admin.add-product');
    }
}
