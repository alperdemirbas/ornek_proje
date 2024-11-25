<?php

namespace Rezyon\Supplier\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ActivityCategory extends Model
{
    use HasFactory;
    public $timestamps = false;
    use HasTranslations;

    protected $fillable = [
        'activity_category_type_id',
        'name',
        'icon',
    ];
    public array $translatable = ['name'];
    public function categoryType(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ActivityCategoryType::class, 'id', 'activity_category_type_id');
    }
}
