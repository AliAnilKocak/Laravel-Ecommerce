<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
                    'is_admin'=>1
                ];

                //auth()-> yerine Auth::guard('manage') kullandık
                //admin ve normal kullanıcı için iki farklı login hattı olsun
                //diye yani admin için giriş yapınca normal kullanıcı için giriş yapmasın diye
                //bu şekilde bir ayrıştırma yaptık. guard içindeki manage değerini auth.php dosyası içersinden//
                 //ayarladım. php artisan config:clear komutunu da çalıştırarak bunun aktifleşmesini sağladım

                if(Auth::guard('manage')->attempt($credentials,request()->has('remindme'))){
                    return redirect()->route('manage.homepage');
                }else{
                    return back()->withInput()->withErrors(['email'=>"Email hatalı ya da şifre"]);
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
}
