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
use App\Http\Controllers\Buyer\CartController;
use App\Http\Controllers\Buyer\OrderController;
use App\Http\Controllers\Buyer\PaymentController;

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
Route::prefix('seller1')->group(function () {
    Route::get('', [DashboardController::class, 'index'])->name('seller');
});

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
Route::get('/logout', [SellerController::class, 'logout'])->name('logout');
Route::get('/product_detail', [ProductController::class, 'productDetail'])->name('buyer.productDetail');
Route::get('/cart', function () {
    return view('buyer.cart.index');
})->name('buyer.cart');


Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::middleware(['Buyer.middleware'])->group(function () {
//  Route Cart

Route::get('/cart', [CartController::class, 'index'])->name('client.cart.index');

Route::delete('/remove-cart-item/{id}', [CartController::class, 'removeCartItem'])->name('remove.cart.item');

Route::post('/update-cart-item/{id}', [CartController::class, 'updateCartItem'])->name('update.cart.item');

//  Route Order Product
Route::get('/order-product', function () {
    return view('buyer.order.orderProduct');
});

Route::post('/order-product', [OrderController::class, 'ProcessOrder'])->name('client.order.processOrder');

// routes/web.php
Route::post('/saveOrder', [OrderController::class, 'SaveOrder'])->name('saveOrder');


Route::get('/saveOrderOnline', [OrderController::class, 'saveOrderOnline'])->name('saveOrderOnline');

Route::post('/vnpay_payment', [PaymentController::class, 'vnpayPayment'])->name('vnpay.payment');

Route::post('/paypal_payment', [PaymentController::class, 'pay'])->name('paypal.payment');

Route::get('/success', [PaymentController::class, 'success'])->name('success');

Route::get('/error', [PaymentController::class, 'error']);
});

