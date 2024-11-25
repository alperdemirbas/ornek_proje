<?php

namespace Rezyon\Companies\Interfaces;

interface CompanyOfficialsRepositoryInterface
{
    public function store(array $array);
    public function updateFromCompany(int $id , array $fill): int;

    /**
     * @description Firma yetkilisi güncelle
     * @param int $id
     * @param array $array
     * @return int
     */
    public function update(int $id, array $array):int;

    public function destroy(int $id):void;

    public function find(int $id);
}