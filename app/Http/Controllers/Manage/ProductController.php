<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        if (request()->filled('search_word')) {
            request()->flash();// eski form verisi sayfa yenilendiğinde kalması için requestteki bilgileri sessiona flashladık.
            $search_word = request('search_word');
            $list = Product::where('name', 'like', "%$search_word%")
                ->orWhere('slug', 'like', "%$search_word%")->orderByDesc('created_at')->paginate(8);
        } else {
            $list = Product::orderByDesc('created_at')->paginate(8);
        }
        return view('manage.product.index', compact('list'));
    }

    public function form($id = 0)
    {
        $entry = new Product;
        if ($id > 0) {
            $entry = Product::find($id);
        }
        return view('manage.product.form', compact('entry'));
    }

    public function save($id = 0)
    {
        $data = request()->only('name', 'slug', 'description','price');
        if (!request()->filled('slug')) {
            $data['slug'] = str_slug(request('name'));
            request()->merge(['slug' => $data['slug']]);
        }


        $this->validate(request(), [
            'name' => 'required',
            'slug' => request('original_slug') != request('slug') ?  'unique:product,slug' : '',
        ]);


        /*if(Category::whereSlug($data['slug'])->count() > 0)
        return back()->withInput()->withErrors(['slug'=>'Slug değer daha önceden kayıtlıdır']);*/

        if ($id > 0) { //update
            $entry = Product::where('id', $id)->firstOrFail();
            $entry->update($data);
        } else { //create
            $entry = Product::create($data);
        }
        return  redirect()->route('manage.product.edit', $entry->id)
            ->with('message', ($id > 0 ? "Güncellendi" : "Yeni bir kayıt oluşturuldu"))
            ->with('message_type', 'success');
    }

    public function delete($id)
    {
        _UsersModel::destroy($id);
        return redirect()->route('manage.user')
            ->with('message_type', 'success')
            ->with('message', 'Kullanıcı silinmiştir.');
    }
}
