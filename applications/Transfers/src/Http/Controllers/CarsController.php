<?php

namespace Rezyon\Applications\Transfers\Http\Controllers;

use App\Enums\ElementTypeEnum;
use App\Http\Controllers\Controller;
use Rezyon\Applications\Transfers\DataTables\CarsDataTable;
use Rezyon\Applications\Transfers\Http\Requests\CarCreateRequest;
use Rezyon\Applications\Transfers\Http\Requests\CarDeleteRequest;
use Rezyon\Applications\Transfers\Http\Requests\CarEditRequest;
use Rezyon\Applications\Transfers\Http\Requests\CarShowRequest;
use Rezyon\Applications\Transfers\Http\Requests\CarUpdateRequest;
use Rezyon\Transfers\Car;
use Rezyon\Transfers\Services\CarsService;

class CarsController extends Controller
{
    public function index(CarsDataTable $dataTable)
    {
        return $dataTable->render('applications.transfers::cars.list', [
            "buttons" => [
                buttonGenerator(
                    ElementTypeEnum::LINK,
                    null,
                    _route('cars.create'),
                    'btn btn-primary',
                    [],
                    '<i class="fas fa-plus"></i>',
                    "Araç Ekle"
                )
            ]
        ]);
    }

    public function create()
    {
        return view('applications.transfers::cars.add');
    }

    public function store(
        CarCreateRequest $request,
        CarsService $service,
    )
    {
        $car = new Car();
        $car->setUserId($request->user()->id);
        $car->setName($request->post('name'));
        $car->setCapacity($request->post('capacity'));
        $car->setNumber($request->post('number'));

        $service->create($car);

        return redirect(_route('cars.index'))->with(["status" => "success", "message" => "Araç Başarıyla Oluşturuldu."]);
    }

    public function edit(
        CarEditRequest $request,
        CarsService $service
    )
    {
        $car = $service->find($request->input('id'));
        return view('applications.transfers::cars.edit', compact('car'));
    }

    public function update(
        CarUpdateRequest $request,
        CarsService $service
    )
    {
        $service->update(
            $request->input('id'),
            [
                'name' => $request->post('name'),
                'capacity' => $request->post('capacity'),
                'number' => $request->post('number')
            ]
        );

        return redirect()->back()->with(["status" => "success", "message" => "Araç Başarıyla Güncellendi."]);
    }

    public function destroy(
        CarDeleteRequest $request,
        CarsService $service
    )
    {
        $service->delete($request->input('id'));
        return redirect(_route('cars.index'))->with(["status" => "success", "message" => "Araç Başarıyla Silindi."]);
    }
}
