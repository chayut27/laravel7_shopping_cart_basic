<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/products', 'ProductController@index');
Route::get('/add_cart/{id}', 'ProductController@addcart');
Route::get('/cart', 'ProductController@show_cart');
Route::get('/delete_cart/{line}', 'ProductController@delete_cart');
