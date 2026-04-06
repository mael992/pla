<?php

use App\Http\Controllers\IncidentController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

// Pages publiques
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/infos', [PageController::class, 'infos'])->name('infos');

// Dashboard (admin only)
Route::get('/dashboard', [IncidentController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('dashboard');

// CRUD incidents (admin only)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('incidents', IncidentController::class);
});