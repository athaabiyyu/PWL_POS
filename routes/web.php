<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/level', [LevelController::class, 'index']);
Route::get('/level/tambah', [LevelController::class, 'tambah']);
Route::post('/level/tambah_simpan', [LevelController::class, 'tambah_simpan']);

Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/kategori/create', [KategoriController::class, 'create']);
Route::post('/kategori', [KategoriController::class, 'store']);
Route::get('/kategori/edit_view/{kategori:kategori_kode}', [KategoriController::class, 'viewEdit']);
Route::put('/kategori/edit/{kategori:kategori_kode}', [KategoriController::class, 'edit']);
Route::get('/kategori/delete/{kategori:kategori_kode}', [KategoriController::class, 'delete']);

Route::get('/user', [UserController::class, 'index']);
Route::get('/user/tambah', [UserController::class, 'tambah']);
Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);
Route::get('/user/form', [UserController::class, 'form']);

