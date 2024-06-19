<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/role-index', [RoleController::class, 'index'])->name('role.index');
    Route::get('/role-create', [RoleController::class, 'create'])->name('role.create');
    Route::post('/role-store', [RoleController::class, 'store'])->name('role.store');
    Route::get('/role-edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
    Route::post('/role-update', [RoleController::class, 'update'])->name('role.update');
    Route::delete('/role-delete/{id}', [RoleController::class, 'destroy'])->name('role.delete');

});
