<?php

use App\Http\Middleware\MarkOnlineAttendance;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Console\Scheduling\Schedule;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo('/auth/login');
        $middleware->append(MarkOnlineAttendance::class);
    })
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('subscriptions:check-expiry')
        ->dailyAt('09:00')
        ->timezone('Asia/Kolkata')
        ->withoutOverlapping()
        ->runInBackground()
        ->emailOutputOnFailure(env('ADMIN_EMAIL'));
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->dontReport([
            \Illuminate\Auth\AuthenticationException::class,
            \Illuminate\Auth\Access\AuthorizationException::class,
            \Symfony\Component\HttpKernel\Exception\HttpException::class,
        ]);

        $exceptions->reportable(function (\Throwable $e) {
            if (app()->bound('sentry')) {
                app('sentry')->captureException($e);
            }
        });

        $exceptions->renderable(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Resource not found'
                ], 404);
            }
        });
    })->create();
