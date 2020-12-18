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
});

//Admin Controllers
Route::match(['get','post'],'/admin-login','AdminController@adminLogin');
Route::match(['get','post'],'/admin-register','AdminController@adminRegister');


Route::group(['middleware'=>['AdminLogin']],function()
{
	Route::match(['get','post'],'/admin-dashboard','AdminController@adminDashboard');

	//Product Controll
	Route::match(['get','post'],'/add-product','ProductController@addProduct');
	Route::match(['get','post'],'/view-products','ProductController@viewProducts');
	Route::post('/admin/update-product-status','ProductController@updateStatus');
	Route::get('/delete-product/{id}','ProductController@deleteProduct');
	Route::match(['get','post'],'/edit-product/{id}','ProductController@editProduct');

	//Category Controll
	Route::match(['get','post'],'/add-category','CategoryController@addCategory');
	Route::match(['get','post'],'/view-category','CategoryController@viewCategory');
	Route::post('/admin/update-category-status','CategoryController@updateStatus');
	Route::match(['get','post'],'/edit-category/{id}','CategoryController@editCategory');
	Route::get('/delete-category/{id}','CategoryController@deleteCategory');

	//Order Controll
	Route::match(['get','post'],'/current-orders','CategoryController@currentOrders');
	Route::match(['get','post'],'/past-orders','CategoryController@pastOrders');
});
Route::get('/admin-logout','AdminController@adminLogout');


// User Modules Routes
Route::match(['get','post'],'/user-login','UserController@userLogin');
Route::match(['get','post'],'/user-register','UserController@userRegister');

Route::group(['middleware'=>['UserLogin']],function()
{
	Route::match(['get','post'],'/user-dashboard','UserController@userDashboard');
});
Route::get('/user-logout','UserController@userLogout');
