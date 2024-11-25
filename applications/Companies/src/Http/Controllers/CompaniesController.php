<?php

namespace Rezyon\Applications\Companies\Http\Controllers;

use App\Http\Controllers\Controller;
use AWS\CRT\Log;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Rezyon\Applications\Companies\DataTables\CompaniesDataTable;
use Rezyon\Applications\Companies\DataTables\CompanyDetails\CompanyActivitiesDataTable;
use Rezyon\Applications\Companies\DataTables\CompanyDetails\CompanyActivityPoolDataTable;
use Rezyon\Applications\Companies\DataTables\CompanyDetails\CompanyCustomersDataTable;
use Rezyon\Applications\Companies\DataTables\CompanyDetails\CompanyOfficialsDataTable;
use Rezyon\Applications\Companies\DataTables\CompanyDetails\CompanyPackagesDataTable;
use Rezyon\Applications\Companies\DataTables\CompanyDetails\CompanySupplierCustomersDataTable;
use Rezyon\Applications\Companies\DataTables\CompanyDetails\CompanyUsersDataTable;
use Rezyon\Applications\Companies\DataTables\OfficalsDataTable;
use Rezyon\Applications\Companies\DataTables\WaitingApprovalsDataTable;
use Rezyon\Applications\Companies\Http\Requests\CompaniesApproveRequest;
use Rezyon\Applications\Companies\Http\Requests\CompaniesDemoCreateRequest;
use Rezyon\Applications\Companies\Http\Requests\CompanyAttachUserRequest;
use Rezyon\Applications\Companies\Http\Requests\CompanyDemoEditRequest;
use Rezyon\Applications\Companies\Http\Requests\CompanyDemoShowRequest;
use Rezyon\Applications\Companies\Http\Requests\CompanyUpdateRequest;
use Rezyon\Applications\Companies\Http\Requests\CompanyShowRequest;
use Rezyon\Applications\Companies\Http\Requests\WaitingCompanyUpdateRequest;
use Rezyon\Applications\Companies\Http\Requests\CompanyEditRequest;
use Rezyon\Applications\TourismCompany\DataTables\ActivityPoolDataTable;
use Rezyon\Companies\CompaniesService;
use Rezyon\Companies\CompanyFiles;
use Rezyon\Companies\Enums\CompanyTypeEnums;
use Rezyon\Companies\Enums\PaymentFrequencyEnums;
use Rezyon\Companies\Enums\PaymentStatusesEnums;
use Rezyon\Companies\Interfaces\CompaniesRepositoryInterface;
use Rezyon\Companies\Interfaces\CompanyFilesInterface;
use Rezyon\Companies\Interfaces\CompanyInterface;
use Rezyon\Companies\Interfaces\CompanyOfficialsInterface;
use Rezyon\Companies\Interfaces\CompanyPackageInterface;
use Rezyon\Companies\Interfaces\CompanyPackageServiceInterface;
use Rezyon\Companies\Models\Companies;
use Rezyon\Companies\Models\CompaniesPackages;
use Rezyon\Companies\Models\CompanyOfficials;
use Rezyon\Companies\Models\Users;
use Rezyon\Companies\User;
use Rezyon\Packages\Interfaces\PackagesServiceInterface;
use Rezyon\Supplier\Models\Activity;
use Rezyon\TourismCompany\Models\TourismCompanyActivity;
use Rezyon\Users\Enums\Types;

class CompaniesController extends Controller
{
    public function __construct(
        public CompaniesService               $service,
        public PackagesServiceInterface       $packagesService,
        public CompanyPackageServiceInterface $companyPackageService,
        public CompanyFilesInterface          $companyFiles,
        public CompanyOfficialsInterface      $companyOfficials,
        public CompanyInterface               $company,
        public CompanyPackageInterface        $companyPackage,
        public CompaniesRepositoryInterface   $repository,
    )
    {
    }

