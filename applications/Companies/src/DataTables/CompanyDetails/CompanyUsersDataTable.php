<?php

namespace Rezyon\Applications\Companies\DataTables\CompanyDetails;

use App\Models\CompanyUser;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\App;
use Rezyon\Companies\Models\Users;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CompanyUsersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Users $model): QueryBuilder
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
            ->setTableId('company-users-table')
            ->columns($this->getColumns())
            ->minifiedAjax(route('datatables.companies.users'), '', ['id' => $id])
            ->language(asset("assets/datatables/lang/".App::getLocale().".json"))
            ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('firstname')->title(trans('general.firstname')),
            Column::make('lastname')->title(trans('general.lastname')),
            Column::make('email')->title(trans('general.email')),
        ];
    }
}
