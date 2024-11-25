<?php

namespace Rezyon\Applications\Flights\DataTables;

use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;
use Rezyon\Flights\Enums\FlightStatusEnums;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Rezyon\Flights\Models\Flights;

class FlightsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('status', function($row) {
                return __($row->status->value);
            })
            ->addColumn('action', function($row){
                return view("applications.flights::datatables_actions", ['row' => $row]);
            })
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Flights $model): QueryBuilder
    {
        return $model->newQuery();
    }


    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('flights-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->language(asset("assets/datatables/lang/".App::getLocale().".json"))
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('flight_number')->title(trans('flight.flight_number_short')),
            Column::make('detail')->title(trans('general.detail')),
            Column::make('departure_time')->title(trans('flight.departure_time')),
            Column::make('departure_airport')->title(trans('flight.departure_airport')),
            Column::make('arrival_time')->title(trans('flight.arrival_time')),
            Column::make('arrival_airport')->title(trans('flight.arrival_airport')),
            Column::make('return')->title(trans('flight.return_time')),
            Column::make('status')->title(trans('general.status')),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Flights_' . date('YmdHis');
    }
}
