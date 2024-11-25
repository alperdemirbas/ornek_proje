<?php

namespace Rezyon\TourismCompany\Repositories;

use Rezyon\TourismCompany\Enums\ActivityStatus;
use Rezyon\TourismCompany\Models\TourismCompanyActivity;

class TourismCompanyActivitiesRepository
{
    public function __construct(
        public TourismCompanyActivity $activity
    )
    {

    }

    public function getActivities(int $companyId)
    {
        return $this->activity->newQuery()->with('activity')->where('companies_id', $companyId)->get();
    }

    public function store(  array  $array )
    {
        return $this->activity->newQuery()->create( $array );
    }

    public function update(int $id, int $profitability)
    {
        return $this->activity->newQuery()
            ->where('id', $id)
            ->update([
                'profitability' => $profitability
            ]);
    }

    public function findByCompany( int $userId )
    {
        return $this->activity->newQuery()
            ->where('companies_id', $userId )
            ->get();
    }

    public function detail(int $id)
    {
        return $this->activity->where('id', $id)->with(
            'company',
            'activity'
        )->first();

    }

    public function waitingApproval(int $userId)
    {
        return $this->activity->newQuery()
            ->where('status', ActivityStatus::WAITING_APPROVE )
            ->where('companies_id', $userId )
            ->get();
    }

    public function poolPendingApprove(int $id)
    {
        return $this->activity->newQuery()
            ->where('id', $id)
            ->update(['status' => ActivityStatus::ACTIVE]);
    }

    public function poolPendingReject(int $id)
    {
        return $this->activity->newQuery()
            ->where('id', $id)
            ->update(['status' => ActivityStatus::PASSIVE]);
    }

    public function activityPoolList(int $companyId)
    {
         return $this->activity->newQuery()
             ->where([
                 'companies_id' => $companyId,
                 'status' => ActivityStatus::ACTIVE
             ])
             ->with([
                 'activity' => function ($query) {
                     $query->with('images');
                     $query->with('address.street.neighborhood.district.city');
                     $query->with('participants.user:id,firstname,lastname');
                     $query->with('extras');
                     $query->with('closedDays');
                     $query->with('privateDays');
                     $query->with('rules');
                     $query->with('prices');
                     $query->with('sessions');
                     $query->with('category.categoryType');
                },
            ])
            ->get();
    }

    public function delete(int $id)
    {
        return $this->activity->newQuery()->where('id', $id)->delete();
    }

    public function disable(int $id)
    {
        return $this->activity->newQuery()->where('id', $id)->update([
            'status' => ActivityStatus::PASSIVE
        ]);
    }

    public function enable(int $id)
    {
        return $this->activity->newQuery()->where('id', $id)->update([
            'status' => ActivityStatus::ACTIVE
        ]);
    }

}