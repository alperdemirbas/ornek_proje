<?php

namespace Rezyon\Applications\Companies\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Rezyon\Applications\Companies\DataTables\CompanyDomainDataTable;
use Rezyon\Companies\Models\Companies;

class DomainController extends Controller
{
    public function viewList(CompanyDomainDataTable $dataTable)
    {
        $this->authorize('domainList', Companies::class);
        return $dataTable->render('applications.companies::domain.list',
            [
                'mainPage' => trans('general.dashboard'),
                'subPage' => trans('company.domain_list_text'),
                'title' => trans('company.domain_list_text'),
                'modals' => [],
            ]
        );
    }

    public function datatablesList(Request $request,CompanyDomainDataTable $dataTable,Companies $companies):array
    {
        $this->authorize('domainList', Companies::class);
        if($request->ajax())
        {
            return $dataTable->dataTable($dataTable->query($companies))->toArray();
        }
        return [];
    }
}