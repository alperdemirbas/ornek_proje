<?php

namespace Rezyon\Supplier\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rezyon\Supplier\Enums\Days;

class ActivitySession extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $casts = [
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'day' => Days::class,
    ];

    protected $fillable = [
        'activity_id',
        'start_time',
        'end_time',
        'capacity',
        'day'
    ];

    /*public function getDayAttribute()
    {
        return \Carbon\Carbon::now()->isoWeekday($this->attributes['day'])->getTranslatedDayName();
    }*/
}
