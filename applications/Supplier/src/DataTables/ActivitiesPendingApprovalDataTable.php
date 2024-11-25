<?php

namespace Rezyon\Applications\Supplier\DataTables;

use App\Models\ActivitiesPendingApproval;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\App;
use Rezyon\Supplier\Activity;
use Rezyon\Supplier\Enums\ActivityStatusEnum;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ActivitiesPendingApprovalDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('name', function($row) {
                return trans($row->name);
            })
            ->addColumn('status', function($row) {
                return trans("activity.pending.status.".$row->status->value);
            })
            ->addColumn('action', function($row){
                return view("applications.supplier::pending-approve.datatable-actions", ['row' => $row]);
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(\Rezyon\Supplier\Models\Activity $model): QueryBuilder
    {
        return $model->newQuery()->with('company')
            ->where('status', ActivityStatusEnum::WAITING);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('activities-pending-approval-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->language(asset("assets/datatables/lang/".App::getLocale().".json"))
                    ->orderBy(1)
                    ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::computed('name')->title(trans('activity.name')),
            Column::make('company.name')->title(trans('company.name')),
            Column::computed('status')->title(trans('general.status')),
            Column::computed('action')->title(trans('general.action'))->className('d-flex justify-content-center'),
        ];
    }
}
