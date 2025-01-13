<?php

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/* use Illuminate\Http\Request; */

Route::get('/', [HomeController::class, 'index']);

Route::resource('jobs', JobController::class);
