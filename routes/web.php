<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ApplicantController;

/* use Illuminate\Http\Request; */

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jobs/search', [JobController::class, 'search'])->name('jobs.search');


// Route::resource('jobs', JobController::class);
// Route::resource('jobs', JobController::class)->middleware('auth')->only(['create', 'edit', 'update', 'destroy']);

Route::resource('jobs', JobController::class)->except(['create', 'edit', 'update', 'destroy']);

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
});
Route::middleware('auth')->group(function () {
    // Resource routes with restrictions
    Route::resource('jobs', JobController::class)->only(['create', 'edit', 'update', 'destroy']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
    Route::post('/bookmarks/{job}', [BookmarkController::class, 'store'])->name('bookmarks.store');

    Route::post('/jobs/{job}/apply', [ApplicantController::class, 'store'])->name('applicant.store');
    Route::delete('/applicants/{applicant}', [ApplicantController::class, 'destroy'])->name('applicant.destroy');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
