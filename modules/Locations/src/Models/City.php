<?php

namespace Rezyon\Locations\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_id',
        'city_name'
    ];

    public $timestamps = false;

    public function district()
    {
        return $this->hasMany(District::class);
    }

    public function scopeId($query,$id)
    {
        return $query->where('id',$id);
    }

}
