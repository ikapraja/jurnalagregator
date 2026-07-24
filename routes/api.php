<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\JournalController;

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

Route::prefix('v1')->group(function () {
    Route::get('/search', [JournalController::class, 'search']);
    Route::get('/journal/{id}', [JournalController::class, 'show']);
    Route::get('/sources', [JournalController::class, 'sources']);
});

Route::post('/track', function(\Illuminate\Http\Request $request) {
    try {
        \App\Models\DownloadLog::create([
            'repository_name' => $request->input('repo', 'Agregator'),
            'download_type' => $request->input('type', 'action'),
            'article_title' => $request->input('title', 'Unknown')
        ]);
        return response()->json(['success' => true]);
    } catch (\Throwable $e) {
        \Illuminate\Support\Facades\Log::error('API Track Error: ' . $e->getMessage());
        return response()->json(['success' => false], 500);
    }
});
