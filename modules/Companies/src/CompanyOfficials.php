<?php

namespace Rezyon\Companies;

use Rezyon\Companies\Interfaces\CompanyOfficialsInterface;

class CompanyOfficials implements CompanyOfficialsInterface
{
    protected string $firstName;
    protected string $lastName;
    protected string $email;
    protected string $title = "";
    protected string $phone;
    protected string $phoneCountry;

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
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
}