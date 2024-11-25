<?php

namespace Rezyon\Hotels\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserHotel extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'users_id',
        'hotel_id',
        'check_in',
        'check_out'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
}
