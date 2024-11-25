<?php

namespace Rezyon\Transfers\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rezyon\Users\Models\Users;
use Spatie\Translatable\HasTranslations;

class Cars extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    public $translatable = ['name'];

    protected $fillable = [
        'users_id',
        'name',
        'capacity',
        'number'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function user()
    {
        return $this->hasOne(Users::class, 'id', 'users_id');
    }
}
