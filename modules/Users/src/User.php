<?php

namespace Rezyon\Users;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Rezyon\Users\Enums\Types;

/**
 *
 */
class User
{
    protected string $pnr;
    /**
     * @var string
     */
    protected string $firstname = "";
    /**
     * @var string
     */
    protected string $lastname = "";
    /**
     * @var string
     */
    protected string $email = "";
    /**
     * @var string
     */
    protected string $password;
    /**
     * @var Types
     */
    protected Types $type = Types::CUSTOMER;


    public function __construct()
    {
        $this->password = Str::password(8);
    }

    /**
     * @return string
     */
    public function getPnr(): string
    {
        return $this->pnr;
    }

    /**
     * @param string $pnr
     */
    public function setPnr(string $pnr): void
    {
        $this->pnr = $pnr;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = Hash::make($password);
    }

    public function getType(): Types
    {
        return $this->type;
    }

    public function setType(Types $type): void
    {
        $this->type = $type;
    }
}