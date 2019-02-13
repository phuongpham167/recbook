<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\FormCustomerRequest;
use App\ScheduleCustomer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \DataTables;
class ScheduleController extends Controller
{
    public function index(){
        return v('schedule.list');
    }
    public function dataList(){
        $data   =   ScheduleCustomer::with('customer');
        $data   =   $data->where('user_id', auth()->user()->id);

        if(!empty(\request('customer_id')) )
            $data   =   $data->where('customer_id', \request('customer_id'));
        $result = Datatables::of($data)
            ->addColumn('customer_id', function(ScheduleCustomer $scheduleCustomer){
                return $scheduleCustomer->customer->name;
            })
            ->addColumn('time', function(ScheduleCustomer $scheduleCustomer) {
                return Carbon::parse($scheduleCustomer->time)->format('d/m/Y');
            })->addColumn('manage', function(ScheduleCustomer $scheduleCustomer) {
                return a('khach-hang/lich-hen/xoa', 'id='.$scheduleCustomer->id,trans('g.delete'), ['class'=>'btn btn-xs btn-danger'],'#',"return bootbox.confirm('".trans('system.delete_confirm')."', function(result){if(result==true){window.location.replace('".asset('khach-hang/lich-hen/xoa?id='.$scheduleCustomer->id)."')}})").'  '.a('khach-hang/lich-hen/sua', 'id='.$scheduleCustomer->id,trans('g.edit'), ['class'=>'btn btn-xs btn-default']);
            })->rawColumns(['manage']);

        return $result->make(true);
    }

    public function getDelete(){
        $data   =   ScheduleCustomer::find(request('id'));
        if(!empty($data) && $data->user_id == auth()->user()->id){
            $data->delete();
            set_notice('Xoá lịch hẹn thành công!', 'success');
        } else set_notice('Lịch hẹn không tồn tại hoặc bạn không có quyền xoá!', 'warning');
        return redirect()->back();
    }

    public function getCreate(){
        return v('schedule.create');
    }
    public function postCreate()
    {
        $data   =   new ScheduleCustomer();
        $data->customer_id   =   \request('customer_id');
        $data->content   =    \request('content');
        $data->time   =    \request('time');
        $data->user_id  =   auth()->user()->id;
        $data->web_id   =   get_web_id();
        $data->created_at   =   Carbon::now();
        $data->save();
        event_log('Tạo lịch hẹn mới mới id '.$data->id);
        set_notice(trans('system.add_success'), 'success');
        return redirect()->back();
    }
    public function getEdit()
    {
        $data   =   ScheduleCustomer::find(request('id'));
        if(!empty($data) && $data->user_id == auth()->user()->id){
            event_log('Truy cập trang ['.trans('customer.edit').']');
            return v('schedule.edit', compact('data'));
        }else{
            set_notice("Lịch hẹn không tồn tại hoặc không thuộc quyền quản lý của bạn", 'warning');
            return redirect()->back();
        }
    }
    public function postEdit()
    {
        $data   =   ScheduleCustomer::find(request('id'));
        if(!empty($data) && $data->user_id == auth()->user()->id){
            $data->customer_id   =   \request('customer_id');
            $data->content   =    \request('content');
            $data->time   =    \request('time');
            $data->web_id   =   get_web_id();
            $data->save();
            event_log('Sửa lịch hẹn id '.$data->id);
            set_notice(trans('system.edit_success'), 'success');
        }else
            set_notice(trans('system.not_exist'), 'warning');
        return redirect()->back();
    }
}
