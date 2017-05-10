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
Route::post('storeOrder', 'OrdersController@store');
Route::get('getOrders','OrdersController@index');
Route::post('updateOrder/{id}','OrdersController@update');
Route::get('showOrder/{id}','OrdersController@show');
Route::post('deleteOrder/{id}','OrdersController@destroy');

Route::post('signup','UsersController@signup');
Route::post('signin','UsersController@signin');
Route::get('getUsers','UsersController@index');
Route::get('showUser','UsersController@show');
Route::post('updateUser','UsersController@update');
Route::post('deleteUser','UsersController@destroy');

Route::post('storeRole', 'RolesController@store');
Route::get('getRoles','RolesController@index');
Route::post('updateRole/{id}','RolesController@update');
Route::get('showRole/{id}','RolesController@show');
Route::post('deleteRole/{id}','RolesController@destroy');

Route::post('storeProduct', 'ProductsController@store');
Route::get('getProducts','ProductsController@index');
Route::post('updateProduct/{id}','ProductsController@update');
Route::get('showProduct/{id}','ProductsController@show');
Route::post('deleteProduct/{id}','ProductsController@destroy');

Route::post('storeCategory', 'CategoriesController@store');
Route::get('getCategories','CategoriesController@index');
Route::post('updateCategory/{id}','CategoriesController@update');
Route::get('showCategory/{id}','CategoriesController@show');
Route::post('deleteCategory/{id}','CategoriesController@destroy');

Route::any('{path?}', 'MainController@index')->where("path", ".+");
