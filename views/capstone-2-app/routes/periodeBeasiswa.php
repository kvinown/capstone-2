<?php

use App\Http\Controllers\PeriodeController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/periode-index', [PeriodeController::class, 'index'])->name('periode.index');
    Route::get('/periode-create', [PeriodeController::class, 'create'])->name('periode.create');
    Route::post('/periode-store', [PeriodeController::class, 'store'])->name('periode.store');
    Route::get('/periode-edit/{id}', [PeriodeController::class, 'edit'])->name('periode.edit');
    Route::post('/periode-update', [PeriodeController::class, 'update'])->name('periode.update');
    Route::delete('/periode-delete/{id}', [PeriodeController::class, 'destroy'])->name('periode.delete');
});
