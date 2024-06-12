<?php

use App\Http\Controllers\FakultasController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/fakultas-index', [FakultasController::class, 'index'])->name('fakultas.index');
    Route::get('/fakultas-create', [FakultasController::class, 'create'])->name('fakultas.create');
    Route::post('/fakultas-store', [FakultasController::class, 'store'])->name('fakultas.store');
});
