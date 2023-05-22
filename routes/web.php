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
    Route::post('store_modal', [UserController::class, 'storeModal'])->name('store_modal');
    Route::resource('users', UserController::class);

    Route::get('collective', [CollectiveController::class, 'index'])->name('collective');
    Route::get('finish/{id}', [CollectiveController::class, 'finish'])->name('finish');
    Route::post('attachment/{id}', [CollectiveController::class, 'attachment'])->name('attachment');
    Route::delete('deletAttachment/{id}', [CollectiveController::class, 'deletAttachment'])->name('deletAttachment');
    Route::resource('collective', CollectiveController::class);

    Route::get('administrative_collective', [AdministrativeCollectiveController::class])->name('administrative_collective.index');
    Route::get('adm_finish/{id}', [AdministrativeCollectiveController::class, 'finish'])->name('adm_finish');
    Route::post('adm_attachment/{id}', [AdministrativeCollectiveController::class, 'attachment'])->name('adm_attachment');
    Route::delete('adm_deletAttachment/{id}', [AdministrativeCollectiveController::class, 'deletAttachment'])->name('adm_deletAttachment');
    Route::resource('administrative_collective', AdministrativeCollectiveController::class);

    Route::get('individual', [IndividualController::class, 'index'])->name('individual');
    Route::resource('individual', IndividualController::class);

    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
});
