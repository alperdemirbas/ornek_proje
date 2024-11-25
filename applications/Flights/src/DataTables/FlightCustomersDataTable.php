<?php

namespace Rezyon\Applications\Flights\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\App;
use Rezyon\Applications\Auth\Models\User;
use Rezyon\Applications\Customer\Models\CustomerModel;
use Rezyon\Applications\Flights\Enums\StatusEnums;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class FlightCustomersDataTable extends DataTable
{
    protected int $flightId;

    public function __construct($flightId = null)
    {
        parent::__construct();
        $this->flightId = $flightId;
    }

    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('checkbox', function ($row) {
                return '<div class="form-check custom-checkbox ms-2">
                            <input type="checkbox" class="form-check-input" id="customCheckBox' . $row->id . '" name="selected[]" value="' . $row->id . '">
                            <label class="form-check-label" for="customCheckBox' . $row->id . '"></label>
                        </div>';
            })
            ->addColumn('status', function (CustomerModel $user) {
                $flight = $user->flight->first();
                $status = $flight->pivot->status;
                if ($status === StatusEnums::CHECKIN->value) {
                    return '<a href="#" class="btn btn-light me-1 shadow w-auto text-nowrap btn-md-xs btn-lg-xs disabled"><i class="fas fa-check me-2 me-md-0 me-lg-0" data-bs-toggle="tooltip" data-bs-placement="top" title="'.trans("flight.confirm_passenger_arrival").'"></i><span class="d-md-none d-lg-none">'.trans("flight.checkin").'</span></a>
                                <a href="#" class="btn btn-danger shadow w-auto text-nowrap btn-md-xs btn-lg-xs changeStatus" data-id="' . $flight->id . '" data-uid="' . $user->id . '" data-role="check_out" data-bs-toggle="tooltip" data-bs-placement="top" title="'.trans("flight.confirm_passenger_not_coming").'"><i class="fa fa-xmark me-2 me-md-0 me-lg-0"></i><span class="d-md-none d-lg-none">'.trans("flight.checkout").'</span></a>';
                } else {
                    return '<a href="#" class="btn btn-success me-1 shadow w-auto text-nowrap btn-md-xs btn-lg-xs changeStatus" data-id="' . $flight->id . '" data-uid="' . $user->id . '" data-role="check_in" data-bs-toggle="tooltip" data-bs-placement="top" title="'.trans("flight.confirm_passenger_arrival").'"><i class="fas fa-check me-2 me-md-0 me-lg-0"></i><span class="d-md-none d-lg-none">'.trans("flight.checkin").'</span></a>
                                <a href="#" class="btn btn-light shadow w-auto text-nowrap btn-md-xs btn-lg-xs disabled"><i class="fa fa-xmark me-2 me-md-0 me-lg-0" data-bs-toggle="tooltip" data-bs-placement="top" title="'.trans("flight.confirm_passenger_not_coming").'"></i><span class="d-md-none d-lg-none">'.trans("flight.checkout").'</span></a>';
                }
            })
            ->rawColumns(['checkbox', 'status'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param CustomerModel $model
     * @return QueryBuilder
     */
    public function query(CustomerModel $model): QueryBuilder
    {
        return $model->newQuery()->whereHas('flight', function ($query) {
            $query->where('flights.id', $this->flightId);
        });
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('flightcustomers-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->language(asset("assets/datatables/lang/".App::getLocale().".json"))
            ->orderBy(1)
            ->dom('Bfrtip')
            ->buttons([
                [
                    'text' => trans('flight.checkin_selected'), // Buton metni
                    'className' => 'btn btn-light disabled changeStatus check_in bulk-check-in', // Butona özel class
                    'action' => 'function () {
                                        // Burada butona tıklandığında yapılacak işlemleri tanımlayabilirsiniz
                                    }',
                ], [
                    'text' => trans('flight.checkout_selected'), // Buton metni
                    'className' => 'btn btn-light disabled changeStatus check_out bulk-check-out', // Butona özel class
                    'action' => 'function () {
                                        // Burada butona tıklandığında yapılacak işlemleri tanımlayabilirsiniz
                                    }',
                ],
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('checkbox')
                ->defaultContent('<div class="form-check custom-checkbox ms-2">
                                    <input type="checkbox" class="form-check-input" id="customCheckBox2">
                                    <label class="form-check-label" for="customCheckBox2"></label>
                                </div>')
                ->title('<div class="form-check custom-checkbox ms-2">
                            <input type="checkbox" class="form-check-input" id="checkAll">
                            <label class="form-check-label" for="checkAll"></label>
                        </div>')
                ->data('checkbox')
                ->name('checkbox')
                ->orderable(false)
                ->searchable(false)
                ->exportable(false)
                ->printable(true)
                ->width('10px'),
            Column::make('pnr')->title(trans('general.pnr')),
            Column::make('firstname')->title(trans('general.firstname')),
            Column::make('lastname')->title(trans('general.lastname')),
            Column::make('email')->title(trans('general.email')),
            Column::make('phone')->title(trans('general.phone')),
            Column::make('birthdate')->title(trans('general.birthdate')),
            Column::make('gender')->title(trans('general.gender')),
            Column::make('status')->title(trans('flight.checkin'))->addClass('d-flex justify-content-center w-auto'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'FlightCustomers_' . date('YmdHis');
    }
}
