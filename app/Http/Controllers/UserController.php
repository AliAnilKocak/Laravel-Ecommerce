<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\_UsersModel;
use App\Mail\UserRegisterMail;
use Illuminate\Support\Facades\Mail;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartProduct;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\UserDetail;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        //Bu class içindeki tüm metotlara sadece guest olanlar yani kullanıcı girişi yapmamış olan kullanıclar girembilir.
        //logout hariç
    }

    public function loginform()
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

        $user->detail()->create([
            'adress' => "sdfsdf",
            'tel_number' => "223",
            'number' => "3434",
        ]); //save yerine create dersek alanları doldururuz.
        //yukarıda her kullanıcı için user_Detail tablosuna boş bir kayıt eklemektedir.

        Mail::to(request('email'))
            ->send(new UserRegisterMail($user));

        auth()->login($user);
        return redirect()->route('homepage');
    }

    public function login()
    {

        $this->validate(request(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (auth()->attempt(['email' => request('email'), 'password' => request('password')], request()->has('remindme'))) {
            request()->session()->regenerate(); //session bilgilerini yeniler
            /*
            Redirect::intended fonksiyonu, kullanıcıları kimlik doğrulama filtresi tarafından yakalanmadan önce
             erişmeye çalıştıkları URL'ye yönlendirecektir. Kullanıcının önceden
            girmeye çalıştığı bir url olmayan durumlarda kullanılabilsin diye bu metoda bir dönüş URI parametresi verilebilir.
            mesela login isteyen bir sayfaya istek attım. orası login page'e yönlendirilip giriş yaptıktan sonra tekrar önceki
            login isteyen sayfaya yönlendirilmemizi sağlıyor.
            */


            $active_shoppingcart_id = ShoppingCart::active_shoppingcart_id();
            if (is_null($active_shoppingcart_id)) {
                $active_shoppingcart  = ShoppingCart::create([
                    'user_id' => auth()->id()
                ]);
                $active_shoppingcart_id  = $active_shoppingcart->id;
                //dd($active_shoppingcart_id); //ekrana basar bundan sonraki kodları da çalıştırmaz
            }
            session()->put('active_shoppingcart_id', $active_shoppingcart_id);
            //if (Cart::count() > 0) {
            error_log(Cart::content());
            foreach (Cart::content() as $cartItem) {
                ShoppingCartProduct::updateOrCreate(
                    ['shoppingcart_id' => $active_shoppingcart_id, 'product_id' => $cartItem->id],
                    ['count' => $cartItem->qty, 'price' => $cartItem->price, 'status' => 'Beklemede']
                );
            }
            //   }

            //Cart::destroy();
            $shoppingCartProducts = ShoppingCartProduct::where('shoppingcart_id', $active_shoppingcart_id)->get();
            error_log($shoppingCartProducts);
            foreach ($shoppingCartProducts as $itemShoppingCart) {
                Cart::add(
                    $itemShoppingCart->product->id,
                    $itemShoppingCart->product->name,
                    $itemShoppingCart->count,
                    $itemShoppingCart->product->price,
                    [
                        'slug' => $itemShoppingCart->product->slug
                    ]
                );
            }

            return redirect()->intended('/');
        } else {
            $errors = ['email' => 'Hatalı giriş'];
            return back()->withErrors($errors); //login.blade'te daha önceden register içim oluşturduğum error sayfasının
            //include ettim. withErrors da hata ile birlikte önceki sayfaya yönlendirilmesini sağlıyor.s
        }
    }

    public function api_register()
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
        return $user;
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

        } else {
            return redirect()->to('/')
                ->with('message', 'Kullanıcı kaydı bulunamadı.')
                ->with('message_type', 'warning');
        }
    }

    public function logout()
    {
        auth()->logout();
        request()->session()->flush();
        request()->session()->regenerate();
        return redirect()->route('homepage');
    }
}
