<?php

namespace App\Http\Controllers;

use App\MappingMenuFE;
use App\Menu;
use App\RealEstate;
use App\ReCategory;
use App\ReType;
use App\Services\PageService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    protected $menuFE, $vipRealEstates, $web_id;

    protected $service;

    public function __construct(
        PageService $pageService
    )
    {
        $this->web_id = get_web_id();
        $mmfe = config('menu.mainMenuFE');
        $this->menuFE = Menu::where('web_id', $this->web_id)->where('menu_type', $mmfe)->first();

        $this->service = $pageService;

        $this->vipRealEstates = RealEstate::select('id', 'title', 'slug', 'direction_id',
            'area_of_premises', 'price', 'unit_id', 'is_vip', 'is_hot')
            ->where('is_vip',  1)
//            ->where('vip_expire_at',  '<=', Carbon::now())
            ->get();
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
        $categories = ReCategory::select('id', 'name', 'slug')
//            ->where('web_id', $web_id)
            ->get();

        return v('pages.home', [
            'hotRealEstates' => $hotRealEstates,
            'goodPriceRealEstate' => $goodPriceRealEstate,
            'freeRealEstates' => $freeRealEstates,
            'categories' => $categories,
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
            'isSearch' => true,
            'menuData' => $this->menuFE
        ]);
    }
}
