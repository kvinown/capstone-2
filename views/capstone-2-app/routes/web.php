<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Include Fakultas routes
include __DIR__.'/fakultas.php';
// Include Program Studi routes
include __DIR__.'/programStudi.php';
// Include Jenis Beassiwa routes
include __DIR__.'/jenisBeasiswa.php';
// Include Role routes
include __DIR__.'/role.php';
// Include User routes
include __DIR__.'/users.php';
// Include periode routes
include __DIR__.'/periodeBeasiswa.php';
// Include Tanggal Periode Beasiswa routes
include __DIR__.'/tanggalPeriodeBeasiswa.php';
// Include Pengajuan Beasiswa routes
include __DIR__.'/pengajuanBeasiswa.php';
// Include Pengajuan Berkas Beasiswa routes
include __DIR__ . '/dokumenPengajuan.php';
// Require Authorization routes
require __DIR__.'/auth.php';

// Welcome route
Route::get('/', function () {
    return view('welcome');
});
Route::get('/unauthorized', function () {
    return view('unauthorized'); // Ensure you have an unauthorized.blade.php view file
})->name('unauthorized');

//Logout route
Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::get('/home', function () {
    return view('home');
})->name('home-index');

// Dashboard route
Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

// contact
// Route untuk halaman kontak
Route::get('/contact', function () {
    return view('contact');
})->name('contact');


// Other routes...
/*
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

// Route untuk halaman detail users
Route::get('/users/{id}', function ($id) {
    // Contoh implementasi: ambil data users berdasarkan ID dan tampilkan di view
    return view('users.detail', ['id' => $id]);
})->name('users-detail');

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
*/
