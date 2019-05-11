<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class HomePageController extends Controller
{

    public function index()
    {
        $categories = Category::whereRaw('parent_id is null')->take(8)->get();
        //error_log($categories);
        return view('homePage', compact('categories'));
    }
}
