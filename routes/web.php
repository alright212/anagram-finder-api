<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HealthController;

Route::get('/', function () {
    return view('welcome');
});

// Health check endpoints for App Runner
Route::get('/health', [HealthController::class, 'check'])->name('health.check');
Route::get('/ready', [HealthController::class, 'ready'])->name('health.ready');

// OpenAPI JSON endpoint (standard path)
Route::get('/openapi.json', function () {
    $docsPath = storage_path('openapi.json');
    if (file_exists($docsPath)) {
        return response()->json(json_decode(file_get_contents($docsPath), true))
            ->header('Content-Type', 'application/json');
    }
    return redirect('/docs');
})->name('openapi.json');

// Testing cache optimization - Thu Jun 12 15:52:36 EEST 2025
