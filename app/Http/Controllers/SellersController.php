<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class SellersController extends Controller
{
    public function index()
    {
        $sellers = Order::with('shoppingcart')
        ->whereHas('shoppingcart',function($query){
            $query->where('user_id',auth()->id());
        })
        ->orderByDesc('created_at')->get();
        //üstteki with siparişler ile birlikte sepet bilgilerini de çekmektedir.
        /*
        public function shoppingcart(){ //Bu fonksiyon order modelinin içinde bulunmaktadır.
            return $this->belongsTo('App\Models\ShoppingCart');
        }
        */
        return view('sellers', compact('sellers'));
    }

    public function detail($id){
        $sellerDetail = Order::with('shoppingcart.shoppingcartProduct.product')
        ->whereHas('shoppingcart',function($query){
            $query->where('user_id',auth()->id());
        })
        ->where('order.id',$id)->first();
        return view('seller', compact('sellerDetail'));
    }

}
