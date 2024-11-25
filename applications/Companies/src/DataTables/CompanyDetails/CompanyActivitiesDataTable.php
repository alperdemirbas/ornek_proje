<?php

namespace Rezyon\Applications\Companies\DataTables\CompanyDetails;

use App\Models\CompanyActivity;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\App;
use Rezyon\Supplier\Enums\PriceTypes;
use Rezyon\Supplier\Models\Activity;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CompanyActivitiesDataTable extends DataTable
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
                return trans($row->name);
            })
            ->addColumn('prices_all', function($row) {
                foreach($row->prices as $price) {
                    if($price->type === PriceTypes::ALL) {
                        return $price->price. ' ' .$row->currency->value;
                    }
                    return "0.00";
                }
                return "0.00";
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Activity $model): QueryBuilder
    {
        return $model->newQuery()
            ->with([
                'prices',
                'category.categoryType',
                'closedDays'
            ])
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
            ->setTableId('company-activities-table')
            ->columns($this->getColumns())
            ->minifiedAjax(route('datatables.companies.activities'), '', ['id' => $id])
            ->language(asset("assets/datatables/lang/".App::getLocale().".json"))
            ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('name_default')->title(__('activity.name')),
            Column::computed('prices_all')->title(trans('activity.price.title')),
            Column::make('category.category_type.name')->title(trans('activity.category')),
            Column::make('category.name')->title(trans('activity.subcategory')),
            Column::make('status')->addClass("text-center")->title(trans('general.status')),
        ];
    }
}
