<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminSearchController;


Route::get('/', function () { return view('pages.home');})->name('home');
Route::get('/about', function () { return view('pages.about');})->name('about');
Route::get('/products', function () { return view('pages.products');})->name('products');
Route::get('/careers', function () { return view('pages.careers');})->name('careers');
Route::get('/locations', function () { return view('pages.locations');})->name('locations');
Route::get('/contact', function () { return view('pages.contact');})->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/Stats', function () { return view('pages.Stats');})->name('Stats');
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/search', [AdminSearchController::class, 'index'])->name('search');

Route::get('/apply', function () { return view('pages.apply.index');})->name('apply.index');
Route::get('/apply/job', [ApplicationController::class, 'showJobApplicationForm'])->name('apply.job');
Route::get('/apply/internship', [ApplicationController::class, 'showInternshipApplicationForm'])->name('apply.internship');
Route::post('/apply/submit', [ApplicationController::class, 'submitApplication'])->name('apply.submit');
