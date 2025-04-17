<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::put('/user/status', [\App\Http\Controllers\RegistrationsController::class, 'updateStatus']);
Route::post('/archive/upload', [\App\Http\Controllers\ArchiveController::class, 'upload'])->name('archive.upload');
