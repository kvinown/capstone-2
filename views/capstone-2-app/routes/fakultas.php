<?php

use App\Http\Controllers\FakultasController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth','admin')->group(function () {
    Route::get('/fakultas-index', [FakultasController::class, 'index'])->name('fakultas.index');
    Route::get('/fakultas-create', [FakultasController::class, 'create'])->name('fakultas.create');
    Route::post('/fakultas-store', [FakultasController::class, 'store'])->name('fakultas.store');
    Route::get('/fakultas-edit/{id}', [FakultasController::class, 'edit'])->name('fakultas.edit');
    Route::post('/fakultas-update', [FakultasController::class, 'update'])->name('fakultas.update');
    Route::delete('/fakultas-delete/{id}', [FakultasController::class, 'destroy'])->name('fakultas.delete');

});
