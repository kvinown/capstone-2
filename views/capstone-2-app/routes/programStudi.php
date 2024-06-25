<?php

use App\Http\Controllers\ProgramStudiController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth','admin')->group(function () {
    Route::get('/programStudi-index', [ProgramStudiController::class, 'index'])->name('programStudi.index');
    Route::get('/programStudi-create', [ProgramStudiController::class, 'create'])->name('programStudi.create');
    Route::post('/programStudi-store', [ProgramStudiController::class, 'store'])->name('programStudi.store');
    Route::get('/programStudi-edit/{id}', [ProgramStudiController::class, 'edit'])->name('programStudi.edit');
    Route::post('/programStudi-update', [ProgramStudiController::class, 'update'])->name('programStudi.update');
    Route::delete('/programStudi-delete/{id}', [ProgramStudiController::class, 'destroy'])->name('programStudi.delete');
});
