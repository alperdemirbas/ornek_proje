<?php

namespace Rezyon\Hotels\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rezyon\Hotels\Enums\StatusEnum;
use Rezyon\Locations\Models\City;
use Rezyon\Locations\Models\District;
use Rezyon\Users\Models\Users;

class Hotel extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $fillable = [
        'users_id',
        'name',
        'phone',
        'phone_country',
        'address',
        'city_id',
        'district_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(Users::class, 'users_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }
}
