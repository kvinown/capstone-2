<?php

use App\Http\Controllers\PengajuanBeasiswaController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/pengajuanBeasiswa-index', [PengajuanBeasiswaController::class, 'index'])->name('pengajuanBeasiswa.index');
    Route::get('/pengajuanBeasiswa-create', [PengajuanBeasiswaController::class, 'create'])->name('pengajuanBeasiswa.create');
    Route::post('/pengajuanBeasiswa-store', [PengajuanBeasiswaController::class, 'store'])->name('pengajuanBeasiswa.store');
    Route::get('/pengajuanBeasiswa-createDokumen', [PengajuanBeasiswaController::class, 'createDokumen'])->name('pengajuanBeasiswa.dokumen');
    Route::post('/pengajuanBeasiswa-storeDokumen', [PengajuanBeasiswaController::class, 'storeDokumen'])->name('pengajuanBeasiswa.storeDocument');
//    Route::get('/fakultas-edit/{id}', [FakultasController::class, 'edit'])->name('fakultas.edit');
//    Route::post('/fakultas-update', [FakultasController::class, 'update'])->name('fakultas.update');
//    Route::delete('/fakultas-delete/{id}', [FakultasController::class, 'destroy'])->name('fakultas.delete');

});
