<?php

namespace App\DataTables;

use App\Category;
use App\JobDetails;
use App\User;
use App\Web;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class JobDetailsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $query  =   $query->with('category');

        $dataTable = new EloquentDataTable($query);

        $dataTable  =   $dataTable
            ->addColumn('manage', function(JobDetails $jobDetails) {
                $manage = null;
                if(auth()->user()->group_id == 1)
                    $manage .= a('jobdetails/del', 'id='.$jobDetails->id,trans('g.delete'), ['class'=>'btn btn-xs btn-danger'],'#',"return bootbox.confirm('".trans('system.delete_confirm')."', function(result){if(result==true){window.location.replace('".asset('jobdetails/del?id='.$jobDetails->id)."')}})").'  '.a('jobdetails/edit', 'id='.$jobDetails->id,trans('g.edit'), ['class'=>'btn btn-xs btn-default']).' ';
                if(auth()->user()->id == $jobDetails->executor_id)
                    $manage .= a('jobdetails/report', 'id='.$jobDetails->id,trans('g.report'), ['class'=>'btn btn-xs btn-primary']).' ';
                if(auth()->user()->group_id == 1 || auth()->user()->id == $jobDetails->executor->id )
                    $manage .= a('#a', 'id='.$jobDetails->id,trans('g.report-list'), ['class'=>'btn btn-xs btn-info btn-report-list', 'data-id'=>''.$jobDetails->id.'']).'  '.a('#a', 'id='.$jobDetails->id,trans('g.history-list'), ['class'=>'btn btn-xs btn-info btn-history-list', 'data-id'=>''.$jobDetails->id.'']);

                return $manage;
            })
            ->addColumn('status', function(JobDetails $jobDetails) {
                if (auth()->user()->id == $jobDetails->executor_id) {
                    return "<button type=\"button\" class=\"btn btn-xs btn-status\" data-container=\"body\" data-toggle=\"popover\" data-html='true' data-placement=\"bottom\" data-content=\"
                                <select class='form-control' name='status-change' id='status-change'>
                                <option value='Chưa thực hiện' ".($jobDetails->status=='Chưa thực hiện'?'selected':'').">Chưa thực hiện</option>
                                <option value='Đang thực hiện' ".($jobDetails->status=='Đang thực hiện'?'selected':'').">Đang thực hiện</option>
                                <option value='Hoàn thành' ".($jobDetails->status=='Hoàn thành'?'selected':'').">Hoàn thành</option>
                                <option value='Tạm dừng' ".($jobDetails->status=='Tạm dừng'?'selected':'').">Tạm dừng</option>
                                <option value='Hủy bỏ' ".($jobDetails->status=='Hủy bỏ'?'selected':'').">Hủy bỏ</option>
                            </select>
                            <label>Ghi chú:</label>
                            <br>
                            <textarea class='note' rows='4'></textarea>
                            <br>
                            <a class='btn btn-sm btn-primary btn-save-status' data-id='$jobDetails->id'>Lưu</a>
                            \">
                              $jobDetails->status
                            </button>";
                }
                else {
                    return $jobDetails->status;
                }
            })
            ->addColumn('category_id', function(JobDetails $jobDetails) {
                return Category::find($jobDetails->category_id)->name;
            })
            ->addColumn('user_id', function(JobDetails $jobDetails) {
                return $jobDetails->user->name;
            })
            ->addColumn('executor_id', function(JobDetails $jobDetails) {
                return $jobDetails->executor->name;
            })
            ->rawColumns(['manage','status']);

        if(get_web_id() == 1) {
            $dataTable = $dataTable->addColumn('web_id', function(JobDetails $jobDetails) {
                return Web::find($jobDetails->web_id)->name;
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
        $data   =   new JobDetails();

        $category_id =   $this->category_id;
        $executor_id =   $this->executor_id;
        $status =   $this->status;

        if(!empty($category_id))
            $data   =   $data->where('category_id', $category_id);

        if(!empty($status))
            $data   =   $data->where('status', $status);

        if(!empty($executor_id))
            $data   =   $data->where('executor_id', $executor_id);

        if(!p('viewall_users','get'))
            $data = $data->where('executor_id', auth()->user()->id);

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
                        'title'  =>  trans('jobdetails.user_id'),
                        'data'  =>  'user_id'
                    ])
                    ->addColumn([
                        'title'  =>  trans('jobdetails.executor_id'),
                        'data'  =>  'executor_id'
                    ])
                    ->addColumn([
                        'title'  =>  trans('jobdetails.details'),
                        'data'  =>  'details'
                    ])
                    ->addColumn([
                        'title'  =>  trans('jobdetails.category_id'),
                        'data'  =>  'category_id'
                    ])
                    ->addColumn([
                        'title'  =>  trans('jobdetails.status'),
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
                'title'  =>  trans('jobdetails.web_id'),
                'data'  =>  'web_id'
            ]);
        }

        $data = $data->addColumn([
            'title'  =>  trans('jobdetails.manage'),
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
            'user_id',
            'details',
            'category_id',
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
        return 'jobdetails_' . time();
    }
}
