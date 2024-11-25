<?php

namespace Rezyon\Supplier\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rezyon\TourismCompanyUser\Models\Users;

class ActivityParticipants extends Model
{
    use HasFactory;

    protected $fillable = [
        "users_id",
        "activity_id"
    ];

    public function user()
    {
        return $this->belongsTo(Users::class, 'users_id', 'id');
    }
}
