<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetails;

class HomePageController extends Controller
{

    public function index()
    {
        $categories = Category::whereRaw('parent_id is null')->take(8)->get();
        //error_log($categories);
        $products_slider = ProductDetails::with('product')->where('show_slider', 1)->take(5)->get();
        //error_log($categories);

        $product_day_opportunity = Product::select('product.*')
            ->join('product_detail', 'product_detail.product_id', 'product.id')
            ->where('product_detail.show_day_opportunity', 1)
            ->orderBy('updated_at', 'desc')
            ->first();

        $products_featured =  Product::select('product.*')
            ->join('product_detail', 'product_detail.product_id', 'product.id')
            ->where('product_detail.show_featured', 1)
            ->orderBy('updated_at', 'desc')
            ->take(4)
            ->get();

        $products_bestselling = Product::select('product.*')
        ->join('product_detail', 'product_detail.product_id', 'product.id')
        ->where('product_detail.show_bestselling', 1)
        ->orderBy('updated_at', 'desc')
        ->take(4)
        ->get();

        $products_reduced = Product::select('product.*')
        ->join('product_detail', 'product_detail.product_id', 'product.id')
        ->where('product_detail.show_reduced', 1)
        ->orderBy('updated_at', 'desc')
        ->take(4)
        ->get();

        return view('homePage', compact(
            'categories',
            'products_slider',
            'product_day_opportunity',
            'products_featured',
            'products_bestselling',
            'products_reduced'
        ));
    }
}
