<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ChantierController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminTicketController;
use App\Http\Controllers\PublicThreadController;

require __DIR__.'/auth.php';

// ── LANGUE ──────────────────────────────────────────────────
Route::get('/lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');

// ── PAGES PUBLIQUES ──────────────────────────────────────────
Route::get('/',           [PageController::class, 'home'])->name('home');
Route::get('/infos',      [PageController::class, 'infos'])->name('infos');
Route::get('/tarifs',     [PageController::class, 'tarifs'])->name('tarifs');
Route::get('/nouveautes', [PageController::class, 'nouveautes'])->name('nouveautes');

// ── CONTACT (système de ticketing) ───────────────────────────
Route::get('/contact',  [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// ── THREAD PUBLIC (accessible sans auth) ─────────────────────
Route::get('/message/{token}',         [PublicThreadController::class, 'show'])->name('message.show');
Route::post('/message/{token}/reply',  [PublicThreadController::class, 'reply'])->name('message.reply');
Route::post('/message/{token}/reopen', [PublicThreadController::class, 'requestReopen'])->name('message.reopen');

// ── ZONES (public — accessibles depuis le formulaire) ────────
Route::get('/zones',           [ZoneController::class, 'index'])->name('zones.index');
Route::post('/zones',          [ZoneController::class, 'store'])->name('zones.store');
Route::delete('/zones/{zone}', [ZoneController::class, 'destroy'])->name('zones.destroy');

// ── ADMIN UNIQUEMENT ─────────────────────────────────────────
Route::middleware(['auth', 'admin'])->group(function () {
    // Tableau d'administration unifié
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::resource('users', UserController::class);
    Route::get('/users/{user}/courrier', [UserController::class, 'courrier'])->name('users.courrier');

    // Logs d'activité
    Route::get('/admin/logs',          [ActivityLogController::class, 'index'])->name('admin.logs.index');
    Route::get('/admin/logs/download', [ActivityLogController::class, 'download'])->name('admin.logs.download');

    // Tickets admin
    Route::get('/admin/tickets',                          [AdminTicketController::class, 'index'])->name('admin.tickets.index');
    Route::get('/admin/tickets/{ticket}',                 [AdminTicketController::class, 'show'])->name('admin.tickets.show');
    Route::post('/admin/tickets/{ticket}/reply',          [AdminTicketController::class, 'reply'])->name('admin.tickets.reply');
    Route::post('/admin/tickets/{ticket}/close',          [AdminTicketController::class, 'close'])->name('admin.tickets.close');
    Route::post('/admin/tickets/{ticket}/accept-reopen',  [AdminTicketController::class, 'acceptReopen'])->name('admin.tickets.accept-reopen');
    Route::post('/admin/tickets/{ticket}/deny-reopen',    [AdminTicketController::class, 'denyReopen'])->name('admin.tickets.deny-reopen');
});

// ── ADMIN + INCIDENT ─────────────────────────────────────────
Route::middleware(['auth', 'incidents.access'])->group(function () {

    // Dashboard & anomalies
    Route::get('/dashboard', [IncidentController::class, 'index'])->name('dashboard');
    Route::resource('incidents', IncidentController::class);

    // Temps réel, suggestions, PDF
    Route::get('/poll-incidents',        [IncidentController::class, 'poll'])->name('incidents.poll');
    Route::get('/incidents-suggestions', [IncidentController::class, 'searchSuggestions'])->name('incidents.suggestions');
    Route::get('/incidents-pdf',         [IncidentController::class, 'exportPdf'])->name('incidents.pdf');

    // Chantiers
    Route::resource('chantiers', ChantierController::class);
    Route::get('/chantiers/{chantier}/members',         [ChantierController::class, 'members'])->name('chantiers.members');
    Route::post('/chantiers/{chantier}/users',          [ChantierController::class, 'addUser'])->name('chantiers.users.add');
    Route::put('/chantiers/{chantier}/users/{user}',    [ChantierController::class, 'updateUser'])->name('chantiers.users.update');
    Route::delete('/chantiers/{chantier}/users/{user}', [ChantierController::class, 'removeUser'])->name('chantiers.users.remove');
});
