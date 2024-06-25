<?php
use App\Http\Controllers\PengajuanBeasiswaController;
use App\Http\Controllers\PengajuanBerkasBeasiswaController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/pengajuanBeasiswa-index', [PengajuanBeasiswaController::class, 'index'])->name('pengajuanBeasiswa.index');
    Route::get('/pengajuanBeasiswa-create', [PengajuanBeasiswaController::class, 'create'])->name('pengajuanBeasiswa.create');
    Route::post('/pengajuanBeasiswa-store', [PengajuanBeasiswaController::class, 'store'])->name('pengajuanBeasiswa.store');
    Route::get('/pengajuanBeasiswa-detail/{users_id}/{jenisBeasiswa_id}/{periodeBeasiswa_id}/{ipk}/{point_portofolio}', [PengajuanBeasiswaController::class, 'detail'])->name('pengajuanBeasiswa.detail');
});
