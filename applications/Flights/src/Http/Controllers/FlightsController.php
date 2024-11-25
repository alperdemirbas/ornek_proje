<?php

namespace Rezyon\Applications\Flights\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Rezyon\Applications\Flights\DataTables\FlightCustomersDataTable;
use Rezyon\Applications\Flights\DataTables\FlightsDataTable;
use Rezyon\Applications\Flights\Http\Requests\FlightChangeStatusRequest;
use Rezyon\Applications\Flights\Imports\UsersImport;
use Rezyon\Flights\Enums\StatusEnums;

class FlightsController extends Controller
{
    public function index(FlightsDataTable $dataTable)
    {
        return $dataTable->render(
            "applications.flights::list",
            [
                'mainPage' => 'Panel',
                'subPage' => "Uçuşlar",
                'title' => "Uçuşlar",
                'modals' => [],
                "buttons" => [
                    [
                        "element" => "a",
                        "href" => _route('flights.create'),
                        "class" => "btn btn-rounded btn-primary",
                        "text" => trans('general.add'),
                        "icon" => '<span class="btn-icon-start text-primary"><i class="fa fa-plus color-info"></i></span>',
                    ]
                ]
            ]
        );
    }

    /**
     * @param FlightEditRequest $request
     * @param FlightServiceInterface $service
     * @return View|Application|Factory|JsonResponse|\Illuminate\Contracts\Foundation\Application
     */
    public function edit(
        FlightEditRequest      $request,
        FlightServiceInterface $service,
    ): View|Application|Factory|JsonResponse|\Illuminate\Contracts\Foundation\Application
    {
        $flight = $service->find($request->route('flight'));

        return view(
            'applications.flights::edit',
            [
                'mainPage' => 'Panel',
                'subPage' => __('admin.flights.edit.title'),
                'title' => __('admin.flights.edit.title'),
                'modals' => [],
                'flight' => $flight
            ]
        );
    }

    /**
     * @param FlightStoreRequest $request
     * @param FlightInterface $flight
     * @param FlightServiceInterface $service
     * @param CompanyFlightsDataAccessInterface $flightEntity
     * @return RedirectResponse
     */
    public function store(
        FlightStoreRequest                $request,
        FlightInterface                   $flight,
        FlightServiceInterface            $service,
        CompanyFlightsDataAccessInterface $flightEntity,
    ): RedirectResponse
    {
        $flight->setFlightNumber($request->post('flight_number'));
        $flight->setDetail($request->post('detail'));
        $flight->setDepartureTime($request->post('departure_time'));
        $flight->setDepartureAirport($request->post('departure_airport'));
        $flight->setArrivalTime($request->post('arrival_time'));
        $flight->setArrivalAirport($request->post('arrival_airport'));
        $flight->setReturn($request->post('return'));

        $createFlight = $service->create($flight);

        $flightEntity->create(
            $request->user()->id,
            $createFlight->id,
            StatusEnums::from('n/a')
        );

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            (new UsersImport(
                $createFlight,
                $request->user(),
            ))->queue($file);
        }

