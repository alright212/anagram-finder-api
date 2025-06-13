<?php

use App\Http\Controllers\Api\V1\AnagramController;
use App\Http\Controllers\Api\V1\WordbaseController;
use App\Http\Controllers\Api\V1\AdvancedWordbaseController;
use App\Http\Controllers\Api\V1\LocaleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API v1 routes
Route::prefix('v1')->group(function () {
    
    // Wordbase management routes
    Route::prefix('wordbase')->group(function () {
        Route::post('import', [WordbaseController::class, 'import'])->name('api.v1.wordbase.import');
        Route::get('status', [WordbaseController::class, 'status'])->name('api.v1.wordbase.status');
    });

    // Anagram search routes
    Route::prefix('anagrams')->group(function () {
        Route::get('top', [AnagramController::class, 'top'])->name('api.v1.anagrams.top');
        Route::get('stats', [AnagramController::class, 'stats'])->name('api.v1.anagrams.stats');
        Route::get('{word}', [AnagramController::class, 'show'])->name('api.v1.anagrams.show');
    });

    // Internationalization routes
    Route::prefix('locale')->group(function () {
        Route::get('info', [LocaleController::class, 'info'])->name('api.v1.locale.info');
        Route::get('translations/{namespace}', [LocaleController::class, 'translations'])->name('api.v1.locale.translations');
        Route::post('preference', [LocaleController::class, 'setPreference'])->name('api.v1.locale.preference');
        Route::get('debug', [LocaleController::class, 'debug'])->name('api.v1.locale.debug');
    });

    // Advanced wordbase management with Unicode optimization
    /*
    Route::prefix('advanced')->group(function () {
        Route::prefix('wordbase')->group(function () {
            Route::post('import', [AdvancedWordbaseController::class, 'import'])->name('api.v1.advanced.wordbase.import');
            Route::get('status', [AdvancedWordbaseController::class, 'status'])->name('api.v1.advanced.wordbase.status');
        });
    });
    */
    
});
