<?php

namespace Rezyon\PaymentManagement\Services\Paytr;

use Rezyon\PaymentManagement\Services\Paytr\Interfaces\PaytrCredentialsInterface;

/**
 *
 */
class Credentials implements PaytrCredentialsInterface
{
    /**
     * @var string
     */
    protected string $id;
    /**
     * @var string
     */
    protected string $oid;
    /**
     * @var string|null
     */
    protected ?string $okUrl = null;
    /**
     * @var string|null
     */
    protected ?string $failUrl = null;
    /**
     * @var string
     */
    protected string $key;
    /**
     * @var string
     */
    protected string $salt;
    /**
     * @var string|null
     */
    protected ?string $reference = null;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getOid(): string
    {
        return $this->oid;
    }

    public function setOid(string $oid): void
    {
        $this->oid = $oid;
    }

    /**
     * @return string|null
     */
    public function getOkUrl(): ?string
    {
        return $this->okUrl;
    }

    /**
     * @param string|null $okUrl
     */
    public function setOkUrl(?string $okUrl): void
    {
        $this->okUrl = $okUrl;
    }

    /**
     * @return string|null
     */
    public function getFailUrl(): ?string
    {
        return $this->failUrl;
    }

    /**
     * @param string|null $failUrl
     */
    public function setFailUrl(?string $failUrl): void
    {
        $this->failUrl = $failUrl;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function setKey(string $key): void
    {
        $this->key = $key;
    }

    public function getSalt(): string
    {
        return $this->salt;
    }

    public function setSalt(string $salt): void
    {
        $this->salt = $salt;
    }

    /**
     * @return string|null
     */
    public function getReference(): ?string
    {
        return $this->reference;
    }

    /**
     * @param string|null $reference
     */
    public function setReference(?string $reference): void
    {
        $this->reference = $reference;
    }
}