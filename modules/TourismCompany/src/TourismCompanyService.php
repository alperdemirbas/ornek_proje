<?php

namespace Rezyon\TourismCompany;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Rezyon\Applications\TourismCompany\Http\Resources\ActivityPoolListCollection;
use Rezyon\Applications\TourismCompany\Http\Resources\ActivityPoolListResource;
use Rezyon\Companies\Models\Users;
use Rezyon\Supplier\Services\ActivityService;
use Rezyon\TourismCompany\Repositories\TourismCompanyActivitiesRepository;
use Rezyon\TourismCompany\Repositories\TourismCompanyActivitySpecialDayRepository;
use Rezyon\TourismCompany\Repositories\TourismCompanyClosedDayRepository;

/**
 *
 */
class TourismCompanyService
{
    /**
     * @param ActivityService $service
     * @param TourismCompanyActivitiesRepository $repository
     */
    public function __construct(
        public ActivityService                    $service,
        public TourismCompanyActivitiesRepository $repository,
        public TourismCompanyClosedDayRepository  $closedDayRepository,
        public TourismCompanyActivitySpecialDayRepository $specialDayRepository
    )
    {

    }

    /**
     * @param $userId
     * @param $activityId
     * @param $profitability
     * @return Builder|Model
     */
    public function attachActivity($userId , $activityId , $profitability): Model|Builder
    {
        return $this->repository->store([
            'profitability' => $profitability,
            'activity_id' => $activityId,
            'companies_id' => $userId
        ]);
    }

    public function getActivities(int $companyId)
    {
        return $this->repository->getActivities($companyId);
    }

    /**
     * @param int $id
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function activityDetail(int $id)
    {
        return $this->service->find($id);
    }


    /**
     * @param Users $users
     * @param array|null $filters
     * @return Builder[]|Collection
     */
    public function pool(Users $users, array $filters = null)
    {
        $idsSql = $this->repository->findByCompany($users->id);
        $ids = data_get($idsSql, '*.activity_id');
        return $this->service->listWithoutIds($ids, $filters);
    }

    public function detail(int $id)
    {
        return $this->repository->detail($id);
    }

    public function poolPendingApprove(int $id)
    {
        return $this->repository->poolPendingApprove($id);
    }

    public function poolPendingReject(int $id)
    {
        return $this->repository->poolPendingReject($id);
    }

    public function activityPoolList(int $companyId)
    {
        return new ActivityPoolListResource($this->repository->activityPoolList($companyId));
    }

    public function updateActivityPool(int $id, int $profitability)
    {
        return $this->repository->update($id, $profitability);
    }

    public function addSpecialDay(int $companyId, array $data)
    {
        return $this->specialDayRepository->create($companyId, $data);
    }

    public function deleteSpecialDay(int $id)
    {
        return $this->specialDayRepository->delete($id);
    }

    public function addClosedDay(array $data)
    {
        return $this->closedDayRepository->create($data);
    }

    public function deleteClosedDay(int $id)
    {
        return $this->closedDayRepository->delete($id);
    }

    public function removeFromPool(int $id)
    {
        return $this->repository->delete($id);
    }

    public function disableFromPool(int $id)
    {
        return $this->repository->disable($id);
    }

    public function enableFromPool(int $id)
    {
        return $this->repository->enable($id);
    }
}