<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;

// Rute untuk halaman utama toko
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rute otomatis untuk Login, Register, dll (bawaan Laravel UI)
Auth::routes();

Route::get('/home', function () {
    if (auth()->check()) {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        // Jika bukan admin (customer), lempar ke halaman utama
        return redirect('/');
    }
    return redirect('/login');
});

// Rute khusus Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});