<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HealthController;

Route::get('/', function () {
    return view('welcome');
});

// Health check endpoints for App Runner
Route::get('/health', [HealthController::class, 'check'])->name('health.check');
Route::get('/ready', [HealthController::class, 'ready'])->name('health.ready');

// Testing cache optimization - Thu Jun 12 15:52:36 EEST 2025
