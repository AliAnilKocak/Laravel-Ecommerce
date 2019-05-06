<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePageController extends Controller
{



    public function index()
    {
        $isim = "Anıl";
        $soyisim = "Koçak";
        $isimler = ["Ayşe", "Zehra", "Alaska", "Yağmur"];
        return view('homePage', compact('isim','soyisim','isimler'));
    }
}
