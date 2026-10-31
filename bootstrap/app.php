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
        // Global, so error pages (404, 500...) carry the headers too.
        $middleware->append([
            \App\Http\Middleware\NoIndex::class,
            \App\Http\Middleware\SecurityHeaders::class,
        ]);

        // Reject requests for unknown host names (host header poisoning).
        // Active outside the local environment; trusts APP_URL's host.
        $middleware->trustHosts();

        // Site-wide request limit per IP address.
        $middleware->web(append: [
            \Illuminate\Routing\Middleware\ThrottleRequests::class . ':site',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
