<?php

use App\Exceptions\LockedOutException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Http\Request as ExceptionRequest;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware(['web', 'guest'])
                ->prefix('admin')
                ->group(base_path('routes/auth.php'));

            Route::middleware(['web', 'auth'])
                ->prefix('admin')
                ->group(base_path('routes/admin.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo(fn (Request $request) => route('login.index'));
        $middleware->redirectUsersTo(fn (Request $request) => route('dashboard'));
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (Throwable $e, ExceptionRequest $request) {
            if ($e instanceof ValidationException) {
                return back()->withErrors($e->errors())->withInput();
            }

            if ($e instanceof AuthenticationException) {
                return redirect()->route('login.index')
                    ->withErrors(['custom' => __('Your session has expired. Please log in again.')])->withInput();
            }

            if ($e instanceof Exception) {
                if ($e instanceof LockedOutException) {
                    event(new Lockout($request));
                }

                if (!config('app.debug')) {
                    return back()->withErrors(['custom' => __('Something went wrong, please contact us!')])->withInput();
                }
            }

            return null;
        });
    })->create();
