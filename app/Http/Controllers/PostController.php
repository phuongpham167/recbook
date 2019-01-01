<?php

namespace App\Http\Controllers;

use App\Post;
use App\Menu;
use App\PostCategory;
use App\RealEstate;
use App\ReCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\DirectionService;
use App\Services\DistrictService;
use App\Services\PageService;
use App\Services\ProjectService;
use App\Services\ProvinceService;
use App\Services\RangePriceService;
use App\Services\ReTypeService;
use App\Services\StreetService;

class PostController extends Controller
{
    protected $menuFE, $vipRealEstates, $web_id;
    protected $categories, $provinces, $districts, $streets, $directions, $projects;

    protected $service;
    protected $reTypeService;
    protected $rangePriceService;
    protected $provinceService;
    protected $districtService;
    protected $streetService;
    protected $directionService;
    protected $projectService;

    public function __construct(
        PageService $pageService,
        ReTypeService $reTypeService,
        ProvinceService $provinceService,
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
        $this->provinceService = $provinceService;
        $this->districtService = $districtService;
        $this->streetService = $streetService;
        $this->directionService = $directionService;
        $this->rangePriceService = $rangePriceService;
        $this->projectService = $projectService;

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

    public function listCategory($slugdanhmuc) {
        $data = PostCategory::where('slugdanhmuc',$slugdanhmuc)->get();

        $this->vipRealEstates = $this->getVipRealEstates();

        return v('post.postcategory_list',compact('data'), [
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

    public function list() {
        $data = Post::all();

        $this->vipRealEstates = $this->getVipRealEstates();

        return v('post.post_list',compact('data'), [
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

    public function detail($slugchitiet) {
        $data = Post::where('slugchitiet',$slugchitiet)->first();

        if(!empty($data)){
            return v('post.post_detail',compact('data'), [
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

        return redirect()->back();
    }
}
