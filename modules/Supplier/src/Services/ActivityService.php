<?php

namespace Rezyon\Supplier\Services;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Rezyon\Supplier\Activity;
use Rezyon\Supplier\Enums\Days;
use Rezyon\Supplier\Models\Activity as ActivityModel;
use Rezyon\Supplier\Models\ActivityClosedDay;
use Rezyon\Supplier\Models\ActivityPrivateDays;
use Rezyon\Supplier\Price;
use Rezyon\Supplier\PriceRule;
use Rezyon\Supplier\Repositories\ActivityCancellationConditionsRepository;
use Rezyon\Supplier\Repositories\ActivityCategoriesRepository;
use Rezyon\Supplier\Repositories\ActivityClosedDaysRepository;
use Rezyon\Supplier\Repositories\ActivityExtrasRepository;
use Rezyon\Supplier\Repositories\ActivityParticipantsRepository;
use Rezyon\Supplier\Repositories\ActivityPrivateDaysRepository;
use Rezyon\Supplier\Repositories\ActivityPhotosRepository;
use Rezyon\Supplier\Repositories\ActivityPriceRuleRepository;
use Rezyon\Supplier\Repositories\ActivityPricesRepository;
use Rezyon\Supplier\Repositories\ActivityRepository;
use Rezyon\Supplier\Repositories\ActivitySessionRepository;
use Rezyon\Supplier\Session;

class ActivityService
{
    public function __construct(
        public ActivityRepository                       $activityRepository,
        public ActivityPriceRuleRepository              $activityPriceRuleRepository,
        public ActivitySessionRepository                $activitySessionRepository,
        public ActivityPricesRepository                 $activityPricesRepository,
        public ActivityPhotosRepository                 $activityPhotosRepository,
        public ActivityCategoriesRepository             $activityCategoriesRepository,
        public ActivityCancellationConditionsRepository $activityCancellationRuleRepository,
        public ActivityExtrasRepository                 $activityExtrasRepository,
        public ActivityPrivateDaysRepository            $activityPrivateDaysRepository,
        public ActivityClosedDaysRepository             $activityClosedDaysRepository,
        public ActivityParticipantsRepository           $activityParticipants,
    )
    {

    }

    public function list()
    {
        return $this->activityRepository->list();
    }

    public function getActivitySessions(int $activityId)
    {
        return $this->activitySessionRepository->getActivitySessions($activityId);
    }

    public function find(int $id)
    {
        return $this->activityRepository->find($id);
    }

    public function setParticipants(int $userId, int $activityId)
    {
        return $this->activityParticipants->create([
            'users_id' => $userId,
            'activity_id' => $activityId
        ]);
    }

    public function listWithoutIds(array $ids, array $filters = null)
    {
        return $this->activityRepository->listWithoutIds($ids, $filters);
    }

    public function setPriceRule(ActivityModel $activity, PriceRule $priceRule)
    {
        $data = [
            'activity_id' => $activity->id,
            'rule' => $priceRule->getPriceRules(),
            'gender' => $priceRule->getPriceRuleGenders(),
            'age' => $priceRule->getAge(),
            'operator' => $priceRule->getPriceRuleOperators(),
            'start_date' => $priceRule->getStartDate(),
            'end_date' => $priceRule->getEndDate(),

        ];
        return $this->activityPriceRuleRepository->store($data);
    }

    public function store(Activity $activity)
    {
        $data = [
            'companies_id' => $activity->getCompaniesId(),
            'activity_category_id' => $activity->getActivityID(),
            'name' => $activity->getName(),
            'currency' => $activity->getCurrency(),
            'description' => $activity->getDescription(),
            'start_time' => $activity->getStartTime(),
            'end_time' => $activity->getEndTime(),
            'duration' => $activity->getDuration(),
        ];
        return $this->activityRepository->store($data);
    }

    public function setSession(ActivityModel $activity, Session $session)
    {
        $data = [
            'activity_id' => $activity->id,
            'start_time' => $session->getStartTime(),
            'end_time' => $session->getEndTime(),
            'capacity' => $session->getCapacity(),

        ];
        if (!empty($session->getDays())) {
            foreach ($session->getDays() as $day) {
                $data['day'] = Days::valueFromString($day);
                $this->activitySessionRepository->store($data);
            }
        } else {
            $this->activitySessionRepository->store($data);
        }
    }

    public function setPrice(ActivityModel $activity, Price $price)
    {
        $data = [
            'activity_id' => $activity->id,
            'type' => $price->getPriceTypes(),
            'price' => $price->getPrice(),
        ];
        $this->activityPricesRepository->store($data);
    }

    public function getCategories(?int $categoriesTypeId = null)
    {
        if (empty($categoriesTypeId)) {
            return $this->activityCategoriesRepository->list();
        }
        return $this->activityCategoriesRepository->listFromId($categoriesTypeId);
    }

    public function getCategoryTypes()
    {
        return $this->activityCategoriesRepository->types();
    }

    public function attachPhoto(UploadedFile $uploadedFile,int $activityId)
    {
        $imagePath = $uploadedFile->store('activity-files', 's3');
        return $this->activityPhotosRepository->store([
            'activity_id' => $activityId,
            'path' => $imagePath
        ]);
    }

    public function viewIncreaseInObserver(int $id, int $lastView = 0)
    {
        $count = $lastView+1;
        $this->activityRepository->update($id, ['views' => $count]);
    }

    /**
     * @param int $id
     * @return Model|Builder|null
     * Admin tarafından onay beklenilen aktiviteleri listeler.
     */
    public function getWaitingActivity(int $id): Model|Builder|null
    {
        return $this->activityRepository->getWaitingActivity($id);
    }

    /**
     * @param int $id
     * @return int|null
     * Admin tarafından onay beklenilen aktiviteyi onaylar.
     */
    public function confirmActivity(int $id): ?int
    {
        return $this->activityRepository->confirmActivity($id);
    }

    /**
     * @param int $id
     * @param string $reason
     * @return int|null
     * Admin tarafından onay beklenilen aktiviteyi reddeder.
     */
    public function rejectActivity(int $id, string $reason): ?int
    {
        return $this->activityRepository->rejectActivity($id, $reason);
    }

    public function addCancellationRule(array $data)
    {
        return $this->activityCancellationRuleRepository->create($data);
    }

    public function addExtra(array $data)
    {
        return $this->activityExtrasRepository->create($data);
    }

    public function setPrivateDays(ActivityModel $activity, Carbon $startDate, Carbon $endDate, bool $isClosed = false)
    {
        $this->activityPrivateDaysRepository->create([
            'activity_id' => $activity->id,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'is_closed' => $isClosed,
        ]);
    }

    public function setClosedDays(ActivityModel $activity, int $day)
    {
        $this->activityClosedDaysRepository->create([
            'activity_id' => $activity->id,
            'day' => $day,
        ]);
    }

}