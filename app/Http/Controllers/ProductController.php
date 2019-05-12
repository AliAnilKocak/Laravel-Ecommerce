<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($slug_productname)
    {
        $product = Product::whereSlug($slug_productname)->firstOrFail();
        $categories = $product->categories()->distinct()->get();
        return view('product', compact('product', 'categories'));
    }

    public function search()
    {
        //request()->only('searched','sdfs','sdf','sdf'); sadece bunları getir.  Form query() query satırını getirir.
        //request()->exception('searched','sdfd'); //bunlar dışındakileri getir. Form all() hepsini getirir.

        $searched = request()->input('searched'); //formun içindeki veriyi alıyor.
        error_log($searched);
        $products = Product::where('name', 'like', "%$searched%")->orWhere('description', 'like', "%$searched%")->paginate(8);
        error_log($products);
        request()->flash();
        return view('search', compact('products'));
    }
}
