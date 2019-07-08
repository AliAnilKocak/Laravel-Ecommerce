<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        if (request()->filled('search_word')) {
            request()->flash();// eski form verisi sayfa yenilendiğinde kalması için requestteki bilgileri sessiona flashladık.
            $search_word = request('search_word');
            $list = Category::where('name', 'like', "%$search_word%")
                ->orWhere('slug', 'like', "%$search_word%")->orderByDesc('created_at')->paginate(8);
        } else {
            $list = Category::orderByDesc('created_at')->paginate(8);
        }
        return view('manage.category.index', compact('list'));
    }

    public function form($id = 0)
    {
        $entry = new Category;
        if ($id > 0) {
            $entry = Category::find($id);
        }
        return view('manage.category.form', compact('entry'));
    }

    public function save($id = 0)
    {
        $this->validate(request(), [
            'email' => 'required',
            'full_name' => 'required'
        ]);

        $data = request()->only('email', 'full_name');
        if (request()->filled('password')) {
            $data['password'] = Hash::make(request('password'));
        }

        $data['is_active'] = request()->has('is_active') ? 1 : 0;
        $data['is_admin'] = request()->has('is_admin') ? 1 : 0;

        if ($id > 0) { //update
            $entry = _UsersModel::where('id', $id)->firstOrFail();
            $entry->update($data);
        } else { //create
            $entry = _UsersModel::create($data);
        }

        UserDetail::updateOrCreate(
            ['user_id' => $entry->id],
            [
                'adress' => request('adress'),
                'number' => request('number'),
                'tel_number' => request('tel_number')
            ]
        );

        return  redirect()->route('manage.user.edit', $entry->id)
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
