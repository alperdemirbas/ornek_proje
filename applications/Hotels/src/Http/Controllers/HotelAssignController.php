<?php

namespace Rezyon\Applications\Hotel\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\DataAccess\HotelsDataAccess;
use App\DataAccess\UsersDataAccess;
use App\DataAccess\UserHotelDataAccess;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Rezyon\Applications\Hotel\DataTables\HotelAssignmentsDataTable;
use Rezyon\Hotel\Entity\HotelsEntity;
use Rezyon\Applications\Hotel\Http\Requests\Assignments\AssignmentDestroyRequest;
use Rezyon\Applications\Hotel\Http\Requests\Assignments\CreateAssignmentRequest;

class HotelAssignController extends Controller
{
    public function index(Request $request, HotelsDataAccess $hotels, UsersDataAccess $users, HotelAssignmentsDataTable $dataTable, UserHotelDataAccess $userHotel)
    {
        $user = $request->user();

        $data = array();
        $data['hotels'] = $hotels->getHotels();
        $data['users'] = $users->getUsers($user->company_id);
        //$data['attached'] = $hotels->getAttachedUsers();
        //return $userHotel->getAll($user->company_id);

        //return $hotels->getAttachedUsers()->first();
        //dd($hotels->getAttachedUsers()->first());

        //return view('app.hotels::assignment', $data);
        return $dataTable->render('app.hotels::assignment', $data);
    }

    public function list(Request $request, HotelsEntity $hotels, UserHotelDataAccess $userHotel, HotelAssignmentsDataTable $dataTable)
    {
        if($request->ajax() && $request->user('panel')) {
            $company_id = $request->user('panel')->company_id;
            return $dataTable->dataTable(
                $userHotel->getModel()->with([
                    'hotel',
                    'user' => function ($query) use (&$company_id) {
                        $query->where('company_id', $company_id);
                    },
                    'operator' => function ($query) use (&$company_id) {
                        $query->where('company_id', $company_id);
                    }
                ])
            );
        }
    }

    public function store(
        CreateAssignmentRequest $request,
        UserHotelDataAccess $userHotel,
        HotelsEntity $hotelsEntity,
        UsersDataAccess $usersDataAccess
    )
    {
        $hotel = $hotelsEntity->find($request->post("hotel"));
        $user  = $usersDataAccess->find($request->post('user'));
        $operator = $usersDataAccess->find($request->user()->id);
        foreach($request->post('user') as $user) {
            try {
                DB::beginTransaction();
                $user = $usersDataAccess->find($user);
                $create = $userHotel->create( $user , $hotel , $operator );
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(["status" => "error", "message" => "Eşleştirme işlemi tamamlanamadı."]);
            }
        }
        return response()->json(["status" => "success", "message" => "Eşleştirme işlemi başarıyla tamamlandı."]);
    }

    public function destroy(AssignmentDestroyRequest $request, UserHotelDataAccess $userHotel)
    {
        $delete = $userHotel->delete($request->post('id'));

        if($delete) {
            return response()->json(["status" => "success", "message" => "Eşleştirme kaldırma işlemi tamamlandı."]);
        } else {
            return response()->json(["status" => "error", "message" => "Eşleştirme kaldırma işlemi tamamlanamadı."]);
        }
    }
}
