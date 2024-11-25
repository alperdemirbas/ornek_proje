<?php

namespace Rezyon\Discounts\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDiscounts extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'discounts_id',
        'users_id',
        'used_at'
    ];

    public function discount()
    {
        return $this->belongsTo(Discounts::class, 'discounts_id', 'id');
    }
}
