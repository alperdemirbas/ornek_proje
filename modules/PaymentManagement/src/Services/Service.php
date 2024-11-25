<?php

namespace Rezyon\PaymentManagement\Services;

use Rezyon\PaymentManagement\Customer;
use Rezyon\PaymentManagement\Enums\UserPaymentTypesEnum;
use Rezyon\PaymentManagement\Interfaces\CredentialsInterface;
use Rezyon\PaymentManagement\Interfaces\PaymentInterface;
use Rezyon\PaymentManagement\Interfaces\SupportedCreditCardInterface;
use Rezyon\PaymentManagement\Interfaces\SupportedInstallmentInterface;
use Rezyon\PaymentManagement\Interfaces\UseTokenInterface;
use Rezyon\PaymentManagement\Product;
use Rezyon\PaymentManagement\Services\Paytr\Definitions;
use Rezyon\PaymentManagement\Services\Paytr\Enums\CurrencyEnums;
use Rezyon\PaymentManagement\Services\Paytr\Interfaces\ClientInterface;
use Rezyon\PaymentManagement\Services\Paytr\PaytrAdapter;

class Service
{
    public PaymentInterface $adapter;
    protected array $products = [];
    protected ClientInterface $client;

    public function __construct(
        UserPaymentTypesEnum $enum,
        ClientInterface $client
    )
    {
        $this->client = $client;
        if ($enum->value == UserPaymentTypesEnum::ADMIN->value) {
            $this->adapter = app(PaytrAdapter::class);
        }
    }

    public function getToken(array $data)
    {
        $client = $this->client->post(Definitions::GET_TOKEN,[
            'form_params' => $data,
            'timeout' => 20,
            'verify' => false
        ]);

        return json_decode($client->getBody()->getContents());
    }

    public function makeReturn(array $data)
    {
        $client = $this->client->post(Definitions::RETURN,[
            'form_params' => $data,
            'timeout' => 20,
            'verify' => false
        ]);

        return json_decode($client->getBody()->getContents());
    }

    public function customer(Customer $customer)
    {
        $this->adapter->customer($customer);
    }

    public function product(Product $product): Service
    {
        $this->adapter->setProduct($product);
        return $this;
    }

    public function credentials(CredentialsInterface $credentials): void
    {
        $this->adapter->credentials($credentials);
    }

    public function data(): array
    {
        $credentials = $this->adapter->getCredentials();
        $customer = $this->adapter->getCustomer();

        $userLang = 'tr';
        $supportedLang = $this->adapter->supportedLanguage();
        $lang = ( in_array($userLang,$supportedLang) ) ? $userLang : 'tr';
        $data = [];

        $data['user_ip'] = $customer['ip'];
        $data['user_name'] = $customer['user_name'];
        $data['email'] = $customer['user_email'];
        $data['user_phone'] = $customer['user_phone'];
        $data['user_address'] = $customer['user_address'];
        $data['user_basket'] = $this->adapter->getProducts();
        $data['test_mode'] = $this->adapter->getTestMode();
        $data['debug_on'] = $this->adapter->getDebugMode();
        $data['no_installment'] = $this->adapter->getNoInstallment();
        $data['max_installment'] = $this->adapter->getMaxInstallment();
        $data['payment_amount'] = (int) $this->adapter->getTotalAmount();
        $data['merchant_ok_url'] = $credentials['merchant_ok_url'];
        $data['merchant_fail_url'] = $credentials['merchant_fail_url'];
        $data['merchant_id'] = $credentials['merchant_id'];
        $data['merchant_oid'] = $credentials['merchant_oid'];
        $data['lang'] = $lang;
        $data['currency'] = $this->adapter->getCurrency();
        $data['timeout'] = $this->adapter->getTimeout();

        if ($this->adapter instanceof UseTokenInterface) {
            $data['paytr_token'] = $this->adapter->token();
        }

        return $data;
    }

    public function returnData()
    {
        $credentials = $this->adapter->getCredentials();
        $data = [];
        $data['merchant_id'] = $credentials['merchant_id'];
        $data['merchant_oid'] = $credentials['merchant_oid'];
        $data['reference_no'] = $credentials['reference_no'];
        $data['return_amount'] = (float) $this->adapter->getTotalAmount();

        if ($this->adapter instanceof UseTokenInterface) {
            $data['paytr_token'] = $this->adapter->returnToken();
        }

        return $data;
    }

    public function setTotalAmount(float|int $amount)
    {
        $this->adapter->setTotalAmount($amount);
    }

    public function getCredentials(): CredentialsInterface
    {
        return $this->adapter->getCredentialsAdapter();
    }

    protected function supportedInstallment(): bool
    {
        return ($this->adapter instanceof SupportedInstallmentInterface);
    }

    public function supportedCreditCard(): bool
    {
        return ($this->adapter instanceof SupportedCreditCardInterface);
    }

    public function supportedCreditCardList()
    {
        if( $this->supportedCreditCard() ){
            return $this->adapter->creditCards();
        }
        return [];
    }

    public function setInstallment(int $installment)
    {
        if( $this->supportedInstallment() ){
            $this->adapter->setInstallment($installment);
        }
    }

    public function setTestMode(bool $testMode)
    {
        $this->adapter->setTestMode($testMode);
    }

    public function setTimeout(int $timeout)
    {
        $this->adapter->setTimeout($timeout);
    }

    public function setDebugMode(bool $debugMode)
    {
        $this->adapter->setDebugMode($debugMode);
    }

    public function setMaxInstallment(int $maxInstallment)
    {
        $this->adapter->setMaxInstallment($maxInstallment);
    }

    public function setNoInstallment(bool $noInstallment)
    {
        $this->adapter->setNoInstallment($noInstallment);
    }

    public function setCurrency(CurrencyEnums $currency)
    {
        $this->adapter->setCurrency($currency->value);
    }

    public function getSupportedInstallment()
    {
        if( $this->supportedInstallment() ){
            return $this->adapter->installments();
        }
        return [];
    }

}