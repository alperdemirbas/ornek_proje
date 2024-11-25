<?php

namespace Rezyon\Companies\Interfaces;

use Carbon\Carbon;
use Rezyon\Companies\Enums\PaymentFrequencyEnums;
use Rezyon\Companies\Enums\PaymentStatusesEnums;
use Rezyon\Companies\Models\Companies;
use Rezyon\Packages\Models\Packages;

interface CompanyPackageInterface
{

    public function getPackages(): Packages;

    public function setPackages(Packages $packages): void;

    public function getStartDate(): ?Carbon;

    public function setStartDate(?Carbon $startDate): void;

    public function getEndDate(): ?Carbon;

    public function setEndDate(?Carbon $endDate): void;

    public function getFrequencyEnums(): PaymentFrequencyEnums;

    public function setFrequencyEnums(PaymentFrequencyEnums $frequencyEnums): void;

    public function getPaymentStatusesEnums(): PaymentStatusesEnums;

    public function setPaymentStatusesEnums(PaymentStatusesEnums $paymentStatusesEnums): void;
}