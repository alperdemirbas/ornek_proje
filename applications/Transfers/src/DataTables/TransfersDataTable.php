<?php

namespace Rezyon\Applications\Transfers\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\App;
use Rezyon\Transfers\Models\Transfers;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TransfersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('user', function($row) {
                return merge($row->user->firstname, $row->user->lastname);
            })
            ->addColumn('datetime', function($row) {
                return merge($row->date->format('Y-m-d'), $row->time->format('H:i'));
            })
            ->addColumn('activity', function($row) {
                return trans($row->activity->name);
            })
            ->addColumn('hotel', function($row) {
                return $row->hotel->name;
            })
            ->addColumn('car', function($row) {
                return trans($row->car->name);
            })
            ->addColumn('session', function($row) {
                return merge('-', $row->session->start_time->format('H:i'), $row->session->end_time->format('H:i'));
            })
            ->addColumn('driver_phone', function($row) {
                return phoneFormat($row->driver_phone, $row->driver_phone_country);
            })
            ->addColumn('action', function($row) {
                return view('applications.transfers::transfers.datatables-actions', compact('row'));
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Transfers $model): QueryBuilder
    {
        return $model->newQuery()->withWhereHas('user', function($query) {
            $query->select('id', 'companies_id', 'firstname', 'lastname');
            $query->where('companies_id', request()->user()->companies_id);
        })->with(['activity:id,name,views', 'hotel:id,name', 'car:id,name', 'session:id,start_time,end_time']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('transfers-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->language(asset("assets/datatables/lang/".App::getLocale().".json"))
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
            Column::computed('user')->title(trans('Ekleyen')),
            Column::computed('activity')->title(trans('Aktivite')),
            Column::computed('hotel')->title(trans('Buluşma Yeri')),
            Column::computed('session')->title(trans('Aktivite Seansı')),
            Column::computed('car')->title(trans('Araç')),
            Column::computed('datetime')->title(trans('Buluşma Zamanı')),
            Column::make('driver_name')->title(trans('Sürücü Adı')),
            Column::computed('driver_phone')->title(trans('Sürücü Telefonu')),
            Column::computed('action')->title(trans('general.action'))->className('d-flex justify-content-center text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Transfers_' . date('YmdHis');
    }
}
