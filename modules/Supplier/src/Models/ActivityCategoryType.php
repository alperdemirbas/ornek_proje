<?php

namespace Rezyon\Supplier\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ActivityCategoryType extends Model
{
    use HasFactory, HasTranslations;
    public $timestamps =false;
    public array $translatable = ['name'];
    protected $fillable = [
        'name',
        'icon',
    ];
}
