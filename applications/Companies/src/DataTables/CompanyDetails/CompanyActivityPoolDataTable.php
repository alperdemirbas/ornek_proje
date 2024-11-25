<?php

namespace Rezyon\Applications\Companies\DataTables\CompanyDetails;

use App\Models\CompanyActivityPool;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\App;
use Rezyon\TourismCompany\Models\TourismCompanyActivity;
use Rezyon\Users\Enums\Types;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CompanyActivityPoolDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('name_default', function($row) {
                return trans($row->activity->name);
            })
            ->addColumn('status', function($row) {
                return trans('general.' . strtolower($row->status->value));
            })
            ->addColumn('profitability', function($row) {
                return '%'.$row->profitability;
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(TourismCompanyActivity $model): QueryBuilder
    {
        return $model->newQuery()
            ->with('activity:id,name')
            ->where('companies_id', $this->request->get('id'));
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        $id = $this->request->route('id');
        return $this->builder()
            ->addTableClass('table-striped w-100')
            ->setTableId('company-activity-pool-table')
            ->columns($this->getColumns())
            ->minifiedAjax(route('datatables.companies.activity.pool'), '', ['id' => $id])
            ->language(asset("assets/datatables/lang/".App::getLocale().".json"))
            ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('name_default')->title(trans('activity.name')), //@todo tıklayınca aktivite detayına gitmeli
            Column::computed('profitability')->title(trans('activity.add.pool.profit_rate')),
            Column::make('status')->title(trans('general.status')),
        ];
    }
}
