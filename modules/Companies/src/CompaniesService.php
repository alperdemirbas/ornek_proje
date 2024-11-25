<?php

namespace Rezyon\Companies;

use Carbon\Carbon;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Password;
use Rezyon\Companies\Enums\PaymentFrequencyEnums;
use Rezyon\Companies\Enums\PaymentStatusesEnums;
use Rezyon\Companies\Exceptions\NotValidDomainName;
use Rezyon\Companies\Interfaces\CompaniesRepositoryInterface;
use Rezyon\Companies\Interfaces\CompaniesServiceInterface;
use Rezyon\Companies\Interfaces\CompanyDocumentsRepositoryInterface;
use Rezyon\Companies\Interfaces\CompanyFilesInterface;
use Rezyon\Companies\Interfaces\CompanyInterface;
use Rezyon\Companies\Interfaces\CompanyOfficialsInterface;
use Rezyon\Companies\Interfaces\CompanyOfficialsRepositoryInterface;
use Rezyon\Companies\Interfaces\CompanyPackageInterface;
use Rezyon\Companies\Interfaces\CompanyPackagesRepositoryInterface;
use Rezyon\Companies\Interfaces\UserInfoRepositoryInterface;
use Rezyon\Companies\Models\Companies;
use Rezyon\Companies\Repositories\UserRepository;
use Rezyon\Packages\Interfaces\PackagesRepositoryInterface;
use Rezyon\TourismCompany\Models\TourismCompanyGroupUser;
use Rezyon\TourismCompany\Repositories\GroupUserRepository;
use Rezyon\Users\Enums\Types;
use Rezyon\Users\Models\Users;


/**
 *
 */
class CompaniesService implements CompaniesServiceInterface
{

    /**
     * @param CompaniesRepositoryInterface $repository
     * @param CompanyDocumentsRepositoryInterface $companyDocumentsRepository
     * @param CompanyOfficialsRepositoryInterface $companyOfficials
     * @param PackagesRepositoryInterface $packagesRepository
     * @param CompanyPackagesRepositoryInterface $companyPackagesRepository
     * @param UserRepository $userRepository
     * @param GroupUserRepository $groupUserRepository
     * @param UserInfoRepositoryInterface $userInfoRepository
     */
    public function __construct(
        public CompaniesRepositoryInterface        $repository,
        public CompanyDocumentsRepositoryInterface $companyDocumentsRepository,
        public CompanyOfficialsRepositoryInterface $companyOfficials,
        public PackagesRepositoryInterface         $packagesRepository,
        public CompanyPackagesRepositoryInterface  $companyPackagesRepository,
        public UserRepository                      $userRepository,
        public GroupUserRepository                 $groupUserRepository,
        public UserInfoRepositoryInterface         $userInfoRepository
    )
    {

    }

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function  waitingCompanyUpdate(int $id, array $data): mixed
    {
        return $this->repository->update($id, $data);
    }

    /**
     * @param string $domain
     * @return mixed
     */
    public function findWithPackageByDomain(string $domain)
    {
        return $this->repository->findWithPackageByDomain($domain);
    }

    /**
     * @param Companies $companies
     * @param CompanyFilesInterface $companyFiles
     * @return void
     */
    public function filesStore(
        Companies             $companies,
        CompanyFilesInterface $companyFiles,
    ): void
    {
        $companyFiles = $companyFiles->getData();
        foreach ($companyFiles as $companyFile) {
            $this->companyDocumentsRepository->store([
                    'companies_id' => $companies->id,
                    'name' => $companyFile['name']
                ]
            );
        }
    }

    /**
     * @return Collection|array
     */
    public function waitingApproval(): Collection|array
    {
        return $this->repository->getWaitingApproval();
    }


    /**
     * @param int $id
     * @return Builder|Model
     */
    public function showWaitingApproval(int $id): Builder|Model
    {
        return $this->repository->showWaitingApproval($id);
    }

