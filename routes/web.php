<?php
use Illuminate\Support\Facades\Redirect;

Route::get('/', 'HomePageController@index');

Route::get('/category/{slug_categoryname}', 'CategoryController@index')->name('category');
Route::view('/product', 'product');
Route::view('/sepet', 'sepet');





