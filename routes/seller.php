<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\seller\sellerHomeController;
use App\Http\Controllers\seller\auth\sellerLoginController;
use App\Http\Controllers\seller\auth\sellerRegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('seller/dashboard/home' , [sellerHomeController::class , 'index'])->name('seller.dashboard.home')->middleware('seller.auth');

Route::get('seller/dashboard/login' , [sellerLoginController::class, 'login'])->name('seller.dashboard.login');

Route::post('seller/dashboard/login' , [sellerLoginController::class , 'checkLogin'])->name('seller.dashboard.check');

Route::get('seller/dashboard/register' , [sellerRegisterController::class , 'register'])->name('seller.dashboard.register');

Route::post('seller/dashboard/register' , [sellerRegisterController::class , 'store'])->name('seller.dashboard.store');

Route::post('seller/dashboard/logout' , [sellerLoginController::class, 'logout'])->name('seller.dashboard.logout');
