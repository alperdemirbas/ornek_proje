<?php

namespace Rezyon\Applications\Supplier\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Rezyon\TourismCompany\Enums\ActivityStatus;
use Rezyon\TourismCompany\Models\TourismCompanyActivity;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PoolPendingDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('company_name', function($row) {
                return __($row->company->name);
            })
            ->addColumn('activity_name', function($row) {
                return __($row->activity->name);
            })
            ->addColumn('actions', function($row){
                return view("applications.supplier::pool.pending-datatable-actions", ['id' => $row->id]);
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(TourismCompanyActivity $model): QueryBuilder
    {
        return $model->newQuery()
            ->where('status', ActivityStatus::WAITING_APPROVE)
            ->whereHas('activity', function($query) {
                $query->select(['id', 'name', 'companies_id']);
                $query->where('companies_id', Auth::user()->company->id);
            })
            ->with(['company:id,name']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('pool-pending-table')
            ->columns($this->getColumns())
            ->minifiedAjax(_route('datatables.activity.pool.pending.list'))
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
            Column::computed('activity_name')->title(__('activity.name')),
            Column::computed('company_name')->title(__('company.name')),
            Column::make('created_at')->title(__('general.created_at')),
            Column::computed('actions')->addClass("d-flex justify-content-center")->title(__('general.action')),
        ];
    }
}
