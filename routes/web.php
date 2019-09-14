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
//default Auth Routes
//Auth::routes();

//Auth\VerificationController handle Email Verificaiton
Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::group(['prefix' => '/'], function(){
    Route::post('/user/login','AuthController@userLogin')->name('user.login_');
    Route::post('/user/register','AuthController@userRegistration')->name('user.register');
});

    Route::get('farmer/login', 'AuthController@showFarmerLoginForm')->name('farmer.login');
    Route::post('farmer/login', 'AuthController@FarmerLogin')->name('farmer.login.post');
    Route::get('farmer/register', 'AuthController@showFarmerRegistrationForm')->name('farmer.register');
    Route::post('farmer/register', 'AuthController@farmerRegistration')->name('farmer.register');

Route::group(['prefix' => 'farmer', 'middleware'=>['check.farmer']], function(){
    Route::get('/', 'Farmer\FarmerController@dashboardView')->name('farmer.dashboard');
    Route::get('logout','AuthController@farmerLogout')->name('farmer.logout');



});

    Route::get('admin/login','admin\AuthController@loginView')->name('admin.login_form');
    Route::post('login','admin\AuthController@login')->name('admin.login');

Route::group(['prefix' => 'admin', 'middleware'=> ['check.admin']], function(){
    Route::get('logout','admin\AuthController@logout')->name('admin.logout');
    Route::get('/', 'admin\AuthController@showDashboard')->name('admin.dashboard');
    //attribute controller
    Route::get('attributes','admin\AttributeController@index')->name('attributes');
    Route::post('add_attribute','admin\AttributeController@store')->name('attribute.store');
    Route::post('update_attribute','admin\AttributeController@update')->name('attribute.update');
    Route::get('delete_attribute/{id}','admin\AttributeController@destroy')->name('attribute.delete');

    //Categories

    Route::get('categories','admin\AdminController@allCategories')->name('categories');
    Route::post('add_category','admin\AdminController@addCategory')->name('add_category');
    Route::post('update_category','admin\AdminController@updateCategory')->name('update_category');
    Route::get('delete_category/{id}','admin\AdminController@deleteCategory')->name('admin/delete_category/{id}');

    //Products
    Route::get('products','admin\AdminController@allProducts')->name('products');
    Route::get('add_product/{id?}','admin\AdminController@addProduct')->name('add_product');
    Route::post('post_add_product','admin\AdminController@postAddProduct')->name('post_add_product');
    Route::post('update_add_product','admin\AdminController@updateAddProduct')->name('update_add_product');
    Route::post('delete_product_img','admin\AdminController@deleteProductImage')->name('delete_product_img');
    Route::get('delete_product/{id}','admin\AdminController@productDelete')->name('delete_product');
    Route::get('detail_product/{id}','admin\AdminController@detailProduct')->name('detail_product');

    //tag controller
    Route::get('tag','admin\TagController@index')->name('tags');
    Route::post('add_tag','admin\TagController@store')->name('tag.store');
    Route::post('update_tag','admin\TagController@update')->name('tag.update');
    Route::get('delete_tag/{id}','admin\TagController@destroy')->name('tag.delete');



});

//route that will be executed when no other route matches the incoming request.
//Route::fallback(function () {
//    return  'route not found';
//});
