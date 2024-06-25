<?php

use App\Http\Controllers\JenisBeasiswaController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth','admin')->group(function () {
    Route::get('/jenisBeasiswa-index', [JenisBeasiswaController::class, 'index'])->name('jenisBeasiswa.index');
    Route::get('/jenisBeasiswa-create', [JenisBeasiswaController::class, 'create'])->name('jenisBeasiswa.create');
    Route::post('/jenisBeasiswa-store', [JenisBeasiswaController::class, 'store'])->name('jenisBeasiswa.store');
    Route::get('/jenisBeasiswa-edit/{id}', [JenisBeasiswaController::class, 'edit'])->name('jenisBeasiswa.edit');
    Route::post('/jenisBeasiswa-update', [JenisBeasiswaController::class, 'update'])->name('jenisBeasiswa.update');
    Route::delete('/jenisBeasiswa-delete/{id}', [JenisBeasiswaController::class, 'destroy'])->name('jenisBeasiswa.delete');
});
