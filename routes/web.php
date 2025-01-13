<?php

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/* use Illuminate\Http\Request; */

Route::get('/', [HomeController::class, 'index']);

Route::get('/jobs', [JobController::class, 'index']);
Route::get('/jobs/create', [JobController::class, 'create']);
Route::get('/jobs/{id}', [JobController::class, 'show']);
Route::post('/jobs', [JobController::class, 'store']);
