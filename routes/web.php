<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BarangMasukController;
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

    Route::prefix('get-data')->as('get-data.')->group(function () {
        Route::get('/produk', [ProdukController::class, 'getData'])->name('produk');
        Route::get('/cek-stok-produk', [ProdukController::class, 'cekStok'])->name('cek-stok');
    });

    Route::resource('/kategori', KategoriController::class)->names([
        'index' => 'kategori',
    ]);

    Route::resource('/produk', ProdukController::class)->names([
        'index' => 'produk',
    ]);

    Route::resource('/supplier', SupplierController::class)->names([
        'index' => 'supplier',
    ]);
    Route::prefix('barang-masuk')->as('barang-masuk.')->controller(BarangMasukController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
    });
    Route::get('laporan', [BarangMasukController::class, 'laporan'])->name('laporan');
});
