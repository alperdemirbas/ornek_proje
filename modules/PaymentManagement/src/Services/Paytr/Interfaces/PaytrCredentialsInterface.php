<?php

namespace Rezyon\PaymentManagement\Services\Paytr\Interfaces;

use Rezyon\PaymentManagement\Interfaces\CredentialsInterface;

interface PaytrCredentialsInterface extends CredentialsInterface
{
    public function getId(): string;

    public function setId(string $id): void;

    public function getOid(): string;

    public function setOid(string $oid): void;

    public function getOkUrl(): ?string;

    public function setOkUrl(string $okUrl): void;

    public function getFailUrl(): ?string;

    public function setFailUrl(string $failUrl): void;

    public function getKey(): string;

    public function setKey(string $key): void;

    public function getSalt(): string;

    public function setSalt(string $salt): void;

    public function getReference(): ?string;

    public function setReference(?string $reference): void;
}