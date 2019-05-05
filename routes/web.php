<?php
use Illuminate\Support\Facades\Redirect;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('users/{name}', function ($name) {
    return  "Kullanıcı adı : $name";
});


Route::get('api', function () {
    return ["sdfsdf"=>"defsdf","asd"=>"asdas","aliasldia"=>"asdasd"];
});

Route::get('users/{name}/{id?}', function ($name,$id=0) {
    return  "Kullanıcı adı : $name id: $id";
})->name('urun_detay');



Route::get('kampanya', function () {
    return redirect()->route('urun_detay',['name'=>"name","id"=>"id"]);
});







