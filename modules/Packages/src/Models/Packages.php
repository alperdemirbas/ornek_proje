<?php

namespace Rezyon\Packages\Models;

use App\Traits\HasFactoryTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rezyon\Packages\Enums\PackageTypesEnums;

class Packages extends Model
{
    use HasFactoryTrait, SoftDeletes;

    protected $fillable = [
        'name',
        'is_active',
        'quarter_yearly_discount',
        'half_yearly_discount',
        'yearly_discount',
        'fee',
        'type',
    ];

    protected $casts=['type'=>PackageTypesEnums::class];

}
