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