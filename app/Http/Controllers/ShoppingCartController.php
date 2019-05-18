<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    //Bu şekilde de route içinde olmadan controller içerisinden de auth middleware tanımlaması yapılabilir.
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view('sepet');
    }
}
