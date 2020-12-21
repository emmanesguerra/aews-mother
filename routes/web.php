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

Route::resource('customer', 'CustomerController');
Route::post('customer/{customer}/pay', 'CustomerController@pay')->name('customer.pay');


Route::resource('payhistory', 'PaymentHistoryController');
Route::get('payhistory/{payhistory}/revert', 'PaymentHistoryController@revert')->name('payhistory.revert');