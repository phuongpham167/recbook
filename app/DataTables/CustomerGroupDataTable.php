<?php

namespace App\DataTables;

use App\UserGroup;
use App\User;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class CustomerGroupDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $query   =   $query->with('customer');
        $dataTable = new EloquentDataTable($query);

        $dataTable = $dataTable
            ->editColumn('name', function(UserGroup $customerGroup){
                return !empty($customerGroup->name)?$customerGroup->name:'';
            })
            ->addColumn('count', function(UserGroup $customerGroup) {
                return $customerGroup->customers()->count();
            })
            ->addColumn('manage', function(UserGroup $customerGroup) {
                return a('khach-hang/nhom/del', 'id='.$customerGroup->id,trans('g.delete'), ['class'=>'btn btn-xs btn-danger'],'#',"return bootbox.confirm('".trans('system.delete_confirm')."', function(result){if(result==true){window.location.replace('".asset('system/customer/del?id='.$customerGroup->id)."')}})").' 
                 '.a('system/customer/edit', 'id='.$customerGroup->id,trans('g.edit'), ['class'=>'btn btn-xs btn-default']).' 
                  '.a('system/customer/care','id='.$customerGroup->id,trans('customer.care'), ['class'=>'btn btn-xs btn-info']);
            })->rawColumns(['manage','name','phone', 'source', 'email','type_id']);

        if(get_web_id() == 1) {
            $dataTable = $dataTable->addColumn('web_id', function(Customer $customer) {
                return Web::withTrashed()->find($customer->web_id)->name;
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
    public function query(User $model)
    {
        return $model->newQuery()->select('id', 'add-your-columns-here', 'created_at', 'updated_at');
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
                    ->addAction(['width' => '80px'])
                    ->parameters($this->getBuilderParameters());
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
        return 'CustomerGroup_' . date('YmdHis');
    }
}
