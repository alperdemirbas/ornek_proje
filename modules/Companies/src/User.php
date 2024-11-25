<?php

namespace Rezyon\Companies;
use Rezyon\Companies\Models\Companies;
use  Rezyon\Users\User as BaseUser;

/**
 *
 */
class User extends BaseUser
{
    /**
     * @var Companies
     */
    protected Companies $companies;
    protected ?string $gender = null;
    protected ?string $birthdate = null;
    protected ?string $pnr = null;

    /**
     * @return string|null
     */
    public function getPnr(): ?string
    {
        return $this->pnr;
    }

    /**
     * @param string|null $pnr
     * @return User
     */
    public function setPnr(?string $pnr): User
    {
        $this->pnr = $pnr;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * @param string|null $gender
     * @return User
     */
    public function setGender(?string $gender): User
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBirthdate(): ?string
    {
        return $this->birthdate;
    }

    /**
     * @param string|null $birthdate
     * @return User
     */
    public function setBirthdate(?string $birthdate): User
    {
        $this->birthdate = $birthdate;
        return $this;
    }

    public function getCompanies(): Companies
    {
        return $this->companies;
    }

    public function setCompanies(Companies $companies): void
    {
        $this->companies = $companies;
    }



}