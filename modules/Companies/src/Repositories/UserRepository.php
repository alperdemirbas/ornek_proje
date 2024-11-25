<?php

namespace Rezyon\Companies\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Rezyon\Companies\Models\Users;
use Rezyon\Users\Enums\Types;
use Spatie\Permission\Models\Permission;

class UserRepository
{
    protected Builder $builder;

    public function __construct(public Users $users)
    {
        $this->builder = $this->users->newQuery();
    }
    public function create(array $array)
    {
        return $this->builder->create($array);
    }

    /**
     * @param int $id
     * @return Model|Builder|null
     */
    public function find(int $id): Model|Builder|null
    {
        return $this->builder->find($id);
    }

    /**
     * @param int $id
     * @param array $data
     * @return int
     */
    public function update(int $id, array $data): int
    {
        return $this->builder->where('id', $id)->update($data);
    }

    /**
     * @param Types $type
     * @return mixed
     * Burda izinleri kullanıcı tipini alıp key'ine göre getiriyoruz.
     */
    public function getPermissions(Types $type): mixed
    {
        if ($type === Types::TOURISM_COMPANY) {
            return Permission::where('name', 'like', 'tourism.%')
                ->get();
        }
        return Permission::where('name', 'like', 'supplier.%')
            ->get();
    }

    /**
     * @param Users $user
     * @param array $permissions
     * @return Users
     *
     * Burda yeni izinlerle eski izinleri değiştiriyoruz.
     */
    public function userSyncPermissions(Users $user, array $permissions): Users
    {
        return $user->syncPermissions($permissions);
    }

}