<?php

namespace App\Http\Controllers;

use App\DataTables\RealEstatesDataTable;
use App\Http\Requests\RealEstateRequest;
use App\Menu;
use App\RealEstate;
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
use Carbon\Carbon;
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
    }

    public function list($filter = null)
    {
        return v('real-estate.list',['menuData' => $this->menuFE], compact('filter'));
    }

    public function data()
    {
        $data = new RealEstate();

        if(!empty(\request('filter'))) {
            if(\request('filter') == 'tin-rao-het-han')
                $data = $data->where('expire_date','<',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')));

            if(\request('filter') == 'tin-rao-cho-duyet')
                $data = $data->where('approved','0');

            if(\request('filter') == 'tin-rao-nhap')
                $data = $data->where('draft','1');

            if(\request('filter') == 'tin-rao-da-xoa')
                $data = $data->onlyTrashed()->get();
        }
        else
            $data = $data->where('approved', 1);

        $result = Datatables::of($data)
            ->addColumn('re_category_id', function($dt) {
                return $dt->reCategory ? $dt->reCategory->name : '';
            })
            ->addColumn('re_type_id', function($dt) {
                return $dt->reType ? $dt->reType->name : '';
            })
            ->addColumn('district_id', function($dt) {
                return $dt->district->name;
            })->addColumn('manage', function($dt) {
                $manage = null;

                $manage =   a('bat-dong-san/xoa', 'id='.$dt->id,trans('g.delete'), ['class'=>'btn btn-xs btn-danger'],'#',"return bootbox.confirm('".trans('system.delete_confirm')."', function(result){if(result==true){window.location.replace('".asset('bat-dong-san/xoa?id='.$dt->id)."')}})");
                if(!$dt->approved) {
                    $manage .= '  ' . a('bat-dong-san/sua', 'id=' . $dt->id, trans('g.edit'), ['class' => 'btn btn-xs btn-default']);
                }

                if(\request('filter') == 'tin-rao-nhap')
                    $manage .=   '  '.a('bat-dong-san/dang-bai', 'id='.$dt->id,trans('g.post'), ['class'=>'btn btn-xs btn-info']);

                return $manage;
            })->rawColumns(['manage']);

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
            $data->draft = 0;
            $data->save();
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
}
