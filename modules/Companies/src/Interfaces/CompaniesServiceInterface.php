<?php

namespace Rezyon\Companies\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Rezyon\Companies\Company;
use Rezyon\Companies\CompanyPackage;
use Rezyon\Companies\Enums\PaymentStatusesEnums;
use Rezyon\Companies\Models\Companies;
use Rezyon\Companies\User;
use Rezyon\TourismCompany\Models\TourismCompanyGroupUser;
use Rezyon\Users\Enums\Types;

interface CompaniesServiceInterface
{
    public function  waitingCompanyUpdate(int $id, array $data): mixed;

    public function companyStore(Company $company);

    public function isValidDomainName(string $domainName);

    public function filesStore(Companies $companies, CompanyFilesInterface $companyFiles): void;

    public function officialsStore(Companies $companies, CompanyOfficialsInterface $companyOfficials);

    public function officialsUpdate(int $id, CompanyOfficialsInterface $companyOfficials): int;

    public function waitingApproval(): Collection|array;

    public function attach(Companies $companies, CompanyPackage $package);

    public function companyVerify(Companies $companies, CompanyInterface $company);

    public function findWithPackageByDomain(string $domain);

    public function attachUser(User $user): Builder|Model;

    public function userInfoStore(int $id, User $user);

    public function findUser(int $id): Model|Collection|Builder|array|null;

    public function updateUser(int $id, array $data): int;

    public function getPermissions(Types $type): mixed;

    public function setPackageStatus(int $id, PaymentStatusesEnums $typesEnums);

    public function getExpiredPackage();

    public function getWaitingPaymentPackage(Companies $companies);

    public function amount(Companies $companies);

    public function find(int $id):Companies;

    public function sendResetPasswordLink( string $domain , string $email ): void;

    public function userSyncPermissions(\Rezyon\Companies\Models\Users $user, array $permissions);

    public function officialsDestroy(int $id):void;

    public function findWithRelations(int $id);

    public function officialFind(int $id);

    public function groupList(int $id);

    public function groupUserCreate(array $payload);
}