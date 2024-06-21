<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/users-index', [UsersController::class, 'index'])->name('users.index');
    Route::get('/users-create', [UsersController::class, 'create'])->name('users.create');
});
