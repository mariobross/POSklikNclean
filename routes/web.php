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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', '@index');
Route::get('/', function() {
    return redirect(route('login'));
});

Route::post('/registerForm', 'Auth\RegisterController@storeUserandCashier');

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::resource('cashier', 'CashiersController');
    Route::resource('product', 'ProductsController');

    // route order
    Route::get('/order', 'OrdersController@addOrder')->name('order.order');
    Route::get('/checkout', 'OrdersController@checkout')->name('order.checkout');
    Route::post('/checkout', 'OrdersController@storeOrder')->name('order.storeOrder');

    Route::get('/report', 'ReportController@index');
    Route::get('/report/pdf/{invoice}', 'ReportController@printPdf');
});

Route::get('/home', 'HomeController@index')->name('home');


