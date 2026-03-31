<?php

use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\DebugSessionMiddleware;
use App\Http\Middleware\SessionAuthMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Register custom middleware aliases
        $middleware->alias([
            'session.auth' => SessionAuthMiddleware::class,
            'role' => RoleMiddleware::class,
            'debug.session' => DebugSessionMiddleware::class,
        ]);

        // Redirect tamu ke '/' (role-select), bukan ke '/login'
        $middleware->redirectGuestsTo(fn() => route('role.select'));
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
