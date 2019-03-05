<?php

namespace App\Http\Controllers;

use App\Customer;
use App\CustomerGroup;
use App\Http\Requests\CustomerGroupRequest;
use App\Http\Requests\FormCustomerRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \DataTables;
class CustomerController extends Controller
{
    public function dataList(){
        $data   =   Customer::with('type');
        $data   =   $data->where('user_id', auth()->user()->id);
        $result = Datatables::of($data)
            ->editColumn('name', function(Customer $customer){
                return "<a href='".route('customerCare', ['id'=>$customer->id])."'>".$customer->name."</a>";
            })
            ->editColumn('phone', function(Customer $customer){
                return "<a href='".route('customerCare', ['id'=>$customer->id])."'>".$customer->phone."</a>";
            })
            ->addColumn('type', function(Customer $customer) {
                return $customer->type?$customer->type->name:'-';
            })->addColumn('manage', function(Customer $customer) {
                return a('khach-hang/xoa', 'id='.$customer->id,trans('g.delete'), ['class'=>'btn btn-xs btn-danger'],'#',"return bootbox.confirm('".trans('system.delete_confirm')."', function(result){if(result==true){window.location.replace('".asset('khach-hang/xoa?id='.$customer->id)."')}})").'  '.a('khach-hang/sua', 'id='.$customer->id,trans('g.edit'), ['class'=>'btn btn-xs btn-default']);
            })->rawColumns(['manage', 'name', 'phone']);

        return $result->make(true);
    }
    public function getDelete(){
        $data   =   Customer::find(request('id'));
        if(!empty($data) && $data->user_id == auth()->user()->id){
            $data->delete();
            set_notice('Xoá khách hàng thành công!', 'success');
        } else set_notice('Khách hàng không tồn tại hoặc bạn không có quyền xoá!', 'warning');
        return redirect()->back();
    }
    public function getCreate(){
        return v('customer.create');
    }
    public function postCreate(FormCustomerRequest $request)
    {
        $data   =   new Customer();
        $data->name   =   $request->name;
        $data->gender   =   $request->gender;
        $data->phone   =   $request->phone;
        $data->address   =   $request->address;
        $data->province_id   =   $request->province_id;
        $data->district_id   =   $request->district_id;
        $data->ward_id   =   $request->ward_id;
        $data->source_id   =   $request->source_id;
        $data->type_id   =   $request->type_id;
        $data->email   =   $request->email;
        $data->user_id  =   auth()->user()->id;
        if(!empty($phone    =   request('phone')) && !empty($origin=Customer::where('origin_id', 0)->withoutGlobalScopes()->where('phone',$phone)->first())){
            $data->origin_id    =   $origin->id;
            if($origin->user_id == auth()->user()->id){
                set_notice("Khách hàng này đã có trong danh sách chăm sóc của bạn!", 'warning');
                return redirect()->back();
            }
        }
        $data->web_id   =   get_web_id();
        $data->created_at   =   Carbon::now();
        $data->save();
        event_log('Tạo khách hàng mới '.$data->name.' id '.$data->id);
        set_notice(trans('customer.add_success'), 'success');
        return redirect()->back();
    }
    public function getEdit()
    {
        $data   =   Customer::find(request('id'));
        if(!empty($data) && $data->user_id == auth()->user()->id){
            event_log('Truy cập trang ['.trans('customer.edit').']');
            return v('customer.edit', compact('data'));
        }else{
            set_notice("Khách hàng không tồn tại hoặc không thuộc quyền quản lý của bạn", 'warning');
            return redirect()->back();
        }
    }
    public function postEdit(FormCustomerRequest $request)
    {
        $data   =   Customer::find($request->id);
        if(!empty($data) && $data->user_id == auth()->user()->id){
            $data->name   =   $request->name;
            $data->gender   =   $request->gender;
            $data->phone   =   $request->phone;
            $data->address   =   $request->address;
            $data->province_id   =   $request->province_id;
            $data->district_id   =   $request->district_id;
            $data->ward_id   =   $request->ward_id;
            $data->source_id   =   $request->source_id;
            $data->type_id   =   $request->type_id;
            $data->email   =   $request->email;
            $data->birthday   =  Carbon::createFromFormat('d/m/Y', $request->birthday);
            $data->save();
            event_log('Sửa khách hàng '.$data->name.' id '.$data->id);
            set_notice(trans('system.edit_success'), 'success');
        }else
            set_notice(trans('system.not_exist'), 'warning');
        return redirect()->back();
    }

