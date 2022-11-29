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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/','App\Http\Controllers\frontend\FrontendController@index');

Auth::routes();

Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('admin/logout','App\Http\Controllers\backend\AdminController@Logout')->name('admin.logout'); 

// ====================== admin route section =====================

// ================== category section ==============
Route::get('admin/category','App\Http\Controllers\backend\CategoryController@index')->name('admin.category');
Route::post('admin/category/store','App\Http\Controllers\backend\CategoryController@StoreData')->name('category.store');
Route::get('admin/categories/delete/{id}','App\Http\Controllers\backend\CategoryController@Delete');
Route::get('admin/categories/status/{id}','App\Http\Controllers\backend\CategoryController@Activies');

Route::get('admin/categories/edit/{id}','App\Http\Controllers\backend\CategoryController@Edit');
Route::post('admin/category/update','App\Http\Controllers\backend\CategoryController@UpdateCategory')->name('category.update');


// ========================= brand section ==========================

Route::get('admin/brand','App\Http\Controllers\backend\BrandController@index')->name('admin.brand');
Route::post('admin/brand/store','App\Http\Controllers\backend\BrandController@StoreData')->name('brand.store');
Route::get('admin/brands/delete/{id}','App\Http\Controllers\backend\BrandController@Delete');
Route::get('admin/brands/status/{id}','App\Http\Controllers\backend\BrandController@Activies');

Route::get('admin/brands/edit/{id}','App\Http\Controllers\backend\BrandController@Edit');
Route::post('admin/brand/update','App\Http\Controllers\backend\BrandController@UpdateBrand')->name('brand.update');


// =========================== admin product control section ===================
Route::get('admin/product','App\Http\Controllers\backend\ProductController@index')->name('admin.product');
Route::get('admin/product/add-product','App\Http\Controllers\backend\ProductController@AddProduct')->name('admin.add-product');
Route::post('admin/product/store','App\Http\Controllers\backend\ProductController@StoreData')->name('admin.product-store');

