<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Rotas públicas
Route::get('/', function () {
    return view('welcome');
});

// Rotas de autenticação (Breeze)
require __DIR__.'/auth.php';

// Rotas de aluno autenticado
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('activities', ActivityController::class)->except(['edit', 'update', 'destroy']);
    Route::get('/certificate', [CertificateController::class, 'generate'])->name('certificate');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Rotas de administrador
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/activities', [AdminController::class, 'activities'])->name('admin.activities');
    Route::get('/students', [AdminController::class, 'students'])->name('admin.students');
    Route::post('/activities/{activity}/status', [ActivityController::class, 'updateStatus'])->name('activities.status');
});