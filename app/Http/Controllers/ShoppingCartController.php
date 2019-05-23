<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Cart;

class ShoppingCartController extends Controller
{
    //Bu şekilde de route içinde olmadan controller içerisinden de auth middleware tanımlaması yapılabilir.
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index()
    {
        return view('sepet');
    }

    public function add()
    {
        $product = Product::find(request('id'));
        error_log($product);
        Cart::add($product->id, $product->name, 1, $product->price);
        return redirect()->route('shoppingcart')
            ->with('message', 'Ürün sepete eklenddi')
            ->with('message_type', 'success');
    }


    public function remove($rowId)
    {
        Cart::remove($rowId);
        return redirect()->route('shoppingcart')
            ->with('message', 'Ürün sepetten kaldırıldı.')
            ->with('message_type', 'success');
    }
    public function remove_all()
    {
        Cart::destroy();
        return redirect()->route('shoppingcart')
            ->with('message', 'Sepet boşaltıldı..')
            ->with('message_type', 'success');
    }
}
