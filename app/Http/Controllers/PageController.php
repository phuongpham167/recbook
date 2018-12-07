<?php

namespace App\Http\Controllers;

use App\MappingMenuFE;
use App\Menu;
use App\RealEstate;
use App\ReCategory;
use App\ReType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    protected $menuFE;

    public function __construct()
    {
        $web_id = get_web_id();
        $mmfe = config('menu.mainMenuFE');
        $this->menuFE = Menu::where('web_id', $web_id)->where('menu_type', $mmfe)->first();

        $vipRealEstates = RealEstate::select('id', 'title', 'slug', 'direction_id',
            'area_of_premises', 'price', 'unit_id', 'is_vip', 'is_hot')
            ->where('is_vip',  1)
            ->where('vip_expire_at',  '<=', Carbon::now())
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
            ->limit(16)
            ->get();
//        dd($hotRealEstates);

        /*
         * TODO: need more info to filter good price items
         * */
        $goodPriceRealEstate = RealEstate::select('id', 'title', 'short_description', 'slug', 'code',
            'area_of_premises', 'price', 'unit_id', 'is_vip', 'is_hot', 'images', 'post_date')
            ->where('is_vip', 1)
            ->where('post_date', '<=', Carbon::now())
            ->orderBy('post_date', 'desc')
            ->limit(200)
            ->get();

        $freeRealEstates = RealEstate::select('id', 'title', 'short_description', 'slug', 'code',
            'area_of_premises', 'price', 'unit_id', 'is_vip', 'is_hot', 'images', 'post_date')
            ->where('is_hot', '<>', 1)
            ->where('is_vip', '<>', 1)
            ->limit(40)
            ->get();

        return v('pages.home', [
            'hotRealEstates' => $hotRealEstates,
            'goodPriceRealEstate' => $goodPriceRealEstate,
            'freeRealEstates' => $freeRealEstates,
            'menuData' => $this->menuFE
        ]);
    }

    public function getDanhmuc($tag)
    {
        try {
            $web_id = get_web_id();
            $mappingMenuFEByTag = MappingMenuFE::where('path', $tag)->first();
//            dd($mappingMenuFEByTag);
            if ($mappingMenuFEByTag) {
                $query = RealEstate::whereNull('deleted_at')->where('web_id', $web_id);
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

    public function detailRealEstate($slug)
    {
        $explodeSlug = explode('-', $slug);
        $id = $explodeSlug[count($explodeSlug)-1];
        $realEstate = RealEstate::find($id);

        /*
         * TODO: -get list same search option
         * TODO: - get list related real estate
         * */

        return v('pages.detail-real-estate', ['data' => $realEstate, 'menuData' => $this->menuFE]);
    }
}
