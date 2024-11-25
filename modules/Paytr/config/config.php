<?php

return [
    'merchant_id' => env('MERCHANT_ID', false),
    'merchant_key' => env('MERCHANT_KEY', false),
    'merchant_salt' => env('MERCHANT_SALT', false),
    'currency' => 'TL',
    'payment_type' => 'card',
    'non_3d' => 0,
    'non3d_test_failed' => 0,
    'timeout_limit' => '5',
    'client_lang' => 'TR',
    'debug_on' => 1,
    'test_mode' => 0,
    'no_installment' => 1,
    'installment_count' => 0,
    'max_installment' => 0,
    'webhook_url' => 'https://sub.domain.com/payment/success',
    'webhook_error_url' => 'https://sub.domain.com/payment/error'
];
