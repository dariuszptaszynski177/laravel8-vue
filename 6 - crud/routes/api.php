<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::prefix('admin')->group(function(){

Route::post('/products', 'App\Http\Controllers\ProductsController@index');
Route::get('/product/producer', 'App\Http\Controllers\ProductsController@product_producer');
Route::post('/product/add', 'App\Http\Controllers\ProductsController@add');
Route::get('/product/edit/{id}', 'App\Http\Controllers\ProductsController@edit');
Route::get('/gallery/{id}', 'App\Http\Controllers\ProductsController@gallery');
Route::get('/image/delete/{id}', 'App\Http\Controllers\ProductsController@image_delete');

Route::post('/product/update', 'App\Http\Controllers\ProductsController@update');
Route::get('/product/delete/{id}', 'App\Http\Controllers\ProductsController@delete');

Route::post('/producers', 'App\Http\Controllers\ProducersController@index');
Route::post('/producer/add', 'App\Http\Controllers\ProducersController@add');
Route::get('/producer/edit/{id}', 'App\Http\Controllers\ProducersController@edit');
Route::post('/producer/update', 'App\Http\Controllers\ProducersController@update');
Route::get('/producer/delete/{id}', 'App\Http\Controllers\ProducersController@delete');

// });