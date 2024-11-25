<?php

namespace Rezyon\Companies\Interfaces;

use Carbon\Carbon;
use Rezyon\Companies\Enums\CompanyTypeEnums;

interface CompanyInterface
{
    public function getType();
    public function setType(CompanyTypeEnums $type): void;
    public function getName(): string;

    public function setName(string $name): void;

    public function getDomain(): ?string;

    public function setDomain(string $domain): void;

    public function isActive(): bool;

    public function setIsActive(bool $isActive): void;

    public function getVerifyAt(): ?Carbon;

    public function setVerifyAt(Carbon $verifyAt): void;

    public function setEmail(string $email): void;

    public function getAddress(): string;

    public function setAddress(string $address): void;

    public function getDescription(): string;

    public function setDescription(string $description): void;

    public function getPhone(): string;

    public function setPhone(string $phone): void;

    public function getPhoneCountry(): string;

    public function setPhoneCountry(string $phoneCountry): void;


}