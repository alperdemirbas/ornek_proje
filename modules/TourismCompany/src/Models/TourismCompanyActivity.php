<?php

namespace Rezyon\TourismCompany\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rezyon\Supplier\Models\Activity;
use Rezyon\TourismCompany\Enums\ActivityStatus;
use Rezyon\Companies\Models\Companies;

class TourismCompanyActivity extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'profitability',
        'companies_id',
        'activity_id',
        'status',
    ];

    protected $casts = [
        'status' => ActivityStatus::class,
        'created_at' => 'datetime:d-m-Y',
    ];

    public function activity(): HasOne
    {
        return $this->hasOne(Activity::class, 'id', 'activity_id');
    }

    public function company(): HasOne
    {
        return $this->hasOne(Companies::class, 'id', 'companies_id');
    }

    public function specialDays()
    {
        return $this->hasMany(TourismCompanyActivitySpecialDay::class, 'activity_id', 'activity_id');
    }

    public function closedDays()
    {
        return $this->hasMany(TourismCompanyActivityClosedDay::class, 'tourism_activity_id');
    }
}
