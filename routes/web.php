<?php
use Illuminate\Support\Facades\Redirect;

Route::get('/', 'HomePageController@index');

Route::view('/category', 'category');
Route::view('/product', 'product');
Route::view('/sepet', 'sepet');





