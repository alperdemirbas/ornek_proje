<?php

namespace Rezyon\Applications\Transfers\DataTables;

use App\Models\TransferUser;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\App;
use Rezyon\Transfers\Models\TransferUsers;
use Rezyon\Users\Enums\Types;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TransferUsersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('user', function($row) {
                return merge($row->user->firstname, $row->user->lastname);
            })
            ->addColumn('hotel', function($row) {
                return $row->user->hotel->name ?? 'Bulunduğu Otel Yok';
            })
            ->addColumn('action', function($row) {
                return "<button type='button' class='btn btn-primary btn-xs' ><i class='fa-solid fa-xmark me-2'></i>Görevliyi Kaldır</button>";
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(TransferUsers $model): QueryBuilder
    {
        return $model->newQuery()
            ->where('transfers_id', $this->request->route('transfer'))
            ->withWhereHas('user')
            ->with('user.hotel');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('transferusers-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax(_route('datatables.transfers.users', ['transfer' => $this->request->route('transfer')]))
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->language(asset("assets/datatables/lang/".App::getLocale().".json"))
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('user')->title(trans('Ad & Soyad')),
            Column::computed('hotel')->title(trans('Otel')),
            Column::computed('action')->title(trans('general.action')),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'TransferUsers_' . date('YmdHis');
    }
}
