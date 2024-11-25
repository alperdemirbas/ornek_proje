<?php

namespace Rezyon\PaymentManagement\Interfaces;

interface UseTokenInterface
{
    public function token(): string;
    public function returnToken(): string;
}