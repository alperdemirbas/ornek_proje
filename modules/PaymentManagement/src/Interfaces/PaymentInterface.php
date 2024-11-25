<?php

namespace Rezyon\PaymentManagement\Interfaces;

use Rezyon\PaymentManagement\Customer;
use Rezyon\PaymentManagement\Product;

interface PaymentInterface
{
    public function credentials(CredentialsInterface $credentials);

    public function getCredentials(): array;

    public function setProduct(Product $product);

    public function getProducts();
    public function getTotalAmount(): float|int;

    public function testMode(bool $testMode);

    public function getTestMode(): bool;

    public function non3d(bool $non3d);

    public function getNon3d(): bool;

    public function currency(): array;

    public function customer(Customer $customer);

    public function getCustomer(): array;

    public function getCredentialsAdapter(): CredentialsInterface;
    public function supportedLanguage():array;
}