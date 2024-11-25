<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobilCheck extends Model
{
    protected $table = 'mobil_check';
    use HasFactory;

    protected $fillable = [
        'deadlock',
        'store'
    ];
}
