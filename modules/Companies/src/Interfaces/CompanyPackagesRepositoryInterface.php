<?php

namespace Rezyon\Companies\Interfaces;

use Carbon\Carbon;
use Rezyon\Companies\Enums\PaymentStatusesEnums;
use Rezyon\Companies\Models\CompaniesPackages;

/**
 *
 */
interface CompanyPackagesRepositoryInterface
{
    /**
     * @param array $array
     * @return mixed
     */
    public function store(array $array);

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id);

    /**
     * @param int $customerId
     * @return mixed
     */
    public function getWaitingVerifyPackage(int $customerId);

    /**
     * @param CompaniesPackages $companiesPackages
     * @param PaymentStatusesEnums $paymentStatusesEnums
     * @return void
     */
    public function setStatus(CompaniesPackages $companiesPackages, PaymentStatusesEnums $paymentStatusesEnums):void;
    /**
     * @param int $id
     * @param array $fill
     * @return mixed
     */
    public function update(int $id, array $fill);

    /**
     * @param Carbon $date
     * @return mixed
     */
    public function expired(Carbon $date);

    public function findWaitingApprovalByCompanyId(int $customerId);
    /**
     * @param int $companyId
     * @return mixed
     */
    public function packages(int $companyId);

    /**
     * @param int $customerId
     * @return mixed
     */
    public function getWaitingPaymentPackage(int $customerId);
}