        return redirect(_route('flights.index'))->with(["status" => "success", "message" => trans('flight.passengers_being_imported')]);
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view(
            'applications.flights::add',
            [
                'mainPage' => 'Panel',
                'subPage' => __('admin.flights.create.title'),
                'title' => __('admin.flights.create.title'),
                'modals' => []
            ]
        );
    }

    /**
     * @param FlightStatusRequest $request
     * @param FlightServiceInterface $service
     * @return JsonResponse
     */
    public function statusAction(
        FlightStatusRequest    $request,
        FlightServiceInterface $service
    ): JsonResponse
    {
        $id = $request->post('id');
        $role = $request->post('role');

        switch ($role) {
            case 'confirm':
                $service->confirm($id);
                break;
            case 'return':
                $service->return($id);
                break;
            case 'cancel':
                $service->cancel($id);
                break;
        }

        return response()->json(['status' => 'success']);
    }

    /**
     * @param FlightShowRequest $request
     * @return mixed
     * @throws BindingResolutionException
     */
    public function show(
        FlightShowRequest $request
    ): mixed
    {
        $flightId = $request->route('flight');
        $dataTable = new FlightCustomersDataTable($flightId);
        $mainPage = 'Panel';
        $subPage = __('admin.flights.view.title');
        $title = __('admin.flights.view.title');
        $modals = [];
        $customers = CustomerModel::with(['company' => function ($query) use ($request) {
            $query->where('company_id', $request->user()->id);
        }])->get();

        $newRequest = new FlightGetRequest(['id' => $flightId]);
        $service = app()->make(FlightService::class);
        $result = $this->getRow($newRequest, $service)->getData();
        if ($result->status !== 'success') {
            abort(404);
        }
        $flight = $result->data;

        return $dataTable->with(['flightId' => $flightId])->render(
            "applications.flights::view",
            compact('flightId', 'mainPage', 'subPage', 'title', 'modals', 'flight', 'customers')
        );
    }

    /**
     * @param FlightGetRequest $request
     * @param FlightServiceInterface $service
     * @return JsonResponse
     */
    public function getRow(
        FlightGetRequest       $request,
        FlightServiceInterface $service
    ): JsonResponse
    {
        $id = $request->post('id') ?? $request->id;

        return response()->json(['status' => 'success', 'data' => $service->find($id)]);
    }

    /**
     * @param FlightAddCustomerRequest $request
     * @param FlightCustomersDataAccessInterface $model
     * @return JsonResponse
     */
    public function addCustomer(
        FlightAddCustomerRequest           $request,
        FlightCustomersDataAccessInterface $model,
    ): JsonResponse
    {
        $id = $request->route('flight');
        $customers = $request->post('customers');

        $fails = [];
        foreach ($customers as $key => $customer) {
            $search = $model->checkCustomerActiveFlight($customer['id']);
            if (!empty($search)) {
                $model->create($id, $customer['id']);
                unset($customers[$key]);
            } else {
                if ($search->flights_id == $id) {
                    $fails[] = trans('flight.already_added_this_plane', ['firstname' => $customer['firstname'], 'lastname' => $customer['lastname']]);
                    unset($customers[$key]);
                } else {
                    $fails[] = trans('flight.already_added_to_plane', ['firstname' => $customer['firstname'], 'lastname' => $customer['lastname']]);
                }
            }
        }

        if (!empty($fails)) {
            return response()->json([
                "status" => "error",
                "message" => implode("<br/>", $fails),
                "data" => $customers
            ], 422);
        } else {
            return response()->json(["status" => "success", "message" => trans('flight.import_success')]);
        }
    }

    /**
     * @param FlightTransferCustomerRequest $request
     * @param FlightCustomersDataAccessInterface $model
     * @return JsonResponse
     */
    public function transferCustomer(
        FlightTransferCustomerRequest      $request,
        FlightCustomersDataAccessInterface $model,
    ): JsonResponse
    {
        $id = $request->route('flight');
        $customers = $request->post('customers');

        foreach ($customers as $customer) {
            $search = $model->checkCustomerActiveFlight($customer['id']);
            if (!empty($search)) {
                $search->delete();
                $model->create($id, $customer['id']);
            } else {
                return response()->json(["status" => "error", "message" => trans('general.error_occurred')], 422);
            }
        }

        return response()->json(["status" => "success", "message" => trans('flight.transfer_success')]);
    }

    /**
     * @param FlightChangeStatusRequest $request
     * @param FlightCustomersDataAccessInterface $service
     * @return JsonResponse
     */
    public function changeStatus(
        FlightChangeStatusRequest          $request,
        FlightCustomersDataAccessInterface $service
    ): JsonResponse
    {
        $id = $request->post('row');
        $role = $request->post('role');
        $uid = $request->post('uid');

        DB::transaction(function () use ($uid, $service, $id, $role) {
            $service->changeStatus($id, $uid, StatusEnums::from($role));
        });

        return response()->json(['status' => 'success', 'data' => trans('general.request_success')]);
    }
}