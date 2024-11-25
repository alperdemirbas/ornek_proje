<?php

namespace Rezyon\Applications\Companies\DataTables\CompanyDetails;

use App\Models\CompanyPackage;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\App;
use Rezyon\Companies\Models\Companies;
use Rezyon\Companies\Models\CompaniesPackages;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CompanyPackagesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('payment_frequency', function($row) {
                return trans('company.'.strtolower($row->payment_frequency->value));
            })
            ->addColumn('amount', function() {
                return number_format(100, 2);
            })
            ->addColumn('start_date', function($row) {
                return $row->start_date->format('d-m-Y');
            })
            ->addColumn('end_date', function($row) {
                return $row->end_date->format('d-m-Y');
            })
            ->addColumn('status', function($row) {
                return trans('package.'.strtolower($row->payment_status->value));
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(CompaniesPackages $model): QueryBuilder
    {
        return $model->newQuery()->with('packages')
            ->orderBy('start_date', 'desc')
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
            ->setTableId('company-packages-table')
            ->columns($this->getColumns())
            ->minifiedAjax(route('datatables.companies.packages'), '', ['id' => $id])
            ->language(asset("assets/datatables/lang/".App::getLocale().".json"))
            ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('packages.name')->title(trans('general.package_name')),
            Column::computed('payment_frequency')->title(trans('company.payment_frequency')),
            Column::computed('amount')->title(trans('general.amount')), //@todo buraya firmanın paket satın aldığında satın aldığı tutar gelecek.
            Column::computed('start_date')->title(trans('general.start')),
            Column::computed('end_date')->title(trans('general.end')),
            Column::computed('status')->title(trans('general.status')),
        ];
    }
}
