<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Auth/Login');
});


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart-item/{product}', [CartItemController::class, 'store'])->name('cart.item.store');
    Route::patch('/cart-item/{cartItem}', [CartItemController::class, 'update'])->name('cart.item.update');
    Route::delete('/cart-item/{cartItem}', [CartItemController::class, 'destory'])->name('cart.item.destory');

    Route::get('/order/{order}/summary', [OrderController::class, 'summary'])->name('order.summary');
    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::get('/order', [OrderController::class, 'create'])->name('order.create');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::put('/order/{order}', [OrderController::class, 'confirm'])->name('order.confirm');
});

require __DIR__ . '/auth.php';
