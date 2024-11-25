<?php

namespace Rezyon\Paytr\Interfaces;

use Rezyon\Paytr\Requests\CreditCard;
use Rezyon\Paytr\Requests\User;

interface PaytrInterface
{
    public function options($options);

    public function setIP($ip): void;

    public function setMerchantOID(string $oid): void;

    /**
     * @param User $user
     * @param array $products
     * @param $amount
     * @param CreditCard $cc
     * @return mixed
     * @throws \Exception
     */
    public function checkout(User $user, array $products, $amount, CreditCard $cc);

    public function control(array $args): bool|\Illuminate\Http\JsonResponse;
}