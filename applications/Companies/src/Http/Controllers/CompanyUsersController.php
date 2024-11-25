<?php

namespace Rezyon\Applications\Companies\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Rezyon\Applications\Companies\Enums\CompanyPermissionsEnum;
use Rezyon\Applications\Companies\Http\Requests\CompanyUserEditRequest;
use Rezyon\Applications\Companies\Http\Requests\CompanyUserStoreRequest;
use Rezyon\Applications\Companies\Http\Requests\CompanyUserUpdateRequest;
use Rezyon\Applications\Companies\Requests\EndUserAStoreRequest;
use Rezyon\Applications\TourismCompany\Enums\PermissionsEnum;
use Rezyon\Companies\Interfaces\CompaniesServiceInterface;
use Rezyon\Companies\Models\Companies;
use Rezyon\Companies\User;
use Rezyon\TourismCompany\Enums\GroupStatus;
use Rezyon\TourismCompany\Enums\GroupTypes;
use Rezyon\TourismCompany\Enums\StatusType;
use Rezyon\TourismCompany\Enums\StatusTypes;
use Rezyon\Users\Enums\Gender;
use Rezyon\Users\Enums\Types;
use Rezyon\Users\Models\Users;

class CompanyUsersController extends Controller
{
    /**
     * @param Request $request
     * @param CompaniesServiceInterface $service
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     * @throws AuthorizationException
     */
    public function add(
        Request $request,
        CompaniesServiceInterface $service
    ): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $this->authorize('subUserStore', Companies::class);

        $permissions = null;
        $user = $request->user();
        if($user->type === Types::TOURISM_COMPANY) {
            if ($user->hasPermissionTo(PermissionsEnum::TOURISM_GIVE_PERMISSONS)) {
                $permissions = $service->getPermissions($request->user()->type);
            }
        } else {
            if ($user->hasPermissionTo(\Rezyon\Applications\Supplier\Enums\PermissionsEnum::SUPPLIER_GIVE_PERMISSONS)) {
                $permissions = $service->getPermissions($request->user()->type);
            }
        }

        return view('applications.companies::company-users.add', [
            'modals' => [],
            'permissions' => $permissions,
        ]);
    }

    /**
     * @param CompanyUserStoreRequest $request
     * @param CompaniesServiceInterface $service
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws AuthorizationException
     */
    public function store(
        CompanyUserStoreRequest $request,
        CompaniesServiceInterface $service,
        User $user
    ): \Illuminate\Http\RedirectResponse
    {
        $this->authorize('subUserStore', Companies::class);

        $user->setEmail($request->post('email'));
        $user->setFirstname($request->post('firstname'));
        $user->setLastname($request->post('lastname'));
        $user->setPassword(Hash::make('password'));
        $user->setType($request->user()->type);
        $user->setCompanies($request->user()->company);
        $newUser = $service->attachUser($user);
        if($request->input('permissions') !== null) {
            $service->userSyncPermissions($newUser, $request->input('permissions'));
        }
        return redirect()->back()->with(['success' => trans('general.success')]);
    }

    /**
     * @param CompanyUserEditRequest $request
     * @param CompaniesServiceInterface $service
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     * @throws AuthorizationException
     */
    public function edit(
        CompanyUserEditRequest $request,
        CompaniesServiceInterface $service
    ): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $this->authorize('subUserUpdate', Companies::class);

        $permissions = null;
        $user = $request->user();
        if($user->type === Types::TOURISM_COMPANY) {
            if ($user->hasPermissionTo(PermissionsEnum::TOURISM_GIVE_PERMISSONS)) {
                $permissions = $service->getPermissions($request->user()->type);
            }
        } else {
            if ($user->hasPermissionTo(\Rezyon\Applications\Supplier\Enums\PermissionsEnum::SUPPLIER_GIVE_PERMISSONS)) {
                $permissions = $service->getPermissions($request->user()->type);
            }
        }

        return view('applications.companies::company-users.edit', [
            'modals' => [],
            'permissions' => $permissions,
            'user' => $service->findUser($request->input('id')),
        ]);
    }

    /**
     * @param CompanyUserUpdateRequest $request
     * @param CompaniesServiceInterface $service
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(
        CompanyUserUpdateRequest $request,
        CompaniesServiceInterface $service
    ): JsonResponse
    {
        $this->authorize('subUserUpdate', Companies::class);

        $user = $service->findUser($request->input('id'));
        if($request->input('permissions') !== null) {
            $service->userSyncPermissions($user, $request->input('permissions'));
        }
        $service->updateUser($request->input('id'), [
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email')
        ]);
        return response()->json(['status' => 'success']);
    }

    public function customerViewList()
    {
        // TODO : DataTable ile bu firmaya bağlı olan tüm yolcuları çek
        return "datatable eklenecek";
    }

    public function customerViewAdd(CompaniesServiceInterface $service)
    {
        $company = Auth::user()->companies_id;
        $Groups = $service->groupList($company);

        return view('applications.companies::customers.add', [
            'mainPage' => __('sidebar.customers'),
            'subPage' => __('sidebar.customer_add'),
            'title' => __('sidebar.customer_add'),
            'data' => [
                "gender"=>Gender::cases(),
                "groups" => $Groups,
                "groupType"=>GroupTypes::cases(),
                "GroupStatus"=>GroupStatus::cases(),
                'statusType' => StatusTypes::cases(),
            ],
            'modals' => []
        ]);
    }

    public function customerStore(
        CompaniesServiceInterface $service,
        EndUserAStoreRequest $request,
        User $customer
    )
    {
        $customers = $request->post();

        unset($customers['user']['_token']);
        $customers = $customers['user'];
        $formattedData = [];
        for ($i = 0; $i < count($customers[array_keys($customers)[0]]); $i++) {
            foreach (array_keys($customers) as $item => $values) {
                foreach ($customers[$values] as $index => $value) {
                    $formattedData[$i][$values] = $customers[$values][$i];
                }
            }
        }
        foreach ($formattedData as $index => $value){
            $customer->setEmail($value['email']);
            $customer->setFirstname($value['first_name']);
            $customer->setLastname($value['last_name']);
            $customer->setGender($value['gender']);
            $customer->setBirthdate($value['birthdate']);
            $customer->setType(Types::CUSTOMER);
            $customer->setCompanies($request->user()->company);
            $customer->setPnr(generateUniqueCode(Users::class));
            $user = $service->attachUser($customer);
            $service->userInfoStore($user->id, $customer);

            //tourism_company_group_users tablosuna
            $groups = [
                'users_id'=>$user->id,
                'tourism_company_group_id'=>intval($value['group']),
                'sub_group_id'=>'', // nullable
                'type'=> $value['group_type'],
                'status'=> $value['status'],
                'arrival_date'=>$value['customer_arrival_date'],
                'date_of_return'=>$value['customer_return_date']
            ];
            $service->groupUserCreate($groups);
        }
        return redirect()->back();
        //return response()->json(['status' => 'success']);
    }

    public function customerViewEdit()
    {
        return view('applications.companies::customers.add', [
            'modals' => [],
            'permissions' => [],
        ]);
    }
}