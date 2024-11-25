<?php

namespace Rezyon\Applications\Supplier\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Rezyon\Applications\Supplier\DataTables\ActivitiesPendingApprovalDataTable;
use Rezyon\Applications\Supplier\Http\Requests\ActivitiesPendingConfirmRequest;
use Rezyon\Applications\Supplier\Http\Requests\ActivitiesPendingDetailRequest;
use Rezyon\Applications\Supplier\Http\Requests\ActivitiesPendingRejectRequest;
use Rezyon\Applications\Supplier\Http\Requests\ActivitiesPendingShowRequest;
use Rezyon\Supplier\Services\ActivityService;

class ActivitiesPendingApproval extends Controller
{
    /**
     * @param ActivitiesPendingApprovalDataTable $dataTable
     * @return mixed
     */
    public function index(ActivitiesPendingApprovalDataTable $dataTable): mixed
    {
        return $dataTable->render('applications.supplier::pending-approve.list', [
            'mainPage' => __('activity.list'),
            'subPage' => __('activity.list'),
            'title' => __('activity.list'),
            'modals' => []
        ]);
    }

    /**
     * @param ActivitiesPendingShowRequest $request
     * @param ActivityService $service
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function show(
        ActivitiesPendingShowRequest $request,
        ActivityService $service
    ): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('applications.supplier::pending-approve.show', [
            'mainPage' => __('activity.list'),
            'subPage' => __('activity.list'),
            'title' => __('activity.list'),
            'modals' => [],
            'activity' => $service->getWaitingActivity($request->route('id'))
        ]);
    }

    /**
     * @param ActivitiesPendingDetailRequest $request
     * @param ActivityService $service
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function detail(
        ActivitiesPendingDetailRequest $request,
        ActivityService $service
    ): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('applications.supplier::pending-approve.detail', [
            'mainPage' => __('activity.list'),
            'subPage' => __('activity.list'),
            'title' => __('activity.list'),
            'modals' => [
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
            ],
            'activity' => $service->find($request->route('id'))
        ]);
    }

    /**
     * @param ActivitiesPendingConfirmRequest $request
     * @param ActivityService $service
     * @return int|null
     */
    public function confirm(
        ActivitiesPendingConfirmRequest $request,
        ActivityService $service
    ): ?int
    {
        return $service->confirmActivity($request->route('id'));
    }

    /**
     * @param ActivitiesPendingRejectRequest $request
     * @param ActivityService $service
     * @return int|null
     */
    public function reject(
        ActivitiesPendingRejectRequest $request,
        ActivityService $service
    ): ?int
    {
        return $service->rejectActivity($request->route('id'), $request->input('rejected_reason'));
    }
}