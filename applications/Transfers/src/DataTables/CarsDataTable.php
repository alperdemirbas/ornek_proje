<?php

namespace Rezyon\Applications\Transfers\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\App;
use Rezyon\Transfers\Models\Cars;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CarsDataTable extends DataTable
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
            ->editColumn('name', function($row) {
                return trans($row->name);
            })
            ->addColumn('action', function($row) {
                return view('applications.transfers::cars.datatables-actions', compact('row'));
            })
            ->rawColumns(['name'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Cars $model): QueryBuilder
    {
        return $model->newQuery()->withWhereHas('user', function($query) {
            $query->select('id', 'companies_id', 'firstname', 'lastname');
            $query->where('companies_id', request()->user()->companies_id);
        });
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('cars-table')
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
            Column::computed('name')->title(trans('Araç Adı')),
            Column::make('capacity')->title(trans('Kapasite')),
            Column::make('number')->title(trans('Araç Numarası')),
            Column::make('user')->title(trans('Ekleyen')),
            Column::make('created_at')->title(trans('general.created_at')),
            Column::computed('action')->title(trans('general.action'))->className('d-flex justify-content-center text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Cars_' . date('YmdHis');
    }
}
