<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class LockedOutException extends Exception
{
    public function __construct(string $throttleKey = "", int $code = Response::HTTP_TOO_MANY_REQUESTS, ?Throwable $previous = null)
    {
        $message = trans('auth.throttle', ['seconds' => RateLimiter::availableIn($throttleKey)]);

        parent::__construct($message, $code, $previous);
    }
}

