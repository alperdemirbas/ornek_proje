<?php

namespace Rezyon\Applications\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Rezyon\Applications\Users\DataTables\UsersDataTable;
use Rezyon\Applications\Users\Http\Requests\UserShowRequest;
use Rezyon\Users\Models\Users;
use Rezyon\Users\UserService;

class AdminUsersController extends Controller
{
    public function listView(UsersDataTable $dataTable)
    {
        $this->authorize('list',Users::class);
        return $dataTable->render('applications.users::list',
            [
                'mainPage' => trans('general.dashboard'),
                'subPage' => trans('company.list_text'),
                'title' => trans('company.list_text'),
                'modals' => []
            ]
        );
    }

    public function dataTableList(Request $request,UsersDataTable $dataTable,Users $model)
    {
        $this->authorize('list',Users::class);
        if ($request->ajax()){
            return $dataTable->dataTable($dataTable->query($model))->toArray();
        }
        return [];
    }


    public function show(UserShowRequest $request,UserService $service)
    {
        $this->authorize('show',Users::class);
        $user = $service->findByAdmin($request->input('id'));
        return view('applications.users::show',
            [
                'mainPage' => trans('general.dashboard'),
                'subPage' => trans('user.list'),
                'title' => trans('user.list'),
                'modals' => [],
                'data' => $user,
                'has_permissions' => $user->getAllPermissions(),
                'permissions'=>config('permissions')
            ]
        );
    }

    public function permissionsUpdate()
    {

    }
}
