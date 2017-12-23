<?php
use App\Customer;
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

//CUSTOMER 
Route::get('/customers', 'CustomerController@index');
Route::get('/customers/list', 'CustomerController@list');
Route::get('/customers/create', 'CustomerController@create');
Route::get('/customers/{customer}', 'CustomerController@show');
Route::post('/customers', 'CustomerController@store');
Route::get('/customers/{customer}/edit', 'CustomerController@edit');
Route::get('/customers/{customer}/disable', 'CustomerController@disable');
Route::patch('/customers/{customer}', 'CustomerController@update');
Route::delete('/customers/{customer}', 'CustomerController@destroy');
Route::post('/customers/search', 'CustomerController@search');

//customer type routes
Route::get('/customers/type/{type}', 'CustomerController@customer_type');

//PRODUCT
Route::get('/products', 'ProductController@index');
Route::get('/products/create', 'ProductController@create');
Route::post('/products', 'ProductController@store');
Route::get('/products/{product}', 'ProductController@show');
Route::get('/products/{product}/edit', 'ProductController@edit');
Route::patch('/products/{customer}', 'ProductController@update');
Route::delete('/products/{customer}', 'ProductController@destroy');

//ORDER
Route::get('/orders', 'OrderController@index');
Route::get('/orders/create/list', 'OrderController@list');
Route::get('/orders/create/{customer}', 'OrderController@create');
Route::post('/orders', 'OrderController@store');
Route::get('/orders/{order}', 'OrderController@show');
Route::get('/orders/{order}/edit', 'OrderController@edit');
Route::patch('/orders/{order}', 'OrderController@update');
Route::delete('/orders/{order}', 'OrderController@destroy');

//PRINT ORDERS
Route::get('/printorders', 'PrintOrderController@index');
Route::get('/printorders/create', 'PrintOrderController@create');
Route::get('/printorders/{printorder}', 'PrintOrderController@show');
Route::get('/printorders/edit/{printorder}', 'PrintOrderController@edit');
Route::get('/printorders/print/{printorder}', 'PrintOrderController@print');
Route::get('/printorders/approve/{printorder}', 'PrintOrderController@approve');
Route::patch('/printorders/approve/{printorder}', 'PrintOrderController@approve_process');
Route::post('/printorders', 'PrintOrderController@store');


//MIGRATE DATA
Route::get('/migrate', 'MigrationController@index');

//Routes
Route::get('/routes', 'RouteController@index');
Route::get('/routes/create', 'RouteController@create');
Route::get('/routes/{route}', 'RouteController@show');
Route::get('/routes/{route}/edit', 'RouteController@edit');
Route::patch('/routes/{route}', 'RouteController@update');
Route::post('/routes', 'RouteController@store');



