<?php

namespace Rezyon\Locations\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'district_name',
        'city_id'
    ];

    public $timestamps = false;

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function neighborhood()
    {
        return $this->hasMany(Neighborhood::class,'district_id','id');
    }

    public function scope($query,$id)
    {
        return $query->where('id',$id);
    }

}
