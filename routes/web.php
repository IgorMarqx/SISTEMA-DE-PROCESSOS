<?php
use App\Models\User;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\UserController;
use App\Http\Controllers\pages\DashboardController;

use App\Http\Controllers\pages\CollectiveController;
use App\Http\Controllers\pages\AdministrativeCollectiveController;

use App\Http\Controllers\pages\IndividualController;

use App\Http\Controllers\profile\ProfileController;

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login_action', [LoginController::class, 'login_action'])->name('login_action');

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('welcome');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::resource('users', UserController::class);

    Route::get('collective', [CollectiveController::class, 'index'])->name('collective');
    Route::resource('collective', CollectiveController::class);
    Route::get('finish/{id}', [CollectiveController::class, 'finish'])->name('finish');
    Route::get('reopen/{id}', [CollectiveController::class, 'reopen'])->name('reopen');
    Route::post('attachment/{id}', [CollectiveController::class, 'attachment'])->name('attachment');
    Route::delete('deletAttachment/{id}', [CollectiveController::class, 'deletAttachment'])->name('deletAttachment');

    Route::get('administrative_collective', [AdministrativeCollectiveController::class])->name('administrative_collective.index');
    Route::resource('administrative_collective', AdministrativeCollectiveController::class);

    Route::get('individual', [IndividualController::class, 'index'])->name('individual');
    Route::resource('individual', IndividualController::class);

    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
});
