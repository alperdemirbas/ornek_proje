<?php

namespace Rezyon\Packages\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Rezyon\Packages\Models\Packages;

interface PackagesRepositoryInterface
{

    public function create(array $package): Model|Builder;

    public function get(): array|Collection;

    public function find(int $id);

    public function all();

    public function update(int $id, array $fill): int;
}