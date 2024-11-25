<?php

namespace Rezyon\Paytr\Requests;

/**
 *
 */
class CreditCard
{
    /**
     * @var
     */
    public $cardholder;
    /**
     * @var
     */
    public $ccno;
    /**
     * @var
     */
    public $expiry_year;
    /**
     * @var
     */
    public $expiry_month;
    /**
     * @var
     */
    public $cvv;

    /**
     * @param string $cardholder
     * @return void
     */
    public function cardholder(string $cardholder)
    {
        $this->cardholder = $cardholder;
    }

    /**
     * @param string $ccno
     * @return void
     */
    public function ccno(string $ccno)
    {
        $this->ccno = $ccno;
    }

    /**
     * @param string $expiry_month
     * @return void
     */
    public function expiry_month(string $expiry_month)
    {
        $this->expiry_month = $expiry_month;
    }

    /**
     * @param string $expiry_year
     * @return void
     */
    public function expiry_year(string $expiry_year)
    {
        $this->expiry_year = $expiry_year;
    }

    /**
     * @param string $cvv
     * @return void
     */
    public function cvv(string $cvv)
    {
        $this->cvv = $cvv;
    }

}
