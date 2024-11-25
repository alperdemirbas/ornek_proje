<?php

return [
    'payment_service' => env('PAYMENT_SERVICE','paytr'),
    'paytr' => [
        'merchant_id' => env('PAYTR_MERCHANT_ID'),
        'merchant_key' => env('PAYTR_MERCHANT_KEY'),
        'merchant_salt' => env('PAYTR_MERCHANT_SALT'),
        'test_mode' => env('PAYTR_TEST_MODE'),
        'debug_mode' => env('PAYTR_DEBUG_MODE'),
        'timeout' => env('PAYTR_TIMEOUT'),
    ]
];
