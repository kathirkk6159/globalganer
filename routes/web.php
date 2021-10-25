<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\productController;
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

Route::get('/product', function () {
    return view('product');
});
Route::get('/auth/logout',[LoginController::class,'logout'])->name('auth.logout');
Route::get('/auth/login', [LoginController::class,'login'])->name('auth.login');

Route::group(['middleware'=>['LoginMiddleware']],function(){

Route::post('/auth/check',[LoginController::class,'check'])->name('auth.check');
Route::get('product',[LoginController::class, 'product']);
Route::get('addproduct', [productController::class,'addproduct']);
Route::post('addnewproduct', [productController::class,'addnewproduct']);
Route::get('manageproduct', [productController::class,'manageproduct']);
Route::get('productdelete/{id}', [productController::class,'productdestroy']);

Route::get('productedit/{id}', [productController::class,'editproduct']);

Route::post('productedit/{id}', [productController::class,'productedit']);
});
