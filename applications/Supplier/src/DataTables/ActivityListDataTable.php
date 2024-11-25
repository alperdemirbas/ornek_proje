<?php

namespace Rezyon\Applications\Supplier\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\App;
use Rezyon\Applications\Supplier\Enums\PermissionsEnum;
use Rezyon\Supplier\Enums\ActivityStatusEnum;
use Rezyon\Supplier\Models\Activity;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ActivityListDataTable extends DataTable
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
                return __($row->name);
            })
            ->addColumn('prices_all', function($row) {
                foreach($row->prices as $price) {
                    if($price->type === "ALL") {
                        return $price->price. ' ' .$row->currency->value;
                    }
                    return "0.00";
                }
                return "0.00";
            })
            ->addColumn('category_name', function($row) {
                return trans($row->category->categoryType->name);
            })
            ->addColumn('status', function($row) {
                if($row->status === ActivityStatusEnum::WAITING){
                    return '<span class="badge badge-warning">'.trans("activity.pending.status.".$row->status->value).'</span>';
                } else if($row->status === ActivityStatusEnum::INACTIVE) {
                    return '<span class="badge badge-danger">'.trans("activity.pending.status.".$row->status->value).'</span>';
                } else if($row->status === ActivityStatusEnum::REJECTED) {
                    return '<button class="badge badge-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$row->rejected_reason.'">'.trans("activity.pending.status.".$row->status->value).'</button>';
                } else {
                    return '<span class="badge badge-success">'.trans("activity.pending.status.".$row->status->value).'</span>';
                }
            })
            ->addColumn('subcategory_name', function($row) {
                return trans($row->category->name);
            })
            ->addColumn('actions', function($row){
                return view("applications.supplier::datatable-actions", ['row' => $row]);
            })
            ->rawColumns(['status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Activity $model): QueryBuilder
    {
        $request = $this->request();
        $query = $model->newQuery()->with([
            'prices',
            'category.categoryType',
            'closedDays'
        ]);

        if($request->has('data.status')) {
            $query->where('status', $request->input('data.status'));
        }

        if($request->has('search.value')) {
            $query->where('name','LIKE','%'.$request->input('search.value').'%');
        }

        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('activitylist-table')
                    ->columns($this->getColumns())
                    ->ajax([
                        'url' => _route('datatables.activity.list'),
                        'method' => 'GET',
                        'dataType' => "JSON",
                        'data' => "function(d){ d.data=activityFilter }"
                    ])
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
            Column::computed('name_default')->title(__('activity.name')),
            Column::computed('prices_all')->title(__('activity.price.title')),
            Column::computed('category_name')->title(__('activity.category')),
            Column::computed('subcategory_name')->title(__('activity.subcategory')),
            Column::computed('status')->addClass("text-center")->title(__('general.status')),
            Column::computed('actions')->addClass('d-flex justify-content-center')->title(__('general.actions')),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ActivityList_' . date('YmdHis');
    }
}
