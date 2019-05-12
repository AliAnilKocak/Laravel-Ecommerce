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
        $order = request('order'); //veya request()->input() veya request()->query()

        if ($order == 'mostsellers') {
            $products = $category->products()
            ->distinct()
            ->join('product_detail','product_detail.product_id','product.id')
            ->orderBy('product_detail.show_bestselling','desc')
            ->paginate(2);
        } else if ($order == 'featured') {
            $products = $category->products()
            ->distinct()
            ->join('product_detail','product_detail.product_id','product.id')
            ->orderBy('product_detail.show_featured','desc') //orderByDesc de kullanılabilir.
            ->paginate(2);
         } else {
            $products = $category->products()->paginate(2);
        }

        return view('category', compact('category', 'sub_categories', 'products'));
    }
}
