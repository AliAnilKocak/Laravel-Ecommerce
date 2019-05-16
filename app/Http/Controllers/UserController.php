<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\_UsersModel;
use App\Mail\UserRegisterMail;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function login()
    {
        return view('user.login');
    }

    public function registerform()
    {
        return view('user.register');
    }

    public function register()
    {

        $this->validate(request(), [
            'fullname' => 'required|min:5|max:60',
            'email' => 'required|email|unique:user',
            'password' => 'required|confirmed|min:5|max:60'
        ]);

        $user = _UsersModel::Create([
            'full_name' => request('fullname'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
            'activation_key' => Str::random(60),
            'is_active' => 0
        ]);

        Mail::to(request('email'))
            ->send(new UserRegisterMail($user));

        auth()->login($user);
        return redirect()->route('homepage');
    }

    public function activation($key)
    {
        $user = _UsersModel::where('activation_key', $key)
            ->first();
        if (!is_null($user)) {
            $user->activation_key = null;
            $user->is_active = 1;
            $user->save();
            return redirect()->to('/')
                ->with('message', 'Hesabınız aktifleştirildi')
                ->with('message_type', 'success');
            //to kullanımı sadece alternatif olarak örnek amaçlı yazdım

        }else{
            return redirect()->to('/')
            ->with('message', 'Kullanıcı kaydı bulunamadı.')
            ->with('message_type', 'warning');
        }
    }
}
