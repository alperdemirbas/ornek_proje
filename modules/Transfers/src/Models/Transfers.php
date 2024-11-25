<?php

namespace Rezyon\Transfers\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rezyon\Hotels\Models\Hotel;
use Rezyon\Supplier\Models\Activity;
use Rezyon\Supplier\Models\ActivitySession;
use Rezyon\Users\Models\Users;

class Transfers extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'users_id',
        'activity_id',
        'hotel_id',
        'activity_session_id',
        'cars_id',
        'time',
        'date',
        'driver_name',
        'driver_phone',
        'driver_phone_country'
    ];

    protected $casts = [
        "time" => "datetime:H:i",
        "date" => "datetime:Y-m-d",
        "created_at" => "datetime:Y-m-d H:i:s",
        "updated_at" => "datetime:Y-m-d H:i:s",
    ];

    public function user()
    {
        return $this->belongsTo(Users::class, 'users_id', 'id');
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function car()
    {
        return $this->belongsTo(Cars::class, 'cars_id', 'id');
    }

    public function session()
    {
        return $this->belongsTo(ActivitySession::class, 'activity_session_id', 'id');
    }

    public function transferUsers()
    {
        return $this->hasMany(TransferUsers::class);
    }
}
