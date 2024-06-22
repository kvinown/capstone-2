<?php

use App\Http\Controllers\TanggalPeriodeBeasiswaController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/tanggalPeriode-index', [TanggalPeriodeBeasiswaController::class, 'index'])->name('tanggalPeriode.index');
    Route::get('/tanggalPeriode-create', [TanggalPeriodeBeasiswaController::class, 'create'])->name('tanggalPeriode.create');
    Route::post('/tanggalPeriode-store', [TanggalPeriodeBeasiswaController::class, 'store'])->name('tanggalPeriode.store');
    Route::get('/tanggalPeriode-edit/{id}', [TanggalPeriodeBeasiswaController::class, 'edit'])->name('tanggalPeriode.edit');
//    Route::post('/periode-update', [TanggalPeriodeBeasiswaController::class, 'update'])->name('periode.update');
//    Route::delete('/periode-delete/{id}', [TanggalPeriodeBeasiswaController::class, 'destroy'])->name('periode.delete');
});
