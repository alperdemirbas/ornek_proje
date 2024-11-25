<?php

namespace Rezyon\Applications\Companies\Http\Controllers;

use App\Http\Controllers\Controller;
use Rezyon\Applications\Companies\DataTables\OfficalsDataTable;
use Rezyon\Applications\Companies\Requests\CompanyOfficialAddRequest;
use Rezyon\Applications\Companies\Requests\CompanyOfficialDestroyRequest;
use Rezyon\Applications\Companies\Requests\CompanyOfficialEditRequest;
use Rezyon\Applications\Companies\Requests\CompanyOfficialsDataTableRequest;
use Rezyon\Applications\Companies\Requests\CompanyOfficialUpdateRequest;
use Rezyon\Companies\Interfaces\CompaniesServiceInterface;
use Rezyon\Companies\Interfaces\CompanyOfficialsInterface;
use Rezyon\Companies\Models\CompanyOfficials;

class CompanyOfficialsController extends Controller
{

    public function datatablesList(CompanyOfficialsDataTableRequest $request, OfficalsDataTable $dataTable, CompanyOfficials $model)
    {
        $this->authorize('list',CompanyOfficials::class);
        if ($request->ajax()) {
            $id = $request->input('id');
            return $dataTable->dataTable($dataTable->query($model, $id))->toArray();
        }
        return [];
    }

    /*
     * Aktif Firmaya Yetkili Kişi Ekle
     */
    public function store(
        CompanyOfficialAddRequest $request,
        CompanyOfficialsInterface $officials,
        CompaniesServiceInterface $service
    )
    {
        $this->authorize('store',CompanyOfficials::class);
        $company = $service->find($request->input('companies_id'));
        if (!empty($company)) {
            $officials->setTitle($request->post('title'));
            $officials->setFirstName($request->post('first_name'));
            $officials->setLastName($request->post('last_name'));
            $officials->setEmail($request->post('email'));
            $officials->setPhoneCountry($request->post('phone_country'));
            $officials->setPhone($request->post('phone'));
            $service->officialsStore($company, $officials);
        }
        return redirect()->back()->with('success', __('form.success', ['type' => __('general.officials')]));
    }



    /*
     * Yetkili içeriklerini düzenle
     */
    public function edit(CompanyOfficialEditRequest $request, CompanyOfficialsInterface $officials, CompaniesServiceInterface $service)
    {
        $this->authorize('edit', CompanyOfficials::class);
        $data = $service->officialFind($request->input('official_id'));
        return view('applications.companies::officials.edit', ['detail' => $data]);
    }

    /**
     * Aktif yetkiliyi sil
     */
    public function destroy(
        CompanyOfficialDestroyRequest $request,
        CompaniesServiceInterface     $service,
    )
    {
        $this->authorize('destroy', CompanyOfficials::class);
        $service->officialsDestroy($request->post('official_id'));

        return redirect()->back()->with('success', __('form.success', ['type' => __('general.officials')]));
    }

    public function update(CompanyOfficialUpdateRequest $request, CompanyOfficialsInterface $officials, CompaniesServiceInterface $service)
    {
        $officials->setFirstName($request->post('first_name'));
        $officials->setLastName($request->post('last_name'));
        $officials->setEmail($request->post('email'));
        $officials->setTitle($request->post('title'));
        $officials->setPhoneCountry($request->post('phone_country'));
        $officials->setPhone($request->post('phone'));

        $service->officialsUpdate($request->post('id'), $officials);
        return redirect()->back()->with('success', __('form.success', ['type' => 'general.officials']));

    }
}