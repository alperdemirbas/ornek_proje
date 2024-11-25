<?php

namespace Rezyon\Applications\Companies\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\App;
use Rezyon\Companies\Models\Companies;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CompanyDomainDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn("created_at", function ($row) {
                return $row->created_at->format('Y-m-d');
            })
            ->editColumn("domain", function ($row) { return $row->domain.".rezyon.com"; });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Companies $model): QueryBuilder
    {
        return $model->newQuery()->select(["domain", "name", "created_at"]);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('domains-table')
            ->columns($this->getColumns())
            ->minifiedAjax(route('datatables.domain.list'))
            ->orderBy(0)
            ->language(asset("assets/datatables/lang/".App::getLocale().".json"))
            ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('domain')->name('Domain'),
            Column::make('name')->title("Firma Adı"),
            Column::make('created_at')->title("Oluşturma Tarihi")
        ];
    }

}
