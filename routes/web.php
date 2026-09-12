<?php

use App\Http\Controllers\Admin\ProductVerificationController;
use App\Http\Controllers\BuyController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChoiceController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Arahkan halaman utama langsung ke katalog barang (BuyController)
Route::get('/', [BuyController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {

    Route::get('/choice', [ChoiceController::class, 'index'])->name('choice');
    Route::get('/dashboard', [ChoiceController::class, 'index'])->name('dashboard');

    Route::prefix('sell')->name('sell.')->group(function () {
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/my-products', [ProductController::class, 'myProducts'])->name('my-products');
    });

    Route::prefix('buy')->name('buy.')->group(function () {
        Route::get('/', [BuyController::class, 'index'])->name('index');
        Route::get('/category/{category:slug}', [BuyController::class, 'byCategory'])->name('category');
        Route::get('/product/{product}', [BuyController::class, 'show'])->name('show');
    });

    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add/{product}', [CartController::class, 'add'])->name('add');
        Route::delete('/remove/{item}', [CartController::class, 'remove'])->name('remove');
    });

    Route::prefix('admin')->name('admin.')->middleware('is_admin')->group(function () {
        Route::get('/products', [ProductVerificationController::class, 'index'])->name('products.index');
        Route::get('/products/history', [ProductVerificationController::class, 'history'])->name('products.history');
        Route::patch('/products/{product}/verify', [ProductVerificationController::class, 'verify'])->name('products.verify');
        Route::patch('/products/{product}/mark-fake', [ProductVerificationController::class, 'markFake'])->name('products.mark-fake');
    });
});

require __DIR__.'/auth.php';