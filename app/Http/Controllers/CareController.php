<?php

namespace App\Http\Controllers;

use App\Care;
use App\Customer;
use App\RelatedCustomer;
use App\ShareCustomer;
use App\UserGroup;
use App\Http\Requests\CreateCareRequest;
use App\RealEstate;
use App\Scopes\PrivateScope;
use App\Services\BlockService;
use App\Services\DirectionService;
use App\Services\DistrictService;
use App\Services\ExhibitService;
use App\Services\ProjectService;
use App\Services\ProvinceService;
use App\Services\ReCategoryService;
use App\Services\StreetService;
use App\Services\WardService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \DataTables;

class CareController extends Controller
{
    protected $reCategoryService;
    protected $provinceService;
    protected $districtService;
    protected $wardService;
    protected $streetService;
    protected $directionService;
    protected $exhibitService;
    protected $projectService;

    public function __construct(
        ReCategoryService $reCategoryService,
        ProvinceService $provinceService,
        DistrictService $districtService,
        WardService $wardService,
        StreetService $streetService,
        DirectionService $directionService,
        ExhibitService $exhibitService,
        ProjectService $projectService,
        BlockService $blockService
    )
    {
        $this->reCategoryService = $reCategoryService;
        $this->provinceService = $provinceService;
        $this->districtService = $districtService;
        $this->wardService = $wardService;
        $this->streetService = $streetService;
        $this->directionService = $directionService;
        $this->exhibitService = $exhibitService;
        $this->projectService = $projectService;
        $this->blockService = $blockService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $id =   \request('id');
        if(!empty($customer = Customer::find($id)) && ($customer->user_id == auth()->user()->id || ShareCustomer::where('customer_id', $customer->id)->first()->user_id == auth()->user()->id)){
            $data   =   new RealEstate();
            $shared = ShareCustomer::where('customer_id', $id)->pluck('user_id');
            $data   =   $data->where('customer_id', $id)->withoutGlobalScope(PrivateScope::class)->where(function ($q) use ($id){
                $q->where('posted_by', auth()->user()->id)->orWhere('is_private',0)->orWhere('customer_id',$id);
            });
            if(!empty(request('re_id'))){
                $data   =   $data->where('id', request('re_id'));
            }
            $data   =   $data->get();
            $reCategories = $this->reCategoryService->getListDropDown();
            $provinces = $this->provinceService->getListDropDown();
            $directions = $this->directionService->getListDropDown();
            $exhibits = $this->exhibitService->getListDropDown();

            $related_customers = RelatedCustomer::where('customer_id1', $customer->id)->orWhere('customer_id2', $customer->id)->get();

            return v('customer.care.index', compact('customer','data', 'reCategories',
                    'provinces', 'directions', 'exhibits','related_customers'));
        }
    }
    public function dataList() {
        $data   =   Care::query();

        if(!empty(request('id'))){
            $data   =   $data->where('realestate_id',request('id'));
        }

        if(get_web_id() != 1){
            $data   =   $data->where('web_id',get_web_id());
        }

        $result = Datatables::of($data)
            ->addColumn('web_id', function($care) {
                return a('care/delete', 'id='.$care->id,trans('g.delete'), ['class'=>'btn btn-xs btn-danger'],'#',"return bootbox.confirm('".trans('system.delete_confirm')."', function(result){if(result==true){window.location.replace('".asset('care/delete?id='.$care->id)."')}})").'  '.a('care/edit', 'id='.$care->id,trans('g.edit'), ['class'=>'btn btn-xs btn-default']);
            })->rawColumns(['manage']);

//        if(get_web_id() == 1) {
//            $result = $result->addColumn('web_id', function(Currency $currency) {
//                return Web::find($currency->web_id)->name;
//            });
//        }

        return $result->make(true);
    }
    public function suggest(){
        $data   =   RealEstate::query();
        if(!empty($phone = request('phone')))
            $data   =   $data->where('contact_phone_number', $phone)->orWhereHas('customer', function($q) use ($phone){
                $q->where('phone', $phone);
            });


        $result = Datatables::of($data)
            ->addColumn('type', function(RealEstate $item){
                return $item->reType?$item->reType->name:'';
            })
            ->editColumn('title', function(RealEstate $item){
                return "<a href='#a' class='picksuggest' data-id='".$item->id."'>".$item->title."</a>";
            })
            ->rawColumns(['title']);
        return $result->make(true);
    }

    public function postCreate(CreateCareRequest $request)
    {
        $realestate =   RealEstate::withoutGlobalScope(PrivateScope::class)->where('id', $request->realestate_id)->first();
        if($realestate){
            $data   =   new Care();
            $data->realestate_id    =   $request->realestate_id;
            $data->content   =   $request->content;
            $data->feedback   =   $request->feedback;
            $data->phone   =   $realestate->contact_phone_number;
            $data->response_id  =   $request->response_id;
            $data->user_id  =   auth()->user()->id;
            $data->created_at   =   Carbon::now();
            $data->web_id   =   get_web_id();
            $data->save();
            event_log('Tạo lịch sử chăm sóc mới id '.$data->id);
            return response()->json(['status'=>0, 'id'=>$realestate->id]);
        }
    }
    public function response(){
        $data   =   RealEstate::query();
        $ids    =   Care::where('realestate_id', request('id'))->pluck('response_id');
        $data   =   $data->withoutGlobalScope(PrivateScope::class)->whereIn('id',$ids);
        $result = Datatables::of($data)->addColumn('type', function(RealEstate $item){
            return $item->reType?$item->reType->name:'';
        });
        return $result->make(true);
    }
}
