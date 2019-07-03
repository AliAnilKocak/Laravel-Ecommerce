<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class PayController extends Controller
{
    public function index()
    {

        if (!auth()->check()) {//Bu kontrolu we.php içinde de yapabilirdik ama burada with ile bir uyarı mesajı gönderdik.
            return redirect()->route('user.login')
                ->with('message_type', 'info')
                ->with('message', 'Ödeme yapabilmeniz için giriş yapmanız veya kaydolmanız gerekmektedir.');
        }
        else if(count(Cart::content()) == 0){
            return redirect()->route('homepage')
            ->with('message_type', 'info')
            ->with('message', 'Ödeme işlemi için sepetinizde en az bir ürün bulunmalıdır.');
        }


        return view('pay');
    }
}
