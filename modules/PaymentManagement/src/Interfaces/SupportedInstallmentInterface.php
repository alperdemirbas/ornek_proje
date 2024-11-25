<?php

namespace Rezyon\PaymentManagement\Interfaces;

interface SupportedInstallmentInterface
{
    public function installments(): array;

    public function setInstallment(int $instalment);
}