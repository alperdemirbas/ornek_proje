<?php

namespace Rezyon\Supplier\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rezyon\Supplier\Enums\PriceRuleGenders;
use Rezyon\Supplier\Enums\PriceRuleOperators;
use Rezyon\Supplier\Enums\PriceRules;

class ActivityPriceRule extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'activity_id',
        'rule',
        'discount_rate',
        'gender',
        'age',
        'operator',
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'operator' => PriceRuleOperators::class,
        'gender' => PriceRuleGenders::class,
        'rule' => PriceRules::class
    ];
}
