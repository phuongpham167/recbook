<?php

namespace App\Http\Controllers;

use App\MappingMenuFE;
use App\Menu;
use App\RealEstate;
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
    }

    public function index()
    {
        $menuData = $this->menuFE;
        return v('pages.home', compact('menuData'));
    }

    public function getDanhmuc($tag)
    {
        try {
            $web_id = get_web_id();
            $mappingMenuFEByTag = MappingMenuFE::where('path', $tag)->first();
//            dd($mappingMenuFEByTag);
            if ($mappingMenuFEByTag) {
                $query = DB::table('real_estates')->whereNull('deleted_at')->where('web_id', $web_id);
                if ($mappingMenuFEByTag->re_category_id) {
                    $query->where('re_category_id', $mappingMenuFEByTag->re_category_id);
                }
                if ($mappingMenuFEByTag->re_category_id && $mappingMenuFEByTag->re_type_id) {
                    $query->where('re_type_id', $mappingMenuFEByTag->re_type_id);
                }
//                if ($mappingMenuFEByTag->suggest) {
//                    $query->where('');
//                }
                $results = $query->get();
                dd($results);
            }
        } catch (\Exception $exception) {

        }
    }
}
