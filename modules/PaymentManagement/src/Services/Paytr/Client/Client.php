<?php

namespace Rezyon\PaymentManagement\Services\Paytr\Client;

use Rezyon\PaymentManagement\Services\Paytr\Interfaces\ClientInterface;

class Client extends \GuzzleHttp\Client implements ClientInterface
{
    public function __construct(array $config = []){
        parent::__construct($config);
    }
}