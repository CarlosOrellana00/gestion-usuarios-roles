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
    ->withMiddleware(function (Middleware $middleware): void {
        //
        $middleware->alias([
            'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class,
        ]);

        // Grupo API mínimo (suficiente para nuestras rutas /api)
        $middleware->group('api', [
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            // Si quieres limitar peticiones: 'throttle:api',
        ]);

        // Grupo WEB (opcional). Solo si usas vistas/sesión/CSRF.
        // Si NO tienes estas clases creadas, puedes omitir este grupo.
        /*
            $middleware->group('web', [
                \App\Http\Middleware\EncryptCookies::class,
                \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
                \Illuminate\Session\Middleware\StartSession::class,
                \Illuminate\View\Middleware\ShareErrorsFromSession::class,
                \App\Http\Middleware\VerifyCsrfToken::class,
                \Illuminate\Routing\Middleware\SubstituteBindings::class,
            ]);
        */
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
