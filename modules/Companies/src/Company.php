<?php

namespace Rezyon\Companies;

use Carbon\Carbon;
use Rezyon\Companies\Enums\CompanyTypeEnums;
use Rezyon\Companies\Interfaces\CompanyInterface;

class Company implements CompanyInterface
{
    protected string $name = "";
    protected CompanyTypeEnums $type = CompanyTypeEnums::TOURISM_COMPANY;
    protected string $email = "";
    protected string $address = "";
    protected string $description = "";
    protected ?string $domain = null;
    protected bool $isActive = false;
    protected string $phone = "";
    protected string $phoneCountry = "";
    protected Carbon $verifyAt;

    public function getType(): CompanyTypeEnums
    {
        return $this->type;
    }

    public function setType(CompanyTypeEnums $type): void
    {
        $this->type = $type;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getPhoneCountry(): string
    {
        return $this->phoneCountry;
    }

    public function setPhoneCountry(string $phoneCountry): void
    {
        $this->phoneCountry = $phoneCountry;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function setDomain(string $domain): void
    {
        $this->domain = $domain;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }

    public function getVerifyAt(): ?Carbon
    {
        return $this->verifyAt ?? null;
    }

    public function setVerifyAt(Carbon $verifyAt): void
    {
        $this->verifyAt = $verifyAt;
    }

}