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
})->name('welcome');

Route::get('/option', 'StripeController@option')->name('stripe.option');
Route::get('/right', 'StripeController@right')->name('stripe.right');
Route::get('/business', 'StripeController@business')->name('stripe.business');

Route::get('/subscribe', function () {
    return view('subscribe');
})->name('subscribe');
Route::post('/register', 'StripeController@register')->name('register');

Route::get('/success', function () {
    return view('success');
})->name('success');
Route::get('/cancel', function () {
    return view('cancel');
})->name('cancel');
