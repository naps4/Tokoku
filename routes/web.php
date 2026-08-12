<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

// Rute Pengatur Lalu Lintas yang diperbarui
Route::get('/home', function () {
    if (Auth::check()) {
        // Jika yang akses adalah admin, kembalikan ke dashboard admin
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
    }
    // Jika customer atau belum login, lempar ke halaman utama toko
    return redirect('/');
});

// Rute Google Login
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// ==========================================
// RUTE KHUSUS ADMIN (Sudah Digabung & Dirapikan)
// ==========================================
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Ini adalah rute sakti yang akan membuat 7 rute CRUD sekaligus!
    Route::resource('products', ProductController::class)->names('admin.products');

    Route::resource('categories', CategoryController::class)->names('admin.categories')->except(['create', 'show', 'edit']);
    
    Route::resource('orders', OrderController::class)->names('admin.orders')->only(['index', 'show', 'update']);
});