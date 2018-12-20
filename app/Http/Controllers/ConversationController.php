<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\Menu;
use App\RealEstate;
use App\ReCategory;
use App\Services\DirectionService;
use App\Services\DistrictService;
use App\Services\ProjectService;
use App\Services\RangePriceService;
use App\Services\ReTypeService;
use App\Services\StreetService;
use Illuminate\Http\Request;
use LRedis;
use App\Http\Requests;
use Auth;
use Carbon\Carbon;

class ConversationController extends Controller
{
    protected $menuFE, $vipRealEstates, $web_id;
    protected $categories, $districts, $streets, $directions, $projects;

    protected $reTypeService;
    protected $rangePriceService;
    protected $districtService;
    protected $streetService;
    protected $directionService;
    protected $projectService;

    public function __construct(
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

    public function store(Request $request){
        $c1 = Conversation::where('user1',Auth::user()->id)->where('user2',$request->user_id)->count();
        $c2 = Conversation::where('user2',Auth::user()->id)->where('user1',$request->user_id)->count();
        if($c1 != 0 || $c2 != 0)
            return redirect()->back();

        $c = new Conversation();
        $c->user1 = Auth::user()->id;
        $c->user2 = $request->user_id;
        $c->save();

        return redirect()->back();
    }
    public function show($id){
        $conversation = Conversation::findOrFail($id);
        if($conversation->user1 == Auth::user()->id || $conversation->user2 == Auth::user()->id)
            return v('conversation.show',[
                'conversation' => $conversation,
                'vipRealEstates' => $this->vipRealEstates,
                'categories' => $this->categories,
                'districts' => $this->districts,
                'streets' => $this->streets,
                'directions' => $this->directions,
                'projects' => $this->projects,
                'menuData' => $this->menuFE
            ]);

        return redirect()->back();
    }
}