    /**
     * @param string $domainName
     * @return bool
     */
    public function isValidDomainName(string $domainName): bool
    {
        return $this->repository->isValidDomainName( $domainName );
    }
    /**
     * @throws NotValidDomainName
     */
    public function companyStore(
        CompanyInterface $company
    )
    {
        try {
            $name = $company->getName();
            $domainName = $company->getDomain();
            if ($domainName) {
                if (!$this->repository->isValidDomainName($domainName)) throw new NotValidDomainName();
            }
            $storeData = [
                'name' => $name,
                'address' => $company->getAddress(),
                'email' => $company->getEmail(),
                'phone' => $company->getPhone(),
                'phone_country' => $company->getPhoneCountry(),
                'domain' => $company->getDomain(),
                'is_active' => $company->isActive(),
                'verify_at' => $company->getVerifyAt(),
                'type' => $company->getType()
            ];
            return $this->repository->store($storeData);
        } catch (NotValidDomainName $exception) {
            throw $exception;
        }
    }

    /**
     * @description Firma bilgilerini güncelle
     * @param CompanyInterface $company
     * @return mixed
     * @throws NotValidDomainName
     */
    public function companyUpdate(
        int $id,
        CompanyInterface $company
    )
    {
        $updateData = [
            'name' =>$company->getName(),
            'address' => $company->getAddress(),
            'email' => $company->getEmail(),
            'description'=>$company->getDescription(),
            'phone' => $company->getPhone(),
            'phone_country' => $company->getPhoneCountry(),
            'domain' => $company->getDomain(),
            'is_active' => $company->isActive(),
            'verify_at' => $company->getVerifyAt(),
            'type' => $company->getType()
        ];
        return $this->repository->update($id,$updateData);

    }

    /**
     * @param Companies $companies
     * @param CompanyInterface $company
     * @return mixed
     */
    public function companyVerify(
        Companies        $companies,
        CompanyInterface $company
    )
    {
        $updateData = [
            'domain' => $company->getDomain(),
            'is_active' => $company->isActive(),
            'verify_at' => $company->getVerifyAt()
        ];

        return $this->repository->update($companies->id, $updateData);
    }

    /**
     * @param Companies $companies
     * @param CompanyOfficialsInterface $companyOfficials
     * @return mixed
     */
    public function officialsStore(
        Companies                 $companies,
        CompanyOfficialsInterface $companyOfficials
    )
    {
        return $this->companyOfficials->store([
            'companies_id' => $companies->id,
            'first_name' => $companyOfficials->getFirstName(),
            'last_name' => $companyOfficials->getLastName(),
            'email' => $companyOfficials->getEmail(),
            'title' => $companyOfficials->getTitle(),
            'phone' => $companyOfficials->getPhone(),
            'phone_country' => $companyOfficials->getPhoneCountry()
        ]);
    }

    /**
     * @param int $officialId
     * @return void
     */
    public function officialsDestroy(int $officialId):void
    {
        $official = $this->companyOfficials->find($officialId);
        $officialCount = $this->repository->findWithOfficials($official->companies_id);
        if($officialCount->officials->count() > 1){
            $this->companyOfficials->destroy($officialId);
        }
    }

    /**
     * @param int $id
     * @param CompanyOfficialsInterface $companyOfficials
     * @return int
     */
    public function officialsUpdate(
        int                      $id,
        CompanyOfficialsInterface $companyOfficials
    ): int
    {
        return $this->companyOfficials->update(
            $id,
            [
                'first_name' => $companyOfficials->getFirstName(),
                'last_name' => $companyOfficials->getLastName(),
                'email' => $companyOfficials->getEmail(),
                'title' => $companyOfficials->getTitle(),
                'phone' => $companyOfficials->getPhone(),
                'phone_country' => $companyOfficials->getPhoneCountry()
            ]
        );
    }

    /**
     * @param int $id
     * @param CompanyOfficialsInterface $companyOfficials
     * @return int
     */
    public function officialsUpdateFromCompany(
        int                      $id,
        CompanyOfficialsInterface $companyOfficials
    ): int
    {
        return $this->companyOfficials->updateFromCompany(
            $id,
            [
                'companies_id' => $id,
                'first_name' => $companyOfficials->getFirstName(),
                'last_name' => $companyOfficials->getLastName(),
                'email' => $companyOfficials->getEmail(),
                'title' => $companyOfficials->getTitle(),
                'phone' => $companyOfficials->getPhone(),
                'phone_country' => $companyOfficials->getPhoneCountry()
            ]
        );
    }

