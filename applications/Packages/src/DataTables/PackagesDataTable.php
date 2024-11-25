<?php

namespace Rezyon\Applications\Packages\DataTables;

use App\Models\Package;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\App;
use Rezyon\Packages\Models\Packages;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PackagesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('is_active_icon',function ($row){
                $class = ($row->is_active)?"success":"danger";
                return "<i class='fa fa-circle text-{$class}'></i>";
            })
            ->addColumn('actions', function($row){
                return view("applications.packages::list-datatables-actions", ['row' => $row]);
            })
            ->rawColumns(['is_active_icon']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Packages $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('packages-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax(route('packages.view.datatable'))
                    ->language(asset("assets/datatables/lang/".App::getLocale().".json"))
                    ->orderBy(0)
                    ->selectStyleSingle();

    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('name')->title(__('package.name')),
            Column::make('quarter_yearly_discount')->title(__('package.quarter_yearly_discount')),
            Column::make('half_yearly_discount')->title(__('package.half_yearly_discount')),
            Column::make('yearly_discount')->title(__('package.yearly_discount')),
            Column::make('fee')->title(__('package.fee')),
            Column::make('type')->title(__('package.type')),
            Column::make('is_active_icon')->addClass("text-center")->title(__('package.status')),
            Column::computed('actions')->title('#'),

        ];
    }

}
