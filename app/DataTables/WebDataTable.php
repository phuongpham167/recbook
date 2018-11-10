<?php

namespace App\DataTables;

use App\User;
use App\Web;
use Carbon\Carbon;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class WebDataTable extends DataTable
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

        return $dataTable
            ->addColumn('image', function(Web $web) {
                if(!empty($web->image))
                    return "<img src='$web->image' width='100px' </img>";
                return '';
            })->addColumn('manage', function(Web $web) {
                return a('web/del', 'id='.$web->id,trans('g.delete'), ['class'=>'btn btn-xs btn-danger'],'#',"return bootbox.confirm('".trans('system.delete_confirm')."', function(result){if(result==true){window.location.replace('".asset('web/del?id='.$web->id)."')}})").'  '.a('web/edit', 'id='.$web->id,trans('g.edit'), ['class'=>'btn btn-xs btn-default']);
            })
            ->rawColumns(['manage','image']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $data   =   new Web();

        $name =   $this->name;
        $datefrom   =   $this->datefrom;
        $dateto   =   $this->dateto;

        $start  =   !empty($datefrom)?Carbon::createFromFormat('d/m/Y',$datefrom)->startOfDay():Carbon::now()->startOfMonth();
        $end    =   !empty($dateto)?Carbon::createFromFormat('d/m/Y',$dateto)->endOfDay():Carbon::now();

        if(!empty($department_id))
            $data   =   $data->where('name','LIKE','%'.$name.'%');

        return $data->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                            ->addColumn([
                                'title'  =>  trans('web.id'),
                                'data'  =>  'id'
                            ])
                            ->addColumn([
                                'title'  =>  trans('web.code'),
                                'data'  =>  'code'
                            ])
                            ->addColumn([
                                'title'  =>  trans('web.name'),
                                'data'  =>  'name'
                            ])
                            ->addColumn([
                                'title'  =>  trans('web.logo'),
                                'data'  =>  'image'
                            ])
                            ->addColumn([
                                'title'  =>  trans('web.address'),
                                'data'  =>  'address'
                            ])
                            ->addColumn([
                                'title'  =>  trans('web.phone'),
                                'data'  =>  'phone'
                            ])
                            ->addColumn([
                                'title'  =>  trans('web.fullname'),
                                'data'  =>  'fullname'
                            ])
                            ->addColumn([
                                'title'  =>  trans('web.datefrom'),
                                'data'  =>  'datefrom'
                            ])
                            ->addColumn([
                                'title'  =>  trans('web.dateto'),
                                'data'  =>  'dateto'
                            ])
                            ->addColumn([
                                'title'  =>  trans('web.manage'),
                                'data'=>'manage',
                                'exportable' => false,
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
            'add your columns',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'web_' . time();
    }
}