    /**
     * @param Companies $companies
     * @param CompanyPackageInterface $package
     * @return mixed
     */
    public function attach(Companies $companies, CompanyPackageInterface $package)
    {
        $packageService = $package->getPackages();
        return $this->companyPackagesRepository->store(
            [
                'packages_id' => $packageService->id,
                'companies_id' => $companies->id,
                'payment_frequency' => $package->getFrequencyEnums(),
                'start_date' => $package->getStartDate(),
                'end_date' => $package->getEndDate()
            ]
        );
    }

    /**
     * @param User $user
     * @return Builder|Model
     */
    public function attachUser(User $user): Builder|Model
    {
        $companies = $user->getCompanies();
        return $this->userRepository->create([
            'pnr' => $user->getPnr(),
            'companies_id' => $companies->id,
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'type' => $user->getType()
        ]);
    }

    public function userInfoStore(int $id, User $user)
    {
        return $this->userInfoRepository->create([
            'user_id' => $id,
            'birthdate' => $user->getBirthdate(),
            'gender' => $user->getGender()
        ]);
    }

    public function groupUserCreate(array $payload)
    {
        return $this->groupUserRepository->attach($payload);
    }

    /**
     * @param int $id
     * @return Model|Collection|Builder|array|null
     */
    public function findUser(int $id): Model|Collection|Builder|array|null
    {
        return $this->userRepository->find($id);
    }

    /**
     * @param int $id
     * @param array $data
     * @return int
     */
    public function updateUser(int $id, array $data): int
    {
        return $this->userRepository->update($id, $data);
    }

    /**
     * @param Types $type
     * @return mixed|null
     */
    public function getPermissions(Types $type): mixed
    {
        return $this->userRepository->getPermissions($type);
    }

    public function userSyncPermissions(\Rezyon\Companies\Models\Users $user, array $permissions)
    {
        return $this->userRepository->userSyncPermissions($user, $permissions);
    }

    public function sendResetPasswordLink( string $email , string $domain ): void
    {


        ResetPassword::createUrlUsing(function (Users $model , string $token) use($email, $domain) {
            $url = '//%s.%s/sifre-sifirlama?token=%s&email=%s';
            $appUrl = env('APP_URL');
            $url = sprintf($url , $domain , $appUrl , $token , $email);
            return $url;
        });
       Password::sendResetLink( ['email'=> $email ] );
    }

    /**
     * @param int $id
     * @param PaymentStatusesEnums $typesEnums
     * @return void
     */
    public function setPackageStatus(int $id, PaymentStatusesEnums $typesEnums): void
    {
        $this->companyPackagesRepository->update($id, [
            'payment_status' => $typesEnums
        ]);
    }


    /**
     * @param Companies $companies
     * @return float|int
     */
    public function amount(Companies $companies)
    {
        $companyPackage = $this->companyPackagesRepository->getWaitingPaymentPackage($companies->id);
        $frequency = $companyPackage->payment_frequency;
        $fee = $companyPackage->packages->fee;

        [$month,$multiplier] = match ($frequency) {
            PaymentFrequencyEnums::YEARLY => [12,$companyPackage->packages->yearly_discount],
            PaymentFrequencyEnums::QUARTER => [3,$companyPackage->packages->quarter_yearly_discount],
            PaymentFrequencyEnums::HALF_YEARLY => [6,$companyPackage->packages->half_yearly_discount],
            default => [ 1 , 0],
        };

        return (($fee * $month) - (($fee / 100) * $multiplier));

    }

    /**
     * @param Companies $companies
     * @return mixed
     */
    public function getWaitingPaymentPackage(Companies $companies)
    {
        return $this->companyPackagesRepository
            ->getWaitingPaymentPackage($companies->id);
    }

    /**
     * @return mixed
     */
    public function getExpiredPackage()
    {
        $now = Carbon::now()->startOfDay();
        return $this->companyPackagesRepository->expired($now);
    }

    /**
     * @param int $id
     * @return Companies
     */
    public function find(int $id):Companies
    {
        return $this->repository->find( $id );
    }

    /**
     * @description Yetkili ID ile bul
     * @param int $id
     * @return mixed
     */
    public function officialFind(int $id)
    {
        return $this->companyOfficials->find($id);
    }

    public function findWithRelations(int $id)
    {
        return $this->repository->findWithRelations( $id );
    }

    /**
     * @description Aktif Grup isimlerini listle
     * $id = Turizm Firma ID'si
     */
    public function groupList($id)
    {
        return $this->repository->groupList($id);

    }
}