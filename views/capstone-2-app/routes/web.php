<?php

use Illuminate\Support\Facades\Route;

// Include Fakultas routes
include __DIR__.'/fakultas.php';
// Include Program Studi routes
include __DIR__.'/programStudi.php';
// Include Jenis Beassiwa routes
include __DIR__.'/jenisBeasiswa.php';

// Welcome route
Route::get('/', function () {
    return view('welcome');
});

// Dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Other routes...
// Route untuk halaman detail periode beasiswa
Route::get('/periode/{id}', function ($id) {
    // Contoh implementasi: ambil data periode beasiswa berdasarkan ID dan tampilkan di view
    return view('periodeBeasiswa.detail', ['id' => $id]);
})->name('periode-detail');

// Route untuk halaman detail pengajuan
Route::get('/pengajuan/{id}', function ($id) {
    // Contoh implementasi: ambil data pengajuan beasiswa berdasarkan ID dan tampilkan di view
    return view('pengajuan.detail', ['id' => $id]);
})->name('pengajuan-detail');

// Route untuk halaman detail jenis beasiswa
Route::get('/jenis/{id}', function ($id) {
    // Contoh implementasi: ambil data jenis beasiswa berdasarkan ID dan tampilkan di view
    return view('jenisBeasiswa.detail', ['id' => $id]);
})->name('jenisBeasiswa-detail');

// Route untuk halaman detail fakultas
Route::get('/fakultas/{id}', function ($id) {
    // Contoh implementasi: ambil data fakultas berdasarkan ID dan tampilkan di view
    return view('fakultas.detail', ['id' => $id]);
})->name('fakultas-detail');

// Route untuk halaman detail user
Route::get('/user/{id}', function ($id) {
    // Contoh implementasi: ambil data user berdasarkan ID dan tampilkan di view
    return view('user.detail', ['id' => $id]);
})->name('user-detail');

// Route untuk halaman detail role
Route::get('/role/{id}', function ($id) {
    // Contoh implementasi: ambil data role berdasarkan ID dan tampilkan di view
    return view('role.detail', ['id' => $id]);
})->name('role-detail');

// Route untuk halaman detail prodi
Route::get('/prodi/{id}', function ($id) {
    // Contoh implementasi: ambil data prodi berdasarkan ID dan tampilkan di view
    return view('prodi.detail', ['id' => $id]);
})->name('prodi-detail');
