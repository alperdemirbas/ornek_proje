<?php

namespace Rezyon\Applications\Hotels\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Rezyon\Applications\Hotels\Datatables\UserHotelDataTable;
use Rezyon\Hotels\Models\Hotel;
use Rezyon\Hotels\Services\HotelService;
use Rezyon\Users\UserService;

class HotelAssignmentController extends Controller
{
    public function index(
        Request $request,
        UserHotelDataTable $dataTable,
        HotelService $hotelService,
        UserService $userService
    )
    {
        $this->authorize('assignmentList', Hotel::class);
        return $dataTable->render('applications.hotels::assignment', [
            'hotels' => $hotelService->getHotels(),
            'users' => $userService->getUsers($request->user()->companies_id),
        ]);
    }
}
