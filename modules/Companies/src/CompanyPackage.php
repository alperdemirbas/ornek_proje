<?php

namespace Rezyon\Companies;

use Carbon\Carbon;
use Rezyon\Companies\Enums\PaymentFrequencyEnums;
use Rezyon\Companies\Enums\PaymentStatusesEnums;
use Rezyon\Companies\Interfaces\CompanyPackageInterface;
use Rezyon\Packages\Models\Packages;

/**
 *
 */
class CompanyPackage implements CompanyPackageInterface
{


    /**
     * @var Packages
     */
    protected Packages $packages;
    /**
     * @var Carbon|null
     */
    protected ?Carbon $startDate = null;
    /**
     * @var Carbon|null
     */
    protected ?Carbon $endDate = null;
    /**
     * @var PaymentFrequencyEnums
     */
    protected PaymentFrequencyEnums $frequencyEnums = PaymentFrequencyEnums::MONTHLY;
    /**
     * @var PaymentStatusesEnums
     */
    protected PaymentStatusesEnums $paymentStatusesEnums = PaymentStatusesEnums::WAITING_VERIFICATION;

    /**
     * @return PaymentStatusesEnums
     */
    public function getPaymentStatusesEnums(): PaymentStatusesEnums
    {
        return $this->paymentStatusesEnums;
    }

    /**
     * @param PaymentStatusesEnums $paymentStatusesEnums
     * @return void
     */
    public function setPaymentStatusesEnums(PaymentStatusesEnums $paymentStatusesEnums): void
    {
        $this->paymentStatusesEnums = $paymentStatusesEnums;
    }

    /**
     * @return PaymentFrequencyEnums
     */
    public function getFrequencyEnums(): PaymentFrequencyEnums
    {
        return $this->frequencyEnums;
    }

    /**
     * @param PaymentFrequencyEnums $frequencyEnums
     * @return void
     */
    public function setFrequencyEnums(PaymentFrequencyEnums $frequencyEnums): void
    {
        $this->frequencyEnums = $frequencyEnums;
    }

    /**
     * @return Packages
     */
    public function getPackages(): Packages
    {
        return $this->packages;
    }

    /**
     * @param Packages $packages
     * @return void
     */
    public function setPackages(Packages $packages): void
    {
        $this->packages = $packages;
    }

    /**
     * @return Carbon|null
     */
    public function getStartDate(): ?Carbon
    {
        return $this->startDate;
    }

    /**
     * @param Carbon|null $startDate
     * @return void
     */
    public function setStartDate(?Carbon $startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return Carbon|null
     */
    public function getEndDate(): ?Carbon
    {
        return $this->endDate;
    }

    /**
     * @param Carbon|null $endDate
     * @return void
     */
    public function setEndDate(?Carbon $endDate): void
    {
        $this->endDate = $endDate;
    }
}