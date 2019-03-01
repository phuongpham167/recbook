<?php

namespace App\Http\Controllers;

use App\Freelancer;
use App\Friend;
use App\MappingMenuFE;
use App\Menu;
use App\Province;
use App\RealEstate;
use App\ReCategory;
use App\ReType;
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
use App\Services\ReTypeService;
use App\Services\StreetService;
use App\Services\UnitService;
use App\Services\WardService;
use App\User;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    protected $menuFE, $vipRealEstates, $web_id;
    protected $categories, $provinces, $districts, $wards, $streets, $directions, $projects;

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
    protected $agencies;

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
        $this->wards = $this->wardService->getListDropDown();
        $this->streets = $this->streetService->getListDropDown();
        $this->directions = $this->directionService->getListDropDown();
        $this->projects = $this->projectService->getListDropDown();
//        var_dump( session('tinhthanhquantam'));
    }

    public function index1()
    {
//        var_dump(session('tinhthanhquantam'));
//        exit();
        $vip    =   [];
        for($i=1; $i<7; $i++){
            $query    = RealEstate::filterprovince()->where('public_site', 1)->select('id', 'title', 'slug', 'short_description', 'detail', 'code', 'don_vi',
                'area_of_premises', 'area_of_use', 'district_id', 'price', 'unit_id', 'is_vip', 'is_hot', 'vip_type',
                'post_date', 'images');
            if($i == 6)
                $query  =   $query->where(function($q){
                    $q->where('vip_type', 2)
                        ->orWhere('vip_type', 6);
                });
            else
                $query  =   $query->where('vip_type', $i);
            $query =    $query->where(function($q){
                    $q->whereNull('vip_expire_at')
                        ->orWhere('vip_expire_at', '>=', Carbon::now());
                })
                ->where('expire_date', '>=', Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')))
                ->where('web_id', $this->web_id);
            $query->take(get_config('vip'.$i, 10));
            $query = $query->get();
            $vip[$i] = $query;
        }


        //Tin HOT
        $hotRealEstates = RealEstate::filterprovince()->where('public_site',1)->select('id', 'title', 'slug', 'short_description', 'detail', 'code', 'don_vi',
            'area_of_premises', 'area_of_use', 'district_id', 'price', 'unit_id', 'is_vip', 'is_hot','vip_type',
            'post_date', 'images')
            ->where('vip_type', 1)
            ->where('expire_date','>=',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')))
            ->where('web_id', $this->web_id);
        $hotRealEstates->limit(get_config('homeHotRealEstate', 10));
        $hotRealEstates = $hotRealEstates->get();

        //Tin HOT nổi bật
        $hotHLRealEstates = RealEstate::filterprovince()->where('public_site',1)->select('id', 'title', 'slug', 'short_description', 'detail', 'code', 'don_vi',
            'area_of_premises', 'area_of_use', 'district_id', 'price', 'unit_id', 'is_vip', 'is_hot','vip_type',
            'post_date', 'images')
            ->where('vip_type', 2)
            ->where('expire_date','>=',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')))
            ->where('web_id', $this->web_id);
        $hotHLRealEstates->limit(get_config('homeHotRealEstate', 10));
        $hotHLRealEstates = $hotHLRealEstates->get();

        //Tin VIP
        $goodPriceRealEstateVip = RealEstate::filterprovince()->where('public_site',1)->select('id', 'title', 'short_description', 'detail', 'slug', 'code', 'don_vi',
            'area_of_premises', 'price', 'unit_id', 'is_vip', 'is_hot', 'images', 'post_date')
            ->where(function($q){
                $q->where('expire_date','>=',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')))
                    ->orWhere('post_date', '>=', Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->subDays(Settings('system_changenametime'))->format('m/d/Y H:i A')));
            })
            ->where('post_date', '<=', Carbon::now())
            ->where('web_id', $this->web_id)
            ->orderBy('post_date', 'desc')
            ->where('vip_type', 3);
        $goodPriceRealEstateVip = $goodPriceRealEstateVip->take(get_config('homeNewestVip'))->get();


        //Tin VIP nổi bật
        $goodPriceRealEstateVipHot = RealEstate::filterprovince()->where('public_site',1)->select('id', 'title', 'short_description', 'detail', 'slug', 'code', 'don_vi',
            'area_of_premises', 'price', 'unit_id', 'is_vip', 'is_hot', 'images', 'post_date')
            ->where(function($q){
                $q->where('expire_date','>=',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')))
                    ->orWhere('post_date', '>=', Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->subDays(Settings('system_changenametime'))->format('m/d/Y H:i A')));
            })
            ->where('post_date', '<=', Carbon::now())
            ->where('web_id', $this->web_id)
            ->orderBy('post_date', 'desc')
            ->where('vip_type',4);
        $goodPriceRealEstateVipHot = $goodPriceRealEstateVipHot->take(get_config('homeNewestHot'))->get();

        //Tin hấp dẫn
        $goodPriceRealEstateNormal = RealEstate::filterprovince()->where('public_site',1)->select('id', 'title', 'short_description', 'detail', 'slug', 'code', 'don_vi',
            'area_of_premises', 'price', 'unit_id', 'is_vip', 'is_hot', 'images', 'post_date')
            ->where(function($q){
                $q->where('expire_date','>=',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')))
                    ->orWhere('post_date', '>=', Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->subDays(Settings('system_changenametime'))->format('m/d/Y H:i A')));
            })
            ->where('post_date', '<=', Carbon::now())
            ->where('web_id', $this->web_id)
            ->orderBy('post_date', 'desc')
            ->where('vip_type','<>',5);
        $goodPriceRealEstateNormal =    $goodPriceRealEstateNormal->take(get_config('homeNewestNormal'))->get();

        //Vip bên phải
        $vipRealEstates  =   RealEstate::filterprovince()->where('public_site',1)->select('id', 'title', 'slug', 'short_description', 'detail', 'code', 'don_vi',
            'area_of_premises', 'area_of_use', 'district_id', 'price', 'unit_id', 'is_vip', 'is_hot','vip_type',
            'post_date', 'images','district_id', 'province_id', 'direction_id')
            ->where('vip_type', 3)
            ->where('expire_date','>=',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')))
            ->where('web_id', $this->web_id)->orderBy('post_date','DESC');

        $vipRealEstates = $vipRealEstates->take(get_config('homeSidebarVip',8))->get();

        //Tin cộng đồng
        $freeRealEstates = RealEstate::filterprovince()->select('id', 'title', 'short_description', 'detail', 'slug', 'code', 'don_vi',
            'area_of_premises', 'price', 'unit_id', 'is_vip', 'is_hot', 'images', 'post_date')
            ->where('is_hot', '<>', 1)
            ->where('is_vip', '<>', 1)
            ->where('web_id', $this->web_id)->where('is_public', 1);

        $freeRealEstates = $freeRealEstates
            ->where(function($q){
                $q->where('expire_date','>=',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')))
                    ->orWhere('post_date', '>=', Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->subDays(Settings('system_changenametime'))->format('m/d/Y H:i A')));
            });


//        $freeRealEstates = $this->checkRegisterDate($freeRealEstates);
        $freeRealEstates =  $freeRealEstates->where('public_site',1)->orderBy('created_at', 'DESC')->take(get_config('homePublic',8))->get();

        /*
         * get lít category
         * */
        $firstCat = $this->categories->first();
//        dd($firstCat->id);
        $reTypes = $this->reTypeService->getReTypeByCat($firstCat->id);
        $rangePrices = $this->rangePriceService->getRangePriceByCat($firstCat->id);

        $freelancer_all    =   Freelancer::where('status', 'open')->take(9)->get();
        $freelancer_re    =   Freelancer::where('status', 'open')->where('category_id', 1)->take(9)->get();
        $freelancer_finance    =   Freelancer::where('status', 'open')->where('category_id', 2)->take(9)->get();
        $freelancer_design    =   Freelancer::where('status', 'open')->where('category_id', 3)->take(9)->get();
        $freelancer_phongthuy    =   Freelancer::where('status', 'open')->where('category_id', 4)->take(9)->get();
        $province_list = Province::whereNotNull('id')->orderBy('order','asc')->get();
        Carbon::setLocale('vi');

        $this->agencies =   User::whereHas('group', function($q){
            $q->where('is_agency', 1);
        })->where('province_id', session('tinhthanhquantam'))->inRandomOrder()->take(get_config('homeAgency', 8))->get();
        return v('pages.home-1', [
            'vip'   =>  $vip,
            'hotHLRealEstates' => $hotHLRealEstates,
            'hotRealEstates' => $hotRealEstates,
            'goodPriceRealEstateNormal' => $goodPriceRealEstateNormal,
            'goodPriceRealEstateVip' => $goodPriceRealEstateVip,
            'goodPriceRealEstateVipHot' => $goodPriceRealEstateVipHot,
            'freeRealEstates' => $freeRealEstates,
            'categories' => $this->categories,
            'reTypes' => $reTypes,
            'provinces' => $this->provinces,
            'districts' => $this->districts,
            'wards' => $this->wards,
            'streets' => $this->streets,
            'directions' => $this->directions,
            'rangePrices' => $rangePrices,
            'menuData' => $this->menuFE,
            'vipRealEstates' => $vipRealEstates,
            'agencies'  =>  $this->agencies,
            'province_list' => $province_list,
            'freelancer' => [
                'all'   =>  $freelancer_all,
                're' => $freelancer_re,
                'finance' => $freelancer_finance,
                'design' => $freelancer_design,
                'phongthuy' => $freelancer_phongthuy
            ]
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
            ->where(function($q){
                $q->where('expire_date','>=',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')))
                    ->orWhere('post_date', '>=', Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->subDays(Settings('system_changenametime'))->format('m/d/Y H:i A')));
            })
            ->where('post_date', '<=', Carbon::now())
//            ->where('hot_expire_at', '<=', Carbon::now())
            ->where('web_id', $this->web_id)->orderBy('post_date','DESC');

        $newestRealEstates = $newestRealEstates->take(10)->get();
        $vipRealEstates  =   RealEstate::select('id', 'title', 'slug', 'short_description', 'code',
            'area_of_premises', 'area_of_use', 'district_id', 'price', 'unit_id', 'is_vip', 'is_hot',
            'post_date', 'images','district_id', 'province_id', 'direction_id')
            ->where(function($q){
                $q->where('is_hot', '<>', 1)
                    ->where('is_vip', 1);
            })
            ->where(function($q){
                $q->where('expire_date','>=',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')))
                    ->orWhere('post_date', '>=', Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->subDays(Settings('system_changenametime'))->format('m/d/Y H:i A')));
            })
            ->where('post_date', '<=', Carbon::now())
//            ->where('hot_expire_at', '<=', Carbon::now())
            ->where('web_id', $this->web_id)->orderBy('post_date','DESC');

        $vipRealEstates = $vipRealEstates->take(10)->get();
        /*
         * TODO: need more info to filter good price items
         * Now: get vip only
         * */
        $goodPriceRealEstate = RealEstate::select('id', 'title', 'short_description', 'slug', 'code',
            'area_of_premises', 'price', 'unit_id', 'is_vip', 'is_hot', 'images', 'post_date','district_id', 'province_id', 'direction_id')
            ->where('is_vip', 1)
            ->where(function($q){
                $q->where('expire_date','>=',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')))
                    ->orWhere('post_date', '>=', Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->subDays(Settings('system_changenametime'))->format('m/d/Y H:i A')));
            })
            ->where('post_date', '<=', Carbon::now())
            ->where('web_id', $this->web_id)
            ->orderBy('post_date', 'desc');

//        $goodPriceRealEstate = $this->checkRegisterDate($goodPriceRealEstate);
        $goodPriceRealEstate->limit(200);
        $goodPriceRealEstate = $goodPriceRealEstate->get();

        $freeRealEstates = RealEstate::with('district','province')->select('id', 'title','province_id','district_id' ,'direction_id','short_description', 'slug', 'code',
            'area_of_premises', 'price', 'unit_id', 'is_vip', 'is_hot', 'images', 'post_date')
            ->where(function($q){
                $q->where('expire_date','>=',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')))
                    ->orWhere('post_date', '>=', Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->subDays(Settings('system_changenametime'))->format('m/d/Y H:i A')));
            })
            ->where('is_hot', '<>', 1)
            ->where('is_vip', '<>', 1)
            ->where('web_id', $this->web_id)->where('is_public', 1);

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
            'wards' => $this->wards,
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
                $query = RealEstate::filterprovince()->where('public_site',1)->whereNull('deleted_at')->where('web_id', $this->web_id);
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
                $results = $query->paginate(get_config('itemsPerPage',30));

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
                    'wards' => $this->wards,
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
        $query = RealEstate::filterprovince()->select('id', 'title', 'short_description', 'detail', 'slug', 'code', 'district_id', 'don_vi',
            'area_of_premises', 'area_of_use', 'price', 'unit_id', 'is_vip', 'is_hot', 'images', 'post_date')
            ->where('vip_type', 1)
            ->where(function($q){
                $q->where('expire_date','>=',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')))
                    ->orWhere('post_date', '>=', Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->subDays(Settings('system_changenametime'))->format('m/d/Y H:i A')));
            })
            ->where('post_date', '<=', Carbon::now())
            ->where('web_id', $this->web_id)
            ->orderBy('post_date', 'desc');

//        $query = $this->checkRegisterDate($query);
        $results = $query->paginate(get_config('itemsPerPage',30));

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
            'wards' => $this->wards,
            'streets' => $this->streets,
            'directions' => $this->directions,
            'projects' => $this->projects,
            'menuData' => $this->menuFE
        ]);
    }

    public function newestRealEstate()
    {
        $query = RealEstate::filterprovince()->select('id', 'title', 'short_description', 'detail', 'slug', 'code', 'district_id', 'don_vi',
            'area_of_premises', 'area_of_use', 'price', 'unit_id', 'is_vip', 'is_hot', 'images', 'post_date')
            ->where('post_date', '<=', Carbon::now())
            ->where('web_id', $this->web_id)
            ->where(function($q){
                $q->where('expire_date','>=',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')))
                    ->orWhere('post_date', '>=', Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->subDays(Settings('system_changenametime'))->format('m/d/Y H:i A')));
            })
            ->orderBy('post_date', 'desc');
//        $query = $this->checkRegisterDate($query);

        $results = $query->paginate(get_config('itemsPerPage', 30));

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
            'wards' => $this->wards,
            'streets' => $this->streets,
            'directions' => $this->directions,
            'projects' => $this->projects,
            'menuData' => $this->menuFE
        ]);
    }

    public function freeRealEstate()
    {
        $query = RealEstate::filterprovince()->select('id', 'title', 'short_description', 'detail', 'slug', 'code', 'district_id', 'don_vi',
            'area_of_premises', 'area_of_use', 'price', 'unit_id', 'is_vip', 'is_hot', 'images', 'post_date')
            ->where(function($q){
                $q->where(function($a){
                    $a->where('is_hot', '<>', 1)
                        ->orWhereNull('is_hot');
                })->where(function($a){
                    $a->where('is_vip', '<>', 1)
                        ->orWhereNull('is_vip');
                });
            })
            ->where(function($q){
                $q->where('expire_date','>=',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')))
                    ->orWhere('post_date', '>=', Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->subDays(Settings('system_changenametime'))->format('m/d/Y H:i A')));
            })
            ->where('post_date', '<=', Carbon::now())
            ->where('web_id', $this->web_id)
            ->orderBy('post_date', 'desc')
            ->where('is_public', 1)
            ->where('public_site', 1);
//        $query = $this->checkRegisterDate($query);

        $results = $query->paginate(get_config('itemsPerPage', 30));

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
            'wards' => $this->wards,
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
            $query = RealEstate::filterprovince()->select('id', 'title', 'short_description', 'detail', 'slug', 'code', 'district_id', 'don_vi',
                'area_of_premises', 'area_of_use', 'price', 'unit_id', 'is_vip', 'is_hot', 'images', 'post_date')
                ->where(function($q){
                    $q->where('expire_date','>=',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')))
                        ->orWhere('post_date', '>=', Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->subDays(Settings('system_changenametime'))->format('m/d/Y H:i A')));
                })
                ->where('re_category_id', $catId)
                ->where('post_date', '<=', Carbon::now())
                ->where('web_id', $this->web_id)
                ->orderBy('post_date', 'desc');

//            $query = $this->checkRegisterDate($query);
            $countAll = $query->count();
            $results = $query->paginate(get_config('itemsPerPage', 30));

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
                'wards' => $this->wards,
                'streets' => $this->streets,
                'directions' => $this->directions,
                'projects' => $this->projects,
                'menuData' => $this->menuFE
            ]);
        }
    }

    public function homeTinVip()
    {
        $query = RealEstate::filterprovince()->select('id', 'title', 'short_description', 'detail', 'slug', 'code', 'district_id', 'don_vi',
            'area_of_premises', 'area_of_use', 'price', 'unit_id', 'is_vip', 'is_hot', 'images', 'post_date')
            ->where(function($q){
                $q->where('is_vip', 1)
                    ->where('is_hot', '<>', 1);
            })
            ->where(function($q){
                $q->where('expire_date','>=',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')))
                    ->orWhere('post_date', '>=', Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->subDays(Settings('system_changenametime'))->format('m/d/Y H:i A')));
            })
            ->where('post_date', '<=', Carbon::now())
            ->where('web_id', $this->web_id)
            ->orderBy('post_date', 'desc');

//        $query = $this->checkRegisterDate($query);
        $results = $query->get();

        $this->vipRealEstates = $this->getVipRealEstates();

        return v('pages.tin-vip', [
            'data' => $results,
            'vipRealEstates' => $this->vipRealEstates,
            'categories' => $this->categories,
            'provinces' => $this->provinces,
            'districts' => $this->districts,
            'wards' => $this->wards,
            'streets' => $this->streets,
            'directions' => $this->directions,
            'projects' => $this->projects,
            'menuData' => $this->menuFE
        ]);
    }

    public function detailRealEstate($slug)
    {
        try {
            $explodeSlug = explode('-', $slug);
            $id = $explodeSlug[count($explodeSlug) - 1];
            $realEstate = RealEstate::withoutGlobalScope(PrivateScope::class)->where('id', $id);
//        $realEstate = $this->checkRegisterDate($realEstate);
            $realEstate = $realEstate->first();
            
            /*
             * get list same search option
             * */
            $sameSearchOptions = $this->service->getListBelowDetailPage(RealEstate::same_search, [], $realEstate);

            $relatedItems = $this->service->getListBelowDetailPage(RealEstate::related_item, [], $realEstate);

            $realEstate->views += 1;
            $realEstate->save();

            $this->vipRealEstates = $this->getVipRealEstates();

            session(['comment.id'=>$realEstate->id, 'comment.type'=>'realestate']);
            activity('RealEstate','view', $id);
            return v('pages.detail-real-estate', [
                'data' => $realEstate,
                'sameSearchOptions' => $sameSearchOptions,
                'relatedItems' => $relatedItems,
                'vipRealEstates' => $this->vipRealEstates,
                'categories' => $this->categories,
                'provinces' => $this->provinces,
                'districts' => $this->districts,
                'wards' => $this->wards,
                'streets' => $this->streets,
                'directions' => $this->directions,
                'projects' => $this->projects,
                'menuData' => $this->menuFE
            ]);
        } catch (\Exception $exception) {
            \Log::info($exception->getMessage());
            return redirect(route('404', [], 404));
        }
    }

    public function search()
    {
        $searchText = \request('txtkeyword');
//        if(!$searchText) {
//            return redirect()->route('home');
//        }
        $query = RealEstate::filterprovince()->select('id', 'title', 'short_description', 'detail', 'slug', 'code', 'district_id', 'don_vi',
            'area_of_premises', 'area_of_use', 'price', 'unit_id', 'is_vip', 'is_hot', 'images', 'post_date');

        $query  =   $query->where(function($q) use ($searchText){
            $q->where('title', 'like', '%' . $searchText . '%');
            $q->orWhere('code', 'like', '%' . $searchText . '%');
            $q->orWhere('contact_phone_number', 'like', '%' . $searchText . '%');
        });

        $query->where('web_id', $this->web_id);
        $query->where('post_date', '<=', Carbon::now());
        $query->orderBy('post_date', 'desc');
        if(!empty(request('project_id')))
            $query  =   $query->where('project_id', request('project_id'));
//        $query = $this->checkRegisterDate($query);

        $results = $query->paginate(get_config('itemsPerPage', 30));

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
            'wards' => $this->wards,
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
            $query = RealEstate::filterprovince()->select('id', 'title', 'short_description', 'detail', 'slug', 'code', 'district_id','province_id','ward_id','street_id', 'don_vi',
                'area_of_premises', 'area_of_use', 'price', 'unit_id', 'is_vip', 'is_hot', 'images', 'post_date');

            if (isset($filter['Search']['cat_id']) && $filter['Search']['cat_id']!=0) {
                $query->where('re_category_id', $filter['Search']['cat_id']);
            }
            if (isset($filter['Search']['type_id']) && $filter['Search']['type_id']!=0) {
                $query->where('re_type_id', $filter['Search']['type_id']);
            }
            if (isset($filter['Search']['province_id']) && $filter['Search']['province_id']!=0) {
                $query->where('province_id', $filter['Search']['province_id']);
            }
            if (isset($filter['Search']['district_id']) && $filter['Search']['district_id']!=0) {
                $query->where('district_id', $filter['Search']['district_id']);
            }
            if (isset($filter['Search']['ward_id']) && $filter['Search']['ward_id']!=0) {
                $query->where('ward_id', $filter['Search']['ward_id']);
            }
            if (isset($filter['Search']['street_id']) && $filter['Search']['street_id']!=0) {
                $query->where('street_id', $filter['Search']['street_id']);
            }
            if (isset($filter['Search']['direction_id']) && $filter['Search']['direction_id']!=0) {
                $query->where('direction_id', $filter['Search']['direction_id']);
            }
            if (isset($filter['Search']['range_price_id']) && $filter['Search']['range_price_id']!=0) {
                $query->where('range_price_id', $filter['Search']['range_price_id']);
            }

            if (isset($filter['Search']['project_id']) && $filter['Search']['project_id']!=0) {
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
            if(isset($filter['Search']['keyword']) && $keyword = $filter['Search']['keyword'] ){
                $query  =   $query->where(function($q) use ($keyword){
                    $q->where('title', 'like', '%' . $keyword . '%');
                    $q->orWhere('code', 'like', '%' . $keyword . '%');
                    $q->orWhere('contact_phone_number', 'like', '%' . $keyword . '%');
                });
            }
            $results = $query->paginate(get_config('itemsPerPage', 30));

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
                'wards' => $this->wards,
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
//        $users = User::where('id','!=',Auth::user()->id)->get();
        $userId = Auth::user()->id;
        $users = Friend::where(function($query) use ($userId) {
                $query->where('user1', $userId)
                    ->orWhere('user2', $userId);
            })
            ->where('confirmed', 1)
            ->get();
        $conversations = Auth::user()->conversations();

        $this->vipRealEstates = $this->getVipRealEstates();

        return v('conversation.list', [
            'users' => $users,
            'conversations' => $conversations,
            'vipRealEstates' => $this->vipRealEstates,
            'categories' => $this->categories,
            'provinces' => $this->provinces,
            'districts' => $this->districts,
            'wards' => $this->wards,
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

                $provinces = $this->provinceService->getListOrderByWishList();
                
                $streets = $this->streetService->getListDropDown();
                $directions = $this->directionService->getListDropDown();
                $exhibits = $this->exhibitService->getListDropDown();
                $blocks = $this->blockService->getListDropDown();
                $constructionTypes = $this->constructionTypeService->getListDropDown();
                $units = $this->unitService->getListDropDown();
                $rangePrices = $this->rangePriceService->getListDropDown();

                /*
                 * TODO: get list districts by user province
                 * */
                $userProvinceId = $user->userinfo->province_id;
                $districtByUProvince = $this->districtService->getDistrictByProvince($userProvinceId);
//                $projectByUProvince = $this->projectService->getProjectByProvince($userProvinceId);

                /*
                 * get all post of user
                 * */
                $query = RealEstate::select('id', 'title', 'detail', 'slug', 'code', 're_category_id', 'contact_phone_number', 'district_id', 'floor', 'position', 'bedroom', 'living_room',
                    'don_vi', 'wc', 'direction_id', 'exhibit_id', 'lat', 'long', 'area_of_premises', 'area_of_use', 'price', 'unit_id', 'is_vip', 'is_hot', 'images', 'post_date');
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

                $joinedFreeLances = $this->service->getJoinedFreelance($user->id);

                return v('users.user-info', [
                    'data' => $user,
                    'vipRealEstates' => $this->vipRealEstates,
                    'categories' => $this->categories,
                    'reCategories' => $reCategories,
                    'provinces' => $provinces,
                    'districts' => $this->districts,
                    'wards' => $this->wards,
                    'streets' => $this->streets,
                    'directions' => $this->directions,
                    'exhibits' => $exhibits,
                    'blocks' => $blocks,
                    'constructionTypes' => $constructionTypes,
                    'units' => $units,
                    'rangePrices' => $rangePrices,
                    'projects' => $this->projects,
                    'listRe' => $listRe,
                    'listPostedRe' => $listPostedRe,
                    'listFriends' => $listFriends,
                    'districtByUProvince' => $districtByUProvince,
//                    'projectByUProvince' => $projectByUProvince,
                    'joinedFreeLances' => $joinedFreeLances,
                    'menuData' => $this->menuFE
                ]);
            }
            return response('Người dùng không tồn tại hoặc đã bị khóa');
        } catch (\Exception $exception) {
            \Log::info($exception->getMessage());
        }
    }

    private function getVipRealEstates()
    {
        $query = RealEstate::filterprovince()->select('id', 'title', 'slug', 'direction_id', 'don_vi',
            'area_of_premises', 'price', 'unit_id', 'is_vip', 'is_hot', 'post_date', 'images')
            ->where(function($q){
                $q->where('is_vip', 1)
                    ->where('is_hot', '<>', 1);
            })
            ->where(function($q){
                $q->where('expire_date','>=',Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->format('m/d/Y H:i A')))
                    ->orWhere('post_date', '>=', Carbon::createFromFormat('m/d/Y H:i A', Carbon::now()->subDays(Settings('system_changenametime'))->format('m/d/Y H:i A')));
            })
            ->where('post_date', '<=', Carbon::now())
            ->where('web_id', $this->web_id);

//            ->where('vip_expire_at',  '<=', Carbon::now())
//        $query = $this->checkRegisterDate($query);
        $results = $query->paginate(get_config('itemsPerPage', 30));
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
