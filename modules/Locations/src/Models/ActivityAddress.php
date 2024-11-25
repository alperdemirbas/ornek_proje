<?php

namespace Rezyon\Locations\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'activity_id',
        'street_id',
        'detail',
        'directions',
        'latitude',
        'longitude'
    ];

    public $timestamps = false;

    public function street()
    {
        return $this->belongsTo(Street::class);
    }
}
