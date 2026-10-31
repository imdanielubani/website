<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Global, so error pages (404, 500...) carry the header too.
        $middleware->append(\App\Http\Middleware\NoIndex::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
