<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
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
Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index']);
Route::get('/logout', [App\Http\Controllers\Admin\HomeController::class, 'logout']);
Route::post('/admin_dashboard',[App\Http\Controllers\Admin\HomeController::class, 'store']);
Route::get('/Admin/dashboard',[App\Http\Controllers\Admin\HomeController::class, 'home']);
Route::resource('/Admin/product',Admin\ProductController::class);
Route::resource('/Admin/service',Admin\ServiceController::class);
Route::resource('/Admin/auth',Admin\AuthController::class);
Route::resource('/Admin/news',Admin\NewsController::class);
Route::resource('/Admin/meet',Admin\MeetController::class);
Route::resource('/Admin/order',Admin\OrderController::class);
Route::resource('/Admin/Bank',Admin\BankController::class);
Route::resource('/Admin/feedback',Admin\FeedbackController::class);
