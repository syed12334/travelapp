<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\LoginMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\Checkpropertystepvalidation;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
         $middleware->alias([
            'propertysteps'=>\App\Http\Middleware\Checkpropertystepvalidation::class,
            'authenticate' =>\App\Http\Middleware\LoginMiddleware::class,
            'admin'=>\App\Http\Middleware\AdminloginMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
