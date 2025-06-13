<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::get('/', [LoginController::class, 'index']);
    Route::get('login', [LoginController::class, 'index']);
    Route::post('login', [LoginController::class, 'handleLogin'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/kategori', KategoriController::class)->names([
        'index' => 'kategori',
    ]);

    Route::resource('/produk', ProdukController::class)->names([
        'index' => 'produk',
    ]);

    Route::resource('/supplier', SupplierController::class)->names([
        'index' => 'supplier',
    ]);
    // Route::prefix('master-data')->as('master-data.')->group(function () {
    // Route::prefix('kategori')->as('kategori')->controller(KategoriController::class)->group(function () {
    // Route::get('kategori', [KategoriController::class, 'index'])->name('kategori');
    // Route::post('kategori', [KategoriController::class, 'store'])->name('store');
    // Route::get('kategori/{kategori}', [KategoriController::class, 'show'])->name('show');
    // Route::put('kategori/{kategori}', [KategoriController::class, 'update'])->name('update');
    // Route::delete('kategori/{kategori}', [KategoriController::class, 'destroy'])->name('delete');
    // Route::get('kategori/{kategori}/edit', [KategoriController::class, 'edit'])->name('edit');
    // });
    // });
});
