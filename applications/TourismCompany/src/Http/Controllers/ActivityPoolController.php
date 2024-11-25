<?php

namespace Rezyon\Applications\TourismCompany\Http\Controllers;

use App\Http\Controllers\Controller;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Rezyon\Applications\PaymentManagement\Http\Requests\ActivityPoolUpdateRequest;
use Rezyon\Applications\Supplier\DataTables\ActivityListDataTable;
use Rezyon\Applications\TourismCompany\DataTables\ActivityPoolDataTable;
use Rezyon\Applications\TourismCompany\Http\Requests\ActivityPoolListRequest;
use Rezyon\Applications\TourismCompany\Http\Requests\ActivityPoolStoreRequest;
use Rezyon\Applications\TourismCompany\Http\Requests\DeleteSpecialDayRequest;
use Rezyon\Applications\TourismCompany\Http\Requests\TourismActivityAddCloseDayRequest;
use Rezyon\Applications\TourismCompany\Http\Requests\TourismActivityDeleteCloseDayRequest;
use Rezyon\Applications\TourismCompany\Http\Requests\TourismActivityRemoveFromPoolRequest;
use Rezyon\Supplier\Models\Activity;
use Rezyon\Supplier\Services\ActivityService;
use Rezyon\TourismCompany\Enums\ActivityStatus;
use Rezyon\TourismCompany\Models\TourismCompanyActivity;
use Rezyon\TourismCompany\TourismCompanyService;


/**
 *
 */
class ActivityPoolController extends Controller
{

    public function __construct(
        public TourismCompanyService $service
    )
    {
    }

    /**
     * @param ActivityPoolListRequest $request
     * @return \Illuminate\Foundation\Application|View|Factory|Application
     * @throws AuthorizationException
     */
    public function list(
        ActivityPoolListRequest $request,
        ActivityService $service,
    ): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $this->authorize('list', TourismCompanyActivity::class);
        $categories = $service->getCategories();
        $filters = [];
        if($request->get('min_price')) {
            $filters['min_price'] = $request->get('min_price');
        }
        if($request->get('max_price')) {
            $filters['max_price'] = $request->get('max_price');
        }
        return view('applications.tourism::pool', [
            'mainPage' => __('activity.list'),
            'subPage' => __('activity.list'),
            'title' => __('activity.list'),
            'modals' => [],
            'filters' => $request->all(),
            'categories' => $categories,
            'activities' => $this->service->pool($request->user(), $filters),
        ]);
    }

    /**
     * @param ActivityPoolDataTable $dataTable
     * @return mixed
     * @throws AuthorizationException
     */
    public function pool(
        ActivityPoolDataTable $dataTable
    ): mixed
    {
        $this->authorize('list', TourismCompanyActivity::class);
        return $dataTable->render('applications.tourism::list', [
            'mainPage' => __('activity.list'),
            'subPage' => __('activity.list'),
            'title' => __('activity.list'),
            'modals' => [
                [
                    'targetId' => 'editPool',
                    'title' => __('activity.edit.pool.title'),
                    'contentView' => 'applications.tourism::modals.edit-pool',
                ],
                [
                    'targetId' => 'closedDays',
                    'title' => __('activity.edit.closed.days'),
                    'contentView' => 'applications.tourism::modals.closed-days',
                    'footerView' => 'applications.tourism::modals.closed-days-footer',
                    'form' => [
                        'id' => 'editClosedDays'
                    ]
                ]
            ],
            'statuses' => ActivityStatus::cases()
        ]);
    }

    public function datatablesPoolList(
        Request                $request,
        ActivityPoolDataTable  $dataTable,
        TourismCompanyActivity $model
    ): array
    {
        $this->authorize('list', TourismCompanyActivity::class);
        if ($request->ajax()) {
            return $dataTable->dataTable($dataTable->query($model))->toArray();
        }

        return [];
    }


    public function store(ActivityPoolStoreRequest $request)
    {
        $this->authorize('store', TourismCompanyActivity::class);
        $this->service->attachActivity($request->user()->company->id, $request->route('id') , $request->input('profit_rate'));
        return redirect()->route('tourism.activity.pool', ['subdomain' => $request->user()->company->domain])->with(['status' => 'success', 'message' => trans('activity.add.pool.success.text')]);
    }

    /**
     * @param Request $request
     * @param TourismCompanyService $service
     * @return JsonResponse
     */
    public function detail(Request $request, TourismCompanyService $service)
    {
        $this->authorize('show', TourismCompanyActivity::class);
        $id = $request->route('id');
        $detail = $service->activityDetail($id);
        return response()->json($detail);
    }

    public function update(ActivityPoolUpdateRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->service->updateActivityPool($request->input('id'), $request->input('profitability'));
            if($request->has('special_days')) {
                foreach($request->input('special_days') as $specialDay) {
                    $this->service->addSpecialDay($request->user()->company->id, $specialDay);
                }
            }
            DB::commit();
            return response()->json(['status' => 'success', 'message' => trans('general.request_success')]);
        } catch (Exception $e) {
            DB::rollBack();
            \Illuminate\Support\Facades\Log::error('approve',[ 'message' => $e->getMessage()]);
            return response()->json(['status' => 'error', 'message' => trans('general.error_occured')], 400);
        }
    }

    public function deleteSpecialDay(DeleteSpecialDayRequest $request)
    {
        return $this->service->deleteSpecialDay($request->input('id'));
    }

    public function addClosedDay(TourismActivityAddCloseDayRequest $request)
    {
        if($request->has('closed_days')) {
            foreach($request->input('closed_days') as $closedDay) {
                $this->service->addClosedDay($closedDay);
            }
        }
        return response()->json(['status' => 'success', 'message' => trans('general.request_success')]);
    }

    public function deleteClosedDay(TourismActivityDeleteCloseDayRequest $request)
    {
        return $this->service->deleteClosedDay($request->input('id'));
    }

    public function destroy(TourismActivityRemoveFromPoolRequest $request)
    {
        return $this->service->removeFromPool($request->input('id'));
    }

    public function disable(TourismActivityRemoveFromPoolRequest $request)
    {
        return $this->service->disableFromPool($request->input('id'));
    }

    public function enable(TourismActivityRemoveFromPoolRequest $request)
    {
        return $this->service->enableFromPool($request->input('id'));
    }
}