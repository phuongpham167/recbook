<?php

namespace App\Http\Controllers;

use App\Account;
use App\Currency;
use App\DataTables\RealEstatesDataTable;
use App\HotVip;
use App\Http\Requests\HotVipRequest;
use App\Http\Requests\RealEstateRequest;
use App\Menu;
use App\ReCategory;
use App\Province;
use App\RealEstate;
use App\Receipt;
use App\ReceiptType;
use App\ReReport;
use App\Scopes\PrivateScope;
use App\Scopes\PublicScope;
use App\Services\BlockService;
use App\Services\ConstructionTypeService;
use App\Services\DirectionService;
use App\Services\DistrictService;
use App\Services\ExhibitService;
use App\Services\PageService;
use App\Services\ProjectService;
use App\Services\ProvinceService;
use App\Services\RangePriceService;
use App\Services\ReCategoryService;
use App\Services\ReSourceService;
use App\Services\ReTypeService;
use App\Services\StreetService;
use App\Services\UnitService;
use App\Services\WardService;
use App\User;
use Carbon\Carbon;
use Efriandika\LaravelSettings\Settings;
use Illuminate\Http\Request;
use App\Services\RealEstateService;
use \DataTables;

class RealEstateController extends Controller
{
    protected $service;
    protected $reCategoryService;
    protected $reTypeService;
    protected $provinceService;
    protected $districtService;
    protected $wardService;
    protected $streetService;
    protected $directionService;
    protected $exhibitService;
    protected $projectService;
    protected $blockService;
    protected $constructionTypeService;
    protected $unitService;
    protected $rangePriceService;
    protected $reSourceService;
    protected $menuFE;

    protected $categories, $provinces, $districts, $wards, $streets, $directions, $projects, $reTypes, $rangePrices;

    public function __construct(
        RealEstateService $realEstateService,
        ReCategoryService $reCategoryService,
        ReTypeService $reTypeService,
        ProvinceService $provinceService,
        DistrictService $districtService,
        WardService $wardService,
        StreetService $streetService,
        DirectionService $directionService,
        ExhibitService $exhibitService,
        ProjectService $projectService,
        BlockService $blockService,
        ConstructionTypeService $constructionTypeService,
        UnitService $unitService,
        RangePriceService $rangePriceService,
        ReSourceService $reSourceService
    )
    {
        $this->service = $realEstateService;
        $this->reCategoryService = $reCategoryService;
        $this->reTypeService = $reTypeService;
        $this->provinceService = $provinceService;
        $this->districtService = $districtService;
        $this->wardService = $wardService;
        $this->streetService = $streetService;
        $this->directionService = $directionService;
        $this->exhibitService = $exhibitService;
        $this->projectService = $projectService;
        $this->blockService = $blockService;
        $this->constructionTypeService = $constructionTypeService;
        $this->unitService = $unitService;
        $this->rangePriceService = $rangePriceService;
        $this->reSourceService = $reSourceService;

        $web_id = get_web_id();
        $mmfe = config('menu.mainMenuFE');
        $this->menuFE = Menu::where('web_id', $web_id)->where('menu_type', $mmfe)->first();

        $vipRealEstates = RealEstate::select('id', 'title', 'slug', 'direction_id',
            'area_of_premises', 'price', 'unit_id', 'is_vip', 'is_hot')
            ->where('is_vip',  1)
            ->where('vip_expire_at',  '<=', Carbon::now())
            ->get();

        $this->categories = ReCategory::select('id', 'name', 'slug')
            ->orderBy('id', 'asc')
            ->get();

        $this->provinces = $this->provinceService->getListDropDown();
        $this->districts = $this->districtService->getListDropDown();
        $this->wards = $this->wardService->getListDropDown();
        $this->streets = $this->streetService->getListDropDown();
        $this->directions = $this->directionService->getListDropDown();
        $this->projects = $this->projectService->getListDropDown();

        $firstCat = $this->categories->first();
        $this->reTypes = $this->reTypeService->getReTypeByCat($firstCat->id);

        $this->rangePrices = $this->rangePriceService->getListDropDown();
    }

    public function list($filter = null)
    {
        return v('real-estate.list',
            [
                'menuData' => $this->menuFE,
                'categories' => $this->categories,
                'reTypes' => $this->reTypes,
                'streets' => $this->streets,
                'directions' => $this->directions,
                'rangePrices' => $this->rangePrices
            ],
            compact('filter'));
    }

