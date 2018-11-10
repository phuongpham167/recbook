<?php

namespace App\DataTables;

use App\RealEstate;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class RealEstatesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
//        $query = $query->with('reCategory', 'reType', 'province');
        $dataTable = new EloquentDataTable($query);
        return $dataTable
            ->addColumn('checkbox', function(RealEstate $dt) {
                return "<input type='checkbox'  class='deleteRow' value='". $dt->id ."'  />";
            })
            ->addColumn('posted_by', function (RealEstate $dt) {
                return $dt->user ? $dt->user->name : '';
            })
            ->addColumn('category', function(RealEstate $dt) {
                return $dt->reCategory ? $dt->reCategory->name : '';
            })
            ->addColumn('re_type', function(RealEstate $dt) {
                return $dt->reType ? $dt->reType->name : '';
            })
            ->addColumn('province', function(RealEstate $dt) {
                return $dt->province ? $dt->province->name : '';
            })
            ->addColumn('action', function($dt) {
                return a('real-estate/delete', 'id='.$dt->id,trans('g.delete'), ['class'=>'btn btn-xs btn-danger'],'#',
                    "return bootbox.confirm('".trans('system.delete_confirm')."', function(result){if(result==true){window.location.replace('".asset('real-estate/delete?id='.$dt->id)."')}})").'  '.a('real-estate/edit',
                    'id='.$dt->id,trans('g.edit'), ['class'=>'btn btn-xs btn-default']);
            })->rawColumns(['action', 'checkbox']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(RealEstate $model)
    {
        return $model->newQuery()->select($this->getColumns());
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->addCheckbox()
//                    ->columns($this->getColumns())
                    ->addColumn([
                        'title'  =>  trans('real-estate.list.column.id'),
                        'data'  =>  'id'
                    ])
                    ->addColumn([
                        'title'  =>  trans('real-estate.list.column.title'),
                        'data'  =>  'title'
                    ])
                    ->addColumn([
                        'title'  =>  trans('real-estate.list.column.posted_by'),
                        'data'  =>  'posted_by'
                    ])
                    ->addColumn([
                        'title'  =>  trans('real-estate.list.column.post_date'),
                        'data'  =>  'post_date'
                    ])
                    ->addColumn([
                        'title'  =>  trans('real-estate.list.column.category'),
                        'data'  =>  'category'
                    ])
                    ->addColumn([
                        'title'  =>  trans('real-estate.list.column.type'),
                        'data'  =>  're_type'
                    ])
                    ->addColumn([
                        'title'  =>  trans('real-estate.list.column.province'),
                        'data'  =>  'province'
                    ])
                    ->minifiedAjax()
                    ->addAction(['width' => '80px'])
                    ->parameters([
                        'dom'     => 'Bfrtip',
                        'order'   => [[1, 'desc']],
                        'buttons' => [
                            'excel',
                            'reload',
                        ],
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
            'id',
            'title',
            'short_description',
            'post_date',
            're_category_id',
            're_type_id',
            'province_id',
            'posted_by'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'real_estates_' . time();
    }
}
