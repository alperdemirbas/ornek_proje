<?php

namespace Rezyon\Applications\PaymentManagement\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        OrderException::class,
    ];

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof OrderException) {
            return response()->json([
                'status' => 'error', 'message' => $exception->getMessage(),
            ], $exception->getCode());
        }

        return parent::render($request, $exception);
    }
}