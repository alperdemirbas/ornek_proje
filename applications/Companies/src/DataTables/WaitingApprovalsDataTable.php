<?php

namespace Rezyon\Applications\Companies\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\App;
use Rezyon\Companies\Models\Companies;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class WaitingApprovalsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('type', function($row) {
                return trans("company.".strtolower($row->type->value));
            })
            ->addColumn('action', function($row){
                return view("applications.companies::waiting-approval.datatables-actions", ['row' => $row]);
            })
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Companies $model): QueryBuilder
    {
        return $model->newQuery()->whereNull('domain');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('waitingapprovals-table')
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
            Column::make('name')->title(trans('company.name')),
            Column::make('email')->title(trans('general.email')),
            Column::make('phone')->title(trans('general.phone')),
            Column::make('type')->title(trans('subscription.type')),
            Column::make('created_at')->title(trans('company.app_date')),
            Column::computed('action')
                ->title(trans('general.action'))
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
        return 'WaitingApprovals_' . date('YmdHis');
    }
}
