<?php

namespace Rezyon\Supplier\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityClosedDay extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'activity_id',
        'day',
    ];
}