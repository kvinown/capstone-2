<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/users-index', [UsersController::class, 'index'])->name('users.index');
    Route::get('/users-create', [UsersController::class, 'create'])->name('users.create');
    Route::post('/users-store', [UsersController::class, 'store'])->name('users.store');
    Route::get('/users-edit/{id}', [UsersController::class, 'edit'])->name('users.edit');
    Route::post('/users-update', [UsersController::class,'update'])->name('users.update');
});
