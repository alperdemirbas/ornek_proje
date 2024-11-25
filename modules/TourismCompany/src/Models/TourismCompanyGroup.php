<?php

namespace Rezyon\TourismCompany\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rezyon\TourismCompany\Enums\GroupTypes;

class TourismCompanyGroup extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'users_id',
        'name',
        'type',
        'status',
        'arrival_date',
        'date_of_return',
    ];
    protected $casts = [
        'type' => GroupTypes::class
    ];
}
