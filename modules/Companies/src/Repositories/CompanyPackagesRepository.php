<?php

namespace Rezyon\Companies\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rezyon\Companies\Enums\PaymentStatusesEnums;
use Rezyon\Companies\Interfaces\CompanyPackagesRepositoryInterface;
use Rezyon\Companies\Models\CompaniesPackages;

class CompanyPackagesRepository implements CompanyPackagesRepositoryInterface
{
    protected Builder $builder;

    public function __construct(
        public CompaniesPackages $companiesPackages
    )
    {
        $this->builder = $this->companiesPackages->newQuery();
    }

    public function store(array $array)
    {
        return $this->builder->create($array);
    }

    public function find(int $id)
    {
        return $this->builder->find($id);
    }

    public function getWaitingPaymentPackage(int $customerId)
    {
        return $this->builder
            ->with('packages')
            ->where([
                'payment_status' => PaymentStatusesEnums::WAITING_PAYMENT,
                'companies_id' => $customerId
            ])->first();
    }

    public function setStatus( CompaniesPackages $companiesPackages, PaymentStatusesEnums $paymentStatusesEnums):void
    {
        $this->builder->where('id' , $companiesPackages->id)->update([
            'payment_status' => $paymentStatusesEnums
        ]);
    }

    public function getWaitingVerifyPackage(int $customerId)
    {
        return $this->builder
            ->where([
                'payment_status' => PaymentStatusesEnums::WAITING_VERIFICATION,
                'companies_id' => $customerId
            ])->first();
    }

    public function findWaitingApprovalByCompanyId(int $customerId)
    {
        return  $this->builder
            ->where([
                'payment_status' => PaymentStatusesEnums::WAITING_APPROVAL,
                'companies_id' => $customerId
            ])->first();
    }

    public function packages(int $companyId)
    {
        return $this->builder
            ->with('packages')
            ->where('companies_id', $companyId)
            ->get();
    }

    public function update(int $id, array $fill)
    {
        return $this->companiesPackages->newQuery()->where('id', $id)->update($fill);
    }

    public function expired(Carbon $date)
    {
        return $this->builder
            ->whereIn('payment_status',[PaymentStatusesEnums::DEMO,PaymentStatusesEnums::PAYMENT_SUCCESS])
            ->whereDate('end_date','<', $date)->get();
    }
}