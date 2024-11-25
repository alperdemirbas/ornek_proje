<?php

namespace Rezyon\Supplier;

use Carbon\Carbon;
use Rezyon\Supplier\Enums\PriceRuleGenders;
use Rezyon\Supplier\Enums\PriceRuleOperators;

/**
 *
 */
class PriceRule
{
    /**
     * @var Enums\PriceRules
     */
    public Enums\PriceRules $priceRules = Enums\PriceRules::FREE;
    /**
     * @var PriceRuleGenders
     */
    public PriceRuleGenders $priceRuleGenders = PriceRuleGenders::ALL;
    /**
     * @var int
     */
    public int $age = 18;

    /**
     * @var PriceRuleOperators
     */
    public PriceRuleOperators $priceRuleOperators = PriceRuleOperators::LOWER;
    public Carbon|null $start_date = null;
    public Carbon|null $end_date = null;

    public function getStartDate(): ?Carbon
    {
        return $this->start_date;
    }

    public function setStartDate(?Carbon $start_date): void
    {
        $this->start_date = $start_date;
    }

    public function getEndDate(): ?Carbon
    {
        return $this->end_date;
    }

    public function setEndDate(?Carbon $end_date): void
    {
        $this->end_date = $end_date;
    }

    public function getPriceRules(): Enums\PriceRules
    {
        return $this->priceRules;
    }

    public function setPriceRules(Enums\PriceRules $priceRules): void
    {
        $this->priceRules = $priceRules;
    }

    public function getPriceRuleGenders(): PriceRuleGenders
    {
        return $this->priceRuleGenders;
    }

    public function setPriceRuleGenders(PriceRuleGenders $priceRuleGenders): void
    {
        $this->priceRuleGenders = $priceRuleGenders;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    public function getPriceRuleOperators(): PriceRuleOperators
    {
        return $this->priceRuleOperators;
    }

    public function setPriceRuleOperators(PriceRuleOperators $priceRuleOperators): void
    {
        $this->priceRuleOperators = $priceRuleOperators;
    }
}