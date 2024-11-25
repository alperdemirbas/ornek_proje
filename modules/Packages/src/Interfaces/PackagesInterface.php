<?php

namespace Rezyon\Packages\Interfaces;


use Rezyon\Packages\Enums\PackageTypesEnums;

interface PackagesInterface
{
    public function getName(): string;

    public function setName(string $name): void;

    public function isIsActive(): bool;

    public function setIsActive(bool $is_active): void;

    public function getQuarterYearlyDiscount(): float;

    public function setQuarterYearlyDiscount(float $quarter_yearly_discount): void;

    public function getHalfYearlyDiscount(): float;

    public function setHalfYearlyDiscount(float $half_yearly_discount): void;

    public function getYearlyDiscount(): float;

    public function setYearlyDiscount(float $yearly_discount): void;

    public function getFee(): float;

    public function setFee(float $fee): void;

    public function getTypesEnums(): PackageTypesEnums;

    public function setTypesEnums(PackageTypesEnums $typesEnums): void;
}