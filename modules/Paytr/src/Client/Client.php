<?php

namespace Rezyon\Paytr\Client;

use Rezyon\Paytr\Interfaces\ClientInterface;

/**
 *
 */
class Client extends \GuzzleHttp\Client implements ClientInterface
{
    public function __construct(array $config = []){
            parent::__construct($config);
    }

}
