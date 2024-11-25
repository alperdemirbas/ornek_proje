<?php

namespace Rezyon\Paytr\Requests;

/**
 *
 */
class Products
{
    /**
     * @var
     */
    protected $name;
    /**
     * @var
     */
    protected $price;
    /**
     * @var
     */
    protected $amount;

    /**
     * @param string $name
     * @return void
     */
    public function name(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param string $product
     * @return void
     */
    public function price(string $product)
    {
        $this->price = $product;
    }

    /**
     * @param string $amount
     * @return void
     */
    public function amount(string $amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return array
     */
    public function toArray():array
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
            'amount' => $this->amount
        ];
    }
}
