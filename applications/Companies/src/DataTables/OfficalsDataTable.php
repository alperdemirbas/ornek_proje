<?php

namespace Rezyon\Applications\Companies\DataTables;

use App\Models\Offical;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\App;
use Rezyon\Companies\Models\CompanyOfficials;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class OfficalsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($row){
                return view('applications.companies::officials.list-datatable-actions',['id'=>$row->id]);
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(CompanyOfficials $model,$id=null): QueryBuilder
    {
        if (empty($id)){
            return $model->newQuery();
        }
        return  $model->newQuery()->where('companies_id',$id);

    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        $id = $this->request()->route('id');
        return $this->builder()
                    ->setTableId('officals-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax(route('datatables.companies.officials.list',['id'=>$id]))
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
            Column::make('first_name'),
            Column::make('last_name'),
            Column::make('email'),
            Column::make('title'),
            Column::make('phone'),
            Column::computed('action'),
        ];
    }
}
