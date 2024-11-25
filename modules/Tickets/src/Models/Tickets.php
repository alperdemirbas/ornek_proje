<?php

namespace Rezyon\Tickets\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rezyon\Carts\Models\Carts;
use Rezyon\Supplier\Models\Activity;
use Rezyon\Users\Models\Users;

class Tickets extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_id',
        'users_id',
        'carts_id',
        'owner_id',
        'code',
        'start_time',
        'end_time',
        'used_at',
        'approved_by'
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }

    public function cart()
    {
        return $this->hasOne(Carts::class, 'id', 'carts_id');
    }

    public function user()
    {
        return $this->hasOne(Users::class, 'id', 'users_id');
    }

    public function owner()
    {
        return $this->hasOne(Users::class, 'id', 'owner_id');
    }

    public function approving()
    {
        return $this->hasOne(Users::class, 'id', 'approved_by');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($ticket) {
            $ticket->code = generateTicketCode();
        });
    }
}
