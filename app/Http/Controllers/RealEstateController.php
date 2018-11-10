<?php

namespace App\Http\Controllers;

use App\DataTables\RealEstatesDataTable;
use App\Http\Requests\RealEstateRequest;
use App\RealEstate;
use App\Services\BlockService;
use App\Services\ConstructionTypeService;
use App\Services\DirectionService;
use App\Services\DistrictService;
use App\Services\ExhibitService;
use App\Services\ProjectService;
use App\Services\ProvinceService;
use App\Services\RangePriceService;
use App\Services\ReCategoryService;
use App\Services\ReSourceService;
use App\Services\ReTypeService;
use App\Services\StreetService;
use App\Services\UnitService;
use App\Services\WardService;
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
    }

    public function list(RealEstatesDataTable $dataTable)
    {

        return $dataTable->render('real-estate.list');
//        return v('real-estate.list');
    }

    public function data()
    {
        $data = $this->service->getList();

        $result = Datatables::of($data)
            ->addColumn('category', function($dt) {
                return $dt->reCategory->name;
            })
            ->addColumn('type', function($dt) {
                return $dt->reType ? $dt->reType->name : '';
            })
            ->addColumn('province', function($dt) {
                return $dt->province->name;
            })
            ->addColumn('manage', function($dt) {
                return a('real-estate/delete', 'id='.$dt->id,trans('g.delete'), ['class'=>'btn btn-xs btn-danger'],'#',
                        "return bootbox.confirm('".trans('system.delete_confirm')."', function(result){if(result==true){window.location.replace('".asset('real-estate/delete?id='.$dt->id)."')}})").'  '.a('real-estate/edit',
                        'id='.$dt->id,trans('g.edit'), ['class'=>'btn btn-xs btn-default']);
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


        return v('real-estate.create', compact(['reCategories', 'provinces', 'streets', 'directions',
            'exhibits', 'blocks', 'constructionTypes', 'units', 'reSources']));
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

            return v('real-estate.edit', compact(['realEstate', 'reCategories', 'reTypes', 'provinces',
                'districts', 'wards', 'streets', 'streets', 'directions', 'exhibits', 'projects', 'blocks',
                'constructionTypes', 'units', 'rangePrices', 'reSources']));
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
}
