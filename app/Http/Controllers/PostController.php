<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index(){
            $name = 'yuna';
            return view('index', compact('name'));
    }
}
