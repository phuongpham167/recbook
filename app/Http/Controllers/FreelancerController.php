<?php

namespace App\Http\Controllers;

use App\FLCategory;
use App\Freelancer;
use App\Menu;
use Illuminate\Http\Request;

class FreelancerController extends Controller
{
    protected $menuFE, $web_id;
    private $flcategories;
    public function __construct()
    {
        $this->flcategories =   FLCategory::all();
        $this->web_id = get_web_id();
        $mmfe = config('menu.mainMenuFE');
        $this->menuFE = Menu::where('web_id', $this->web_id)->where('menu_type', $mmfe)->first();
    }

    public function index(){
        $data   =   new Freelancer();
        $data   =   $data->orderBy(request('sort','end_at'),request('order','DESC'));

        if(!empty(request('status')))
            $data   =   $data->where('status', request('status'));
        if(!empty(request('province_id')))
            $data   =   $data->where('province_id', request('province_id'));
        if(!empty(request('district_id')))
            $data   =   $data->where('district_id', request('district_id'));
        return v('freelancer.index', [
            'data'=>$data,
            'categories'=>$this->flcategories,
            'menuData'  =>  $this->menuFE
        ]);
    }
}
