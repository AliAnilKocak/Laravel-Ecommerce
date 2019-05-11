<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($slug_productname){
        return view('product');
    }
}
