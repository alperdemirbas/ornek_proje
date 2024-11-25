<?php

namespace Rezyon\Supplier;

use Carbon\Carbon;
use Rezyon\Supplier\Enums\PriceTypes;


/**
 *
 */
class Price
{
    protected PriceTypes $priceTypes = PriceTypes::ALL;
    protected float $price = 1;

    public function getPriceTypes(): PriceTypes
    {
        return $this->priceTypes;
    }

    public function setPriceTypes(PriceTypes $priceTypes): void
    {
        $this->priceTypes = $priceTypes;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

}