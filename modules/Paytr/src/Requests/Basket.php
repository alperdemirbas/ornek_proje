<?php

namespace Rezyon\Paytr\Requests;

/**
 *
 */
class Basket
{

    /**
     * @param array $products
     * @return string
     */
    public static function getUserBasket(array $products): string
    {
        $p = [];
        foreach ($products as $product){
            $p[] = [ $product['name'],$product['price'],$product['amount']];

        };
        return base64_encode(json_encode($p));
    }
}