    public function approve(
        CompaniesApproveRequest $request,
        User $user
    ): JsonResponse
    {
        $this->authorize('approve', Companies::class);
        try {
            $domain = $request->post('domain');
            $date = Carbon::now()->startOfDay();
            $company = $this->repository->findWithOfficials($request->post('company_id'));
            $this->company->setVerifyAt($date);
            $this->company->setDomain( $domain);
            $this->company->setIsActive(true);
            DB::beginTransaction();

            $this->service->companyVerify($company, $this->company);
            $this->companyPackageService->packageVerify($company);

            foreach( $company->officials as $official){
                $user->setFirstname($official->first_name);
                $user->setLastname( $official->last_name);
                $user->setEmail( $official->email);
                $type = Types::SUPPLIER;
                if($company->type->value === Types::TOURISM_COMPANY->value){
                    $type = Types::TOURISM_COMPANY;
                }
                $user->setType($type);
                $user->setCompanies($company);
                $this->service->attachUser( $user );
                $this->service->sendResetPasswordLink($official->email , $domain );
            }

            DB::commit();
            return response()->json(['message' => 'Firma Onaylandi']);
        } catch (Exception $e) {
            \Illuminate\Support\Facades\Log::error('approve',[ 'message' => $e->getMessage()]);
            DB::rollBack();
            return response()->json(['message' => 'Sistemimizde yasanan bir sorundan dolayi firmayi onaylayamadik. Lutfen tekrar deneyin.'], 500);
        }
    }

    public function getWaitingApproval(WaitingApprovalsDataTable $dataTable)
    {

        $this->authorize('getWaitingApproval', Companies::class);
        return $dataTable->render('applications.companies::waiting-approval.list',
            [
                'mainPage' => __('general.dashboard'),
                'subPage' => __('company.list_text'),
                'title' => __('company.list_text'),
                'modals' => []
            ]
        );
    }


    public function waitingCompanyUpdate(WaitingCompanyUpdateRequest $request)
    {
        $id = $request->post('id');
        $company = $this->service->find($id);

        //return response()->json($request->all());

        DB::beginTransaction();
        try {
            $this->service->waitingCompanyUpdate(
                $id,
                [
                    "name" => $request->post('name'),
                    "email" => $request->post('email'),
                    "description" => $request->post('description'),
                    "address" => $request->post('address'),
                    "phone" => $request->post('phone'),
                    "phone_country" => $request->post('phone_country')
                ]
            );

            if($request->has('files')) {
                $this->companyFiles = new CompanyFiles();
                foreach ($request->file('files') as $file) {
                    $this->companyFiles->setFile($file);
                }
                $this->companyFiles->uploadFiles();
                $this->service->filesStore($company, $this->companyFiles);
            }

            $this->companyOfficials->setEmail($request->post('official_email'));
            $this->companyOfficials->setPhone($request->post('official_phone'));
            $this->companyOfficials->setPhoneCountry($request->post('official_phone_country'));
            $this->companyOfficials->setTitle($request->post('official_title') ?? "");
            $this->companyOfficials->setFirstName($request->post('official_first_name'));
            $this->companyOfficials->setLastName($request->post('official_last_name'));

            $this->service->officialsUpdateFromCompany($id, $this->companyOfficials);

            DB::commit();

            return redirect()->back()->with(['status' => 'success', 'message' => 'Başarıyla güncellendi.']);

        } catch (Exception $exception) {
            DB::rollback();
            return redirect()->back()->with(['status' => 'error', 'message' => 'Bir hata oluştu lütfen daha sonra tekrar deneyiniz.']);
        }
    }

    public function edit(
        CompanyDemoEditRequest $request,
        PackagesServiceInterface $packagesService
    )
    {
        $this->authorize('editWaitingApprovalEdit', Companies::class);
        return view('applications.companies::waiting-approval.edit',
            [
                'mainPage' => trans('general.dashboard'),
                'subPage' => trans('company.list_text'),
                'title' => trans('company.list_text'),
                'modals' => [],
                'data' => $this->service->showWaitingApproval($request->route('id')),
                'packages' => $packagesService->all()
            ]
        );
    }

    public function editCompany(CompanyEditRequest $request,OfficalsDataTable $dataTable)
    {
        $id = $request->input('id');
        $paymentFrequencyEnums= PaymentFrequencyEnums::values();
        return $dataTable->render('applications.companies::edit',
            [
                'mainPage' => __('company.edit'),
                'subPage' => __('company.edit'),
                'title' => __('company.edit'),
                'modals' => [
                    [
                        'targetId'=>'official_add',
                        'title'=>__('company.add_official'),
                        'contentView'=>'applications.companies::includes.modals.officials_add_modal'
                    ],
                    [
                        'targetId'=>'official_destroy',
                        'title'=>__('company.destroy_official_title'),
                        'contentView'=>'applications.companies::includes.modals.officials_destroy_modal'
                    ]
                ],
                'paymentFrequencyEnums' => $paymentFrequencyEnums,
                'detail' => $this->service->find($id),
            ]
        );
    }

