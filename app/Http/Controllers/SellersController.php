<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellersController extends Controller
{
    public function index(){
        return view('sellers');
    }

    public function detail($id){
        return view('seller');
    }
}
