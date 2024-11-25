<?php

namespace Rezyon\Companies\Models;


use Rezyon\Companies\Database\Factories\UsersFactory;
use Rezyon\Hotels\Models\Hotel;
use Rezyon\Hotels\Models\UserHotel;

class Users extends \Rezyon\Users\Models\Users
{
    protected $guard_name = 'companies';

    protected static function newFactory(): UsersFactory
    {
        return UsersFactory::new();
    }

    public function company()
    {
        return $this->belongsTo(Companies::class, 'companies_id');
    }

    public function hotel()
    {
        return $this->hasOneThrough(Hotel::class, UserHotel::class, 'users_id', 'id');
    }
}
