<?php

namespace Rezyon\Companies\Interfaces;

interface CompanyOfficialsInterface
{
    public function getFirstName(): string;

    public function setFirstName(string $firstName): void;

    public function getLastName(): string;

    public function setLastName(string $lastName): void;

    public function getEmail(): string;

    public function setEmail(string $email): void;

    public function getTitle(): string;

    public function setTitle(string $title): void;

    public function getPhone(): string;

    public function setPhone(string $phone): void;

    public function getPhoneCountry(): string;

    public function setPhoneCountry(string $phoneCountry): void;
}