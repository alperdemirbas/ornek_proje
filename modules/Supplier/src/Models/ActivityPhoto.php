<?php

namespace Rezyon\Supplier\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class ActivityPhoto extends Model
{
    use HasFactory;
    protected $fillable = [
        'activity_id',
        'path',
        'order',
        'views'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order');
        });
    }

    public function getPathAttribute()
    {
        return Storage::disk('s3')->temporaryUrl(
            $this->attributes['path'],
            Carbon::now()->addMinutes(999)
        );
    }
}
