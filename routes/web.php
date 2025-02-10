<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;
use App\Http\Middleware\UserAccess;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// Autentikasi bawaan Laravel
Auth::routes();

// Middleware untuk user biasa
Route::middleware(['auth', UserAccess::class . ':user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

// Middleware untuk admin
Route::middleware(['auth', UserAccess::class . ':admin'])->group(function () {
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
});

// Middleware untuk manager
Route::middleware(['auth', 'user-access:manager'])->group(function () {
    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');
});

// Route untuk ProdukController (Hanya bisa diakses setelah login)
Route::middleware(['auth'])->group(function () {
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('produk/{id}', [ProdukController::class, 'show'])->name('produk.show');
    Route::get('produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
});
