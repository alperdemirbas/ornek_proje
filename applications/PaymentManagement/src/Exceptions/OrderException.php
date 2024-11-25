<?php

namespace Rezyon\Applications\PaymentManagement\Exceptions;

use Exception;

class OrderException extends Exception
{
    public function __construct($message, $code, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}