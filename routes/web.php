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

// Productos
Route::get('/', 'ProductController@indexByFeatured');
Route::get('categoria/{categoria_id}', 'ProductController@indexByCategory')->name('categoria');
Route::get('todo', 'ProductController@index')->name('todo');
Route::resource('product', ProductController::class);

// Carrito
Route::post('/cart-add', 'CartController@add')->name('cart.add');
Route::get('/cart-checkout','CartController@cart')->name('cart.checkout');
Route::post('/cart-clear', 'CartController@clear')->name('cart.clear');
Route::post('/cart-removeitem', 'CartController@removeitem')->name('cart.removeitem');

// Procesar pedido
Route::get('order', 'OrderController@fillAddress')->name('order');
Route::get('payment', 'OrderController@payment')->name('payment');
Route::post('address', 'OrderController@validateAddress')->name('address');

// Auth
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
