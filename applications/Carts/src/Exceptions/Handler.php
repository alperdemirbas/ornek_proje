<?php

namespace Rezyon\Applications\Carts\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        ActivityException::class,
    ];

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ActivityException) {
            return response()->json([
                'status' => 'error', 'message' => $exception->getMessage(),
            ], $exception->getCode());
        }

        return parent::render($request, $exception);
    }
}