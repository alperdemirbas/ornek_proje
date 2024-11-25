<?php

namespace Rezyon\Companies\Interfaces;

interface UserInfoRepositoryInterface
{
    public function create(array $array);
    public function find(int $id);
    public function update(int $id,array $payload);
    public function delete(int $id);
}