<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\_UsersModel;
use Illuminate\Support\Facades\Hash;
use App\Models\UserDetail;

class UserController extends Controller
{
    public function login()
    {
        if (request()->isMethod('POST')) {

            $this->validate(request(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $credentials = [
                'email' => request('email'),
                'password' => request('password'),
                'is_admin' => 1
            ];

            //auth()-> yerine Auth::guard('manage') kullandık
            //admin ve normal kullanıcı için iki farklı login hattı olsun
            //diye yani admin için giriş yapınca normal kullanıcı için giriş yapmasın diye
            //bu şekilde bir ayrıştırma yaptık. guard içindeki manage değerini auth.php dosyası içersinden//
            //ayarladım. php artisan config:clear komutunu da çalıştırarak bunun aktifleşmesini sağladım

            if (Auth::guard('manage')->attempt($credentials, request()->has('remindme'))) {
                return redirect()->route('manage.homepage');
            } else {
                return back()->withInput()->withErrors(['email' => "Email hatalı ya da şifre"]);
            }
        } else { }

        return view('manage.login');
    }

    public function logout()
    {
        Auth::guard('manage')->logout();
        request()->session()->flush();
        request()->session()->regenerate();
        return redirect()->route('manage.login');
    }

    public function index()
    {
        if (request()->filled('search_word')) {
            request()->flash();// eski form verisi sayfa yenilendiğinde kalması için requestteki bilgileri sessiona flashladık.
            $search_word = request('search_word');
            $list = _UsersModel::where('full_name', 'like', "%$search_word%")
                ->orWhere('email', 'like', "%$search_word%")->orderByDesc('created_at')->paginate(8);
        } else {
            $list = _UsersModel::orderByDesc('created_at')->paginate(8);
        }
        return view('manage.user.index', compact('list'));
    }

    public function form($id = 0)
    {
        $entry = new _UsersModel;
        if ($id > 0) {
            $entry = _UsersModel::find($id);
        }
        return view('manage.user.form', compact('entry'));
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
