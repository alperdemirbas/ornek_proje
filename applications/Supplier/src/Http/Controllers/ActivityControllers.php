<?php

namespace Rezyon\Applications\Supplier\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Rezyon\Applications\Supplier\DataTables\ActivityListDataTable;
use Rezyon\Applications\Supplier\DataTables\PoolPendingDataTable;
use Rezyon\Applications\Supplier\Http\Requests\ActivityPoolPendingApproveRequest;
use Rezyon\Applications\Supplier\Http\Requests\ActivityPoolPendingRejectRequest;
use Rezyon\Applications\Supplier\Http\Requests\ActivitySessionsRequest;
use Rezyon\Applications\Supplier\Http\Requests\ActivityShowRequest;
use Rezyon\Applications\Supplier\Http\Requests\ActivityStoreRequest;
use Rezyon\Applications\Supplier\Http\Requests\PoolPendingShowRequest;
use Rezyon\Companies\Enums\CompanyTypeEnums;
use Rezyon\Locations\Location;
use Rezyon\Locations\Services\ActivityAddressService;
use Rezyon\PaymentManagement\Services\Paytr\Enums\CurrencyEnums;
use Rezyon\Supplier\Activity;
use Rezyon\Supplier\Enums\ActivityExtraTypeEnum;
use Rezyon\Supplier\Enums\PriceCurrency;
use Rezyon\Supplier\Enums\PriceRuleGenders;
use Rezyon\Supplier\Enums\PriceRuleOperators;
use Rezyon\Supplier\Enums\PriceRules;
use Rezyon\Supplier\Enums\PriceTypes;
use Rezyon\Supplier\Models\Activity as ActivityModel;
use Rezyon\Supplier\Price;
use Rezyon\Supplier\PriceRule;
use Rezyon\Supplier\Services\ActivityService;
use Rezyon\Supplier\Session;
use Rezyon\TourismCompany\Models\TourismCompanyActivity;
use Rezyon\TourismCompany\TourismCompanyService;

class ActivityControllers extends Controller
{
    public function __construct(
        public ActivityService $service
    )
    {

    }

    public function getActivitySessions(
        ActivitySessionsRequest $request
    )
    {
        return response()->json($this->service->getActivitySessions($request->input('activity_id')));
    }

    public function getCategories(Request $request)
    {
        return response()->json($this->service->getCategories($request->get('id')));
    }

    public function index()
    {
        $this->authorize('store', \Rezyon\Supplier\Models\Activity::class);
        $categoryTypes = $this->service->getCategoryTypes();

        return view('applications.supplier::add',
            [
                'modals' => [
                    /*[
                        'targetId' => 'activitySessions',
                        'title' => __('activity.sessions.title'),
                        'contentView' => 'applications.supplier::modals.activity-sessions',
                    ],*/
                ],
                //@todo supported language enum'u eklenecek
                'categoryTypes' => $categoryTypes,
                'lang' => [
                    [
                        'code' => 'tr',
                        "name" => "Türkçe"
                    ],
                    [
                        'code' => 'en',
                        "name" => "İngilizce"
                    ]
                ],
                'currencies' => CurrencyEnums::cases(),
            ]
        );
    }

    public function datatablesList(
        Request $request,
        ActivityListDataTable $dataTable,
        ActivityModel $activityModel
    ): array
    {
        $this->authorize('list', \Rezyon\Supplier\Models\Activity::class);

        if($request->ajax()) {
            return $dataTable->dataTable($dataTable->query($activityModel))->toArray();
        }

        return [];
    }

    public function show(ActivityShowRequest $request)
    {
        $modals = [
            [
                'targetId' => 'activitySessions',
                'title' => __('activity.sessions.title'),
                'contentView' => 'applications.supplier::modals.activity-sessions',
            ],
            [
                'targetId' => 'activityRules',
                'title' => __('activity.rules.title'),
                'contentView' => 'applications.supplier::modals.activity-rules',
            ],
            [
                'targetId' => 'reviews',
                'title' => __('activity.reviews.title'),
                'contentView' => 'applications.supplier::modals.reviews',
            ],
        ];

        if(Auth::user()->company->type === CompanyTypeEnums::TOURISM_COMPANY) {
            $modals[] = [
                'targetId' => 'addToPool',
                'title' => __('activity.add.to.pool'),
                'contentView' => 'applications.supplier::modals.add-pool',
                'footerView' => 'applications.supplier::modals.add-pool-footer',
                'form' => [
                    'action' => _route('tourism.activity.store', ['id' => $request->route('id')]),
                    'method' => 'post',
                    'media' => false
                ]
            ];
        }

        return view('applications.supplier::show', [
            'mainPage' => __('activity.list'),
            'subPage' => __('activity.list'),
            'title' => __('activity.list'),
            'modals' => $modals,
            'activity' => $this->service->find($request->input('id'))
        ]);
    }

