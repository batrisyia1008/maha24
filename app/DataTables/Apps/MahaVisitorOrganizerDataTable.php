<?php

namespace App\DataTables\Apps;

use App\Models\Apps\Visitor;
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
            ->addColumn('formatted_name', function ($item) {
                $lastSixDigits = substr($item->ic_number, -6);
                return $item->name . ' (' . $lastSixDigits . ')';
            })
            ->rawColumns(['created_date', 'action', 'formatted_name'])
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
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ])
                    ->parameters([
                        'dom' => '<"row mx-1"<"col-sm-12 col-md-3" l><"col-sm-12 col-md-9"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center flex-wrap me-1"<"me-3"f>B>>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                        'buttons' => [
                            [
                                'extend' => 'collection',
                                'text' => '<i class="fa fa-download"></i> Export',
                                'className' => 'btn btn-primary dropdown-toggle mb-3 mb-md-0 waves-effect waves-light',
                                'buttons' => [
                                    ['extend' => 'excel', 'text' => 'Export to Excel'],
                                    ['extend' => 'csv', 'text' => 'Export to CSV'],
                                    ['extend' => 'pdf', 'text' => 'Export to PDF'],
                                    ['extend' => 'print', 'text' => 'Print'],
                                ],
                            ],
                            [
                                'extend' => 'reload',
                                'text' => '<i class="fa fa-refresh"></i> Reload',
                                'className' => 'btn btn-secondary mb-3 mb-md-0 waves-effect waves-light',
                            ]
                        ],
                    ]);
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
            Column::make('formatted_name')->title('Name (Last 6 Digits)')
                    ->exportable(false),
            Column::computed('created_date')
                    ->exportable(false)
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
