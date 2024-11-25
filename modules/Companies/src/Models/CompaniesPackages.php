<?php

namespace Rezyon\Companies\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Rezyon\Companies\Enums\PaymentFrequencyEnums;
use Rezyon\Companies\Enums\PaymentStatusesEnums;
use Rezyon\Packages\Models\Packages;

class CompaniesPackages extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'packages_id',
        'companies_id',
        'payment_frequency',
        'payment_status',
        'start_date',
        'end_date'
    ];
    protected $casts = [
        'payment_frequency' => PaymentFrequencyEnums::class,
        'payment_status' => PaymentStatusesEnums::class,
        'start_date'=> 'date:Y-m-d H:s:00',
        'end_date'=> 'date:Y-m-d H:s:00',
    ];

    public function packages(): HasOne
    {
        return $this->hasOne(Packages::class, 'id', 'packages_id');
    }
}
