<?php

namespace Rezyon\Carts\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rezyon\Orders\Models\OrderReturn;
use Rezyon\Orders\Models\Orders;
use Rezyon\Supplier\Models\Activity;
use Rezyon\Supplier\Models\ActivitySession;
use Rezyon\Tickets\Models\Tickets;
use Rezyon\Users\Models\Users;

class Carts extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'activity_id',
        'users_id',
        'orders_id',
        'price',
        'selected_time',
        'activity_session_id',
        'adult',
        'child',
        'baby',
        'status'
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }

    public function session()
    {
        return $this->hasOne(ActivitySession::class, 'id', 'activity_session_id');
    }

    public function tickets()
    {
        return $this->hasMany(Tickets::class);
    }

    public function user()
    {
        return $this->belongsTo(Users::class);
    }

    public function order()
    {
        return $this->hasOne(Orders::class, 'id', 'orders_id');
    }

    public function cancelled()
    {
        return $this->hasOne(OrderReturn::class);
    }
}
