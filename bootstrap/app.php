<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo(function () {
            return request()->is('*api*') ? route('api.auth.fail') : route('admin.login');
        });
        $middleware->statefulApi();
        $middleware->trustHosts(at: fn() => config('app.trusted_hosts'), subdomains: false);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
