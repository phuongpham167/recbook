<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\CreateContactRequest;
use App\Menu;
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

class ContactController extends Controller
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

//    public function getContact()
//    {
//        return v('contact.contact', ['menuData' => $this->menuFE]);
//    }

    public function postContact(CreateContactRequest $request)
    {
        $data   =   new Contact();
        $data->name   =   $request->name;
        $data->address   =   $request->address;
        $data->mobile   =   $request->mobile;
        $data->note   =   $request->note;
        $data->email   =   $request->email;
        $data->created_at   =   Carbon::now();
        $data->save();
        set_notice(trans('contact.add_success'), 'success');
        return redirect()->back();
    }

    public function getContact()
    {
        $this->vipRealEstates = $this->getVipRealEstates();

        return v('contact.contact', [
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
}
