<?php

namespace Rezyon\Applications\Hotels\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Rezyon\Applications\Hotels\Datatables\HotelsDataTable;
use Rezyon\Applications\Hotels\Http\Requests\HotelEditRequest;
use Rezyon\Applications\Hotels\Http\Requests\HotelStoreRequest;
use Rezyon\Applications\Hotels\Http\Requests\HotelUpdateRequest;
use Rezyon\Hotels\Hotel;
use Rezyon\Hotels\Models\Hotel as HotelModel;
use Rezyon\Hotels\Services\HotelService;

class HotelsController extends Controller
{
    public function index(HotelsDataTable $dataTable)
    {
        $this->authorize('list', HotelModel::class);
        return $dataTable->render('applications.hotels::list',
            [
                "buttons" => [
                    [
                        "element" => "a",
                        "href" => route('hotels.create'),
                        "class" => "btn btn-rounded btn-primary",
                        "text" => trans('general.add'),
                        "icon" => '<span class="btn-icon-start text-primary"><i class="fa fa-plus color-primary"></i></span>',
                    ]
                ]
            ]
        );
    }

    public function create()
    {
        $this->authorize('add', HotelModel::class);
        return view('applications.hotels::add');
    }

    public function edit(
        HotelEditRequest $request,
        HotelService $service
    )
    {
        $this->authorize('edit', HotelModel::class);
        return view('applications.hotels::edit', ['hotel' => $service->getHotel($request->input('id'))]);
    }

    public function store(
        HotelStoreRequest $request,
        Hotel $hotel
    )
    {
        $this->authorize('add', HotelModel::class);
        $hotel
            ->setUser($request->user()->id)
            ->setName($request->post('name'))
            ->setPhoneCountry($request->post('phone_country'))
            ->setPhone($request->post('phone'))
            ->setAddress($request->post('address'))
            ->setCity($request->post('city'))
            ->setDistrict($request->post('district'))
            ->setStatus($request->post('status'))
            ->save();

        return redirect()->route('hotels.index')->with(['status' => 'success', 'message' => 'Otel Başarıyla Eklendi']);
    }

    public function update(
        HotelUpdateRequest $request,
        HotelService $service
    )
    {
        $this->authorize('edit', HotelModel::class);
        $service->update($request->input('id'), $request->validated());
        return redirect()->back()->with(['status' => 'success', 'message' => 'Otel Başarıyla Güncellendi']);
    }

    public function assignment(
        Request $request
    )
    {
        dd($request->all());
    }
}
