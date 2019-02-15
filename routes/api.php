<?php

use Illuminate\Http\Request;

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

Route::post('/login', 'AuthController@login');
Route::resource('/products', 'ProductController');
Route::resource('/categories', 'CategoryController');
Route::resource('/vendors', 'VendorController');
Route::resource('/users', 'UserController');
Route::resource('/orders', 'OrderController');


/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
