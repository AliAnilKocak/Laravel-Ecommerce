<?php

namespace App\Http\Controllers;


use Cart;
use App\Models\Order;

class PayController extends Controller
{
    public function index()
    {

        if (!auth()->check()) { //Bu kontrolu we.php içinde de yapabilirdik ama burada with ile bir uyarı mesajı gönderdik.
            return redirect()->route('user.login')
                ->with('message_type', 'info')
                ->with('message', 'Ödeme yapabilmeniz için giriş yapmanız veya kaydolmanız gerekmektedir.');
        } else if (count(Cart::content()) == 0) {
            return redirect()->route('homepage')
                ->with('message_type', 'info')
                ->with('message', 'Ödeme işlemi için sepetinizde en az bir ürün bulunmalıdır.');
        }

        $user_detail = auth()->user()->detail;


        return view('pay', compact('user_detail'));
    }


    public function startPay()
    {
        $order = request()->all();
        $order['shoppingcart_id'] = session('active_shoppingcart_id');
        $order['bank'] = "Garanti";
        $order['hire'] = 1;
        $order['status'] = "Spiarişiniz alındı";
        $order['price'] = Cart::subtotal();
        Order::create($order);
        Cart::destroy();
        session()->forget('active_shoppingcart_id');
        return redirect()->route('sellers')
            ->with('message_type', 'success')
            ->with('message', 'Siparişiniz başarıyla alınmıştır.');
    }
}
