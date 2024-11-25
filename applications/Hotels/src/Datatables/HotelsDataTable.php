<?php

namespace Rezyon\Applications\Hotels\Datatables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\App;
use Rezyon\Hotels\Enums\StatusEnum;
use Rezyon\Hotels\Models\Hotel;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class HotelsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'hotels.action')
            ->addColumn('user', function($row) {
                return $row->user->firstname.' '.$row->user->lastname;
            })
            ->addColumn('phone', function($row) {
                return phone($row->phone, $row->phone_country)->formatE164();
            })
            ->addColumn('actions', function($row){
                return view("applications.hotels::datatable-actions", ['id' => $row->id]);
            })
            ->editColumn('status', function($row) {
                return $row->status ? trans('general.active') : trans('general.inactive');
            })
            ->rawColumns(['status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Hotel $model): QueryBuilder
    {
        return $model->newQuery()->with('user', 'city', 'district');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('hotels-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->language(asset("assets/datatables/lang/".App::getLocale().".json"))
                    ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('user')->title(trans('Ekleyen')),
            Column::computed('name')->title(trans('general.name')),
            Column::computed('phone')->title(trans('general.phone')),
            Column::make('address')->title(trans('general.address')),
            Column::make('city.city_name')->title(trans('general.city')),
            Column::make('status')->title(trans('general.status')),
            Column::computed('actions')->title('#'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Hotels_' . date('YmdHis');
    }
}
