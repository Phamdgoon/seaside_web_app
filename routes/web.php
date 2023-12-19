<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\Seller\DashboardController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Buyer\ProfileSellerController;

use App\Http\Controllers\Buyer\HomeController;
use App\Http\Controllers\Buyer\ProductController;
use App\Http\Controllers\Seller\VoucherController;

Route::get('/', [HomeController::class, 'index'])->name('buyer.home');

Route::get('/product', [ProductController::class, 'product'])->name('buyer.product');
Route::post('/product', [ProductController::class, 'search'])->name('buyer.product.search');
Route::post('/product_sort', [ProductController::class, 'sort'])->name('buyer.product.sort');
Route::post('/product_price', [ProductController::class, 'priceFilter'])->name('buyer.product.price');
Route::get('/', [HomeController::class, 'index'])->name('buyer.home');


Route::post('/buyer/login', [AuthController::class, 'login'])->name('login');
Route::post('/buyer/register', [AuthController::class, 'register'])->name('register');
Route::get('/buyer/login', function () {
    return view('auth.buyer.login');
})->name('buyer.login');

Route::get('/buyer/register', function () {
    return view('auth.buyer.register');
})->name('buyer.register');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/email/verify/{token}', [AuthController::class, 'verifyEmail'])->name('verify.email');

Route::get('/verify-email', function () {
    return view('emails.verify-email');
})->name('verify.email.custom');


//seller
Route::middleware(['SellerMiddleware'])->group(function () {
Route::prefix('seller1')->group(function () {
    Route::get('', [DashboardController::class, 'index'])->name('seller');

    Route::controller(VoucherController::class)->group(function() {
        Route::prefix('vouchers')->group(function () {
            Route::get('list','index');
            Route::get('create','create');
            Route::post('create', 'store');
            Route::get('update/{id}', 'edit');
            Route::post('update/{id}', 'update');
            Route::delete('delete/{id}', 'destroy');
        });
    });
    

});
});
//
Route::get('/profile-seller', [ProfileSellerController::class, 'getInforShop'])->name('profile-seller');
Route::get('/product_detail', [ProductController::class, 'productDetail'])->name('buyer.productDetail');

//seller-register/login
use App\Http\Controllers\Auth\SellerController;
Route::get('/seller/register', function () {
    return view('auth.seller.register');
})->name('seller.register');

Route::post('/seller/login', [SellerController::class, 'login'])->name('login');
Route::post('/seller/register', [SellerController::class, 'register'])->name('register');
Route::get('/seller/login', function () {
    return view('auth.seller.login');
})->name('seller.login');
//seller-logout
Route::get('/logout', [SellerController::class, 'logout'])->name('logout');
