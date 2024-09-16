<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\AuthUser;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/login', function () {
    return Inertia::render('Auth/Login');
});


Route::get('/', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');


Route::middleware(AuthUser::class)->group(function () {
    Route::post('/product/{product}/edit', [ProductController::class, 'update'])->name('product.update')->middleware(CheckRole::class);

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart-item/{product}', [CartItemController::class, 'store'])->name('cart.item.store');
    Route::patch('/cart-item/{cartItem}', [CartItemController::class, 'update'])->name('cart.item.update');
    Route::delete('/cart-item/{cartItem}', [CartItemController::class, 'destory'])->name('cart.item.destory');

    Route::get('/order/{order}/summary', [OrderController::class, 'summary'])->name('order.summary');
    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::get('/order', [OrderController::class, 'create'])->name('order.create');
    Route::get('/order/{order}', [OrderController::class, 'show'])->name('order.show');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::put('/order/{order}', [OrderController::class, 'confirm'])->name('order.confirm');

    Route::put('/currency', [CurrencyController::class, 'update'])->name('currency.update');

    Route::get('/user/{user}/promote', [RegisteredUserController::class, 'grantAdmin'])->name('user.grant');
});

require __DIR__ . '/auth.php';
