<?php

namespace Rezyon\Applications\Users\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Rezyon\Users\Enums\Types;
use Rezyon\Users\Models\Users;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action',function($row){
                return view('applications.users::list-datatables-actions',['id'=>$row->id]);
            })
            ->addColumn('role',function ($row){
                $names = data_get($row->roles,'*.name');
                return implode(',',$names);
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Users $model): QueryBuilder
    {
        return $model->newQuery()
            ->whereNot('id',Auth::user()->id)
            ->where('type',Types::ADMIN);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax(route('admin.users.datatable.list'))
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
            Column::make('id')->title("#"),
            Column::make('firstname')->title(__('')),
            Column::make('lastname'),
            Column::make('email'),
            Column::computed('role'),
            Column::computed('action')
                ->title(trans('general.action'))
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

}
