<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Cart;
use Validator;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartProduct;
use Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        $cartItem =  Cart::add($product->id, $product->name, 1, $product->price);

        if (auth::check()) { //kullanıcı girişi yapmış kullanıcılar için çalışan kısım veritabanına sepet eklemesini yapar.
            $active_shoppingcart_id = session('active_shoppingcart_id');
            if (!isset($active_shoppingcart_id)) {
                $active_shoppingcart = ShoppingCart::create([
                    'user_id' => auth()->id()
                ]);
                $active_shoppingcart_id = $active_shoppingcart->id;
                session()->put('active_shoppingcart_id', $active_shoppingcart_id);
            }
        ShoppingCartProduct::updateOrCreate( //ilk paremetredeki değerler epğer m-m tablosunda varsa ikinci paremetredikler gibi günceller eğer yoksa ilk vew ikinci paremetreler ile bir satır oluşturur.
            ['shoppingcart_id'=>$active_shoppingcart_id,'product_id'=>$product->id],
            [ 'count'=>$cartItem->qty,'price'=>$product->price,'status'=>'Beklemede']
        );

        }
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

    public function update($rowId)
    {

        $validator = Validator::make(request()->all(), [
            'count' => 'required|numeric|between:1,5'
        ]);

        if ($validator->fails()) {
            session()->flash('message_type', 'danger');
            session()->flash('message', 'Adet değeri 1 ile 5 arasında olmalıdır');
            return response()->json(['success' => false]);
        }

        Cart::update($rowId, request('count'));

        session()->flash('message_type', 'success');
        session()->flash('message', 'Adet bilgisi güncellendi');

        return response()->json(['success' => true]);
    }
}
