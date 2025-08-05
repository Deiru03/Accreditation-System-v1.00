<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\IqaMiddleware;
use App\Http\Middleware\ValidatorMiddleware;
use App\Http\Middleware\AccreditorMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        // Register the IqaMiddleware with an alias
        $middleware->alias([
            'iqa' => IqaMiddleware::class, // Alias for IqaMiddleware
            'val' => ValidatorMiddleware::class, // Alias for ValidatorMiddleware
            'accre' => AccreditorMiddleware::class, // Alias for AccreditorMiddleware
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
