<?php

use App\Http\Middleware\EnsureUserIsAdmin as EnsureUserIsAdminAlias;
use App\Http\Middleware\EnsureUserIsApproved as EnsureUserIsApprovedAlias;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/not-approved', function () {
        return Inertia::render('NotApproved');
    })->name('not-approved');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    EnsureUserIsApprovedAlias::class
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/polls', [\App\Http\Controllers\PollController::class, 'index'])->name('polls');
    Route::get('/poll/{poll}', [\App\Http\Controllers\PollController::class, 'show'])->name('polls.show');
    Route::get('/archive', [\App\Http\Controllers\ArchiveController::class, 'show'])->name('archive');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    EnsureUserIsAdminAlias::class,
])->group(function () {
    Route::get('/registrations', [\App\Http\Controllers\RegistrationsController::class, 'index'])->name('registrations');
    });
