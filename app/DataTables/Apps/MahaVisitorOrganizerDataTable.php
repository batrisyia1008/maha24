<?php

namespace App\DataTables\Apps;

use App\Models\Apps\Visitor;
use App\Models\MahaVisitorOrganizer;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MahaVisitorOrganizerDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($item) {
                return '
                        <a href="'.route('visitor.show', $item->id).'" class="btn btn-icon btn-sm btn-primary"><i class="ti ti-eye"></i></a>
                   ';
            })
            ->addColumn('created_date', function ($item) {
                return $item->created_at->format('d-M-Y, h:i A');
            })
            ->rawColumns(['created_date', 'action'])
            ->setRowId('id')
            ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Visitor $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('maha-visitor-organizer-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    /*->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ])*/;
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->width('1%')->addClass('text-center'),
            Column::make('uniq'),
            Column::make('name'),
            Column::make('email'),
            Column::make('phone'),
            Column::make('ic_number'),
            Column::make('total'),
            Column::computed('created_date')
                    ->width('15%'),
            Column::computed('action')
                    ->exportable(false)
                    ->printable(false)
                    ->width('10%'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'MahaVisitorOrganizer_' . date('YmdHis');
    }
}
