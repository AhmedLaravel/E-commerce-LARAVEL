<?php

namespace App\DataTables;

use App\Subscribe;
use Yajra\DataTables\Services\DataTable;

class SubscribeDataTables extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('checkbox', 'admin.subscribe.btn.checkbox')
            ->addColumn('delete', 'admin.subscribe.btn.delete')
            ->rawColumns([
                'delete',
                'checkbox',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Subscribe::query();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->addAction(['width' => '80px'])
                    //->parameters($this->getBuilderParameters());
                    ->parameters(
                        [
                            'dom'=>'Blfrtip',
                            'lengthMenu'=>[[10,25,50,100],[10,25,50,trans('admin.all_record')]],
                            'buttons' =>[
                                [
                                    'text'=>'<i class = "fa fa-plus">'.trans('admin.email_all').'</i>','className'=>'btn btn-info','action'=>'function(){
                                        window.location.href = "'.\URL::current().'/email/subscribers";
                                    }',
                                ],
                                ['extend'=>'print','className'=>'btn btn-primary', 'text'=>'<i class = "fa fa-print"></i>'],
                                ['extend'=>'csv','className'=>'btn btn-info', 'text'=>'<i class = "fa fa-file"></i> '.trans('admin.export_csv').''],
                                ['extend'=>'excel','className'=>'btn btn-success', 'text'=>'<i class = "fa fa-file"></i> '.trans('admin.export_excel').''],
                                [
                                    'text'=>'<i class = "fa fa-trash">'.trans('admin.delete_all').'</i>','className'=>'btn btn-danger delBtn', 
                                ],
                                ['extend'=>'reload','className'=>'btn btn-default', 'text'=>'<i class = "fa fa-refresh"></i> '],
                                /*
                                    export_excel
                                    export_csv
                                    create_admin
                                */

                            ],
                            'initComplete' => "function () {
                                this.api().columns([1,2]).every(function () {
                                    var column = this;
                                    var input = document.createElement(\"input\");
                                    $(input).appendTo($(column.footer()).empty())
                                    .on('keyup', function () {
                                        column.search($(this).val(), false, false, true).draw();
                                    });
                                });
                            }",

                            'language'=>languageData(),

                        ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'name'=>'id',
                'data' =>'id',
                'title' => trans('admin.id'),
            ],
            [
                'name'=>'email',
                'data'=>'email',
                'title' => trans('admin.email'),
            ],
            [
                'name'=>'name',
                'data'=>'name',
                'title' => trans('admin.nam_user'),
            ],
            [
                'name' => 'created_at',
                'data' => 'created_at',
                'title' => trans('admin.created_at'),
            ], 
            [
                'name' => 'updated_at',
                'data' => 'updated_at',
                'title' => trans('admin.updated_at'),
            ],
            [
                'name' => 'delete',
                'data' => 'delete',
                'title' => trans('admin.delete'),
                'exportable'=>false,
                'orderable'=>false,
                'printable'=>false,
                'searchable'=>false,
            ],
            [
                'name' => 'checkbox',
                'data' => 'checkbox',
                'title' =>'<input type = "checkbox" class = "check_all" onclick = "check_all()"  />',
                'exportable'=>false,
                'orderable'=>false,
                'printable'=>false,
                'searchable'=>false,
            ],
            

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'AdminDataTables_' . date('YmdHis');
    }
}
