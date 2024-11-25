<?php

namespace Rezyon\Paytr\Requests;

/**
 *
 */
class User
{
    /**
     * @var
     */
    public $fullname;
    /**
     * @var
     */
    public $address;
    /**
     * @var
     */
    public $phone;
    /**
     * @var
     */
    public $email;
    /**
     * @var
     */
    public $ip;

    /**
     * @param string $fullname
     * @return void
     */
    public function fullname(string $fullname)
    {
        $this->fullname = $fullname;
    }

    /**
     * @param string $email
     * @return void
     */
    public function email(string $email)
    {
        $this->email = $email;
    }

    /**
     * @param string $address
     * @return void
     */
    public function address(string $address)
    {
        $this->address = $address;
    }

    /**
     * @param string $phone
     * @return void
     */
    public function phone(string $phone)
    {
        $this->phone = $phone;
    }

}
