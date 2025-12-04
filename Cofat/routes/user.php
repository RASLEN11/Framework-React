<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsUserController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\MessageController;

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
| Routes for authenticated users (protected by auth and user middleware)
|
*/

Route::middleware(['auth', 'user'])->group(function () {
    // Dashboard Route
    Route::get('/user/dashboard', [UserDashboardController::class, 'dashboard'])
        ->name('user.dashboard');

    // Settings Routes
    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingsUserController::class, 'index'])->name('settings');
        Route::put('/', [SettingsUserController::class, 'update'])->name('settings.update');
        Route::post('/avatar', [SettingsUserController::class, 'updateAvatar'])->name('settings.avatar');
        Route::post('/avatar/remove', [SettingsUserController::class, 'removeAvatar'])->name('settings.avatar.remove');
        Route::post('/application-availability', [SettingsUserController::class, 'updateApplicationAvailability'])
            ->name('settings.update-application-availability');
    });

    // Message Routes
    Route::prefix('/user/messages')->group(function () {
        Route::get('/', [MessageController::class, 'index'])->name('user.messages');
        Route::post('/', [MessageController::class, 'store'])->name('user.messages.store');
    });
});

require __DIR__.'/auth.php';