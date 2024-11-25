<?php

namespace Rezyon\Companies;

use Carbon\Carbon;
use Rezyon\Companies\Enums\PaymentFrequencyEnums;
use Rezyon\Companies\Enums\PaymentStatusesEnums;
use Rezyon\Companies\Interfaces\CompanyPackageServiceInterface;
use Rezyon\Companies\Interfaces\CompanyPackagesRepositoryInterface;
use Rezyon\Companies\Models\Companies;
use Rezyon\Companies\Models\CompaniesPackages;
use function Symfony\Component\Translation\t;

class CompanyPackageService implements CompanyPackageServiceInterface
{
    public function __construct(
        public CompanyPackagesRepositoryInterface $companyPackagesRepository
    )
    {

    }

    protected function calcEndDate(CompaniesPackages $companyPackage)
    {

        $endDate = $companyPackage->end_date;
        return  match ($companyPackage->payment_frequency) {
            PaymentFrequencyEnums::YEARLY => $endDate->addYear(),
            PaymentFrequencyEnums::QUARTER => $endDate->addMonths(6),
            PaymentFrequencyEnums::HALF_YEARLY =>$endDate->addMonths(3),
            PaymentFrequencyEnums::MONTHLY => $endDate->addMonth()
        };

    }

    public function setSuccess(Companies $companies)
    {
        $package = $this->companyPackagesRepository->findWaitingApprovalByCompanyId($companies->id);
        $endDate = $this->calcEndDate($package);
        $this->companyPackagesRepository->update($package->id,[
            'end_date'=>$endDate,
            'payment_status' => PaymentStatusesEnums::PAYMENT_SUCCESS
        ]);

    }

    public function packageWaitingApproval(Companies $companies)
    {
        $companyPackage = $this->companyPackagesRepository->getWaitingPaymentPackage($companies->id);
        $this->companyPackagesRepository->setStatus(
            $companyPackage,
            PaymentStatusesEnums::WAITING_APPROVAL
        );
    }

    public function packageVerify(Companies $companies): void
    {
        $companyPackage = $this->companyPackagesRepository->getWaitingVerifyPackage($companies->id);
        if (!empty($companyPackage)) {
            $this->companyPackagesRepository
                ->update($companyPackage->id, [
                    'payment_status' => PaymentStatusesEnums::DEMO,
                    'start_date' => Carbon::now()->startOfDay(),
                    'end_date' => Carbon::now()->addDays(30)->endOfDay()
                ]);
        }
    }

    public function setEndDate(CompanyPackage $companyPackage, Carbon $endDate)
    {
        $this->companyPackagesRepository
            ->update($companyPackage->id, [
                'end_date' => $endDate
            ]);
    }

    public function findWaitingApprovalByCompanyId(int $companyId)
    {
        return $this->companyPackagesRepository->findWaitingApprovalByCompanyId($companyId);
    }

}