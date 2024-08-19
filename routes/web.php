<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Models\Seller;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route to homepage
Route::get('/', [BuyerController::class, 'showApprovedProducts'])->name('home');

// Auth routes
Auth::routes();

// Custom login route if needed
Route::get('/auth/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/auth/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

// Logout route
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login'); // Redirects to the login route
})->name('logout');

// Profile route
Route::get('/profile/{id}', function ($id) {
    $seller = Seller::find($id);

    if (!$seller) {
        abort(404, 'Seller not found');
    }

    return view('profile.show', ['seller' => $seller]);
})->name('profile');

// Seller routes
Route::group(['middleware' => ['seller.auth'], 'prefix' => 'product'], function () {
    Route::get('/', [ProductController::class, 'index'])->name('products');
    Route::get('/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/update/{product}', [ProductController::class, 'update'])->name('product.update');
});

// Buyer routes
Route::middleware('auth')->group(function () {
    Route::get('/products', [BuyerController::class, 'showApprovedProducts'])->name('buyer.products.index');
    Route::get('/product/{id}', [BuyerController::class, 'show'])->name('product.show');
});

// Cart routes
Route::group(['middleware' => ['auth'], 'prefix' => 'carts'], function () {
    Route::get('/', [CartController::class, 'index'])->name('carts.index');
    Route::get('/create', [CartController::class, 'create'])->name('carts.create');
    Route::post('/store', [CartController::class, 'store'])->name('carts.store');
    Route::post('/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/show', [CartController::class, 'show'])->name('cart.show');
});

Route::delete('/cart/remove/{productId}', [CartController::class, 'removeFromCart'])->name('cart.remove');

// Checkout routes
Route::group(['middleware' => ['auth']], function () {
    Route::get('/checkout', 'App\Http\Controllers\StripeController@checkout')->name('checkout');
    Route::post('/session', 'App\Http\Controllers\StripeController@session')->name('session');
    Route::get('/success', 'App\Http\Controllers\StripeController@success')->name('success');
});

// Contact routes
Route::get('contact', [ContactController::class, 'showForm'])->name('contact.form');
Route::post('contact', [ContactController::class, 'submitForm'])->name('contact.submit');

// Messages route for admin
Route::get('messages', [MessageController::class, 'index'])->name('messages.index')->middleware('auth:admin');
