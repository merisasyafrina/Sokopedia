<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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



Route::get('/', 'WelcomeController@index');
Route::get('/search', 'WelcomeController@search');
Auth::routes();

Route::group(['middleware' => 'nonadmin'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/detail/{id}', 'DetailController@index');
    Route::get('/add-to-cart/{id}', 'TransactionController@add');
    Route::post('/add-to-cart/order/{id}', 'TransactionController@order');
    Route::get('/cart', 'TransactionController@index');
    Route::delete('/cart/{id}', 'TransactionController@delete');
    Route::get('/cart/checkout', 'TransactionController@checkout');
    Route::get('/cart/edit-page/{id}', 'TransactionController@editPage');
    Route::post('/cart/edit-page/edit/{id}', 'TransactionController@edit');
    Route::get('/history', 'TransactionController@history');
    Route::get('/history/detail-transaction/{id}', 'TransactionController@detailTransaction');
    
});

Route::group(['middleware' => 'admin'], function () {    
    Route::get('/admin-panel','AdminController@adminHome');
    Route::get('/admin-add-product', 'AdminController@addProductPage');
    Route::post('/admin-add-product/addProduct', 'AdminController@addProduct');
    Route::get('/admin-list-product', 'AdminController@productListPage');
    Route::delete('/admin-list-product/{id}', 'AdminController@delete');
    Route::get('/admin-add-category', 'AdminController@addCategoryPage');
    Route::post('admin-add-category/addCategory', 'AdminController@addCategory');
    Route::get('/admin-list-category', 'AdminController@categoryPage');
    Route::get('/admin-list-category/{id}', 'AdminController@categoryListPage');
});