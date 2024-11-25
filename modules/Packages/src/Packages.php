<?php

namespace Rezyon\Packages;

use Rezyon\Packages\Enums\PackageTypesEnums;
use Rezyon\Packages\Interfaces\PackagesInterface;

/**
 *
 */
class Packages implements PackagesInterface
{
    protected string $name;
    protected bool $is_active = false;
    protected float $quarter_yearly_discount = 0;
    protected float $half_yearly_discount = 0;
    protected float $yearly_discount = 0;
    protected float $fee = 0;
    protected PackageTypesEnums $typesEnums = PackageTypesEnums::SUPPLIER;
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function isIsActive(): bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): void
    {
        $this->is_active = $is_active;
    }

    public function getQuarterYearlyDiscount(): float
    {
        return $this->quarter_yearly_discount;
    }

    public function setQuarterYearlyDiscount(float $quarter_yearly_discount): void
    {
        $this->quarter_yearly_discount = $quarter_yearly_discount;
    }

    public function getHalfYearlyDiscount(): float
    {
        return $this->half_yearly_discount;
    }

    public function setHalfYearlyDiscount(float $half_yearly_discount): void
    {
        $this->half_yearly_discount = $half_yearly_discount;
    }

    public function getYearlyDiscount(): float
    {
        return $this->yearly_discount;
    }

    public function setYearlyDiscount(float $yearly_discount): void
    {
        $this->yearly_discount = $yearly_discount;
    }

    public function getFee(): float
    {
        return $this->fee;
    }

    public function setFee(float $fee): void
    {
        $this->fee = $fee;
    }

    public function getTypesEnums(): PackageTypesEnums
    {
        return $this->typesEnums;
    }

    public function setTypesEnums(PackageTypesEnums $typesEnums): void
    {
        $this->typesEnums = $typesEnums;
    }

}