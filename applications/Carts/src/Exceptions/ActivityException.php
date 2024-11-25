<?php

namespace Rezyon\Applications\Carts\Exceptions;

use Exception;

class ActivityException extends Exception
{
    public function __construct($message, $code, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}