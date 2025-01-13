<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use Illuminate\Support\Facades\Route;   // for global constraints on routes

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Global constraints
        // Route::pattern('id', '[0-9]+'); or letters also ('id', '[a-zA-Z]+')
    }
}
