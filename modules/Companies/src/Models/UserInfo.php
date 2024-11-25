<?php

namespace Rezyon\Companies\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;

    protected $table = "user_info";

    protected $fillable = [
        'user_id',
        'gender',
        'birthdate'
    ];

    protected $casts = [
        'birthdate' => 'datetime:YY-mm-dd', // Change your format
    ];
}
