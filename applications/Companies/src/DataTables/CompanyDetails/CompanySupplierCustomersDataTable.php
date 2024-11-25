<?php

namespace Rezyon\Applications\Companies\DataTables\CompanyDetails;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\App;
use Rezyon\TourismCompany\Models\TourismCompanyActivity;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CompanySupplierCustomersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('company_phone', function ($row){
                return phone($row->company->phone, $row->company->phone_country)->formatE164();
            })
            ->addColumn('activity_name', function ($row){
                return trans($row->activity->name);
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(TourismCompanyActivity $model): QueryBuilder
    {
        return $model->newQuery()->with([
            'activity' => function ($query) {
                $query->select('id', 'companies_id', 'name');
                $query->where('companies_id', $this->request->get('id'));
            },
            'company:id,name,phone,phone_country,email,domain']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        $id = $this->request->route('id');
        return $this->builder()
            ->addTableClass('table-striped w-100')
            ->setTableId('company-supplier-customers-table')
            ->columns($this->getColumns())
            ->minifiedAjax(route('datatables.companies.supplier.customers'), '', ['id' => $id])
            ->language(asset("assets/datatables/lang/".App::getLocale().".json"))
            ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('company.name')->title(trans('company.name')),
            Column::computed('company_phone')->title(trans('general.phone')),
            Column::make('company.email')->title(trans('general.email')),
            Column::make('company.domain')->title(trans('company.domain')),
            Column::computed('activity_name')->title(trans('activity.name')),
        ];
    }
}
