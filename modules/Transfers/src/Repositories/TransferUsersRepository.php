<?php

namespace Rezyon\Transfers\Repositories;

use Rezyon\Transfers\Models\TransferUsers;

class TransferUsersRepository
{
    protected TransferUsers $model;

    public function __construct(TransferUsers $model)
    {
        $this->model = $model;
    }
}