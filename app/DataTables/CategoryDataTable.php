<?php

namespace App\DataTables;

use App\Category;
use App\Department;
use App\Web;
use Carbon\Carbon;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class CategoryDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        $dataTable = $dataTable
            ->addColumn('manage', function(Category $category) {
                return a('system/category/del', 'id='.$category->id,trans('g.delete'), ['class'=>'btn btn-xs btn-danger'],'#',"return bootbox.confirm('".trans('system.delete_confirm')."', function(result){if(result==true){window.location.replace('".asset('system/category/del?id='.$category->id)."')}})").'  '.a('system/category/edit', 'id='.$category->id,trans('g.edit'), ['class'=>'btn btn-xs btn-default']);
            })
            ->addColumn('department_id', function(Category $category) {
                return Department::find($category->department_id)->name;
            })
            ->rawColumns(['manage']);

        if(get_web_id() == 1) {
            $dataTable = $dataTable->addColumn('web_id', function(Category $category) {
                return Web::find($category->web_id)->name;
            });
        }

        return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $data   =   new Category();

        $department_id =   $this->department_id;

        if(!empty($department_id))
            $data   =   $data->where('department_id', $department_id);

        return $data->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $data = $this->builder()
                                ->addColumn([
                                    'title'  =>  trans('category.name'),
                                    'data'  =>  'name'
                                ])
                                ->addColumn([
                                    'title'  =>  trans('category.note'),
                                    'data'  =>  'note'
                                ])
                                ->addColumn([
                                    'title'  =>  trans('category.department'),
                                    'data'  =>  'department_id'
                                ])
                                ->minifiedAjax()
                    //                    ->addAction(['width' => '80px'])
                                ->parameters([
                                    'dom'     => 'Bfrtip',
                                    'order'   => [[0, 'asc']],
                                    'buttons' => [
                                        'excel',
                                        'print',
                                        'reload',
                                    ],
                                ]);
        if(get_web_id() == 1)
        {
            $data = $data->addColumn([
                'title'  =>  trans('category.web_id'),
                'data'  =>  'web_id'
            ]);
        }

        $data = $data->addColumn([
            'title'  =>  trans('category.manage'),
            'data'=>'manage',
            'exportable' => false,
        ]);

        return $data;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'name',
            'note',
            'status',
            'manage'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'category_' . time();
    }
}
