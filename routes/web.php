<?php
use Illuminate\Support\Facades\Redirect;

Route::get('/', 'HomePageController@index')->name('homepage');

Route::get('/category/{slug_categoryname}', 'CategoryController@index')->name('category');

Route::get('/product/{slug_productname}', 'ProductController@index')->name('product');

Route::get('/shoppingcart', 'ShoppingCartController@index')->name('shoppingcart');

Route::get('/pay', 'PayController@index')->name('pay');

Route::get('/sellers', 'SellersController@index')->name('sellers');

Route::get('/seller/{id}', 'SellersController@detail')->name('seller');

Route::group(['prefix' => 'user'], function () {
    Route::get('/login', 'UserController@login')->name('user.login');
    Route::get('/register', 'UserController@register')->name('user.register');
});












