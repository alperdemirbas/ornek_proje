<?php

namespace Rezyon\Supplier\Repositories;

use Rezyon\Supplier\Models\ActivityCategory;
use Rezyon\Supplier\Models\ActivityCategoryType;
use Rezyon\Supplier\Models\ActivitySession;

class ActivityCategoriesRepository
{
    public function __construct(
        public ActivityCategory $category,
        public ActivityCategoryType $activityCategoryType
    )
    {

    }

    public function list()
    {
        return $this->category->newQuery()->get();
    }

    public function listFromId(int $id)
    {
        return $this->category->newQuery()->where('activity_category_type_id',$id)->get();
    }

    public function types()
    {
        return $this->activityCategoryType->newQuery()->get();
    }
}