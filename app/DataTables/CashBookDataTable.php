<?php

namespace App\DataTables;

use App\Receipt;
use App\User;
use App\Web;
use Carbon\Carbon;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class CashBookDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $query  =   $query->with('receipt_type');

        $dataTable = new EloquentDataTable($query);

        $dataTable = $dataTable
            ->addColumn('receipt_types_id', function(Receipt $receipt) {
                return $receipt->receipt_type->name;
            })->addColumn('type', function(Receipt $receipt) {
                if($receipt->type == 'chi')
                    return '-';
                else
                    return '+';
            })->addColumn('value', function(Receipt $receipt) {
                return number_format($receipt->value).' '.$receipt->account()->first()->currency()->first()->icon;
            });

        if(get_web_id() == 1) {
            $dataTable = $dataTable->addColumn('web_id', function(Receipt $receipt) {
                return Web::find($receipt->web_id)->name;
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
        $data   =   new Receipt();

        $id   =   $this->id;
        $datefrom   =   $this->datefrom;
        $dateto   =  $this->dateto;
        $start  =   !empty($datefrom)?Carbon::createFromFormat('d/m/Y',$datefrom)->startOfDay():Carbon::now()->startOfMonth();
        $end    =   !empty($dateto)?Carbon::createFromFormat('d/m/Y',$dateto)->endOfDay():Carbon::now();

        $data   =   $data->where('time', '>=', $start)->where('time', '<=', $end);

        $data   =   $data->where('account_id',$id);
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
                'title'  =>  trans('receipts.timeTrade'),
                'data'  =>  'time'
            ])
            ->addColumn([
                'title'  =>  trans('receipts.ticketNum'),
                'data'  =>  'code'
            ])
            ->addColumn([
                'title'  =>  trans('receipts.ticketType'),
                'data'  =>  'type'
            ])
            ->addColumn([
                'title'  =>  trans('receipts.ticketReceiptType'),
                'data'  =>  'receipt_types_id'
            ])
            ->addColumn([
                'title'  =>  trans('receipts.ticketValue'),
                'data'  =>  'value'
            ])
            ->minifiedAjax($url = '', $script = null, $data = [
                'id' => $this->id,
                'datefrom' => $this->datefrom,
                'dateto' => $this->dateto,
            ])
            //                    ->addAction(['width' => '80px'])
            ->parameters([
                'dom'     => 'Bfrtip',
                'order'   => [[0, 'asc']],
                'buttons' => [
                    'excel',
                    'print',
                    'reload'
                ]
            ]);

        if(get_web_id() == 1)
        {
            $data = $data->addColumn([
                'title'  =>  trans('receipts.web_id'),
                'data'  =>  'web_id'
            ]);
        }

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
            'time',
            'code',
            'type',
            'receipt_types_id',
            'value'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'cashbook_' . time();
    }
}
