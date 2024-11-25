<?php

namespace Rezyon\Applications\Companies\DataTables\CompanyDetails;

use App\Models\CompanyOfficial;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\App;
use Rezyon\Companies\Models\CompanyOfficials;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CompanyOfficialsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('phone', function($row) {
                return phone($row->phone, $row->phone_country)->formatE164();
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(CompanyOfficials $model): QueryBuilder
    {
        return $model->newQuery()
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
            ->setTableId('company-officials-table')
            ->columns($this->getColumns())
            ->minifiedAjax(route('datatables.companies.officials'), '', ['id' => $id])
            ->language(asset("assets/datatables/lang/".App::getLocale().".json"))
            ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('first_name')->title(trans('general.firstname')),
            Column::make('last_name')->title(trans('general.lastname')),
            Column::make('email')->title(trans('general.email')),
            Column::computed('phone')->title(trans('general.phone')),
            Column::make('title')->title(trans('general.title')),
        ];
    }
}
