<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingsUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



// Include route files
require __DIR__.'/auth.php';    // Authentication routes (login, register, etc.)
require __DIR__.'/pages.php';   // General page routes
require __DIR__.'/admin.php';   // Admin-specific routes
require __DIR__.'/user.php';    // User-specific routes