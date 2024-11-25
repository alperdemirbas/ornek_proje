<?php

namespace Rezyon\Applications\Companies\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\App;
use Rezyon\Companies\Enums\PaymentStatusesEnums;
use Rezyon\Companies\Models\Companies;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CompaniesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('phone', function ($row) {
                return "<a title='Arama için tıklayın' href='tel:+{$row->phone}'>{$row->phone}</a>";
            })
            ->editColumn('email',function($row){
                return "<a title='Email gönder' href='email:{$row->email}'>{$row->email}</a>";
            })
            ->addColumn('package_name', function ($row) {
                return $row->packages->last()->packages->name;
            })
            ->addColumn('package_payment', function ($row) {
                return __($row->packages->last()->payment_status->value);
            })
            ->addColumn('action', function($row){
                return view("applications.companies::list-datatables-actions", ['row' => $row]);
            })
            ->rawColumns(['phone','email'])
            ->filterColumn("payment_status", function ($data) { dd($data); })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Companies $model): QueryBuilder
    {
        $query = $model->newQuery()
            ->whereHas('packages', function ($query) {
                if(request()->has('data.package_id')){
                    $query->where('packages_id', request()->input('data.package_id'));
                }

                if (request()->has('data.payment_status')){
                    $query->where('payment_status', request()->input('data.payment_status'));
                }

                return $query
                    ->with('packages')
                    ->whereNotIn('companies_packages.payment_status', [
                    PaymentStatusesEnums::WAITING_VERIFICATION->value,
                    PaymentStatusesEnums::WAITING_APPROVAL->value
                ]);
            });

        if (request()->has('data.company_type')) {
            $query->where('type', request()->input('data.company_type'));
        }

        if (request()->has('data.package_type')) {
            $query->where('type', request()->get('data.company_type'));
        }

        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('companies-table')
            ->columns($this->getColumns())
            ->ajax([
                'url' => route('datatables.companies.list'),
                'method' => 'GET',
                'dataType' => "Json",
                'data' => "function(d){ d.data=company_filter_data }"
            ])
            ->addTableClass(['table','table-sm','table-bordered','table-striped','table-condensed','flip-content'])
            ->orderBy(1)
            ->language(asset("assets/datatables/lang/".App::getLocale().".json"))
            ->selectStyleSingle();

    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('name')->title(__("company.name")),
            Column::make('email')->title(__("general.email")),
            Column::make('phone')->title(__("general.phone")),
            Column::make('type')->title(__("company.type")),
            Column::make('domain')->title(__("company.domain"))->orderable(false),
            Column::make('package_name')->title(__("general.package")),
            Column::make('package_payment')->title(__("general.payment_status"))->orderable(false)->searchable(false),
            Column::computed('action')
                ->title(trans('general.action'))
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Companies_' . date('YmdHis');
    }
}
