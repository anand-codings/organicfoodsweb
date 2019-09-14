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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'API\UserController@register');
Route::post('login', 'API\UserController@login');
Route::get('get_categories', 'API\UserController@getCategories');
Route::get('get_products', 'API\ProductController@getProducts');
Route::group(['middleware' => ['auth:api', 'checkSession']], function() {
    Route::get('logout', 'API\UserController@logout');
});