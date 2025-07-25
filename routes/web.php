<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    alert()->error('404', 'Halaman tidak ditemukan.');
    return redirect()->route('dashboard');
});

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
        Route::get('/supplier', [SupplierController::class, 'getData'])->name('supplier');
        Route::get('/cek-stok-produk', [ProdukController::class, 'cekStok'])->name('cek-stok');
        Route::get('/cek-harga-beli', [ProdukController::class, 'cekHargaBeli'])->name('cek-harga-beli');
        Route::get('/cek-harga-jual', [ProdukController::class, 'cekHargaJual'])->name('cek-harga-jual');
    });

    Route::middleware(['is_admin'])->group(function () {
        Route::resource('/users', UsersController::class)->except(['show'])->names([
            'index' => 'users',
        ]);

        Route::post('/user/reset-password', [UsersController::class, 'resetPass'])->name('reset-password');
    });

    Route::resource('/kategori', KategoriController::class)->except(['show'])->names([
        'index' => 'kategori',
    ]);

    Route::resource('/produk', ProdukController::class)->except(['show'])->names([
        'index' => 'produk',
    ]);

    Route::resource('/supplier', SupplierController::class)->except(['show'])->names([
        'index' => 'supplier',
    ]);

    Route::get('/profil', [UsersController::class, 'profil'])->name('profil');
    Route::post('/profil', [UsersController::class, 'editProfil'])->name('edit-profil');

    Route::prefix('kasir')->as('kasir.')->controller(KasirController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
    });

    Route::prefix('laporan-penjualan')->as('laporan-penjualan.')->group(function () {
        Route::get('/', [KasirController::class, 'laporan'])->name('laporan');
        Route::get('/{no_kwitansi}/detail', [KasirController::class, 'detailLaporan'])->name('detail');
    });

    Route::prefix('barang-masuk')->as('barang-masuk.')->controller(BarangMasukController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
    });

    Route::prefix('laporan-pembelian')->as('laporan-pembelian.')->group(function () {
        Route::get('/', [BarangMasukController::class, 'laporan'])->name('laporan');
        Route::get('/{no_penerimaan}/detail', [BarangMasukController::class, 'detailLaporan'])->name('detail');
    });
});
