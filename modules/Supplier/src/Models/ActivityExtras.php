<?php

namespace Rezyon\Supplier\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rezyon\Supplier\Enums\ActivityExtraTypeEnum;
use Spatie\Translatable\HasTranslations;

class ActivityExtras extends Model
{
    use HasFactory, HasTranslations;

    public $timestamps = false;

    public array $translatable = ['value'];

    protected $fillable = [
      "activity_id",
      "key",
      "value",
    ];

    protected $casts = [
      'key' => ActivityExtraTypeEnum::class,
    ];
}