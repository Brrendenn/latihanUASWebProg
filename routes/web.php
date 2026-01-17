<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BookController;
use App\Http\Middleware\setLocale;
use Illuminate\Support\Facades\Route;

// routes/web.php

// 1. Language Switcher (Public)
Route::get('lang/{locale}', function ($locale) {
    session()->put('locale', $locale);
    return redirect()->back();
})->name('lang.switch');

Auth::routes();

// 2. APPLY LOCALE MIDDLEWARE TO ALL PAGES
Route::middleware(['setLocale'])->group(function () {

    // --- PUBLIC / USER ROUTES ---
    // Homepage
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Cart Routes (Must be logged in)
    Route::middleware(['auth'])->group(function () {
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
        Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/cart/delete/{id}', [CartController::class, 'destroy'])->name('cart.delete');
        Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
        Route::get('/success', function () {
            return view('success');
        })->name('success');
    });

    // --- ADMIN ROUTES (Protected by isAdmin) ---
    Route::middleware(['auth', 'isAdmin'])->prefix('admin')->group(function () {
        Route::get('/home', [BookController::class, 'index'])->name('admin.home');
        Route::get('/create', [BookController::class, 'create'])->name('books.create');
        Route::post('/store', [BookController::class, 'store'])->name('books.store');
        Route::get('/edit/{id}', [BookController::class, 'edit'])->name('books.edit');
        Route::put('/update/{id}', [BookController::class, 'update'])->name('books.update');
        Route::delete('/delete/{id}', [BookController::class, 'destroy'])->name('books.delete');
    });

});


