<?php

namespace Rezyon\Supplier\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityPrice extends Model
{
    use HasFactory;
    protected $fillable = [
        'activity_id',
        'type',
        'price',
        'start_date',
        'end_date'
    ];
    public $timestamps =false;
}
