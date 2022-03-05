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

Route::get('/')->name('main-page');

Route::get('/users', 'App\Http\Controllers\UserController@users')->name('users-page');
Route::post('/search', 'App\Http\Controllers\UserController@search')->name('users-page1');

Route::post('/szukaj', 'App\Http\Controllers\UserController@search');


Route::get('/user/{id}', 'App\Http\Controllers\UserController@user')->name('user-page');


