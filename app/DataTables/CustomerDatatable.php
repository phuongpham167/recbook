<?php

namespace App\DataTables;

use App\Customer;
use App\User;
use App\Web;
use Carbon\Carbon;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class CustomerDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $query   =   $query->with('source','type');
        $dataTable = new EloquentDataTable($query);

        $dataTable = $dataTable
            ->editColumn('name', function(Customer $customer){
                return a('system/customer/care','id='.$customer->id,!empty($customer->name)?$customer->name:'', []);
            })
            ->editColumn('phone', function(Customer $customer){
                return a('system/customer/care','id='.$customer->id,!empty($customer->phone)?$customer->phone:trans('system.customer_no_phone'), []);
            })
            ->editColumn('email', function(Customer $customer){
                return a('system/customer/care','id='.$customer->id,!empty($customer->email)?$customer->email:trans('system.customer_no_email'), []);
            })
            ->addColumn('manage', function(Customer $customer) {
                return a('system/customer/del', 'id='.$customer->id,trans('g.delete'), ['class'=>'btn btn-xs btn-danger'],'#',"return bootbox.confirm('".trans('system.delete_confirm')."', function(result){if(result==true){window.location.replace('".asset('system/customer/del?id='.$customer->id)."')}})").' 
                 '.a('system/customer/edit', 'id='.$customer->id,trans('g.edit'), ['class'=>'btn btn-xs btn-default']).' 
                  '.a('system/customer/care','id='.$customer->id,trans('customer.care'), ['class'=>'btn btn-xs btn-info']);
            })
            ->addColumn('source', function(Customer $customer) {
                return a('system/customer/care','id='.$customer->id,!empty($customer->source->name)?$customer->source->name:trans('system.customer_no_source'), []);
            })
            ->addColumn('type_id', function(Customer $customer) {
                return a('system/customer/care','id='.$customer->id,!empty($customer->type->name)?$customer->type->name:trans('system.customer_no_type'), []);
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
    public function query(Customer $model)
    {
        $data   =   new Customer();

        $user_id   =   $this->user_id;
        $datefrom   =   $this->datefrom;
        $dateto   =   $this->dateto;
        $phone   =   $this->phone;
        $source_id   =   $this->source_id;
        $type_id   =   $this->type_id;

        $start  =   !empty($datefrom)?Carbon::createFromFormat('d/m/Y',$datefrom)->startOfDay():'';
        $end    =   !empty($dateto)?Carbon::createFromFormat('d/m/Y',$dateto)->endOfDay():'';

        if($start != '' && $end != '')
            $data   =   $data->where('created_at', '>=', $start)->where('created_at', '<=', $end);

        if(!empty($user_id))
            $data   =   $data->where('id', $user_id);
        if(!empty($phone))
            $data   =   $data->where('phone', $phone);
        if(!empty($source_id))
            $data   =   $data->where('source_id', $source_id);
        if(!empty($type_id))
            $data   =   $data->where('type_id', $type_id);

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
                'title'  =>  trans('customer.name'),
                'data'  =>  'name'
            ])
            ->addColumn([
                'title'  =>  trans('customer.phone'),
                'data'  =>  'phone'
            ])
            ->addColumn([
                'title'  =>  trans('customer.email'),
                'data'  =>  'email'
            ])
            ->addColumn([
                'title'  =>  trans('customer.source'),
                'data'  =>  'source'
            ])
            ->addColumn([
                'title'  =>  trans('customer.type'),
                'data'  =>  'type_id'
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
                'title'  =>  trans('customer.web_id'),
                'data'  =>  'web_id'
            ]);
        }

        $data = $data->addColumn([
            'title'  =>  trans('customer.manage'),
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
            'phone',
            'email',
            'source_id',
            'type_id'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'customers_' . time();
    }
}
