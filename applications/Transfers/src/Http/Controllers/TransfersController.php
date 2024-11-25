<?php

namespace Rezyon\Applications\Transfers\Http\Controllers;

use App\Enums\ElementTypeEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Rezyon\Applications\Transfers\DataTables\TransferCustomersDataTable;
use Rezyon\Applications\Transfers\DataTables\TransfersDataTable;
use Rezyon\Applications\Transfers\DataTables\TransferUsersDataTable;
use Rezyon\Applications\Transfers\Http\Requests\TransferCreateRequest;
use Rezyon\Applications\Transfers\Http\Requests\TransferDeleteRequest;
use Rezyon\Applications\Transfers\Http\Requests\TransferShowRequest;
use Rezyon\Applications\Transfers\Http\Requests\TransferUpdateRequest;
use Rezyon\Carts\Services\CartService;
use Rezyon\Hotels\Services\HotelService;
use Rezyon\TourismCompany\TourismCompanyService;
use Rezyon\Transfers\Models\TransferUsers;
use Rezyon\Transfers\Services\CarsService;
use Rezyon\Transfers\Services\TransfersService;
use Rezyon\Transfers\Transfer;
use Rezyon\Users\Enums\Types;
use Rezyon\Users\UserService;

class TransfersController extends Controller
{
    public function index(TransfersDataTable $dataTable)
    {
        return $dataTable->render('applications.transfers::transfers.list', [
            "buttons" => [
                buttonGenerator(
                    ElementTypeEnum::LINK,
                    null,
                    _route('transfers.create'),
                    'btn btn-primary',
                    [],
                    '<i class="fas fa-plus"></i>',
                    "Transfer Ekle"
                )
            ]
        ]);
    }

    public function create(
        Request $request,
        TourismCompanyService $tourismCompanyService,
        CarsService $carsService,
        CartService $cartService,
        HotelService $hotelService
    )
    {
        $user = $request->user();
        $hotels = $hotelService->getHotels();
        $cars = $carsService->getCars($user->companies_id);
        $activities = $tourismCompanyService->getActivities($user->companies_id);
        return view('applications.transfers::transfers.add', compact('activities', 'cars', 'hotels'));
    }

    public function store(
        TransferCreateRequest $request,
        TransfersService $service
    )
    {
        $transfer = new Transfer();
        $transfer->setUserId($request->user()->id);
        $transfer->setCarId($request->post('cars_id'));
        $transfer->setActivityId($request->post('activity_id'));
        $transfer->setDriverName($request->post('driver_name'));
        $transfer->setDriverPhone($request->post('driver_phone'));
        $transfer->setDriverPhoneCountry($request->post('driver_phone_country'));
        $transfer->setHotelId($request->post('hotel_id'));
        $transfer->setSessionId($request->post('activity_session_id'));
        $transfer->setDate($request->post('date'));
        $transfer->setTime($request->post('time'));

        $result = $service->create($transfer);

        return redirect(_route('transfers.show', ['transfer', $result->id]))->with(["status" => "success", "message" => "Transfer Başarıyla Oluşturuldu."]);
    }

    public function show(
        TransferShowRequest $request,
        TransferCustomersDataTable $customersDataTable,
        TransferUsersDataTable $usersDataTable,
        TransfersService $transferService,
        UserService $userService
    )
    {
        $transfer = $transferService->find($request->input('id'));
        $users = $userService->getUsers($request->user()->companies_id);
        $filteredUsers = $users->filter(function ($user) use ($transfer) {
            return !$transfer->transferUsers->contains(function ($transferUser) use ($user) {
                return $transferUser->users_id === $user->id;
            });
        });
        $users = $filteredUsers->filter(function ($user) use ($transfer) {
            return $user->type === Types::TOURISM_COMPANY;
        });
        $customers = $filteredUsers->filter(function ($user) use ($transfer) {
            return $user->type === Types::CUSTOMER;
        });
        return view('applications.transfers::transfers.show', [
            'customersDataTable' => $customersDataTable->html(),
            'usersDataTable' => $usersDataTable->html(),
            'users' => $users,
            'customers' => $customers
        ]);
    }

    public function edit()
    {

    }

    public function update(TransferUpdateRequest $request)
    {

    }

    public function destroy(
        TransferDeleteRequest $request,
        TransfersService $service
    )
    {
        $service->delete($request->input('id'));
        return redirect(_route('transfers.index'))->with(["status" => "success", "message" => "Transfer Başarıyla Silindi."]);
    }

    public function datatablesCustomers(
        TransferShowRequest $request,
        TransferCustomersDataTable $dataTable,
        TransferUsers $model
    )
    {
        if($request->ajax()){
            return $dataTable->dataTable(
                $dataTable->query($model)
            )->toArray();
        }
        return [];
    }

    public function datatablesUsers(
        TransferShowRequest $request,
        TransferUsersDataTable $dataTable,
        TransferUsers $model
    )
    {
        if($request->ajax()){
            return $dataTable->dataTable(
                $dataTable->query($model)
            )->toArray();
        }
        return [];
    }
}
