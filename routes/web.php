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

use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductController;

Route::get('/', [HomeController::class, 'index'])->name('client.home');

Route::get('/product', [ProductController::class, 'product'])->name('client.product');
Route::post('/product', [ProductController::class, 'search'])->name('client.product.search');
Route::post('/product_sort', [ProductController::class, 'sort'])->name('client.product.sort');
Route::post('/product_price', [ProductController::class, 'priceFilter'])->name('client.product.price');
use App\Http\Controllers\Auth\AuthController;
Route::get('/', [HomeController::class, 'index'])->name('client.home');


Route::post('/buyer/login', [AuthController::class, 'login'])->name('login');
Route::post('/buyer/register', [AuthController::class, 'register'])->name('register');
Route::get('/buyer/login', function () {
    return view('auth.buyer.login');
})->name('buyer.login');

Route::get('/buyer/register', function () {
    return view('auth.buyer.register');
})->name('buyer.register');

Route::get('/logout', [AuthController::class,'logout'])->name('logout');

Route::get('/email/verify/{token}', [AuthController::class, 'verifyEmail'])->name('verify.email');

Route::get('/verify-email', function () {
    return view('emails.verify-email');
})->name('verify.email.custom');


Route::get('/product_detail', [ProductController::class, 'productDetail'])->name('client.productDetail');