    public function updateCompany(CompanyUpdateRequest $request)
    {
        $this->company->setName($request->post('name'));
        $this->company->setEmail($request->post('email'));
        $this->company->setPhone($request->post('phone'));
        $this->company->setPhoneCountry($request->post('phone_country'));
        $this->company->setAddress($request->post('address'));
        $this->company->setDescription($request->post('description'));

        $this->service->companyUpdate($request->route('id'),$this->company);

        return redirect()->back();
    }

    public function show(CompanyDemoShowRequest $request)
    {
        $this->authorize('showWaitingApproval', Companies::class);
        return view('applications.companies::waiting-approval.show',
            [
                'mainPage' => trans('general.dashboard'),
                'subPage' => trans('company.list_text'),
                'title' => trans('company.list_text'),
                'modals' => [],
                'data' => $this->service->showWaitingApproval($request->route('id')),
            ]
        );
    }

    public function demo(CompaniesDemoCreateRequest $request): JsonResponse
    {
        /**
         * Sirket Olustur
         */
        $this->company->setName($request->post('name'));
        $this->company->setEmail($request->post('email'));
        $this->company->setPhone($request->post('phone'));
        $this->company->setPhoneCountry($request->post('phone_country'));
        $this->company->setAddress($request->post('address'));
        $this->company->setDescription($request->post('description'));
        $this->company->setType(CompanyTypeEnums::valueFromString($request->post('type')));

        /**
         * Sirket Evraklarini Olustur
         */
        $this->companyFiles = new CompanyFiles();
        foreach ($request->file('files') as $file) {
            $this->companyFiles->setFile($file);
        }
        $this->companyFiles->uploadFiles();

        /**
         * Sirket Yetkilisi Olustur
         */
        $this->companyOfficials->setEmail($request->post('official_email'));
        $this->companyOfficials->setPhone($request->post('official_phone'));
        $this->companyOfficials->setPhoneCountry($request->post('official_phone_country'));
        $this->companyOfficials->setTitle($request->post('official_title') ?? "");
        $this->companyOfficials->setFirstName($request->post('official_first_name'));
        $this->companyOfficials->setLastName($request->post('official_last_name'));


        $package = $this->packagesService->find($request->post('package_id'));

        /**
         * Sirket Paketi Olustur
         */
        $this->companyPackage->setPackages($package);
        $this->companyPackage->setFrequencyEnums(
            PaymentFrequencyEnums::valueFromString($request->post('payment_frequency'))
        );
        $this->companyPackage->setPaymentStatusesEnums(PaymentStatusesEnums::WAITING_VERIFICATION);

        DB::beginTransaction();
        try {
            $sqlCompany = $this->service->companyStore($this->company); // Sirket Olustur
            $this->service->filesStore($sqlCompany, $this->companyFiles); // Sirketin dosyalarini ekle
            $this->service->officialsStore($sqlCompany, $this->companyOfficials); // sirketin etkilisini ekle
            $this->service->attach($sqlCompany, $this->companyPackage); // Sirkete bir paket bagla

            DB::commit();

//        /**
//         * @todo burasi view ile degisecek.
//         */
            return response()->json([
                    'message' => 'Talebiniz basariyla alindi',
                    'company' => $sqlCompany
                ]
            );

        } catch (Exception $exception) {
            DB::rollback();
            return response()->json(['message' => 'Sistemimizde yasanan bir sorundan dolayi talebinizi alamadik. Lutfen tekrar deneyin.'], 500);
        }
    }

    /**
     * @throws ValidationException
     */
    public function checkDomain(Request $request)
    {
        $this->authorize('checkDomain', Companies::class);
        $isAvailability = $this->service->isValidDomainName($request->post('domain'));
        if( !$isAvailability ) throw ValidationException::withMessages(['domain' => "This value isn't availability"]);
        return response()->json(['is_availability'=>true]);

    }

    public function viewList(CompaniesDataTable $dataTable,PackagesServiceInterface $packagesService)
    {
        $this->authorize('view', Companies::class);

        $companyType = CompanyTypeEnums::values();
        $package = $packagesService->allWithInActive();
        $paymentStatus = PaymentStatusesEnums::values();

        return $dataTable->render('applications.companies::list',
            [
                'mainPage' => trans('general.dashboard'),
                'subPage' => trans('company.list'),
                'title' => trans('company.list'),
                'modals' => [],
                'companyType'=>$companyType,
                'packages' => $package,
                'paymentStatus' => $paymentStatus
            ]
        );
    }

