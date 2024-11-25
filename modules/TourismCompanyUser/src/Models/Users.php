<?php

namespace Rezyon\TourismCompanyUser\Models;


use App\Traits\HasFactoryTrait;
use Carbon\Carbon;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Rezyon\Companies\Models\Companies;
use Rezyon\Discounts\Models\UserDiscounts;
use Rezyon\Hotels\Models\Hotel;
use Rezyon\Hotels\Models\UserHotel;
use Rezyon\TourismCompanyUser\Database\Factories\UsersFactory;
use Rezyon\Users\Enums\Types;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Users extends Authenticatable implements JWTSubject
{

    use HasFactoryTrait, Notifiable, HasRoles, CanResetPassword;

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
        'phone',
        'phone_country',
        'birthdate',
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
        'type' => Types::class,
        'birthdate' => 'datetime:Y-m-d',
    ];

    protected static function newFactory(): UsersFactory
    {
        return UsersFactory::new();
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [

        ];
    }

    public function company()
    {
        return $this->belongsTo(Companies::class, 'companies_id');
    }

    public function cartDiscount()
    {
        return $this->belongsTo(UserDiscounts::class, 'id', 'users_id')->whereNull('used_at');
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['birthdate'])->age;
    }

    public function hotel()
    {
        return $this->hasOneThrough(Hotel::class, UserHotel::class, 'users_id', 'id');
    }
}
