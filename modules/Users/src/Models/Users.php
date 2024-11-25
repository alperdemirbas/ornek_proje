<?php

namespace Rezyon\Users\Models;


use App\Traits\HasFactoryTrait;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Rezyon\Companies\Models\Companies;
use Rezyon\Discounts\Models\UserDiscounts;
use Rezyon\Hotels\Models\Hotel;
use Rezyon\Hotels\Models\UserHotel;
use Rezyon\Transfers\Models\TransferUsers;
use Rezyon\Users\Database\Factories\UsersFactory;
use Rezyon\Users\Enums\Types;
use Spatie\Permission\Traits\HasRoles;

class Users extends  Authenticatable
{

    use HasFactoryTrait, Notifiable, HasRoles, CanResetPassword, SoftDeletes;
    protected $guard_name = 'web';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'companies_id',
        'pnr',
        'firstname',
        'lastname',
        'password',
        'email',
        'password',
        'type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'type'=> Types::class
    ];

    protected static function newFactory(): UsersFactory
    {
        return UsersFactory::new();
    }

    public function company()
    {
        return $this->belongsTo(Companies::class, 'companies_id');
    }

    public function cartDiscount()
    {
        return $this->belongsTo(UserDiscounts::class, 'id', 'users_id');
    }

    public function hotel()
    {
        return $this->hasOneThrough(Hotel::class, UserHotel::class, 'users_id', 'id');
    }
}
