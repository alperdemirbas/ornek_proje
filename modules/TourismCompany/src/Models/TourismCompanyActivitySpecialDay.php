<?php

namespace Rezyon\TourismCompany\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourismCompanyActivitySpecialDay extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'profitability',
        'companies_id',
        'activity_id',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'datetime:d-m-Y',
        'end_date' => 'datetime:d-m-Y',
    ];
}
