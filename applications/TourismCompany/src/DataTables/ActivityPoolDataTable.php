<?php

namespace Rezyon\Applications\TourismCompany\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Rezyon\Supplier\Enums\ActivityStatusEnum;
use Rezyon\TourismCompany\Enums\ActivityStatus;
use Rezyon\TourismCompany\Models\TourismCompanyActivity;
use Rezyon\Supplier\Models\Activity;
use Rezyon\TourismCompany\Repositories\TourismCompanyActivitiesRepository;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ActivityPoolDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('name_default', function ($row) {
                return __($row->activity->name);
            })
            ->addColumn('status', function ($row) {
                if($row->status === ActivityStatus::PASSIVE) {
                    return '<span class="badge badge-danger">'.trans("general.".strtolower($row->status->value)).'</span>';
                } else if($row->status === ActivityStatus::WAITING_APPROVE) {
                    return '<button class="badge badge-warning">'.trans("general.".strtolower($row->status->value)).'</button>';
                } else {
                    return '<span class="badge badge-success">'.trans("general.".strtolower($row->status->value)).'</span>';
                }
            })
            ->addColumn('prices_all', function ($row) {
                foreach ($row->activity->prices as $price) {
                    if ($price->type === "ALL") {
                        return $price->price . ' ' . $row->activity->currency->value;
                    }
                    return "0.00";
                }
                return "0.00";
            })
            ->addColumn('actions', function ($row) {
                return view("applications.tourism::datatable-actions", ['row' => $row]);
            })
            ->addColumn('category', function ($row) {
                return __($row->activity->category->categoryType->name);
            })
            ->addColumn('subCategory', function ($row) {
                return __($row->activity->category->name);
            })
            ->addColumn('profitability', function ($row) {
                return '%'.$row->profitability;
            })
            ->addColumn('total_price', function ($row) {
                foreach ($row->activity->prices as $price) {
                    if ($price->type === "ALL") {
                        return $price->price + ($price->price / 100 * $row->profitability) . ' ' . $row->activity->currency->value;
                    }
                    return "0.00";
                }
                return "0.00";
            })
            ->rawColumns(['status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(
        TourismCompanyActivity $model
    ): QueryBuilder
    {
        $request = $this->request();
        $query = $model->newQuery()
            ->where('companies_id', Auth::user()->company->id)
            ->with([
                'activity:id,name,currency,status,activity_category_id',
                'activity.category.categoryType',
                'specialDays',
                'closedDays'
            ]);

        if ($request->has('data.status')) {
            $query->where('status', $request->input('data.status'));
        }

        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('activitypool-table')
            ->columns($this->getColumns())
            //->minifiedAjax()
            ->ajax([
                'url' => _route('datatables.activity.pool.list'),
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
            Column::computed('profitability')->title(__('activity.add.pool.profit_rate')),
            Column::computed('total_price')->title(__('activity.add.pool.total')),
            Column::computed('prices_all')->title(__('activity.price.title')),
            Column::computed('category')->title(__('activity.category')),
            Column::computed('subCategory')->title(__('activity.subcategory')),
            Column::computed('status')->addClass("text-center")->title(__('general.status')),
            Column::computed('actions')->addClass("d-flex justify-content-center")->title(__('general.action')),
        ];
    }
}
