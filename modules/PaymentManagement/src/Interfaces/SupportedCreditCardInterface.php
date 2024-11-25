<?php

namespace Rezyon\PaymentManagement\Interfaces;

interface SupportedCreditCardInterface
{
    public function creditCards():array;
}