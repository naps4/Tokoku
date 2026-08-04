<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Auth;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        $middleware->alias([
            'admin' => \App\Http\Middleware\IsAdmin::class,
        ]);

        // Cukup arahkan ke /home, biarkan web.php yang menyortir
        $middleware->redirectUsersTo('/home');

        $middleware->web(append: [
            \App\Http\Middleware\PreventBackHistory::class,
        ]);

    })
    
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
