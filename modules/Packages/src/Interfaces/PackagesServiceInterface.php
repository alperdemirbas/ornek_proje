<?php

namespace Rezyon\Packages\Interfaces;


interface PackagesServiceInterface
{
    public function create(PackagesInterface $package);

    public function find(int $id);

    public function all();

    public function allWithInActive();

    public function update(int $id , array $fill);
}