<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\CreateCompanyRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $data   =   new Company();
        $data   =   $data->whereHas('users', function($q){
            $q->where('users.id', auth()->user()->id);
        });

        $data   =   $data->paginate(10);
        return v('company.index', compact('data'));
    }

    public function create()
    {
        return v('company.create');
    }

    public function save(CreateCompanyRequest $request)
    {
        $data   =   new Company();
        $data->name     =   $request->name;
        $data->address  =   $request->address;
        $data->user_id  =   auth()->user()->id;
        $data->description  =   $request->description;
        $data->status   =   'active';
        $data->created_at   =   Carbon::now();
        $data->save();
        $data->users()->attach(auth()->user()->id, ['confirmed'=>1]);
        $members    =   explode(',',$request->members);
        $data->users()->attach($members);

        $group = $data->group()->create([
            'name'  =>  'Nhóm chính',
            'user_id'   =>  auth()->user()->id,
            'description'   =>  'Nhóm mặc định của '.$data->name
        ]);
        $group->users()->attach(auth()->user()->id, ['confirmed'=>1, 'role'=>'admin']);
        $group->users()->attach($members);
        set_notice('Tạo doanh nghiệp thành công!<br/>Thêm thành viên vào doanh nghiệp thành công. Vui lòng chờ xác nhận.', 'success');
        notify($members, 'Lời mời vào doanh nghiệp', (auth()->user()->userinfo?auth()->user()->userinfo->fullname:auth()->user()->name).' mời bạn vào '.$data->name, route('confirmCompany', ['id'=>$data->id]));
        return redirect()->route('companyIndex');
    }

    public function confirm()
    {
        $data   =   Company::where('id', request('id'))->whereHas('users', function($q){
            $q->where('users.id', auth()->user()->id);
        })->first();
        $confirmed  =   $data->users()->where('user_id', auth()->user()->id)->first()->pivot->confirmed;
        if($confirmed == 1)
            return redirect()->route('companyDetail', ['id'=>$data->id]);
        if(request('confirmed')==1){
            $pivot  =   $data->users()->updateExistingPivot(auth()->user()->id, ['confirmed'=>1]);
            set_notice('Tham gia doanh nghiệp thành công!', 'success');
            return redirect()->route('companyDetail', ['id'=>$data->id]);
        }else
            return v('company.confirm', compact('data', 'confirmed'));
    }

    public function realEstateData()
    {

        $customer = Customer::where('user_id', auth()->user()->id)->pluck('id')->toArray();
        $data   =   RealEstate::whereIn('customer_id', $customer)->withoutGlobalScope(PrivateScope::class);
        $result = Datatables::of($data)
            ->addColumn('title', function(RealEstate $item){
                return "<a href='".route('customerCare', ['id'=>$item->customer_id,'re_id' => $item->id])."'>".$item->title."</a>";
            })
            ->addColumn('type', function(RealEstate $item){
                return $item->reType?$item->reType->name:'';
            })->rawColumns(['title']);

        return $result->make(true);
    }
}
