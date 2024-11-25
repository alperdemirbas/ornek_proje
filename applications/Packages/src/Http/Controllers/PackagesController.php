<?php

namespace Rezyon\Applications\Packages\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Rezyon\Applications\Packages\DataTables\PackagesDataTable;
use Rezyon\Applications\Packages\Http\Requests\PackageEditRequest;
use Rezyon\Applications\Packages\Http\Requests\PackageShowRequest;
use Rezyon\Applications\Packages\Http\Requests\PackageStoreRequest;
use Rezyon\Applications\Packages\Http\Requests\PackageUpdateRequest;
use Rezyon\Packages\Enums\PackageTypesEnums;
use Rezyon\Packages\Interfaces\PackagesInterface;
use Rezyon\Packages\Interfaces\PackagesServiceInterface;
use Rezyon\Packages\Models\Packages;

class PackagesController extends Controller
{
    public function __construct(public PackagesServiceInterface $packagesService)
    {

    }

    public function create(){
        $this->authorize('store', Packages::class);
        $packageType = PackageTypesEnums::values();
        return view('applications.packages::create',[
            'mainPage' => trans('general.dashboard'),
            'subPage' => trans('packages.list'),
            'title' => trans('packages.list'),
            'modals' => [],
            'packageType' => $packageType,
            ]
        );
    }

    public function store(PackageStoreRequest $request,PackagesInterface $package)
    {

        $this->authorize('store', Packages::class);
        $packageTypeEnum = $request->post('package_type');
        $packageType = PackageTypesEnums::valueFromString($packageTypeEnum);


        $package->setName($request->post('package_name'));
        $package->setQuarterYearlyDiscount($request->post('quarter_yearly_discount'));
        $package->setHalfYearlyDiscount($request->post('half_yearly_discount'));
        $package->setYearlyDiscount($request->post('yearly_discount'));
        $package->setFee($request->post('sale_price'));
        $package->setTypesEnums($packageType);

        $this->packagesService->create($package);
        return redirect()->back()->with('success', __('form.success',['type'=>__('general.packages')]));
    }

    public function viewList(PackagesDataTable $dataTable)
    {
        $this->authorize('list', Packages::class);

        return $dataTable->render('applications.packages::list',
            [
                'mainPage' => trans('general.dashboard'),
                'subPage' => trans('package.list'),
                'title' => trans('package.list'),
                'modals' => []
            ]
        );
    }

    public function datatableList(Request $request,PackagesDataTable $dataTable,Packages $packages)
    {
        $this->authorize('list', Packages::class);
        if ($request->ajax()){
            return $dataTable->dataTable($dataTable->query($packages))->toArray();
        }
        return [];
    }

    public function show(PackageShowRequest $request)
    {
        $this->authorize('show', Packages::class);
        $id = $request->input('id');
        $data = [
            'detail'=> $this->packagesService->find($id),
            'mainPage' => trans('general.packages'),
            'subPage' => trans('package.list'),
            'title' => trans('package.list'),
            'modals' => []
        ];

        return view('applications.packages::show',$data);
    }

    public function edit(PackageEditRequest $request)
    {
        $this->authorize('edit', Packages::class);
        $packageType = PackageTypesEnums::values();
        $id = $request->input('id');
        $package = $this->packagesService->find($id);
        return view('applications.packages::edit', [
            'detail' => $package,
            'types' => $packageType,
            'mainPage' => trans('general.dashboard'),
            'subPage' => trans('package.list'),
            'title' => trans('package.list'),
            'modals' => []
        ]);
    }

    public function update(PackageUpdateRequest $request)
    {
        $this->authorize('edit', Packages::class);
        $data = [
            'name' => $request->post('package_name'),
            'type' => $request->post('package_type'),
            'is_active' => false,
            'fee' => $request->post('sale_price'),
            'quarter_yearly_discount' => $request->post('quarter_yearly_discount'),
            'half_yearly_discount' => $request->post('half_yearly_discount'),
            'yearly_discount' => $request->post('yearly_discount'),
        ];

        if ($request->has('status')) {
            $data['is_active'] = true;
        }

        $this->packagesService->update($request->input('id'), $data);
        return redirect()->back()->with('success', __('form.success', ['type' => __('general.packages')]));
    }
}
