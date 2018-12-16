<?php

namespace App\Http\Controllers;

use App\MappingMenuFE;
use App\Menu;
use App\RealEstate;
use App\ReCategory;
use App\ReType;
use App\Services\DirectionService;
use App\Services\DistrictService;
use App\Services\PageService;
use App\Services\ProjectService;
use App\Services\RangePriceService;
use App\Services\ReTypeService;
use App\Services\StreetService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    protected $menuFE, $vipRealEstates, $web_id;
    protected $categories, $districts, $streets, $directions, $projects;

    protected $service;
    protected $reTypeService;
    protected $rangePriceService;
    protected $districtService;
    protected $streetService;
    protected $directionService;
    protected $projectService;

    public function __construct(
        PageService $pageService,
        ReTypeService $reTypeService,
        DistrictService $districtService,
        StreetService $streetService,
        DirectionService $directionService,
        RangePriceService $rangePriceService,
        ProjectService $projectService
    )
    {
        $this->web_id = get_web_id();
        $mmfe = config('menu.mainMenuFE');
        $this->menuFE = Menu::where('web_id', $this->web_id)->where('menu_type', $mmfe)->first();

        $this->service = $pageService;
        $this->reTypeService = $reTypeService;
        $this->districtService = $districtService;
        $this->streetService = $streetService;
        $this->directionService = $directionService;
        $this->rangePriceService = $rangePriceService;
        $this->projectService = $projectService;

        $this->vipRealEstates = RealEstate::select('id', 'title', 'slug', 'direction_id',
            'area_of_premises', 'price', 'unit_id', 'is_vip', 'is_hot', 'post_date', 'images')
            ->where('is_vip',  1)
            ->where('is_hot', '<>', 1)
            ->where('post_date', '<=', Carbon::now())
            ->where('web_id', $this->web_id)
//            ->where('vip_expire_at',  '<=', Carbon::now())
            ->limit(30)
            ->get();

        $this->categories = ReCategory::select('id', 'name', 'slug')
            ->orderBy('id', 'asc')
//            ->where('web_id', $web_id)
            ->get();
        $this->districts = $this->districtService->getListDropDown();
        $this->streets = $this->streetService->getListDropDown();
        $this->directions = $this->directionService->getListDropDown();
        $this->projects = $this->projectService->getListDropDown();
    }

    public function index()
    {
        $hotRealEstates = RealEstate::select('id', 'title', 'slug', 'short_description', 'code',
            'area_of_premises', 'area_of_use', 'district_id', 'price', 'unit_id', 'is_vip', 'is_hot',
            'post_date', 'images')
            ->where('is_hot', 1)
            ->where('is_vip', '<>', 1)
            ->where('post_date', '<=', Carbon::now())
//            ->where('hot_expire_at', '<=', Carbon::now())
            ->where('web_id', $this->web_id)
            ->limit(16)
            ->get();
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
            ->orderBy('post_date', 'desc')
            ->limit(200)
            ->get();

        $freeRealEstates = RealEstate::select('id', 'title', 'short_description', 'slug', 'code',
            'area_of_premises', 'price', 'unit_id', 'is_vip', 'is_hot', 'images', 'post_date')
            ->where('is_hot', '<>', 1)
            ->where('is_vip', '<>', 1)
            ->where('web_id', $this->web_id)
            ->limit(40)
            ->get();

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
            'districts' => $this->districts,
            'streets' => $this->streets,
            'directions' => $this->directions,
            'rangePrices' => $rangePrices,
            'menuData' => $this->menuFE
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
//                if ($mappingMenuFEByTag->suggest) {
//                    $query->where('');
//                }
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

                return v('pages.list-real-estate', [
                    'data' => $results,
                    'category' => $category,
                    'type' =>$type,
                    'count' => $countAll,
                    'vipRealEstates' => $this->vipRealEstates,
                    'categories' => $this->categories,
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
        $results = $query->get();

        return v('pages.list-real-estate', [
            'data' => $results,
            'category' => null,
            'type' => null,
            'count' => null,
            'pageTitle' => trans('page.featured_real_estate'),
            'vipRealEstates' => $this->vipRealEstates,
            'categories' => $this->categories,
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
        $results = $query->get();

        return v('pages.list-real-estate', [
            'data' => $results,
            'category' => null,
            'type' => null,
            'count' => null,
            'pageTitle' => trans('page.newest_real_estate'),
            'vipRealEstates' => $this->vipRealEstates,
            'categories' => $this->categories,
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
        $results = $query->get();

        return v('pages.list-real-estate', [
            'data' => $results,
            'category' => null,
            'type' => null,
            'count' => null,
            'pageTitle' => trans('page.free_real_estate'),
            'vipRealEstates' => $this->vipRealEstates,
            'categories' => $this->categories,
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

            $countAll = $query->count();
            $results = $query->get();

            return v('pages.list-real-estate', [
                'data' => $results,
                'category' => $category,
                'type' => null,
                'count' => $countAll,
                'vipRealEstates' => $this->vipRealEstates,
                'categories' => $this->categories,
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
        $results = $query->get();

        return v('pages.tin-vip', [
            'data' => $results,
            'vipRealEstates' => $this->vipRealEstates,
            'categories' => $this->categories,
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
        $realEstate = RealEstate::find($id);

        /*
         * TODO: -get list same search option
         * TODO: - get list related real estate
         * */

        /*
         * get list same search option
         * */
        $sameSearchOptions = $this->service->getListBelowDetailPage(RealEstate::same_search, [], $realEstate);

        $relatedItems = $this->service->getListBelowDetailPage(RealEstate::related_item, [], $realEstate);

        return v('pages.detail-real-estate', [
            'data' => $realEstate,
            'sameSearchOptions' => $sameSearchOptions,
            'relatedItems' => $relatedItems,
            'vipRealEstates' => $this->vipRealEstates,
            'categories' => $this->categories,
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

        $results = $query->get();

        return v('pages.list-real-estate', [
            'data' => $results,
            'category' => null,
            'type' => null,
            'count' => null,
            'pageTitle' => trans('page.search_box_title'),
            'vipRealEstates' => $this->vipRealEstates,
            'categories' => $this->categories,
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
                $query->where('area_of_premises', '>', $filter['Search']['dtmb_from']);
            }
            if (isset($filter['Search']['dtmb_to']) && $filter['Search']['dtmb_to']) {
                $query->where('area_of_premises', '<', $filter['Search']['dtmb_to']);
            }

            $results = $query->get();
            return v('pages.list-real-estate', [
                'data' => $results,
                'category' => null,
                'type' => null,
                'count' => null,
                'pageTitle' => trans('page.smart_search_title'),
                'vipRealEstates' => $this->vipRealEstates,
                'categories' => $this->categories,
                'districts' => $this->districts,
                'streets' => $this->streets,
                'directions' => $this->directions,
                'projects' => $this->projects,
                'menuData' => $this->menuFE
            ]);
        }

        return redirect()->route('home');
    }

    public function getContact()
    {
        return v('contact.contact', [
            'vipRealEstates' => $this->vipRealEstates,
            'categories' => $this->categories,
            'districts' => $this->districts,
            'streets' => $this->streets,
            'directions' => $this->directions,
            'projects' => $this->projects,
            'menuData' => $this->menuFE
        ]);
    }
}
