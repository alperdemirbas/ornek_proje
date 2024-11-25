<?php

namespace Rezyon\Paytr;

use Rezyon\Paytr\Interfaces\ClientInterface;
use Rezyon\Paytr\Interfaces\PaytrInterface;
use Rezyon\Paytr\Requests\Basket;
use Rezyon\Paytr\Requests\User;
use Rezyon\Paytr\Requests\CreditCard;

class Paytr implements PaytrInterface
{
    /**
     * @var ClientInterface
     */
    protected ClientInterface $client;
    /**
     * @var array
     */
    protected array $options;
    /**
     * @var array|\Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected array $config;
    protected string $ip;
    protected string $oid;

    /**
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
        $this->config = config('paytr');
        $this->options = $this->config;
    }

    /**
     * @param $options
     * @return void
     */
    public function options($options)
    {
        $this->options = array_replace($this->config, $options);

        dd($this->options);
    }

    public function setIP($ip): void
    {
        $this->ip = $ip;
    }
    protected function getIP(): string
    {
        if(empty($this->ip)) throw new \Exception("istek için bir ip belirtmelisiniz.");
        return $this->ip;
    }

    public function setMerchantOID(string $oid): void
    {
        if(empty($oid)) throw new \Exception("Lütfen bir benzersiz bir key belirleyin");
        $this->oid = $oid;
    }
    protected function getMerchantOID(): string
    {
        return $this->oid;
    }
    /**
     * @param User $user
     * @param array $products
     * @param $amount
     * @param CreditCard $cc
     * @return mixed
     * @throws \Exception
     */
    public function checkout(User $user, array $products, $amount, CreditCard $cc)
    {
        $payment_amount     = doubleval($amount);
        $merchantID         = $this->options['merchant_id'];
        $ip                 = $this->getIP();
        $merchantOID        = $this->getMerchantOID();
        $email              = $user->email;
        $userBasket         = Basket::getUserBasket($products);
        $non_3d             = $this->options['non_3d'];
        $installment_count  = $this->options['installment_count'];
        $noInstallment      = $this->options['no_installment'];
        $maxInstallment     = $this->options['max_installment'];
        $currency           = $this->options['currency'];
        $testMode           = $this->options['test_mode'];
        $merchantSalt       = $this->options['merchant_salt'];
        $merchantKey        = $this->options['merchant_key'];
        $debug              = $this->options['debug_on'];
        $merchantOK         = $this->options['webhook_url'];
        $merchantFail       = $this->options['webhook_error_url'];
        $timeOutLimit       = $this->options['timeout_limit'];
        $payment_type       = $this->options['payment_type'];
        $client_lang        = $this->options['client_lang'];
        $cardholder         = $cc->cardholder;
        $ccno               = $cc->ccno;
        $expiry_month       = $cc->expiry_month;
        $expiry_year        = $cc->expiry_year;
        $cvv                = $cc->cvv;
        $hash_str           = $merchantID . $ip . $merchantOID . $email . $payment_amount . $payment_type . $installment_count . $currency . $testMode . $non_3d . $merchantSalt;
        $token              = base64_encode(hash_hmac('sha256', $hash_str, $merchantKey, true));

        $checkoutData = [
            'cc_owner'          => $cardholder,
            'card_number'       => $ccno,
            'expiry_month'      => $expiry_month,
            'expiry_year'       => $expiry_year,
            'cvv'               => $cvv,
            'merchant_id'       => $merchantID,
            'user_ip'           => $ip,
            'non_3d'            => $non_3d,
            'merchant_oid'      => $merchantOID,
            'email'             => $email,
            'payment_amount'    => $payment_amount,
            'payment_type'      => $payment_type,
            'paytr_token'       => $token,
            'user_basket'       => $userBasket,
            'debug_on'          => $debug,
            'installment_count' => $installment_count,
            'no_installment'    => $noInstallment,
            'max_installment'   => $maxInstallment,
            'user_name'         => $user->fullname,
            'user_address'      => $user->address,
            'user_phone'        => $user->phone,
            'merchant_ok_url'   => $merchantOK,
            'merchant_fail_url' => $merchantFail,
            'timeout_limit'     => $timeOutLimit,
            'currency'          => $currency,
            'test_mode'         => $testMode,
            'client_lang'       => $client_lang
        ];

        return $this->client->post(Definitions::PAYMENT_URL,[
            'form_params' => $checkoutData
        ]);
    }

    public function control(array $args): bool|\Illuminate\Http\JsonResponse
    {
        $amount             = doubleval($args['total_amount']);
        $merchantID         = $this->options['merchant_id'];
        $merchantOID        = $args['merchant_oid'];
        $merchantSalt       = $this->options['merchant_salt'];
        $merchantKey        = $this->options['merchant_key'];
        $status             = $args['status'];
        $hash               = $args['hash'];
        $payment_type       = $args['payment_type'];
        $hashStr            = $merchantOID . $merchantSalt . $status . $amount;
        $token              = base64_encode(hash_hmac('sha256', $hashStr, $merchantKey, true));

        if($hash != $token) {
            return false;
        }

        return ($status == "success");
    }
}
