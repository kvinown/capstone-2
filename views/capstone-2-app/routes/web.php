<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FakultasController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Fakultas
    Route::get('/fakultas-index', [FakultasController::class, 'index'])->name('fakultas.index');
});

Route::get('/index', function () {
    return view('periodeBeasiswa.index');
});
Route::get('/index2', function () {
    return view('periodeBeasiswa.create');
});



require __DIR__.'/auth.php';
