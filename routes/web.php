<?php
use Illuminate\Support\Facades\Redirect;

Route::get('/', 'HomePageController@index');

Route::get('/category/{slug_categoryname}', 'CategoryController@index')->name('category');

Route::get('/product/{slug_productname}', 'ProductController@index')->name('product');



Route::view('/sepet', 'sepet');





