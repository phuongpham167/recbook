<?php

namespace App\Http\Controllers;

use App\Friend;
use App\MappingMenuFE;
use App\Menu;
use App\RealEstate;
use App\ReCategory;
use App\ReType;
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
use App\Services\ReTypeService;
use App\Services\StreetService;
use App\Services\UnitService;
use App\Services\WardService;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class PageController extends Controller
{
    protected $menuFE, $vipRealEstates, $web_id;
    protected $categories, $provinces, $districts, $streets, $directions, $projects;

    protected $service;
    protected $reCategoryService;
    protected $reTypeService;
    protected $rangePriceService;
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

    public function __construct(
        PageService $pageService,
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
        RangePriceService $rangePriceService
    )
    {
        $this->web_id = get_web_id();
        $mmfe = config('menu.mainMenuFE');
        $this->menuFE = Menu::where('web_id', $this->web_id)->where('menu_type', $mmfe)->first();

        $this->service = $pageService;
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

        $this->categories = ReCategory::select('id', 'name', 'slug')
            ->orderBy('id', 'asc')
//            ->where('web_id', $web_id)
            ->get();

        $this->provinces = $this->provinceService->getListDropDown();
        $this->districts = $this->districtService->getListDropDown();
        $this->streets = $this->streetService->getListDropDown();
        $this->directions = $this->directionService->getListDropDown();
        $this->projects = $this->projectService->getListDropDown();
    }

    public function index1()
    {
        $hotRealEstates = RealEstate::select('id', 'title', 'slug', 'short_description', 'code',
            'area_of_premises', 'area_of_use', 'district_id', 'price', 'unit_id', 'is_vip', 'is_hot',
            'post_date', 'images')
            ->where(function($q){
                $q->where('is_hot', 1)
                  ->where('is_vip', '<>', 1);
            })
            ->where(function($q){
                $q->where('expire_date','>=',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')))
                ->orWhere('post_date', '>=', Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->subDays(Settings('system_changenametime'))->format('m/d/Y H:i A')));
            })
            ->where('post_date', '<=', Carbon::now())
//            ->where('hot_expire_at', '<=', Carbon::now())
            ->where('web_id', $this->web_id);


//        $hotRealEstates = $this->checkRegisterDate($hotRealEstates);
        $hotRealEstates->limit(16);
        $hotRealEstates = $hotRealEstates->get();
//        dd($hotRealEstates);

        /*
         * TODO: need more info to filter good price items
         * Now: get vip only
         * */
        $goodPriceRealEstate = RealEstate::select('id', 'title', 'short_description', 'slug', 'code',
            'area_of_premises', 'price', 'unit_id', 'is_vip', 'is_hot', 'images', 'post_date')
            ->where('is_vip', 1)
            ->where('post_date', '<=', Carbon::now())
            ->where('web_id', $this->web_id)
            ->orderBy('post_date', 'desc');

        $goodPriceRealEstate = $goodPriceRealEstate
            ->where('expire_date','>=',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')))
            ->orWhere('post_date', '>=', Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->subDays(Settings('system_changenametime'))->format('m/d/Y H:i A')));


//        $goodPriceRealEstate = $this->checkRegisterDate($goodPriceRealEstate);
        $goodPriceRealEstate->limit(200);
        $goodPriceRealEstate = $goodPriceRealEstate->get();

        $vipRealEstates  =   RealEstate::select('id', 'title', 'slug', 'short_description', 'code',
            'area_of_premises', 'area_of_use', 'district_id', 'price', 'unit_id', 'is_vip', 'is_hot',
            'post_date', 'images','district_id', 'province_id', 'direction_id')
            ->where('is_hot', '<>', 1)
            ->where('is_vip', 1)
            ->where('post_date', '<=', Carbon::now())
//            ->where('hot_expire_at', '<=', Carbon::now())
            ->where('web_id', $this->web_id)->orderBy('post_date','DESC');
        $vipRealEstates = $vipRealEstates->take(10)->get();

        $freeRealEstates = RealEstate::select('id', 'title', 'short_description', 'slug', 'code',
            'area_of_premises', 'price', 'unit_id', 'is_vip', 'is_hot', 'images', 'post_date')
            ->where('is_hot', '<>', 1)
            ->where('is_vip', '<>', 1)
            ->where('web_id', $this->web_id);

        $freeRealEstates = $freeRealEstates
            ->where('expire_date','>=',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')))
            ->orWhere('post_date', '>=', Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->subDays(Settings('system_changenametime'))->format('m/d/Y H:i A')));

//        $freeRealEstates = $this->checkRegisterDate($freeRealEstates);
        $freeRealEstates->limit(40);
        $freeRealEstates = $freeRealEstates->get();

        /*
         * get lít category
         * */
        $firstCat = $this->categories->first();
//        dd($firstCat->id);
        $reTypes = $this->reTypeService->getReTypeByCat($firstCat->id);
        $rangePrices = $this->rangePriceService->getRangePriceByCat($firstCat->id);


        return v('pages.home-1', [
            'hotRealEstates' => $hotRealEstates,
            'goodPriceRealEstate' => $goodPriceRealEstate,
            'freeRealEstates' => $freeRealEstates,
            'categories' => $this->categories,
            'reTypes' => $reTypes,
            'provinces' => $this->provinces,
            'districts' => $this->districts,
            'streets' => $this->streets,
            'directions' => $this->directions,
            'rangePrices' => $rangePrices,
            'menuData' => $this->menuFE,
            'vipRealEstates' => $vipRealEstates
        ]);
    }
    public function index()
    {
        $hotRealEstates = RealEstate::select('id', 'title', 'slug', 'short_description', 'code',
            'area_of_premises', 'area_of_use', 'district_id', 'price', 'unit_id', 'is_vip', 'is_hot',
            'post_date', 'images','district_id', 'province_id', 'direction_id')
            ->where(function($q){
                $q->where('is_hot', 1)
                    ->where('is_vip', '<>', 1);
            })
            ->where(function($q){
                $q->where('expire_date','>=',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')))
                    ->orWhere('post_date', '>=', Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->subDays(Settings('system_changenametime'))->format('m/d/Y H:i A')));
            })
            ->where('post_date', '<=', Carbon::now())
//            ->where('hot_expire_at', '<=', Carbon::now())
            ->where('web_id', $this->web_id);

//        $hotRealEstates = $this->checkRegisterDate($hotRealEstates);
        $hotRealEstates->limit(16);
        $hotRealEstates = $hotRealEstates->get();
//        dd($hotRealEstates);

        $newestRealEstates  =   RealEstate::select('id', 'title', 'slug', 'short_description', 'code',
            'area_of_premises', 'area_of_use', 'district_id', 'price', 'unit_id', 'is_vip', 'is_hot',
            'post_date', 'images','district_id', 'province_id', 'direction_id')
            ->where('post_date', '<=', Carbon::now())
//            ->where('hot_expire_at', '<=', Carbon::now())
            ->where('web_id', $this->web_id)->orderBy('post_date','DESC');

        $newestRealEstates = $newestRealEstates
            ->where('expire_date','>=',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')))
            ->orWhere('post_date', '>=', Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->subDays(Settings('system_changenametime'))->format('m/d/Y H:i A')));

        $newestRealEstates = $newestRealEstates->take(10)->get();
        $vipRealEstates  =   RealEstate::select('id', 'title', 'slug', 'short_description', 'code',
            'area_of_premises', 'area_of_use', 'district_id', 'price', 'unit_id', 'is_vip', 'is_hot',
            'post_date', 'images','district_id', 'province_id', 'direction_id')
            ->where('is_hot', '<>', 1)
            ->where('is_vip', 1)
            ->where('post_date', '<=', Carbon::now())
//            ->where('hot_expire_at', '<=', Carbon::now())
            ->where('web_id', $this->web_id)->orderBy('post_date','DESC');

        $vipRealEstates = $vipRealEstates
            ->where('expire_date','>=',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')))
            ->orWhere('post_date', '>=', Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->subDays(Settings('system_changenametime'))->format('m/d/Y H:i A')));
        $vipRealEstates = $vipRealEstates->take(10)->get();
        /*
         * TODO: need more info to filter good price items
         * Now: get vip only
         * */
        $goodPriceRealEstate = RealEstate::select('id', 'title', 'short_description', 'slug', 'code',
            'area_of_premises', 'price', 'unit_id', 'is_vip', 'is_hot', 'images', 'post_date','district_id', 'province_id', 'direction_id')
            ->where('is_vip', 1)
            ->where('post_date', '<=', Carbon::now())
            ->where('web_id', $this->web_id)
            ->orderBy('post_date', 'desc');

        $goodPriceRealEstate = $goodPriceRealEstate
            ->where('expire_date','>=',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')))
            ->orWhere('post_date', '>=', Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->subDays(Settings('system_changenametime'))->format('m/d/Y H:i A')));

//        $goodPriceRealEstate = $this->checkRegisterDate($goodPriceRealEstate);
        $goodPriceRealEstate->limit(200);
        $goodPriceRealEstate = $goodPriceRealEstate->get();

        $freeRealEstates = RealEstate::with('district','province')->select('id', 'title','province_id','district_id' ,'direction_id','short_description', 'slug', 'code',
            'area_of_premises', 'price', 'unit_id', 'is_vip', 'is_hot', 'images', 'post_date')
            ->where('is_hot', '<>', 1)
            ->where('is_vip', '<>', 1)
            ->where('web_id', $this->web_id);

        $freeRealEstates = $freeRealEstates
            ->where('expire_date','>=',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')))
            ->orWhere('post_date', '>=', Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->subDays(Settings('system_changenametime'))->format('m/d/Y H:i A')));

//        $freeRealEstates = $this->checkRegisterDate($freeRealEstates);
        $freeRealEstates->limit(40);
        $freeRealEstates = $freeRealEstates->get();

        /*
         * get lít category
         * */
        $firstCat = $this->categories->first();
//        dd($firstCat->id);
        $reTypes = $this->reTypeService->getReTypeByCat($firstCat->id);
        $rangePrices = $this->rangePriceService->getRangePriceByCat($firstCat->id);


        return v('pages.home', [
            'hotRealEstates' => $hotRealEstates,
            'goodPriceRealEstate' => $goodPriceRealEstate,
            'freeRealEstates' => $freeRealEstates,
            'categories' => $this->categories,
            'reTypes' => $reTypes,
            'provinces' => $this->provinces,
            'districts' => $this->districts,
            'streets' => $this->streets,
            'directions' => $this->directions,
            'rangePrices' => $rangePrices,
            'menuData' => $this->menuFE,
            'newestRealEstates' => $newestRealEstates,
            'vipRealEstates' => $vipRealEstates
        ]);
    }
    public function getDanhmuc($tag)
    {
        try {
            $mappingMenuFEByTag = MappingMenuFE::where('path', $tag)->first();
//            dd($mappingMenuFEByTag);
            if ($mappingMenuFEByTag) {
                $query = RealEstate::whereNull('deleted_at')->where('web_id', $this->web_id);
                if ($mappingMenuFEByTag->re_category_id) {
                    $query->where('re_category_id', $mappingMenuFEByTag->re_category_id);
                }
                if ($mappingMenuFEByTag->re_category_id && $mappingMenuFEByTag->re_type_id) {
                    $query->where('re_type_id', $mappingMenuFEByTag->re_type_id);
                }
                if ($mappingMenuFEByTag->suggest) {
                    if ($mappingMenuFEByTag->suggest == MappingMenuFE::SG_HOT) {
                        $query->where('is_hot', 1);
                        $query->orderBy('post_date', 'desc');
                    }
                    if ($mappingMenuFEByTag->suggest == MappingMenuFE::SG_VIP) {
                        $query->where('is_vip', 1);
                        $query->where('is_hot', '<>', 1);
                    }
                }
//                $query = $this->checkRegisterDate($query);
                $countAll = $query->count();
                $results = $query->get();

                $category = null;
                if ($mappingMenuFEByTag->re_category_id) {
                    $category = ReCategory::find($mappingMenuFEByTag->re_category_id);
                }

                $type = null;
                if ($mappingMenuFEByTag->re_type_id) {
                    $type = ReType::find($mappingMenuFEByTag->re_type_id);
                }
//                dd($results);

                $pageTitle = '';
                if (!$mappingMenuFEByTag->re_category_id
                    && !$mappingMenuFEByTag->re_type_id
                    && $mappingMenuFEByTag->suggest) {
                    if ($mappingMenuFEByTag->suggest == MappingMenuFE::SG_HOT) {
                        $pageTitle = trans('page.tin_hot_box_title');
                    }
                    if ($mappingMenuFEByTag->suggest == MappingMenuFE::SG_VIP) {
                        $pageTitle = trans('page.tin_vip_box_title');
                    }
                }

                $this->vipRealEstates = $this->getVipRealEstates();

                return v('pages.list-real-estate', [
                    'data' => $results,
                    'category' => $category,
                    'type' =>$type,
                    'count' => $countAll,
                    'pageTitle' => $pageTitle,
                    'vipRealEstates' => $this->vipRealEstates,
                    'categories' => $this->categories,
                    'provinces' => $this->provinces,
                    'districts' => $this->districts,
                    'streets' => $this->streets,
                    'directions' => $this->directions,
                    'projects' => $this->projects,
                    'menuData' => $this->menuFE
                ]);

            }
        } catch (\Exception $exception) {

        }
    }

    public function featuredRealEstate()
    {
        $query = RealEstate::select('id', 'title', 'short_description', 'slug', 'code', 'district_id',
            'area_of_premises', 'area_of_use', 'price', 'unit_id', 'is_vip', 'is_hot', 'images', 'post_date')
            ->where('is_hot', 1)
            ->where('is_vip', '<>', 1)
            ->where('post_date', '<=', Carbon::now())
            ->where('web_id', $this->web_id)
            ->orderBy('post_date', 'desc');

        $query = $query
            ->where('expire_date','>=',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')))
            ->orWhere('post_date', '>=', Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->subDays(Settings('system_changenametime'))->format('m/d/Y H:i A')));
//        $query = $this->checkRegisterDate($query);
        $results = $query->get();

        $this->vipRealEstates = $this->getVipRealEstates();

        return v('pages.list-real-estate', [
            'data' => $results,
            'category' => null,
            'type' => null,
            'count' => null,
            'pageTitle' => trans('page.featured_real_estate'),
            'vipRealEstates' => $this->vipRealEstates,
            'categories' => $this->categories,
            'provinces' => $this->provinces,
            'districts' => $this->districts,
            'streets' => $this->streets,
            'directions' => $this->directions,
            'projects' => $this->projects,
            'menuData' => $this->menuFE
        ]);
    }

    public function newestRealEstate()
    {
        $query = RealEstate::select('id', 'title', 'short_description', 'slug', 'code', 'district_id',
            'area_of_premises', 'area_of_use', 'price', 'unit_id', 'is_vip', 'is_hot', 'images', 'post_date')
            ->where('post_date', '<=', Carbon::now())
            ->where('web_id', $this->web_id)
            ->orderBy('post_date', 'desc');
//        $query = $this->checkRegisterDate($query);
        $query = $query
            ->where('expire_date','>=',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')))
            ->orWhere('post_date', '>=', Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->subDays(Settings('system_changenametime'))->format('m/d/Y H:i A')));
        $results = $query->get();

        $this->vipRealEstates = $this->getVipRealEstates();

        return v('pages.list-real-estate', [
            'data' => $results,
            'category' => null,
            'type' => null,
            'count' => null,
            'pageTitle' => trans('page.newest_real_estate'),
            'vipRealEstates' => $this->vipRealEstates,
            'categories' => $this->categories,
            'provinces' => $this->provinces,
            'districts' => $this->districts,
            'streets' => $this->streets,
            'directions' => $this->directions,
            'projects' => $this->projects,
            'menuData' => $this->menuFE
        ]);
    }

    public function freeRealEstate()
    {
        $query = RealEstate::select('id', 'title', 'short_description', 'slug', 'code', 'district_id',
            'area_of_premises', 'area_of_use', 'price', 'unit_id', 'is_vip', 'is_hot', 'images', 'post_date')
            ->where('is_hot', '<>', 1)
            ->where('is_vip', '<>', 1)
            ->where('post_date', '<=', Carbon::now())
            ->where('web_id', $this->web_id)
            ->orderBy('post_date', 'desc');
//        $query = $this->checkRegisterDate($query);
        $query = $query
            ->where('expire_date','>=',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')))
            ->orWhere('post_date', '>=', Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->subDays(Settings('system_changenametime'))->format('m/d/Y H:i A')));
        $results = $query->get();

        $this->vipRealEstates = $this->getVipRealEstates();

        return v('pages.list-real-estate', [
            'data' => $results,
            'category' => null,
            'type' => null,
            'count' => null,
            'pageTitle' => trans('page.free_real_estate'),
            'vipRealEstates' => $this->vipRealEstates,
            'categories' => $this->categories,
            'provinces' => $this->provinces,
            'districts' => $this->districts,
            'streets' => $this->streets,
            'directions' => $this->directions,
            'projects' => $this->projects,
            'menuData' => $this->menuFE
        ]);
    }

    public function getRealEstateByCat($tag)
    {
        $explodeSlug = explode('-', $tag);
        $last = $explodeSlug[count($explodeSlug)-1];
        $catId = substr($last, 1);

        $category = ReCategory::find($catId);
        if ($category) {
            $query = RealEstate::select('id', 'title', 'short_description', 'slug', 'code', 'district_id',
                'area_of_premises', 'area_of_use', 'price', 'unit_id', 'is_vip', 'is_hot', 'images', 'post_date')
                ->where('re_category_id', $catId)
                ->where('post_date', '<=', Carbon::now())
                ->where('web_id', $this->web_id)
                ->orderBy('post_date', 'desc');
            $query = $query
                ->where('expire_date','>=',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')))
                ->orWhere('post_date', '>=', Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->subDays(Settings('system_changenametime'))->format('m/d/Y H:i A')));
//            $query = $this->checkRegisterDate($query);
            $countAll = $query->count();
            $results = $query->get();

            $this->vipRealEstates = $this->getVipRealEstates();

            return v('pages.list-real-estate', [
                'data' => $results,
                'category' => $category,
                'type' => null,
                'count' => $countAll,
                'vipRealEstates' => $this->vipRealEstates,
                'categories' => $this->categories,
                'provinces' => $this->provinces,
                'districts' => $this->districts,
                'streets' => $this->streets,
                'directions' => $this->directions,
                'projects' => $this->projects,
                'menuData' => $this->menuFE
            ]);
        }
    }

    public function homeTinVip()
    {
        $query = RealEstate::select('id', 'title', 'short_description', 'slug', 'code', 'district_id',
            'area_of_premises', 'area_of_use', 'price', 'unit_id', 'is_vip', 'is_hot', 'images', 'post_date')
            ->where('is_vip', 1)
            ->where('is_hot', '<>', 1)
            ->where('post_date', '<=', Carbon::now())
            ->where('web_id', $this->web_id)
            ->orderBy('post_date', 'desc');
        $query = $query
            ->where('expire_date','>=',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')))
            ->orWhere('post_date', '>=', Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->subDays(Settings('system_changenametime'))->format('m/d/Y H:i A')));
//        $query = $this->checkRegisterDate($query);
        $results = $query->get();

        $this->vipRealEstates = $this->getVipRealEstates();

        return v('pages.tin-vip', [
            'data' => $results,
            'vipRealEstates' => $this->vipRealEstates,
            'categories' => $this->categories,
            'provinces' => $this->provinces,
            'districts' => $this->districts,
            'streets' => $this->streets,
            'directions' => $this->directions,
            'projects' => $this->projects,
            'menuData' => $this->menuFE
        ]);
    }

    public function detailRealEstate($slug)
    {
        $explodeSlug = explode('-', $slug);
        $id = $explodeSlug[count($explodeSlug)-1];
        $realEstate = RealEstate::where('id', $id);
//        $realEstate = $this->checkRegisterDate($realEstate);
        $realEstate = $realEstate->first();

        /*
         * TODO: -get list same search option
         * TODO: - get list related real estate
         * */

        /*
         * get list same search option
         * */
        $sameSearchOptions = $this->service->getListBelowDetailPage(RealEstate::same_search, [], $realEstate);

        $relatedItems = $this->service->getListBelowDetailPage(RealEstate::related_item, [], $realEstate);

        $realEstate->views += 1;
        $realEstate->save();

        $this->vipRealEstates = $this->getVipRealEstates();

        return v('pages.detail-real-estate', [
            'data' => $realEstate,
            'sameSearchOptions' => $sameSearchOptions,
            'relatedItems' => $relatedItems,
            'vipRealEstates' => $this->vipRealEstates,
            'categories' => $this->categories,
            'provinces' => $this->provinces,
            'districts' => $this->districts,
            'streets' => $this->streets,
            'directions' => $this->directions,
            'projects' => $this->projects,
            'menuData' => $this->menuFE
        ]);
    }

    public function search()
    {
        $searchText = \request('txtkeyword');
        if(!$searchText) {
            return redirect()->route('home');
        }
        $query = RealEstate::select('id', 'title', 'short_description', 'slug', 'code', 'district_id',
            'area_of_premises', 'area_of_use', 'price', 'unit_id', 'is_vip', 'is_hot', 'images', 'post_date');

        $query->where('title', 'like', '%' . $searchText . '%');
        $query->orWhere('code', 'like', '%' . $searchText . '%');
        $query->orWhere('contact_phone_number', 'like', '%' . $searchText . '%');
        $query->where('web_id', $this->web_id);
        $query->where('post_date', '<=', Carbon::now());
        $query->orderBy('post_date', 'desc');
//        $query = $this->checkRegisterDate($query);

        $results = $query->get();

        $this->vipRealEstates = $this->getVipRealEstates();

        return v('pages.list-real-estate', [
            'data' => $results,
            'category' => null,
            'type' => null,
            'count' => null,
            'pageTitle' => trans('page.search_box_title'),
            'vipRealEstates' => $this->vipRealEstates,
            'categories' => $this->categories,
            'provinces' => $this->provinces,
            'districts' => $this->districts,
            'streets' => $this->streets,
            'directions' => $this->directions,
            'projects' => $this->projects,
            'isSearch' => true,
            'menuData' => $this->menuFE
        ]);
    }

    public function smartSearch(Request $request)
    {
        $filter = $request->all();
//        dd($filter);
        if($filter['Search']) {
            $query = RealEstate::select('id', 'title', 'short_description', 'slug', 'code', 'district_id',
                'area_of_premises', 'area_of_use', 'price', 'unit_id', 'is_vip', 'is_hot', 'images', 'post_date');

            if (isset($filter['Search']['cat_id']) && $filter['Search']['cat_id']) {
                $query->where('re_category_id', $filter['Search']['cat_id']);
            }
            if (isset($filter['Search']['type_id']) && $filter['Search']['type_id']) {
                $query->where('re_type_id', $filter['Search']['type_id']);
            }
            if (isset($filter['Search']['province_id']) && $filter['Search']['province_id']) {
                $query->where('province_id', $filter['Search']['province_id']);
            }
            if (isset($filter['Search']['district_id']) && $filter['Search']['district_id']) {
                $query->where('district_id', $filter['Search']['district_id']);
            }
            if (isset($filter['Search']['street_id']) && $filter['Search']['street_id']) {
                $query->where('street_id', $filter['Search']['street_id']);
            }
            if (isset($filter['Search']['direction_id']) && $filter['Search']['direction_id']) {
                $query->where('direction_id', $filter['Search']['direction_id']);
            }
            if (isset($filter['Search']['range_price_id']) && $filter['Search']['range_price_id']) {
                $query->where('range_price_id', $filter['Search']['range_price_id']);
            }

            if (isset($filter['Search']['project_id']) && $filter['Search']['project_id']) {
                $query->where('project_id', $filter['Search']['project_id']);
            }
            if (isset($filter['Search']['phone']) && $filter['Search']['phone']) {
                $query->where('contact_phone_number', 'like', '%'.$filter['Search']['phone'].'%');
            }
            if (isset($filter['Search']['dtmb_from']) && $filter['Search']['dtmb_from']) {
                $query->where('area_of_premises', '>=', floatval($filter['Search']['dtmb_from']));
            }
            if (isset($filter['Search']['dtmb_to']) && $filter['Search']['dtmb_to']) {
                $query->where('area_of_premises', '<=', floatval($filter['Search']['dtmb_to']));
            }
//            $query = $this->checkRegisterDate($query);

            $results = $query->get();

            $this->vipRealEstates = $this->getVipRealEstates();

            return v('pages.list-real-estate', [
                'data' => $results,
                'category' => null,
                'type' => null,
                'count' => null,
                'pageTitle' => trans('page.smart_search_title'),
                'vipRealEstates' => $this->vipRealEstates,
                'categories' => $this->categories,
                'provinces' => $this->provinces,
                'districts' => $this->districts,
                'streets' => $this->streets,
                'directions' => $this->directions,
                'projects' => $this->projects,
                'menuData' => $this->menuFE
            ]);
        }

        return redirect()->route('home');
    }

    /*
     * Chat function
     * */
    public function getChat()
    {
        if (!Auth::user()->group->chat_permission) {
            return redirect()->route('home');
        }
        $users = User::where('id','!=',Auth::user()->id)->get();
        $conversations = Auth::user()->conversations();

        $this->vipRealEstates = $this->getVipRealEstates();

        return v('conversation.list', [
            'users' => $users,
            'conversations' => $conversations,
            'vipRealEstates' => $this->vipRealEstates,
            'categories' => $this->categories,
            'provinces' => $this->provinces,
            'districts' => $this->districts,
            'streets' => $this->streets,
            'directions' => $this->directions,
            'projects' => $this->projects,
            'menuData' => $this->menuFE
        ]);
    }

    public function getUserInfo($id)
    {
        try {
            $user = User::find($id);
            if ($user) {
                $reCategories = $this->reCategoryService->getListDropDown();
                $provinces = $this->provinceService->getListDropDown();
                $streets = $this->streetService->getListDropDown();
                $directions = $this->directionService->getListDropDown();
                $exhibits = $this->exhibitService->getListDropDown();
                $blocks = $this->blockService->getListDropDown();
                $constructionTypes = $this->constructionTypeService->getListDropDown();
                $units = $this->unitService->getListDropDown();

                /*
                 * TODO: get list districts by user province
                 * */
                $userProvinceId = $user->userinfo->province_id;
                $districtByUProvince = $this->districtService->getDistrictByProvince($userProvinceId);
                $projectByUProvince = $this->projectService->getProjectByProvince($userProvinceId);

                /*
                 * get all post of user
                 * */
                $query = RealEstate::select('id', 'title', 'slug', 'code', 're_category_id', 'contact_phone_number', 'district_id', 'floor', 'position', 'bedroom', 'living_room',
                    'wc', 'lat', 'long', 'area_of_premises', 'area_of_use', 'price', 'unit_id', 'is_vip', 'is_hot', 'images', 'post_date');
                $query1 = clone $query;
                $query1->where('posted_by', $id);
                if (!Auth::user() || (Auth::user() && Auth::user()->id !== intval($id))) {
                    $query1->where('draft', 0);
                    $query1->where('approved', 1);
                }
                $query1->orderBy('created_at', 'desc');
                $listRe = $query1->get();

                /*
                 * get posted real estate
                 * */
                $query2 = clone $query;
                $query2->where('posted_by', $id);
                $query2->where('draft', 0);
                $query2->where('approved', 1);
                $listPostedRe = $query2->get();

                /*
                 * get all friend
                 * */
                $listFriends = Friend::where('user1', $id)->orWhere('user2', $id)->where('confirmed', 1)->get();
                /*
                 * get list friend request
                 * */
//                $authUser = \Auth::user();
//                $authFriendRequestLists = Friend::where('user2', $authUser->id)->where('confirmed', 0)->get();
//                dd($authFriendRequestLists);

                return v('users.user-info', [
                    'data' => $user,
                    'vipRealEstates' => $this->vipRealEstates,
                    'categories' => $this->categories,
                    'reCategories' => $reCategories,
                    'provinces' => $this->provinces,
                    'districts' => $this->districts,
                    'streets' => $this->streets,
                    'directions' => $this->directions,
                    'exhibits' => $exhibits,
                    'blocks' => $blocks,
                    'constructionTypes' => $constructionTypes,
                    'units' => $units,
                    'projects' => $this->projects,
                    'listRe' => $listRe,
                    'listPostedRe' => $listPostedRe,
                    'listFriends' => $listFriends,
                    'districtByUProvince' => $districtByUProvince,
                    'projectByUProvince' => $projectByUProvince,
                    'menuData' => $this->menuFE
                ]);
            }
        } catch (\Exception $exception) {
            \Log::info($exception->getMessage());
        }
    }

    private function getVipRealEstates()
    {
        $query = RealEstate::select('id', 'title', 'slug', 'direction_id',
            'area_of_premises', 'price', 'unit_id', 'is_vip', 'is_hot', 'post_date', 'images')
            ->where('is_vip',  1)
            ->where('is_hot', '<>', 1)
            ->where('post_date', '<=', Carbon::now())
            ->where('web_id', $this->web_id);

//            ->where('vip_expire_at',  '<=', Carbon::now())
//        $query = $this->checkRegisterDate($query);
        $query->limit(30);
        $results = $query->get();
//        dd($results);
        return $results;
    }

    private function checkRegisterDate($query)
    {
        $adminGroupVal = config('group.admin_group');
        if ( ($user = Auth::user()) && Auth::user()->group_id !== $adminGroupVal) {
            $query->where('post_date', '>=', $user->created_at);
        }
        return $query;
    }
}
