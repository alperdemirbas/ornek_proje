<?php

namespace Rezyon\Transfers\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rezyon\Users\Enums\Types;

class TransferUsers extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'users_id',
        'transfers_id',
        'pickup_time'
    ];

    protected $casts = [
        'pickup_time' => 'datetime:H:i'
    ];

    public function customer()
    {
        return $this->hasOne(\Rezyon\TourismCompanyUser\Models\Users::class, 'id', 'users_id')->where('type', Types::CUSTOMER);
    }

    public function user()
    {
        return $this->hasOne(\Rezyon\Companies\Models\Users::class, 'id', 'users_id')->where('type', Types::TOURISM_COMPANY);
    }

    public function transfer()
    {
        return $this->hasOne(Transfers::class);
    }
}
