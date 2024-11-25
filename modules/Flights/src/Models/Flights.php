<?php

namespace Rezyon\Flights\Models;

use App\Traits\HasFactoryTrait;
use Illuminate\Database\Eloquent\Model;
use Rezyon\Flights\Enums\FlightStatusEnums;
use Rezyon\Applications\Auth\Models\User;

class Flights extends Model
{
    use HasFactoryTrait;

    protected $fillable = [
        'users_id',
        'flight_number',
        'detail',
        'departure_time',
        'departure_airport',
        'arrival_time',
        'arrival_airport',
        'return',
        'status',
    ];

    protected $casts = [
        'status' => FlightStatusEnums::class,
    ];
}
