<?php

namespace Rezyon\Supplier\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Rezyon\Supplier\Enums\ActivityStatusEnum;
use Rezyon\Supplier\Models\Activity;
use Spatie\QueryBuilder\QueryBuilder;

class ActivityRepository
{
    public function __construct(
        public Activity $activity
    )
    {

    }

    public function list()
    {
        return $this->activity->newQuery()->with([
            'closedDays',
            'rules',
            'sessions'
        ])->get();
    }

    public function listWithoutIds(array $ids, array $filters = null)
    {
        return QueryBuilder::for($this->activity)
            ->allowedFilters(['activity_category_id'])
            ->whereNotIn('id' , $ids)
            ->where('status', ActivityStatusEnum::ACTIVE)
            ->with('images')
            ->withWhereHas('prices', function($query) use ($filters) {
                $query->where('type', 'ALL');
                if(isset($filters['min_price'])) {
                    $query->where('price', '>=', $filters['min_price']);
                }
                if(isset($filters['max_price'])) {
                    $query->where('price', '<=', $filters['max_price']);
                }
            })
            ->get();
    }
    
    public function find(int $id)
    {
        return $this->activity->newQuery()->with([
            'closedDays',
            'privateDays',
            'rules',
            'sessions',
            'prices',
            'category',
            'images',
            'priceRules',
            'address',
            'company.activities' => function($query) use($id) {
                $query->where('id', '!=', $id);
                $query->where('status', ActivityStatusEnum::ACTIVE);
                $query->with(['images', 'prices']);
            },
            'cancellationConditions'
        ])->find( $id );
    }
    public function store(array $data)
    {
        return $this->activity->newQuery()->create($data);
    }

    public function update(int $id , array $array)
    {
        $this->activity->newQuery()->where('id', $id)->update($array);
    }

    /**
     * @param int $id
     * @return Model|Builder|null
     */
    public function getWaitingActivity(int $id): Model|Builder|null
    {
        return $this->activity->newQuery()
            ->where(['id' => $id, 'status' => ActivityStatusEnum::WAITING])
            ->with('company')
            ->first();
    }

    /**
     * @param int $id
     * @return int
     */
    public function confirmActivity(int $id): int
    {
        return $this->activity->newQuery()
            ->where(['id' => $id, 'status' => ActivityStatusEnum::WAITING])
            ->update(['status' => ActivityStatusEnum::ACTIVE]);
    }

    /**
     * @param int $id
     * @param string $reason
     * @return int
     */
    public function rejectActivity(int $id, string $reason): int
    {
        return $this->activity->newQuery()
            ->where(['id' => $id, 'status' => ActivityStatusEnum::WAITING])
            ->update(['status' => ActivityStatusEnum::REJECTED, 'rejected_reason' => $reason]);
    }
}