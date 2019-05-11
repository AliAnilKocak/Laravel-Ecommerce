<?php

namespace App\Http\Controllers;

use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($slug_categoryname)
    {
        $category = Category::where('slug', $slug_categoryname)->firstOrFail();
        $sub_categories = Category::where('parent_id', $category->id)->get();
        $products = $category->products;
        return view('category', compact('category', 'sub_categories','products'));
    }
}
