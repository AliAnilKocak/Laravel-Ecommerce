<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        if (request()->filled('search_word')) {
            request()->flash(); // eski form verisi sayfa yenilendiğinde kalması için requestteki bilgileri sessiona flashladık.
            $search_word = request('search_word');
            $list = Order::with('shoppingcart.shoppingcartProduct.product')
                ->Where('bank', 'like', "%$search_word%")->orderByDesc('created_at')->paginate(8);
        } else {
            $list = Order::with('shoppingcart.shoppingcartProduct.product')->orderByDesc('created_at')->paginate(8);
            //dd($list);
        }

        return view('manage.order.index', compact('list'));
    }

    public function form($id = 0)
    {
        $entry = new Order();
        if ($id > 0) {
            $entry = Order::with('shoppingcart.shoppingcartProduct.product')->find($id);
        }
        return view('manage.order.form', compact('entry'));
    }

    public function save($id = 0)
    {
        $data = request()->only('full_name', 'adress', 'price', 'status', 'bank');

        if ($id > 0) { //update
            $entry = Order::where('id', $id)->firstOrFail();
            $entry->update($data);
        }

        return  redirect()->route('manage.order.edit', $entry->id)
            ->with('message', ($id > 0 ? "Güncellendi" : "Yeni bir kayıt oluşturuldu"))
            ->with('message_type', 'success');
    }

    public function delete($id)
    {
        Order::destroy($id);
        return redirect()->route('manage.order')
            ->with('message_type', 'success')
            ->with('message', 'Kullanıcı silinmiştir.');
    }
}
