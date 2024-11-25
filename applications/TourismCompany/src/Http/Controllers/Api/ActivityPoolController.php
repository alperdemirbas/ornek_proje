<?php

namespace Rezyon\Applications\TourismCompany\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Rezyon\TourismCompany\TourismCompanyService;

class ActivityPoolController extends Controller
{
    public function list(
        Request $request,
        TourismCompanyService $service
    )
    {
        $activities = $service->activityPoolList($request->user()->companies_id);
        return response()->json(['status' => 'success', 'data' => $activities]);
    }
}
