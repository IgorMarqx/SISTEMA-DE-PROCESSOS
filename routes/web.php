<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\UserController;
use App\Http\Controllers\auth\LawyerController;
use App\Http\Controllers\pages\DashboardController;

use App\Http\Controllers\pages\CollectiveController;
use App\Http\Controllers\pages\AdministrativeCollectiveController;

use App\Http\Controllers\pages\AdministrativeIndividualController;
use App\Http\Controllers\pages\IndividualController;

use App\Http\Controllers\profile\ProfileController;
use App\Http\Controllers\requeriments\RequerimentController;

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login_action', [LoginController::class, 'login_action'])->name('login_action');

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('welcome');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::post('store_modal', [UserController::class, 'storeModal'])->name('store_modal');
    Route::post('lawyer', [LawyerController::class, 'store'])->name('lawyer');

    // PROCESSOS JUDICIAL COLETIVOS
    Route::get('collective', [CollectiveController::class, 'index'])->name('collective');
    Route::get('finish/{id}', [CollectiveController::class, 'finish'])->name('finish');
    Route::post('attachment/{id}', [CollectiveController::class, 'attachment'])->name('attachment');
    Route::delete('deletAttachment/{id}', [CollectiveController::class, 'deletAttachment'])->name('deletAttachment');
    Route::get('downloadAttachment/{id}', [CollectiveController::class, 'downloadAttachment'])->name('downloadAttachment');

    // PROCESSOS ADMINISTRATIVOS COLETIVOS
    Route::get('administrative_collective', [AdministrativeCollectiveController::class])->name('administrative_collective.index');
    Route::get('adm_finish/{id}', [AdministrativeCollectiveController::class, 'finish'])->name('adm_finish');
    Route::post('adm_attachment/{id}', [AdministrativeCollectiveController::class, 'attachment'])->name('adm_attachment');

    // PROCESSOS JUDICIAIS INDIVIDUAIS
    Route::get('individual', [IndividualController::class, 'index'])->name('individual');
    Route::post('individual_attachment/{id}', [IndividualController::class, 'attachment'])->name('individual_attachment');
    Route::get('individual_finish/{id}', [IndividualController::class, 'finish'])->name('individual_finish');

    // PROCESSOS ADMINISTRATIVOS INDIVIDUAIS
    Route::get('administrative_individual', [AdministrativeIndividualController::class, 'index'])->name('administrative_individual');
    Route::post('adm_individual_attachment/{id}', [AdministrativeIndividualController::class, 'attachment'])->name('adm_individual_attachment');
    Route::get('adm_idividual_finish/{id}', [AdministrativeIndividualController::class, 'finish'])->name('adm_individual_finish');

    Route::get('requeriments', [RequerimentController::class, 'index'])->name('requeriments');

    // RESOURCES
    Route::resource('users', UserController::class);
    Route::resource('collective', CollectiveController::class);
    Route::resource('administrative_collective', AdministrativeCollectiveController::class);
    Route::resource('individual', IndividualController::class);
    Route::resource('administrative_individual', AdministrativeIndividualController::class);
    Route::resource('requeriments', RequerimentController::class);
});
