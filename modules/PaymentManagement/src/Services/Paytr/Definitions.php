<?php

namespace Rezyon\PaymentManagement\Services\Paytr;

abstract class Definitions
{
    public const INSTALLMENTS = 'https://paytr.com/odeme/taksit-oranlari';
    public const URL = "https://paytr.com";
    public const GET_TOKEN = "https://www.paytr.com/odeme/api/get-token";
    public const RETURN = "https://www.paytr.com/odeme/iade";
}