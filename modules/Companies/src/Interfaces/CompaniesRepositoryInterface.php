<?php

namespace Rezyon\Companies\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface CompaniesRepositoryInterface
{
    public function store(array $array);

    public function isValidDomainName(string $name): bool;

    public function getWaitingApproval(): Collection|array;

    public function showWaitingApproval(int $id): Builder|Model;

    public function update(int $id, array $fill);

    public function find(int $id);

    public function findWithOfficials(int $id);

    public function findByDomain(string $domain);

    public function findWithPackageByDomain(string $domain);

    /*public function destroy(int $id);*/

    public function findWithRelations(int $id);

    public function groupList(int $id);
}