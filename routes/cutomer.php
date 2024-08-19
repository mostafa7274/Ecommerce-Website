<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\cutomer\CutomerController;
use App\Http\Controllers\cutomer\auth\cutomerLoginController;
use App\Http\Controllers\cutomer\auth\cutomerRegisterController;

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


Route::middleware('cutomer.auth')->group(function () {

    Route::get('cutomer/dashboard/home', [CutomerController::class, 'home'])->name('cutomer.dashboard.home');




    // Logout route
    Route::post('cutomer/dashboard/logout', [CutomerController::class, 'logout'])->name('cutomer.dashboard.logout');
});

// Cutomer Authentication Routes
Route::get('cutomer/dashboard/login', [CutomerController::class, 'login'])->name('cutomer.dashboard.login');
Route::post('cutomer/dashboard/login', [CutomerController::class, 'checkLogin'])->name('cutomer.dashboard.check');
Route::get('cutomer/dashboard/register', [CutomerController::class, 'register'])->name('cutomer.dashboard.register');
Route::post('cutomer/dashboard/register', [CutomerController::class, 'store'])->name('cutomer.dashboard.store');


Route::get('cutomer/dashboard', function () {
    return redirect()->route('cutomer.dashboard.home');
})->name('cutomer.dashboard');

