<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'adminLogin'])->name('admin.login');
    Route::get('/register', [AdminController::class, 'adminRegister'])->name('admin.register');
    Route::post('/register-process', [AdminController::class, 'adminRegisterProcess'])->name('admin.register.process');
    Route::post('/login-process', [AdminController::class, 'adminLoginProcess'])->name('admin.login.process');
});
