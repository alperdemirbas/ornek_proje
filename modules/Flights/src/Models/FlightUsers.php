<?php

namespace Rezyon\Applications\Flights\Models;

use App\Traits\HasFactoryTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rezyon\Applications\Flights\Enums\StatusEnums;
use Rezyon\Flights\Enums\FlightStatusEnums;
use Rezyon\Flights\Models\Flights;

class FlightUsers extends Model
{
    use HasFactoryTrait, SoftDeletes;

    protected $fillable = [
        "flights_id",
        "users_id",
        "status",
    ];

    protected $casts = [
        "status" => StatusEnums::class,
    ];
}
