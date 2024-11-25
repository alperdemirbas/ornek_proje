<?php

namespace Rezyon\Paytr\Facades;

use Illuminate\Support\Facades\Facade;
use Rezyon\Paytr\Interfaces\PaytrInterface;

class Paytr extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PaytrInterface::class;
    }
}