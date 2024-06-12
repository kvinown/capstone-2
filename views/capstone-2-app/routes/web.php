<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\ProgramStudiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Fakultas
    Route::get('/fakultas-index', [FakultasController::class, 'index'])->name('fakultas.index');
    Route::get('/fakultas-create', [FakultasController::class, 'create'])->name('fakultas.create');
    Route::post('/fakultas-store', [FakultasController::class, 'store'])->name('fakultas.store');

    // Program Studi
    Route::get('/programStudi-index', [ProgramStudiController::class, 'index'])->name('programStudi.index');
    Route::get('/programStudi-create', [ProgramStudiController::class, 'create'])->name('programStudi.create');
    Route::post('/programStudi-store', [ProgramStudiController::class, 'store'])->name('programStudi.store');
});

Route::get('/periode', function () {
    return view('periodeBeasiswa.index');
})->name('periode-index');
Route::get('/createPeriode', function () {
    return view('periodeBeasiswa.create');
})->name('periode-create');

Route::get('/role', function () {
    return view('role.index');
})->name('role-index');
Route::get('/createRole', function () {
    return view('role.create');
})->name('role-create');

Route::get('/user', function () {
    return view('user.index');
})->name('user-index');
Route::get('/createUser', function () {
    return view('user.create');
})->name('user-create');

Route::get('/prodi', function () {
    return view('prodi.index');
})->name('prodi-index');
Route::get('/createProdi', function () {
    return view('prodi.create');
})->name('prodi-create');

Route::get('/pengajuan', function () {
    return view('pengajuan.index');
})->name('pengajuan-index');
Route::get('/createPengajuan', function () {
    return view('pengajuan.create');
})->name('pengajuan-create');

Route::get('/jenis', function () {
    return view('jenisBeasiswa.index');
})->name('jenisBeasiswa-index');
Route::get('/createJenis', function () {
    return view('jenisBeasiswa.create');
})->name('jenisBeasiswa-create');

Route::get('/fakultas', function () {
    return view('fakultas.index');
})->name('fakultas-index');
Route::get('/createFakultas', function () {
    return view('fakultas.create');
})->name('fakultas-create');

require __DIR__.'/auth.php';
