<?php

use App\Http\Middleware\LogRequest;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // ovedriving, to be able test /submit without csrf token
        $middleware->validateCsrfTokens(except: ['/submit']);
        /*         $middleware->append(LogRequest::class); */ //middleware globalt
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
