<?php

use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard', ['title' => 'Dahsboard']);
});

// Kategori
Route::get('/kategori', [KategoriController::class, 'index2']); //menampikan data
Route::resource('/kategori', KategoriController::class);