    public function list(ActivityListDataTable $dataTable)
    {
        $this->authorize('list', \Rezyon\Supplier\Models\Activity::class);
        return $dataTable->render('applications.supplier::list', [
            'mainPage' => __('activity.list'),
            'subPage' => __('activity.list'),
            'title' => __('activity.list'),
            'modals' => []
        ]);
    }

    public function store(
        ActivityStoreRequest $request,
        ActivityAddressService $activityAddressService,
        Location $location
    )
    {

        try {
            DB::beginTransaction();

            $activity = new Activity();
            $activity->setCompaniesId( $request->user()->company->id );
            $activity->setActivityID($request->post('activity_category_id'));
            $activity->setName($request->post('name'));
            $activity->setDescription($request->post('description'));
            $currency = PriceCurrency::valueFromString($request->post('price_currency'));
            $activity->setCurrency( $currency );

            if ($request->exists('start_time')) {
                $start = Carbon::parse($request->post('start_time'));
                $end = Carbon::parse($request->post('end_time'));
                $activity->setStartTime($start);
                $activity->setEndTime($end);
            }

            if ($request->exists('duration')) {
                $hours = $request->input('duration.hours');
                $minutes = $request->input('duration.minutes');
                $activity->setDuration(($hours * 60) + $minutes);
            }

            $activityResult = $this->service->store($activity);

            if($request->exists('cancellation_rules')) {
                foreach($request->input('cancellation_rules') as $cancellationRule) {
                    $this->service->addCancellationRule([
                        'activity_id' => $activityResult->id,
                        'hour' => $cancellationRule['hour'],
                        'discount_rate' => $cancellationRule['discount_rate']
                    ]);
                }
            }

            if($request->exists('extras')) {
                foreach($request->input('extras') as $extra) {
                    switch ($extra['type']) {
                        case ActivityExtraTypeEnum::INCLUDE_PRICE->value:
                            $this->service->addExtra([
                                'activity_id' => $activityResult->id,
                                'key' => ActivityExtraTypeEnum::INCLUDE_PRICE,
                                'value' => $extra['description']
                            ]);
                            break;
                        case ActivityExtraTypeEnum::NOT_INCLUDE_PRICE->value:
                            $this->service->addExtra([
                                'activity_id' => $activityResult->id,
                                'key' => ActivityExtraTypeEnum::NOT_INCLUDE_PRICE,
                                'value' => $extra['description']
                            ]);
                            break;
                        case ActivityExtraTypeEnum::ADVICE->value:
                            $this->service->addExtra([
                                'activity_id' => $activityResult->id,
                                'key' => ActivityExtraTypeEnum::ADVICE,
                                'value' => $extra['description'],
                            ]);
                            break;
                    }
                }
            }

            if ($request->exists('sessions')) {
                foreach ($request->post('sessions') as $item) {
                    $session = new Session();
                    $session->setStartTime(Carbon::parse($item['start_time']));
                    $session->setEndTime(Carbon::parse($item['end_time']));
                    $session->setCapacity((int)$item['capacity']);
                    $session->setDays($item['days']);
                    $this->service->setSession($activityResult, $session);
                }
            }

            if ($request->exists('price_rules')) {
                foreach ($request->post('price_rules') as $item) {

                    $gender = PriceRuleGenders::valueFromString($item['gender']);
                    $rule = PriceRules::valueFromString($item['rule']);
                    $operator = PriceRuleOperators::valueFromString($item['operator']);

                    $priceRule = new PriceRule();
                    $priceRule->setPriceRules($rule);
                    $priceRule->setPriceRuleGenders($gender);
                    $priceRule->setAge((int)$item['age']);
                    $priceRule->setPriceRuleOperators($operator);

                    if (!empty($item['start_date'])) {
                        $priceRule->setStartDate(Carbon::parse($item['start_date']));
                        $priceRule->setEndDate(Carbon::parse($item['end_date']));
                    }
                    $this->service->setPriceRule($activityResult, $priceRule);

                }
            }

            if ($request->exists('closed_days')) {
                foreach ($request->post('closed_days') as $closedDay) {
                    $this->service->setClosedDays($activityResult, $closedDay);
                }
            }

            if ($request->exists('private_days')) {
                foreach ($request->post('private_days') as $privateDay) {
                    $startDate = Carbon::parse($privateDay['start_date']);
                    $endDate = Carbon::parse($privateDay['end_date']);
                    $this->service->setPrivateDays($activityResult, $startDate, $endDate, $privateDay['is_closed']);
                }
            }

            $types = data_get($request->post('price'),'*.type');
            if (!in_array(PriceTypes::ALL->value, $types)) {
                throw ValidationException::withMessages(['ALL prices required']);
            }
            foreach ($request->post('price') as $priceItem) {
                $priceType = PriceTypes::valueFromString($priceItem['type']);
                $price = new Price();
                $price->setPrice($priceItem['price']);
                $price->setPriceTypes($priceType);
                $this->service->setPrice($activityResult, $price);
            }

            if ($request->exists('files')) {
                foreach ($request->file('files') as $file) {
                    $this->service->attachPhoto($file, $activityResult->id);
                }
            }

            $location->setStreet($request->input('street'));
            $location->setDetail($request->input('detail'));
            $location->setDirections($request->input('directions'));
            $location->setLatitude($request->input('latitude'));
            $location->setLongitude($request->input('longitude'));

            $activityAddressService->create($activityResult,$location);

            DB::commit();
            return redirect()->back()->with(['status' => 'success', 'message' => 'Başarılı.']);
        } catch (ValidationException $validationException){
            DB::rollBack();
            return response()->json(['message'=> __('validation.required'),'errors'=>['all'=>[$validationException->getMessage()]]],422);
        }catch (Exception $exception) {
            DB::rollBack();
            return response()->json(["message"=>$exception->getMessage()],400);
        }
    }

