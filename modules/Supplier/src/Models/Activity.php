<?php

namespace Rezyon\Supplier\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rezyon\Companies\Models\Companies;
use Rezyon\Supplier\Enums\ActivityStatusEnum;
use Rezyon\Locations\Models\ActivityAddress;
use Rezyon\Supplier\Enums\PriceCurrency;
use Rezyon\TourismCompany\Enums\ActivityStatus;
use Rezyon\TourismCompany\Models\TourismCompanyActivity;
use Spatie\Translatable\HasTranslations;

class Activity extends Model
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;

    public $translatable = ['name','description'];

    protected $fillable = [
        'companies_id',
        'name',
        'currency',
        'description',
        'start_time',
        'end_time',
        'duration',
        'activity_category_id',
        'views',
        'rejected_reason',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'currency' => PriceCurrency::class,
        'status' => ActivityStatusEnum::class
    ];
    protected $appends = [
        'duration'
    ];

    public function closedDays(): HasMany
    {
        return $this->hasMany(ActivityClosedDay::class);
    }

    public function privateDays()
    {
        return $this->hasMany(ActivityPrivateDays::class);
    }

    public function rules(): HasMany
    {
        return $this->hasMany(ActivityPriceRule::class);
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(ActivitySession::class);
    }

    public function prices(): HasMany
    {
        return $this->hasMany(ActivityPrice::class);
    }

    public function priceRules(): HasMany
    {
        return $this->hasMany(ActivityPriceRule::class);
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ActivityCategory::class, 'id', 'activity_category_id');
    }

    public function company()
    {
        return $this->hasOne(Companies::class, 'id', 'companies_id');
    }

    public function images()
    {
        return $this->hasMany(ActivityPhoto::class);
    }

    public function address()
    {
        return $this->hasOne(ActivityAddress::class);
    }

    public function participants()
    {
        return $this->hasMany(ActivityParticipants::class);
    }

    public function extras()
    {
        return $this->hasMany(ActivityExtras::class);
    }

    public function cancellationConditions()
    {
        return $this->hasMany(ActivityCancellationConditions::class);
    }

    public function tourismCompanyProfitability()
    {
        return $this->hasOne(TourismCompanyActivity::class)->where('status', ActivityStatus::ACTIVE);
    }

    public function getDurationAttribute($value): array
    {
        $hours = floor($value / 60);
        $minutes = $value % 60;

        return ['hours' => $hours , 'minutes' => $minutes];
    }
}
