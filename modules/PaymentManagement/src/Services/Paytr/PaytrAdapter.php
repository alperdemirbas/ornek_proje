<?php

namespace Rezyon\PaymentManagement\Services\Paytr;

use Rezyon\PaymentManagement\Customer;
use Rezyon\PaymentManagement\Interfaces\CredentialsInterface;
use Rezyon\PaymentManagement\Interfaces\PaymentInterface;
use Rezyon\PaymentManagement\Interfaces\SupportedCreditCardInterface;
use Rezyon\PaymentManagement\Interfaces\SupportedInstallmentInterface;
use Rezyon\PaymentManagement\Interfaces\UseTokenInterface;
use Rezyon\PaymentManagement\Product;
use Rezyon\PaymentManagement\Services\Paytr\Enums\CurrencyEnums;
use Rezyon\PaymentManagement\Services\Paytr\Enums\SupportedCreditCards;
use Rezyon\PaymentManagement\Services\Paytr\Enums\SupportedLanguage;
use Rezyon\PaymentManagement\Services\Paytr\Interfaces\ClientInterface;

class PaytrAdapter implements
    PaymentInterface,
    SupportedInstallmentInterface,
    SupportedCreditCardInterface,
    UseTokenInterface
{
    protected array $products = [];
    protected array $customer = [];
    protected array $credentials = [];
    protected bool $testMode;
    protected bool $debugMode;
    protected bool $non3d;
    protected float $totalAmount = 0;
    protected int $installment = 0;
    protected int $noInstallment = 0;
    protected int $maxInstallment = 0;
    protected int $timeout = 5;
    protected string $currency;
    protected ClientInterface $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function supportedLanguage(): array
    {
        return SupportedLanguage::values();
    }

    public function testMode(bool $testMode)
    {
        $this->testMode = $testMode;
    }

    public function non3d(bool $non3d)
    {
        $this->non3d = $non3d;
    }

    public function currency(): array
    {
        return CurrencyEnums::values();
    }

    public function creditCards(): array
    {
        return SupportedCreditCards::values();
    }

    public function setProduct(Product $product): void
    {
        $this->products[] = [
            $product->getName(),
            $product->getPrice(),
            $product->getPiece()
        ];
    }

    public function getProducts(): string
    {
        $total = 0;
        foreach ($this->products as $product) {
            [$name, $price, $piece] = $product;
            $total += $price;
        }
        $this->totalAmount = $total*100;//number_format($total, 2);
        return base64_encode(json_encode($this->products));
    }

    public function getTotalAmount(): float|int
    {
        return $this->totalAmount;
    }

    public function setTotalAmount(float|int $amount): void
    {
        $this->totalAmount = $amount;
    }

    public function customer(Customer $customer)
    {
        $this->customer = [
            'user_name' => $customer->getName(),
            'user_address' => $customer->getAddress(),
            'user_phone' => $customer->getPhone(),
            'user_email' => $customer->getEmail(),
            'ip' => $customer->getIp()
        ];
    }

    public function getCustomer(): array
    {
        return $this->customer;
    }

    public function credentials(CredentialsInterface $credentials): void
    {
        $data = [
            'merchant_id' => $credentials->getId(),
            'merchant_oid' => $credentials->getOid(),
            'merchant_key' => $credentials->getKey(),
            'merchant_salt' => $credentials->getSalt()
        ];

        if($credentials->getOkUrl() && $credentials->getFailUrl()) {
            $data['merchant_ok_url'] = $credentials->getOkUrl();
            $data['merchant_fail_url'] = $credentials->getFailUrl();
        }

        if($credentials->getReference()) {
            $data['reference_no'] = $credentials->getReference();
        }

        $this->credentials = $data;
    }

    public function getCredentials(): array
    {
        return $this->credentials;
    }

    public function getCredentialsAdapter(): CredentialsInterface
    {
        return new Credentials();
    }

    public function getTestMode(): bool
    {
        return $this->testMode;
    }

    public function getNon3d(): bool
    {
        return $this->non3d;
    }

    public function returnToken(): string
    {
        $hashStr =
            $this->credentials['merchant_id'].
            $this->credentials['merchant_oid'].
            (float) $this->totalAmount.
            $this->credentials['merchant_salt']
        ;
        return base64_encode(hash_hmac('sha256', $hashStr, $this->credentials['merchant_key'],true));
    }

    public function token(): string
    {
        $hashStr =
            $this->credentials['merchant_id'] .
            $this->customer['ip'] .
            $this->credentials['merchant_oid'] .
            $this->customer['user_email'] .
            (int) $this->totalAmount .
            $this->getProducts() .
            (int) $this->noInstallment .
            $this->maxInstallment .
            //'card' .
            //$this->installment .
            'TL'.
            (int) $this->testMode;
            //(int)$this->non3d;

        $key  = $this->credentials['merchant_key'];
        $salt = $this->credentials['merchant_salt'];

        return base64_encode(hash_hmac('sha256',$hashStr.$salt , $key,true));
    }

    public function setNoInstallment(bool $noInstallment)
    {
        $this->noInstallment = $noInstallment;
    }

    public function getNoInstallment()
    {
        return $this->noInstallment;
    }

    public function setMaxInstallment(int $maxInstallment)
    {
        $this->maxInstallment = $maxInstallment;
    }

    public function getMaxInstallment()
    {
        return $this->maxInstallment;
    }

    public function setTestMode(bool $testMode)
    {
        $this->testMode = $testMode;
    }

    public function setDebugMode(bool $debugMode)
    {
        $this->debugMode = $debugMode;
    }

    public function getDebugMode()
    {
        return $this->debugMode;
    }

    public function setTimeout(int $timeout)
    {
        $this->timeout = $timeout;
    }

    public function getTimeout()
    {
        return $this->timeout;
    }

    public function setInstallment(int $instalment): void
    {
        $this->installment = $instalment;
    }

    public function setCurrency(string $currency)
    {
        $this->currency = $currency;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function installments(): array
    {
        // TODO: Implement installments() method.
    }
}