    public function data()
    {
        $data = RealEstate::query();

        if(!empty(\request('filter'))) {
            if(\request('filter') == 'tin-rao-het-han')
                $data = $data->where('posted_by',auth()->user()->id)->where('expire_date','<',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')));

            if(\request('filter') == 'tin-rao-cho-duyet')
                $data = $data->where('posted_by',auth()->user()->id)->where('approved','0')->where('draft', 0)->where('expire_date','>=',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')));

            if(\request('filter') == 'tin-rao-nhap')
                $data = $data->where('posted_by',auth()->user()->id)->where('draft','1')->where('expire_date','>=',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')));

            if(\request('filter') == 'tin-rao-da-xoa')
                $data = $data->where('posted_by',auth()->user()->id)->onlyTrashed()->get();
        }
        else
            $data = $data->where('posted_by',auth()->user()->id)->where('approved', 1)->where('expire_date','>=',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')));

        $start  =   !empty(\request('datefrom'))?Carbon::createFromFormat('d/m/Y',\request('datefrom'))->startOfDay():'';
        $end    =   !empty(\request('dateto'))?Carbon::createFromFormat('d/m/Y',\request('dateto'))->endOfDay():'';

        if($start != '' && $end != '')
            $data   =   $data->where('post_date', '>=', $start)->where('post_date', '<=', $end);

        if(!empty(\request('re_type_id')))
            $data = $data->where('re_type_id',\request('re_type_id'));

        if(!empty(\request('re_category_id')))
            $data = $data->where('re_category_id',\request('re_category_id'));

        $result = Datatables::of($data)
            ->addColumn('re_category_id', function($dt) {
                return $dt->reCategory ? $dt->reCategory->name : '';
            })
            ->addColumn('code', function($dt) {
                return $dt->code ? $dt->code : '';
            })
            ->addColumn('title', function($dt) {
                $title = null;
                if($dt->vip_expire_at >= Carbon::now()){
                    if($dt->vip_type == 1 || $dt->vip_type == 2)
                        $title .= '<img src="'.asset('/images/vip1.gif').'"> ';
                    else if($dt->vip_type == 3 || $dt->vip_type == 4)
                        $title .= '<img src="'.asset('/images/vip2.gif').'"> ';
                }
                $title .= $dt->title;
                $slug   =   !empty($dt->slug)?$dt->slug:to_slug($dt->title);
                return "<a href='".route('detail-real-estate', ['slug'=>$slug."-".$dt->id])."' target='_blank'>".$title."</a> ";
            })
            ->addColumn('re_type_id', function($dt) {
                return $dt->reType ? $dt->reType->name : '';
            })
            ->addColumn('district_id', function($dt) {
                return $dt->district?$dt->district->name:'-';
            })->addColumn('manage', function($dt) {
                $manage = null;

                $manage =   a('bat-dong-san/xoa', 'id='.$dt->id,trans('g.delete'), ['class'=>'btn btn-xs btn-danger'],'#',"return bootbox.confirm('".trans('system.delete_confirm')."', function(result){if(result==true){window.location.replace('".asset('bat-dong-san/xoa?id='.$dt->id)."')}})");

                $manage .= '  ' . a('bat-dong-san/sua', 'id=' . $dt->id, trans('g.edit'), ['class' => 'btn btn-xs btn-default']);
                $manage .= '  ' . a('#a', '', trans('g.renewed'), ['class' => 'btn btn-xs btn-primary btn-renewed', 'id' => $dt->id]);
                if($dt->expire_date >= Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')) ) {

                    if(\request('filter') == 'tin-rao-nhap')
                        $manage .=   '  '.a('bat-dong-san/dang-bai', 'id='.$dt->id,trans('g.post'), ['class'=>'btn btn-xs btn-info']);

                    $manage .= '  ' . a('#a', '', trans('g.hotvip'), ['class' => 'btn btn-xs btn-success btn-hotvip', 'id' => $dt->id, 'hot' => number_format(HotVip::where('province_id', $dt->province_id)->first()->hot_value)
                        ,'hot_hl' => number_format(HotVip::where('province_id', $dt->province_id)->first()->hot_highlight_value)
                        ,'vip' => number_format(HotVip::where('province_id', $dt->province_id)->first()->vip_value)
                        ,'vip_hl' => number_format(HotVip::where('province_id', $dt->province_id)->first()->vip_highlight_value)
                        ,'i_value' => number_format(HotVip::where('province_id', $dt->province_id)->first()->interesting_value)
                        ,'vip_right' => number_format(HotVip::where('province_id', $dt->province_id)->first()->vip_right_value)]);

                    if($dt->approved)
                        $manage .= '  ' . a('bat-dong-san/up', 'id=' . $dt->id, trans('g.up'), ['class' => 'btn btn-xs btn-info']);
                    if($dt->sold == 1)
                        $manage .=' '. a('#','id='.$dt->id,trans('g.sold'), ['class'=>'btn btn-xs btn-default btn-is-disabled']);
                    else
                        $manage .= ' '.a('bat-dong-san/da-ban','id='.$dt->id,trans('g.sold'), ['class'=>'btn btn-xs btn-info'],'#',
                            "return bootbox.confirm('".trans('system.sold_confirm')."', function(result){if(result==true){window.location.replace('".asset('bat-dong-san/da-ban?id='.$dt->id)."')}})");
                }
                else {
                    $manage .= '<br>'. trans('system.expired');
                }

                return $manage;
            })->rawColumns(['manage','title']);

        return $result->make(true);
    }

    public function districtByProvince($provinceId)
    {
        $districts = $this->districtService->getDistrictByProvince($provinceId);
        return response()->json($districts);
    }

    public function wardByDistrict($districtId)
    {
        $wards = $this->wardService->getWardByDistrict($districtId);
        return response()->json($wards);
    }

    public function streetByWard($wardId)
    {
        $streets = $this->streetService->getStreetByWard($wardId);
        return response()->json($streets);
    }

    public function projectByProvince($provinceId)
    {
        $projects = $this->projectService->getProjectByProvince($provinceId);
        return response()->json($projects);
    }

    public function create()
    {
        $reCategories = $this->reCategoryService->getListDropDown();
        $provinces = $this->provinceService->getListDropDown();
        $streets = $this->streetService->getListDropDown();
        $directions = $this->directionService->getListDropDown();
        $exhibits = $this->exhibitService->getListDropDown();
        $blocks = $this->blockService->getListDropDown();
        $constructionTypes = $this->constructionTypeService->getListDropDown();
        $units = $this->unitService->getListDropDown();
        $reSources = $this->reSourceService->getListDropDown();

        $menuData = $this->menuFE;

        return v('real-estate.create', compact([
            'reCategories', 'provinces', 'streets', 'directions',
            'exhibits', 'blocks', 'constructionTypes', 'units', 'reSources', 'menuData'
        ]));
    }

    public function store(RealEstateRequest $request)
    {
//        print_r($request->all());
//        exit();
        $result = $this->service->store($request->all());
        if($result) {
            set_notice(trans('real-estate.message.createSuccess'), 'success');
            return redirect()->back();
        } else {
            set_notice(trans('real-estate.message.error'), 'error');
            return redirect()->back()->withInput();
        }
    }

    public function edit()
    {
        $id = \request('id');
        if ($id && $realEstate = RealEstate::find($id)){
            $reCategories = $this->reCategoryService->getListDropDown();
            $reTypes = $this->reTypeService->getReTypeByCat($realEstate->re_category_id);
            $provinces = $this->provinceService->getListDropDown();
            $districts = $this->districtService->getDistrictByProvince($realEstate->province_id);
            $wards = $this->wardService->getWardByDistrict($realEstate->district_id);
            $streets = $this->streetService->getStreetByWard($realEstate->ward_id);
            $directions = $this->directionService->getListDropDown();
            $exhibits = $this->exhibitService->getListDropDown();
            $projects = $this->projectService->getListDropDown();
            $blocks = $this->blockService->getListDropDown();
            $constructionTypes = $this->constructionTypeService->getListDropDown();
            $units = $this->unitService->getListDropDown();
            $rangePrices = $this->rangePriceService->getRangePriceByCat($realEstate->re_category_id);
            $reSources = $this->reSourceService->getListDropDown();

            $menuData = $this->menuFE;

            return v('real-estate.edit', compact(['realEstate', 'reCategories', 'reTypes', 'provinces',
                'districts', 'wards', 'streets', 'directions', 'exhibits', 'projects', 'blocks',
                'constructionTypes', 'units', 'rangePrices', 'reSources', 'menuData']));
        }
        set_notice(trans('real-estate.message.error'), 'error');
        return redirect()->back();
    }

    public function update(RealEstateRequest $request)
    {
        $id = \request('id');
        if ($id) {
            $data = \request()->all();
            $result = $this->service->update($data);
            if ($result) {
                set_notice(trans('real-estate.message.updateSuccess'), 'success');
                return redirect()->back();
            }
            set_notice(trans('real-estate.message.error'), 'error');
            return redirect()->back()->withInput();
        }
        set_notice(trans('real-estate.message.error'), 'error');
        return redirect('realEstateList');
    }

    public function renewed()
    {
        $data = RealEstate::where('posted_by',auth()->user()->id)->where('id',\request('id'))->first();

        if (!empty($data)) {
            $data->expire_date = Carbon::createFromFormat('Y-m-d H:i:s', $data->expire_date)->addDays(\request('days'));
            $data->save();
            set_notice(trans('real-estate.message.renewed_success'), 'success');
            return redirect()->back()->withInput();
        }
        set_notice(trans('real-estate.message.error'), 'warning');
        return redirect('realEstateList');
    }

    public function report()
    {
        $data = RealEstate::find(\request('id'));

        if ($data) {
            $report = new ReReport();
            $report->user_id = auth()->user()->id;
            $report->real_estate_id = $data->id;
            $report->type = \request('report_type');
            $report->content = \request('report_content');
            $report->save();
            set_notice(trans('real-estate.message.report_success'), 'success');
            return redirect()->back();
        }
        set_notice(trans('real-estate.message.error'), 'warning');
        return redirect('realEstateList');
    }

    public function delete()
    {
        $data   =   RealEstate::find(request('id'));
        if(!empty($data)){
//            event_log('Xóa thành viên '.$data->name.' id '.$data->id);
            $data->delete();
            set_notice(trans('system.delete_success'), 'success');
        }else
            set_notice(trans('system.not_exist'), 'warning');
        return redirect()->back();
    }

    public function multiDelete(Request $request)
    {
        $ids = $request['ids'];
        $ids = explode(',', $ids);
        if ($ids) {
            $result = $this->service->multiDelete($ids);
        }
        if ($result) {
            return response()->json([
                    'success' => true,
                    'message' => 'Delete success'
                ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Delete success'
        ]);
    }

    public function publish()
    {
        $data   =   RealEstate::find(request('id'));
        if(!empty($data)){
//            event_log('Xóa thành viên '.$data->name.' id '.$data->id);
            $this->service->publish($data);
//            $data->draft = 0;
//            $data->save();
            set_notice(trans('system.publish_success'), 'success');
        }else
            set_notice(trans('system.not_exist'), 'warning');

        return redirect()->back();
    }

    public function customerByPhone($phone)
    {
        $result = $this->service->customerByPhone($phone);
        return response()->json($result);
    }

    public function setVipHot(HotVipRequest $request)
    {
        $data   =   RealEstate::find($request->id);
        if(!empty($data)){

            $data->vip_type = $request->vip_type;
            $data->vip_expire_at = Carbon::now()->addDay($request->vip_time);
            if($request->vip_type == 1){
                $price = HotVip::where('province_id', $data->province_id)->first()->hot_value;
                $type = 'tin hot';
            }
            else if($request->vip_type == 2){
                $price = HotVip::where('province_id', $data->province_id)->first()->hot_highlight_value;
                $type = 'tin hot nổi bật';
            }
            else if($request->vip_type == 3){
                $price = HotVip::where('province_id', $data->province_id)->first()->vip_value;
                $type = 'tin vip';
            }
            else if($request->vip_type == 4){
                $price = HotVip::where('province_id', $data->province_id)->first()->vip_highlight_value;
                $type = 'tin vip nổi bật';
            }
            else if($request->vip_type == 5){
                $price = HotVip::where('province_id', $data->province_id)->first()->interesting_value;
                $type = 'tin hấp dẫn';
            }
            else if($request->vip_type == 6){
                $price = HotVip::where('province_id', $data->province_id)->first()->vip_right_value;
                $type = 'tin vip phải';
            }
            $value = $request->vip_time*$price;
            if(RealEstate::where('vip_type', $request->vip_type)->where('province_id',$data->province_id)->count() == get_config('vip'.$request->vip_type)){
                set_notice('Loại '.$type.' tại '.$data->province->name.' hiện không còn vị trí trống.Hãy thử chọn loại tin vip/hot khác!', 'warning');
            }else if(credit(auth()->user()->id,$value,1, 'nâng cấp '.$type.' cho id '.$data->id.' trong '.$request->vip_time.' ngày')){
                $data->save();
                set_notice(trans('system.set_vip_success').$type.' '.$request->vip_time.' ngày thành công!', 'success');
            }
            else
                set_notice(trans('system.credit_fail'), 'warning');
        }else
            set_notice(trans('system.not_exist'), 'warning');

        return redirect()->back();
    }

    public function upPost(Request $request)
    {
        if(auth()->user()->up_limit >= auth()->user()->group()->first()->up_limit) {
            set_notice(trans('real-estate.message.up_limit'), 'error');
            return redirect()->back();
        }
        $data   =   RealEstate::find($request->id);
        if(!empty($data)){
            $user = User::find($data->posted_by);
            if($user->up_limit < $user->group->up_limit){
                $user->up_limit++;
                $user->save();
                $data->updated_at = Carbon::now();
                $data->save();
                set_notice(trans('system.up_post_success'), 'success');
            }
            else
                set_notice(trans('system.up_post_fail'), 'warning');
        }else
            set_notice(trans('system.not_exist'), 'warning');
        return redirect()->back();
    }

    public function getDetailRe($id) {
        if ($id) {
            $re = RealEstate::with(['street', 'project', 'block'])->find($id);
            if ($re) {
                $user = auth()->user();
                $uProvince = $user->userinfo->province_id;
                $districts = $this->districtService->getDistrictByProvince($uProvince);
                $reCategories = $this->reCategoryService->getListDropDown();
                $districtsByProvince = [];
                if ($re->province_id) {
                    $districtsByProvince = $this->districtService->getDistrictByProvince($re->province_id);
                }
                $wardsByDistrict = [];
                if ($re->district_id) {
                    $wardsByDistrict = $this->wardService->getWardByDistrict($re->district_id);
                }
                $typeByLoaiBDS = [];
                $projects = [];
                if ($re->loai_bds) {
                    if ($re->loai_bds == 1) {
                        $typeByLoaiBDS = $this->reTypeService->getListDropDownNoCat();
                    }
                    if ($re->loai_bds == 2) {
                        if ($re->province_id) {
                            $projects = $this->projectService->getProjectByProvince($re->province_id);
                        }
                    }
                }
                return response()->json([
                    'success' => true,
                    'message' => '',
                    'data' => [
                        're' => $re,
                        'districts' => $districts,
                        'categories' => $reCategories,
                        'districtsByProvince' => $districtsByProvince,
                        'wardsByDistrict' => $wardsByDistrict,
                        'typeByLoaiBDS' => $typeByLoaiBDS,
                        'projects' => $projects
                    ]
                ]);
            }
            return response()->json([
                'success' => false,
                'message' => '',
                'data' => []
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => '',
            'data' => []
        ]);
    }
    public function updateDetailRe($id)
    {
        $result = false;
        if ($id) {
            $re = RealEstate::withoutGlobalScope(PrivateScope::class)->find($id);
            if ($re) {

                $result = $this->service->updateAjax(request()->all());
            }
        }
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật thành công',
                'data' => [
                    're' => $result,
                    'content'   =>  nl2br($result->detail)
                ]
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Có lỗi xảy ra. vui lòng thử lại',
            'data' => []
        ]);
    }

    public function sold () {
        $data = RealEstate::find(request('id'));

        if($data->posted_by != auth()->user()->id)
        {
            set_notice(trans('real-estate.message.notPermission'), 'warning');
            return redirect()->back();
        }
        if(!empty($data)) {
            $data->sold = 1;
            $data->save();

            $receipt = new Receipt();
            $account = Account::where('web_id',get_web_id())->where('default',1)->first();
            $receipt->account_id   =   $account->id;
            $receipt->code   =   $account->code.time();
            $receipt->type   =   ReceiptType::where('web_id',get_web_id())->where('read_only',1)->first()->type;
            $receipt->receipt_types_id   =   ReceiptType::where('web_id',get_web_id())->where('read_only',1)->first()->id;
            $receipt->value   =   floor (($data->price * $data->commission_percent) / 100);
            $receipt->target_user_id   =   auth()->user()->id;
            $receipt->time   =   Carbon::now();
            $receipt->web_id   =   auth()->user()->web_id;
            $receipt->user_id   =   auth()->user()->id;
            $receipt->save();

            set_notice(trans('real-estate.message.updateSuccess'), 'success');
            return redirect()->back();
        }
        set_notice(trans('real-estate.message.error'), 'warning');
        return redirect()->back();
    }

    public function addCil() {
        $result = $this->service->store(request()->all());
        if($result) {
            return response()->json([
                'success' => true,
                'message' => 'Thêm thành công',
                'data' => [
                    're' => $result
                ]
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra. vui lòng thử lại',
                'data' => []
            ]);
        }
    }
}
