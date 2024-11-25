<?php

namespace Rezyon\Carts\Exceptions;

use Exception;

class ActivityAlreadyInCartException extends Exception
{
    public function __construct($message = "There are activities added to your cart on the dates or sessions you have selected.", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}