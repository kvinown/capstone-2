<?php
use App\Http\Controllers\DokumenPengajuanController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/dokumenBeasiswa-index', [DokumenPengajuanController::class, 'index'])->name('dokumenBeasiswa.index');
    Route::get('/dokumenBeasiswa-create', [DokumenPengajuanController::class, 'create'])->name('dokumenBeasiswa.create');
    Route::post('/dokumenBeasiswa-store', [DokumenPengajuanController::class, 'store'])->name('dokumenBeasiswa.store');
});