    public function poolPending(PoolPendingDataTable $dataTable)
    {
        $this->authorize('supplier.activity.pool.pending.list', \Rezyon\Supplier\Models\Activity::class);

        return $dataTable->render('applications.supplier::pool.pending', [
            'mainPage' => __('activity.list'),
            'subPage' => __('activity.list'),
            'title' => __('activity.list'),
            'modals' => []
        ]);
    }

    public function poolPendingDataTable(
        Request $request,
        TourismCompanyActivity $model,
        PoolPendingDataTable $dataTable
    ): array
    {
        $this->authorize('supplier.activity.pool.pending.list', \Rezyon\Supplier\Models\Activity::class);

        if($request->ajax()) {
            return $dataTable->dataTable($dataTable->query($model))->toArray();
        }

        return [];
    }

    public function poolPendingShow(
        PoolPendingShowRequest $request,
        TourismCompanyService $service
    )
    {
        $this->authorize('supplier.activity.pool.pending.show', \Rezyon\Supplier\Models\Activity::class);
        return view('applications.supplier::pool.show', [
            'mainPage' => __('activity.list'),
            'subPage' => __('activity.list'),
            'title' => __('activity.list'),
            'modals' => [],
            'data' => $service->detail($request->route('id'))
        ]);
    }

    public function poolPendingApprove(
        ActivityPoolPendingApproveRequest $request,
        TourismCompanyService $service
    )
    {
        $status = $service->poolPendingApprove($request->input('id'));
        if(!$status) {
            return response()->json(['status' => 'error', 'message' => trans('general.error_occured')], 400);
        }
        return response()->json(['status' => 'success', 'message' => trans('general.success')]);
    }

    public function poolPendingReject(
        ActivityPoolPendingRejectRequest $request,
        TourismCompanyService $service
    )
    {
        $status = $service->poolPendingReject($request->input('id'));
        if(!$status) {
            return response()->json(['status' => 'error', 'message' => trans('general.error_occured')], 400);
        }
        return response()->json(['status' => 'success', 'message' => trans('general.success')]);
    }
}