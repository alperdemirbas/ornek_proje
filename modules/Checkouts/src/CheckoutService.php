<?php

namespace Rezyon\Checkouts;

use Rezyon\Checkouts\Repositories\CheckoutRepository;
use Rezyon\Companies\Enums\PaymentStatusesEnums;

class CheckoutService
{
    public function __construct(
        public CheckoutRepository $checkoutRepository
    )
    {

    }

    public function new(Checkout $checkout)
    {
        /*** @todo Buna env yazilacak ** */
        $user = $checkout->getUsers();
        $company = $checkout->getCompanies();
        $amount = $checkout->getAmount();

        $text = sprintf('%s-%s-%s-%s-%s',
            $user->id ?? '_',
            $company->id ?? '_',
            $amount,
            rand(10000, 99999),
            time()
        );
        $cipher = "aes-128-gcm";
        $key = 'REZYON';
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext = openssl_encrypt($text, $cipher, $key, $options = 0, $iv, $tag);
        $oid = str_replace("=", '', base64_encode($ciphertext));
        $data = [
            'merchant_oid' => $oid,
            'users_id' => $user->id ?? null,
            'companies_id' => $company->id ?? null,
            'amount' => $amount,
            'meta' => $checkout->getMeta(),
            'success' => $checkout->getSuccess(),
            'fail' => $checkout->getFail(),
            'status' => $checkout->getCheckoutStatusEnums(),
        ];

        return $this->checkoutRepository->create($data);

    }

    public function setWaitingApproval(string $merchant_oid)
    {
        return $this->checkoutRepository->setStatus(
            $merchant_oid,
            PaymentStatusesEnums::WAITING_APPROVAL
        );
    }

    public function setSuccess(string $merchant_oid)
    {

        $this->checkoutRepository->setStatus(
            $merchant_oid,
            PaymentStatusesEnums::PAYMENT_SUCCESS
        );
    }

    public function findByMerchantOid(string $merchant_oid)
    {
        return $this->checkoutRepository->findByMerchantOid($merchant_oid);
    }
}