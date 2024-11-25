<?php

namespace Rezyon\Locations\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'street_name',
        'neighborhood_id'
    ];

    public $timestamps = false;

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class);
    }
}
