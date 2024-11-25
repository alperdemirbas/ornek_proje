<?php

namespace Rezyon\Companies\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rezyon\Companies\Database\Factories\CompaniesFactory;
use Rezyon\Companies\Enums\CompanyTypeEnums;
use Rezyon\Supplier\Models\Activity;


class Companies extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'domain',
        'email',
        'phone',
        'phone_country',
        'address',
        'description',
        'is_active',
        'verify_at',
        'type'
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:s:00',
        'updated_at' => 'datetime:Y-m-d H:s:00',
        'verify_at' => 'datetime:Y-m-d H:s:00',
        'type' => CompanyTypeEnums::class
    ];

    protected static function newFactory(): CompaniesFactory
    {
        return CompaniesFactory::new();
    }

    public function packages(): HasMany
    {
        return $this->hasMany(CompaniesPackages::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(CompanyDocuments::class);
    }

    public function officials(): HasMany
    {
        return $this->hasMany(CompanyOfficials::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
