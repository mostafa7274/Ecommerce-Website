<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminHomeController;
use App\Http\Controllers\admin\auth\AdminLoginController;
use App\Http\Controllers\admin\auth\AdminRegisterController;

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


Route::middleware('admin.auth')->group(function () {

    Route::get('admin/dashboard/home', [AdminHomeController::class, 'home'])->name('admin.dashboard.home');


    Route::get('/admin/products', [AdminHomeController::class, 'index'])->name('admin.products.index');


    Route::post('/admin/products/{id}/approve', [AdminHomeController::class, 'approve'])->name('admin.products.approve');
    Route::post('/admin/products/{id}/reject', [AdminHomeController::class, 'reject'])->name('admin.products.reject');

    // Routes to manage users
    Route::get('/admin/users', [AdminHomeController::class, 'showUsers'])->name('admin.users.index');
    Route::get('/admin/users/{id}/edit', [AdminHomeController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [AdminHomeController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [AdminHomeController::class, 'destroyUser'])->name('admin.users.destroy');

    // Routes to manage sellers
    Route::get('/admin/sellers', [AdminHomeController::class, 'showSellers'])->name('admin.sellers.index');
    Route::get('/admin/sellers/{id}/edit', [AdminHomeController::class, 'editSeller'])->name('admin.sellers.edit');
    Route::put('/admin/sellers/{id}', [AdminHomeController::class, 'updateSeller'])->name('admin.sellers.update');
    Route::delete('/admin/sellers/{id}', [AdminHomeController::class, 'destroySeller'])->name('admin.sellers.destroy');

    // Route to block a seller
    Route::post('/admin/sellers/{id}/block', [AdminHomeController::class, 'blockSeller'])->name('admin.sellers.block');

    Route::post('/sellers/{seller}/unblock', [AdminHomeController::class, 'unblockSeller'])->name('admin.sellers.unblock');

    // Logout route
    Route::post('admin/dashboard/logout', [AdminLoginController::class, 'logout'])->name('admin.dashboard.logout');
});

// Admin Authentication Routes
Route::get('admin/dashboard/login', [AdminLoginController::class, 'login'])->name('admin.dashboard.login');
Route::post('admin/dashboard/login', [AdminLoginController::class, 'checkLogin'])->name('admin.dashboard.check');
Route::get('admin/dashboard/register', [AdminRegisterController::class, 'register'])->name('admin.dashboard.register');
Route::post('admin/dashboard/register', [AdminRegisterController::class, 'store'])->name('admin.dashboard.store');


Route::get('admin/dashboard', function () {
    return redirect()->route('admin.dashboard.home');
})->name('admin.dashboard');

