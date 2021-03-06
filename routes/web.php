<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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

// Productos:
// Destacados
Route::get('/', 'ProductController@indexByFeatured');
// De una Categoria
Route::get('categoria/{categoria_id}', 'ProductController@indexByCategory')->name('categoria');
// Todos
Route::get('todo', 'ProductController@index')->name('todo');
// Detalle de un producto
Route::get('product/{id}', 'ProductController@show')->name('product.show');

// Carrito
Route::post('/cart-add', 'CartController@add')->name('cart.add');
Route::get('/cart-checkout', 'CartController@cart')->name('cart.checkout');
Route::post('/cart-clear', 'CartController@clear')->name('cart.clear');
Route::post('/cart-removeitem', 'CartController@removeitem')->name('cart.removeitem');
Route::post('/cart-update', 'CartController@updateQuantity')->name('cart.update');

// Procesar pedido
Route::get('order', 'OrderController@fillAddress')->name('order');
Route::get('payment', 'OrderController@payment')->name('payment');
Route::post('address', 'OrderController@validateAddress')->name('address');

// Pagos
Route::get('handle-payment', 'PayPalPaymentController@handlePayment')->name('make.payment');
Route::get('cancel-payment', 'PayPalPaymentController@paymentCancel')->name('cancel.payment');
Route::get('payment-success', 'PayPalPaymentController@paymentSuccess')->name('success.payment');

// Auth
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Usuarios
Route::get('profile/{user}', ['as' => 'users.profile', 'uses' => 'UserController@view']);
Route::get('users/{user}',  ['as' => 'users.edit', 'uses' => 'UserController@edit']);
Route::patch('users/{user}/update',  ['as' => 'users.update', 'uses' => 'UserController@update']);
Route::get('users/{user}/confirmdelete', ['as' => 'users.confirmdelete', 'uses' => 'UserController@confirmDelete']);
Route::get('users/{user}/delete/', ['as' => 'users.delete', 'uses' => 'UserController@delete']);

// OAuth
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('{provider}/callback', 'Auth\LoginController@handleProviderCallback');

// Pedidos
Route::get('pedidos/{user}', ['as' => 'pedidos', 'uses' => 'OrderController@indexByUser']);
Route::get('pedido/{id}', ['as' => 'pedido', 'uses' => 'OrderController@show']);
Route::get('confirmar/{id}', 'OrderController@cancelConfirm')->name('confirmar');
Route::get('cancelar/{id}', 'OrderController@cancel')->name('cancelar');
// PDF
Route::get('factura/{id}', 'OrderController@downloadPDF')->name('factura');

// EXCEL
Route::get('excelpedido/{id}', [OrderController::class, 'fileExportOrder'])->name('excel-pedido');
Route::get('excelpedidos/{id}', [OrderController::class, 'fileExportOrderList'])->name('excel-pedidos');
Route::get('excelarticulos', [ProductController::class, 'fileExport'])->name('excel-articulos');
Route::get('excelcategorias', [CategoryController::class, 'fileExport'])->name('excel-categorias');

// Otros
Route::view('legal', 'legal')->name('legal');
