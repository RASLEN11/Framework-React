<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonnelManagementController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminMessageController;
use App\Http\Controllers\SettingsUserController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| All routes here are protected by admin authentication middleware
|
*/

Route::middleware(['auth', 'admin'])->group(function () {
    // Dashboard Route
    Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])
        ->name('admin.dashboard');
    
    // Unified Personnel Management Routes
    Route::prefix('admin/personnel')->name('personnel.')->group(function () {
        // Main index route with tabs
        Route::get('/', [PersonnelManagementController::class, 'index'])->name('index');
        
        // Employee Routes
        Route::prefix('employees')->group(function () {
            Route::get('/create', [PersonnelManagementController::class, 'createEmployee'])->name('employees.create');
            Route::post('/', [PersonnelManagementController::class, 'storeEmployee'])->name('employees.store');
            Route::get('/{employee}', [PersonnelManagementController::class, 'showEmployee'])->name('employees.show');
            Route::get('/{employee}/edit', [PersonnelManagementController::class, 'editEmployee'])->name('employees.edit');
            Route::put('/{employee}', [PersonnelManagementController::class, 'updateEmployee'])->name('employees.update');
            Route::delete('/{employee}', [PersonnelManagementController::class, 'destroyEmployee'])->name('employees.destroy');
            Route::get('/admin/personnel/employees/export-simple', [PersonnelManagementController::class, 'exportEmployeesSimple'])
    ->name('employees.export.simple');
            
            // Qualification Routes
            Route::prefix('{employee}/qualifications')->group(function () {
                Route::get('/create', [PersonnelManagementController::class, 'createQualification'])->name('qualifications.create');
                Route::post('/', [PersonnelManagementController::class, 'storeQualification'])->name('qualifications.store');
                Route::put('/{qualification}', [PersonnelManagementController::class, 'updateQualification'])->name('qualifications.update');
                Route::delete('/{qualification}', [PersonnelManagementController::class, 'destroyQualification'])->name('qualifications.destroy');
                Route::get('/{qualification}', [PersonnelManagementController::class, 'showQualification'])->name('qualifications.show');
            });
        });
        
        // Stagiaire (Intern) Routes
        Route::prefix('stagiaires')->group(function () {
            Route::get('/create', [PersonnelManagementController::class, 'createStagiaire'])->name('stagiaires.create');
            Route::post('/', [PersonnelManagementController::class, 'storeStagiaire'])->name('stagiaires.store');
            Route::get('/{stagiaire}', [PersonnelManagementController::class, 'showStagiaire'])->name('stagiaires.show');
            Route::get('/{stagiaire}/edit', [PersonnelManagementController::class, 'editStagiaire'])->name('stagiaires.edit');
            Route::put('/{stagiaire}', [PersonnelManagementController::class, 'updateStagiaire'])->name('stagiaires.update');
            Route::delete('/{stagiaire}', [PersonnelManagementController::class, 'destroyStagiaire'])->name('stagiaires.destroy');
            Route::get('/export', [PersonnelManagementController::class, 'exportStagiaires'])->name('stagiaires.export');
        });
        
        // Qualification data route
        Route::get('/qualifications/employees', [DashboardController::class, 'getEmployeesByQualification']);
    });
    
    // Application Routes (unchanged)
    Route::prefix('admin/applications')->name('admin.applications.')->group(function () {
        Route::get('/', [ApplicationController::class, 'dashboard'])->name('index');

        // Job Application Routes
        Route::prefix('job')->name('job.')->group(function () {
            Route::get('/', [ApplicationController::class, 'jobIndex'])->name('index');
            Route::get('{application}', [ApplicationController::class, 'jobShow'])->name('show');
            Route::put('{application}', [ApplicationController::class, 'jobUpdate'])->name('update');
            Route::delete('{application}', [ApplicationController::class, 'jobDestroy'])->name('destroy');
            Route::get('{application}/download-cv', [ApplicationController::class, 'downloadJobCv'])->name('download.cv');
        });

        // Internship Application Routes
        Route::prefix('internship')->name('internship.')->group(function () {
            Route::get('/', [ApplicationController::class, 'internshipIndex'])->name('index');
            Route::get('{application}', [ApplicationController::class, 'internshipShow'])->name('show');
            Route::put('{application}', [ApplicationController::class, 'internshipUpdate'])->name('update');
            Route::delete('{application}', [ApplicationController::class, 'internshipDestroy'])->name('destroy');
            Route::get('{application}/download-cv', [ApplicationController::class, 'downloadInternshipCv'])->name('download.cv');
        });
    });
    
    // Contact Routes (unchanged)
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

    // Settings Routes (unchanged)
    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingsUserController::class, 'index'])->name('settings');
        Route::put('/', [SettingsUserController::class, 'update'])->name('settings.update');
        Route::post('/avatar', [SettingsUserController::class, 'updateAvatar'])->name('settings.avatar');
        Route::post('/avatar/remove', [SettingsUserController::class, 'removeAvatar'])->name('settings.avatar.remove');
        Route::post('/application-availability', [SettingsUserController::class, 'updateApplicationAvailability'])->name('settings.application.update');
        
        // Admin-only user management routes
        Route::put('/users/{user}', [SettingsUserController::class, 'userUpdate'])->name('settings.users.update');
        Route::delete('/users/{user}', [SettingsUserController::class, 'userDestroy'])->name('settings.users.destroy');
    });

    // Message Routes (unchanged)
    Route::prefix('admin/messages')->group(function() {
        Route::get('/', [AdminMessageController::class, 'index'])->name('admin.messages.index');
        Route::post('/{message}/reply', [AdminMessageController::class, 'reply'])->name('admin.messages.reply');
        Route::get('/user/{user}', [AdminMessageController::class, 'getUserMessages'])->name('admin.messages.user');
        Route::delete('/user/{user}/delete-all', [AdminMessageController::class, 'deleteUserMessages'])->name('admin.messages.delete-all');
    });

    Route::get('/messages', [AdminMessageController::class, 'index'])->name('admin.messages');
    Route::get('/messages/unreplied-count', [AdminMessageController::class, 'getUnrepliedCount'])->name('admin.messages.unreplied');
});

require __DIR__.'/auth.php';