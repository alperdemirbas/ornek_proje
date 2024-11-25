<?php

namespace Rezyon\TourismCompany\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourismCompanyGroupUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'tourism_company_group_id',
        'sub_group_id',
        'type',
        'status',
        'arrival_date',
        'date_of_return'
    ];
}
