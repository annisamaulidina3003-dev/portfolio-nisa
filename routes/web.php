<?php

use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CvController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PortofolioController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortofolioController::class, 'index'])->name('home');

Route::view('/cv', 'cv')->name('cv');
Route::get('/cv/download', [CvController::class, 'download'])->name('cv.download');

Route::post('/feedback', [FeedbackController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('feedback.store');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
    Route::post('/', [PortofolioController::class, 'store'])->name('portofolios.store');
    Route::get('/portofolios/{portofolio}/edit', [PortofolioController::class, 'edit'])->name('portofolios.edit');
    Route::put('/portofolios/{portofolio}', [PortofolioController::class, 'update'])->name('portofolios.update');
    Route::delete('/portofolios/{portofolio}', [PortofolioController::class, 'destroy'])->name('portofolios.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('projects', ProjectController::class)->except('show');
    Route::resource('certificates', CertificateController::class)->except('show');

    Route::get('content', [ContentController::class, 'edit'])->name('content.edit');
    Route::put('content', [ContentController::class, 'update'])->name('content.update');

    Route::get('messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('messages/{message}', [MessageController::class, 'show'])->name('messages.show');
    Route::delete('messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

    Route::get('settings', [AdminProfileController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [AdminProfileController::class, 'update'])->name('settings.update');
    Route::post('settings/photo', [AdminProfileController::class, 'updatePhoto'])->name('settings.photo');
});
