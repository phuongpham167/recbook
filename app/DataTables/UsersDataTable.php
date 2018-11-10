<?php

namespace App\DataTables;

use App\User;
use App\Web;
use Carbon\Carbon;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $query   =   $query->with('group','branch');
        $dataTable = new EloquentDataTable($query);

        $dataTable  =   $dataTable
            ->addColumn('manage', function(User $user) {
                return a('config/user/del', 'id='.$user->id,trans('g.delete'), ['class'=>'btn btn-xs btn-danger'],'#',"return bootbox.confirm('".trans('system.delete_confirm')."', function(result){if(result==true){window.location.replace('".asset('config/user/del?id='.$user->id)."')}})").'  '.a('config/user/edit', 'id='.$user->id,trans('g.edit'), ['class'=>'btn btn-xs btn-default']);
            })
            ->addColumn('group', function(User $user) {
                return $user->group->name;
            })
            ->addColumn('branch', function(User $user) {
                return $user->branch->name;
            })->rawColumns(['manage']);

        if(get_web_id() == 1) {
            $dataTable = $dataTable->addColumn('web_id', function(User $user) {
                return Web::find($user->web_id)->name;
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
        $data   =   new User();

        $user_id   =   $this->user_id;
        $datefrom   =   $this->datefrom;
        $dateto   =   $this->dateto;

        $start  =   !empty($datefrom)?Carbon::createFromFormat('d/m/Y',$datefrom)->startOfDay():Carbon::now()->startOfMonth();
        $end    =   !empty($dateto)?Carbon::createFromFormat('d/m/Y',$dateto)->endOfDay():Carbon::now();

        $data   =   $data->where('created_at', '>=', $start)->where('created_at', '<=', $end);

        if(!empty($user_id))
            $data   =   $data->where('id', $user_id);

        return $data;
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
                'title'  =>  trans('users.name'),
                'data'  =>  'name'
            ])
            ->addColumn([
                'title'  =>  trans('users.email'),
                'data'  =>  'email'
            ])
            ->addColumn([
                'title'  =>  trans('users.group'),
                'data'  =>  'group'
            ])
            ->addColumn([
                'title'  =>  trans('users.branch'),
                'data'  =>  'branch'
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
                'title'  =>  trans('users.web_id'),
                'data'  =>  'web_id'
            ]);
        }

        $data = $data->addColumn([
            'title'  =>  trans('users.manage'),
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
            'id',
            'name',
            'email',
            'group_id',
            'branch_id'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'users_' . time();
    }
}
