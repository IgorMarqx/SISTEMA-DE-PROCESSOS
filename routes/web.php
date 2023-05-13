<?php
use App\Models\User;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\UserController;

use App\Http\Controllers\pages\AdminController;
use App\Http\Controllers\pages\ProccessController;

use App\Http\Controllers\profile\ProfileController;

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login_action', [LoginController::class, 'login_action'])->name('login_action');

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('welcome');
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin');

    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::resource('users', UserController::class);

    Route::get('proccess', [ProccessController::class, 'index'])->name('proccess');
    Route::get('finish/{id}', [ProccessController::class, 'finish'])->name('finish');
    Route::resource('proccess', ProccessController::class);

    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
});
