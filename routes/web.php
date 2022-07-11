<?php

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

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('locale/{locale?}', array('as' => 'set-locale', 'uses' => 'LanguageController@setLocale'));

Route::resource('currency', 'CurrencyController');

Route::resource('payments', 'PaymentController');

Route::resource('/accounts/{account_id}/paymentrequests', 'PaymentRequestController');
Route::get('/accounts/{account_id}/paymentrequests/{paymentrequest}/delete', 'PaymentRequestController@delete');
Route::get('/success/{succesurl}', 'PaymentRequestController@success')->name('success2');

Route::resource('accounts', 'AccountController');
Route::get('accounts/{account}/delete', 'AccountController@delete');

Route::get('/admin', 'AdminController@index');
Route::get('/admin/users', 'AdminController@users');
Route::get('/admin/groups', 'AdminController@groups');

Route::resource('users', 'UserController');

Route::resource('group', 'GroupController');

Route::resource('contact', 'ContactController');

Route::resource('payment', 'PaymentController');
