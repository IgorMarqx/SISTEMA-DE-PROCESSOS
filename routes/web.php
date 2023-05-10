<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\UserController;

use App\Http\Controllers\pages\AdminController;

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login_action', [LoginController::class, 'login_action'])->name('login_action');

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');

    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::resource('users', UserController::class);
});
