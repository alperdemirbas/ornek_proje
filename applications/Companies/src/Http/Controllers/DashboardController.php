<?php

namespace Rezyon\Applications\Companies\Http\Controllers;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('applications.companies::dashboard',
            [
                'mainPage' => trans('general.dashboard'),
                'subPage' => trans('company.list_text'),
                'title' => trans('company.list_text'),
            ]
        );
    }
}
