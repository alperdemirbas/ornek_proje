<?php

namespace Rezyon\Locations\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'neighborhood_name',
        'district_id'
    ];

    public $timestamps = false;

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function street()
    {
        return $this->hasMany(Street::class);
    }
}