    public function attachUser(
        CompanyAttachUserRequest $request,
        User                     $user
    )
    {
        $this->authorize('attachUser', Companies::class);
        $company = $this->service->find($request->input('id'));
        $user->setFirstname($request->post('first_name'));
        $user->setLastname($request->post('last_name'));
        $user->setEmail($request->post('email'));
        $user->setPassword(Str::random(12));
        $type = ($company->type->value === Types::TOURISM_COMPANY->value)
            ? Types::TOURISM_COMPANY
            : Types::SUPPLIER;
        $user->setType($type);
        $user->setCompanies($company);
        $this->service->attachUser($user);
        return response()->json(['message' => 'Kullanici Eklendi']);
    }
    public function datatablesList(CompaniesDataTable $dataTable,Request $request,Companies $model)
    {
        $this->authorize('view', Companies::class);
        if($request->ajax()){
            return $dataTable->dataTable(
                $dataTable->query($model)
            )->toArray();
        }
        return [];
    }

    public function showCompany(
        CompanyShowRequest                $request,
        CompanyPackagesDataTable          $packages,
        CompanyUsersDataTable             $users,
        CompanyOfficialsDataTable         $officials,
        CompanyCustomersDataTable         $customers,
        CompanyActivityPoolDataTable      $activityPool,
        CompanyActivitiesDataTable        $activities,
        CompanySupplierCustomersDataTable $supplierCustomers,
    )
    {
        $company = $this->service->findWithRelations($request->route('id'));
        $data = [
            'mainPage' => trans('general.dashboard'),
            'subPage' => trans('company.list_text'),
            'title' => trans('company.list_text'),
            'modals' => [],
            'company' => $company,
            'packages' => $packages->html(),
            'users' => $users->html(),
            'officials' => $officials->html(),
            'activityPool' => $activityPool->html(),
            'customers' => $customers->html(),
            'activities' => $activities->html(),
            'supplierCustomers' => $supplierCustomers->html(),
        ];
        return view('applications.companies::show', $data);
    }

    public function packagesDataTable(
        Request $request,
        CompanyPackagesDataTable $dataTable,
        CompaniesPackages $model,
    )
    {
        $this->authorize('showPackages', Companies::class);
        if($request->ajax() && $request->has('id')){
            return $dataTable->dataTable(
                $dataTable->query($model)
            )->toArray();
        }
        return [];
    }

    public function usersDataTable(
        Request $request,
        CompanyUsersDataTable $dataTable,
        Users $model,
    )
    {
        $this->authorize('showUsers', Companies::class);
        if($request->ajax() && $request->has('id')){
            return $dataTable->dataTable(
                $dataTable->query($model)
            )->toArray();
        }
        return [];
    }

    public function officialsDataTable(
        Request $request,
        CompanyOfficialsDataTable $dataTable,
        CompanyOfficials $model,
    )
    {
        $this->authorize('showOfficials', Companies::class);
        if($request->ajax() && $request->has('id')){
            return $dataTable->dataTable(
                $dataTable->query($model)
            )->toArray();
        }
        return [];
    }

    public function customersDataTable(
        Request $request,
        CompanyCustomersDataTable $dataTable,
        \Rezyon\Users\Models\Users $model,
    )
    {
        $this->authorize('showCustomers', Companies::class);
        if($request->ajax() && $request->has('id')){
            return $dataTable->dataTable(
                $dataTable->query($model)
            )->toArray();
        }
        return [];
    }

    public function activityPoolDataTable(
        Request $request,
        CompanyActivityPoolDataTable $dataTable,
        TourismCompanyActivity $model,
    )
    {
        $this->authorize('showActivityPool', Companies::class);
        if($request->ajax() && $request->has('id')){
            return $dataTable->dataTable(
                $dataTable->query($model)
            )->toArray();
        }
        return [];
    }

    public function activitiesDataTable(
        Request $request,
        CompanyActivitiesDataTable $dataTable,
        Activity $model,
    )
    {
        $this->authorize('showActivities', Companies::class);
        if($request->ajax() && $request->has('id')){
            return $dataTable->dataTable(
                $dataTable->query($model)
            )->toArray();
        }
        return [];
    }

    public function companySupplierCustomersDataTable(
        Request $request,
        CompanySupplierCustomersDataTable $dataTable,
        TourismCompanyActivity $model,
    )
    {
        $this->authorize('showSupplierCustomers', Companies::class);
        if($request->ajax() && $request->has('id')){
            return $dataTable->dataTable(
                $dataTable->query($model)
            )->toArray();
        }
        return [];
    }
}