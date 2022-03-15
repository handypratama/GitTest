<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
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

//Guest
Route::get('/', [GuestController::class, 'index'])->middleware('guest');
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::get('/view', [GuestController::class, 'view'])->middleware('guest');
Route::get('/view/search', [GuestController::class, 'search'])->middleware('guest');

Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::post('/register', [RegisterController::class, 'store']);

//User
Route::get('/user', [UserController::class, 'index'])->middleware('auth');
Route::get('/user/view', [UserController::class, 'view'])->middleware('auth');
Route::get('/user/profile', [UserController::class, 'profile'])->middleware('auth');
Route::get('/user/profile/update', [UserController::class, 'updateProfilePage'])->middleware('auth');
Route::get('/user/profile/history', [UserController::class, 'history'])->middleware('auth');
Route::get('/user/cart', [UserController::class, 'cartPage'])->middleware('auth');
Route::get('/user/view/search', [UserController::class, 'search'])->middleware('auth');
Route::get('/user/checkout', [UserController::class, 'checkOutPage'])->middleware('auth');

Route::post('/user/profile/update', [UserController::class, 'updateProfile']);
Route::post('/user/checkout', [UserController::class, 'checkOut']);

//Admin
Route::get('/admin', [AdminController::class, 'index'])->middleware('admin');
Route::get('/admin/view', [AdminController::class, 'view'])->middleware('admin');
Route::get('/admin/profile', [AdminController::class, 'profile'])->middleware('admin');
Route::get('/admin/profile/history', [AdminController::class, 'history'])->middleware('admin');
Route::get('/admin/profile/update', [AdminController::class, 'updateProfilePage'])->middleware('admin');
Route::get('/admin/addItem', [AdminController::class, 'viewAddItem'])->middleware('admin');
Route::get('/admin/view/search', [AdminController::class, 'search'])->middleware('admin');

Route::post('/admin/profile/update', [AdminController::class, 'updateProfile']);
Route::post('/admin/addItem', [AdminController::class, 'addItem']);

//Guest
Route::get('/{item}', [GuestController::class, 'detail'])->middleware('guest');

//User
Route::get('/user/{item}', [UserController::class, 'itemDetail'])->middleware('auth');

Route::post('/user/{item}', [UserController::class, 'addToCart'])->middleware('auth');
Route::post('/user/detail/{item}', [UserController::class, 'addToCart'])->middleware('auth');
Route::post('/user/view/{item}', [UserController::class, 'addToCart'])->middleware('auth');
Route::post('/user/cart/{item}/addQty', [UserController::class, 'addQty']);
Route::post('/user/cart/{item}/minQty', [UserController::class, 'minQty']);

//Admin
Route::get('/admin/{item}', [AdminController::class, 'itemDetail'])->middleware('admin');
Route::get('/admin/{item}/update', [AdminController::class, 'updateItemPage'])->middleware('admin');

Route::post('/admin/{item}/update', [AdminController::class, 'updateItem']);

Route::delete('/admin/{item}/delete', [AdminController::class, 'deleteItem']);
