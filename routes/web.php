<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ArticleController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\TrackingController;

Route::get('/', [SearchController::class, 'index'])->name('search.index');
Route::get('/export', [SearchController::class, 'export'])->name('search.export');
Route::get('/article/{id}', [ArticleController::class, 'show'])->name('article.show');

// Tracking Route
Route::get('/track/redirect', [TrackingController::class, 'redirect'])->name('track.redirect');

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/authenticate', [AdminController::class, 'authenticate'])->name('admin.authenticate');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

// Halaman Statis / Bantuan
Route::view('/tentang', 'about')->name('about');
Route::view('/cara-menggunakan', 'how-to-use')->name('how-to-use');
Route::view('/faq', 'faq')->name('faq');

// Route khusus untuk preview halaman error
Route::get('/error-preview/{code}', function($code) {
    if (view()->exists("errors.{$code}")) {
        return view("errors.{$code}");
    }
    abort(404);
});
// Easter Egg Route
Route::get('/meetyourmaker', function () {
    return redirect('https://www.linkedin.com/in/bagusikapraja/');
});