    public function getListGroup(){
        return v('customer.groupList');
    }

    public function dataListGroup(){
        $data   =   CustomerGroup::with('customers');
        $data   =   $data->where('user_id', auth()->user()->id);
        $result = Datatables::of($data)
            ->addColumn('name', function(CustomerGroup $group){
                return $group->name;
            })
            ->addColumn('count', function(CustomerGroup $group) {
                return $group->customers()->count();
            })
            ->addColumn('manage', function(CustomerGroup $group) {
                return a('khach-hang/nhom/xoa', 'id='.$group->id,trans('g.delete'), ['class'=>'btn btn-xs btn-danger'],'#',"return bootbox.confirm('".trans('system.delete_confirm')."', function(result){if(result==true){window.location.replace('".asset('khach-hang/nhom/xoa?id='.$group->id)."')}})").'  '.a('khach-hang/nhom/sua', 'id='.$group->id,trans('g.edit'), ['class'=>'btn btn-xs btn-default']);
            })->rawColumns(['manage']);

        return $result->make(true);
    }
    public function getDeleteGroup(){
        $data   =   CustomerGroup::find(request('id'));
        if(!empty($data) && $data->user_id == auth()->user()->id){
            $data->delete();
            set_notice('Xoá nhóm khách hàng thành công!', 'success');
        } else set_notice('Nhóm khách hàng không tồn tại hoặc bạn không có quyền xoá!', 'warning');
        return redirect()->back();
    }
    public function getCreateGroup(){
        return v('customer.createGroup');
    }
    public function postCreateGroup(CustomerGroupRequest $request)
    {
        $data   =   new CustomerGroup();
        $data->name   =   $request->name;
        $data->user_id  =   auth()->user()->id;
        $data->web_id   =   get_web_id();
        $data->created_at   =   Carbon::now();
        $data->save();
        event_log('Tạo nhóm khách hàng mới '.$data->name.' id '.$data->id);
        set_notice(trans('customer.add_group_success'), 'success');
        return redirect()->back();
    }
    public function getEditGroup()
    {
        $data   =   CustomerGroup::find(request('id'));
        if(!empty($data) && $data->user_id == auth()->user()->id){
            event_log('Truy cập trang [Sửa nhóm khách hàng]');
            return v('customer.editGroup', compact('data'));
        }else{
            set_notice("Nhóm khách hàng không tồn tại hoặc không thuộc quyền quản lý của bạn", 'warning');
            return redirect()->back();
        }
    }
    public function postEditGroup(CustomerGroupRequest $request)
    {
        $data   =   CustomerGroup::find($request->id);
        if(!empty($data) && $data->user_id == auth()->user()->id){
            $data->name   =   $request->name;
            $data->save();
            event_log('Sửa nhóm khách hàng '.$data->name.' id '.$data->id);
            set_notice(trans('system.edit_success'), 'success');
        }else
            set_notice(trans('system.not_exist'), 'warning');
        return redirect()->back();
    }

    public function getCustomer(){
        $id   = request()->input('customerGroup');
        $result =   [];
        foreach(\App\Customer::where('customer_group_id',$id)->get() as $item){
            $result[]   =   [
                'id'    =>  $item->id,
                'name'  =>  $item->name,
                'phone' =>  $item->phone,
                'email' =>  $item->email
            ];
        }
        return response()->json($result);
    }
}
