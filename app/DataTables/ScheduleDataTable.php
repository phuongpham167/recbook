<?php

namespace App\DataTables;

use App\Schedule;
use App\User;
use App\Web;
use Carbon\Carbon;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ScheduleDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $query   =   $query->with('user');
        $dataTable = new EloquentDataTable($query);

        $dataTable = $dataTable
            ->addColumn('manage', function(Schedule $schedule) {
                return a('system/schedule/del', 'id='.$schedule->id,trans('g.delete'), ['class'=>'btn btn-xs btn-danger'],'#',"return bootbox.confirm('".trans('system.delete_confirm')."', function(result){if(result==true){window.location.replace('".asset('system/schedule/del?id='.$schedule->id)."')}})").'  '.a('system/schedule/edit', 'id='.$schedule->id,trans('g.edit'), ['class'=>'btn btn-xs btn-default']);
            })
            ->addColumn('user_id', function(Schedule $schedule) {
                if(!empty($schedule->user_id))
                    return $schedule->user->name;
            })
            ->addColumn('status', function(Schedule $schedule) {
                if (auth()->user()->id == $schedule->user->id) {
                    return "<div class=\"dropdown\" style=\"margin-bottom: 10px\">
                            <button class=\"btn btn-xs dropdown-toogle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">$schedule->status
                                <span class=\"caret\"></span></button>
                            <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
                                <li><a class=\"dropdown-item\" href=\"".asset('system/schedule/status?id='.$schedule->id.'&value=Chưa thực hiện')."\">Chưa thực hiện</a></li>
                                <li><a class=\"dropdown-item\" href=\"".asset('system/schedule/status?id='.$schedule->id.'&value=Đang thực hiện')."\">Đang thực hiện</a></li>
                                <li><a class=\"dropdown-item\" href=\"".asset('system/schedule/status?id='.$schedule->id.'&value=Hoàn thành')."\">Hoàn thành</a></li>
                                <li><a class=\"dropdown-item\" href=\"".asset('system/schedule/status?id='.$schedule->id.'&value=Tạm dừng')."\">Tạm dừng</a></li>
                                <li><a class=\"dropdown-item\" href=\"".asset('system/schedule/status?id='.$schedule->id.'&value=Hủy bỏ')."\">Hủy bỏ</a></li>
                            </div>
                        </div>";
                }
                else {
                    return $schedule->status;
                }
            })
            ->rawColumns(['manage','status']);

        if(get_web_id() == 1) {
            $dataTable = $dataTable->addColumn('web_id', function(Schedule $schedule) {
                return Web::find($schedule->web_id)->name;
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
        $data   =   new Schedule();

        $datefrom   =   $this->datefrom;
        $dateto   =   $this->dateto;
        $user_id   =   $this->user_id;
        $status   =   $this->status;

        $start  =   !empty($datefrom)?Carbon::createFromFormat('d/m/Y',$datefrom)->startOfDay():Carbon::now()->startOfMonth();
        $end    =   !empty($dateto)?Carbon::createFromFormat('d/m/Y',$dateto)->endOfDay():Carbon::now();

        $data   =   $data->where('created_at', '>=', $start)->where('created_at', '<=', $end);

        if(!p('viewall_users','get'))
            $data = $data->where('user_id', auth()->user()->id);

        if(!empty($user_id))
            $data   =   $data->where('id', $user_id);

        if(!empty($status))
            $data   =   $data->where('status', $status);

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
                        'title'  =>  trans('schedule.name'),
                        'data'  =>  'name'
                    ])
                    ->addColumn([
                        'title'  =>  trans('schedule.time'),
                        'data'  =>  'time'
                    ])
                    ->addColumn([
                        'title'  =>  trans('schedule.user'),
                        'data'  =>  'user_id'
                    ])
                    ->addColumn([
                        'title'  =>  trans('schedule.content'),
                        'data'  =>  'content'
                    ])
                    ->addColumn([
                        'title'  =>  trans('schedule.status'),
                        'data'  =>  'status'
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
                'title'  =>  trans('schedule.web_id'),
                'data'  =>  'web_id'
            ]);
        }

        $data = $data->addColumn([
            'title'  =>  trans('schedule.manage'),
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
            'time',
            'user',
            'content',
            'status'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'schedule_' . time();
    }
}
