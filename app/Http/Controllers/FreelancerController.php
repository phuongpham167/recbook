<?php

namespace App\Http\Controllers;

use App\FLCategory;
use App\Freelancer;
use App\Http\Requests\CreateFreelancerRequest;
use App\Menu;
use Carbon\Carbon;
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

        if(!empty(\request('filter'))) {
            if(\request('filter') == 'tu-van-bat-dong-san')
                $data = $data->where('category_id',1);

            if(\request('filter') == 'tu-van-tai-chinh')
                $data = $data->where('category_id',2);

            if(\request('filter') == 'tu-van-thiet-ke')
                $data = $data->where('category_id',3);

            if(\request('filter') == 'tu-van-phong-thuy')
                $data = $data->where('category_id',4);
        }
        else
            $data = $data->where('category_id',1);

        if(!empty(request('status')))
            $data   =   $data->where('status', request('status'));
        if(!empty(request('province_id')))
            $data   =   $data->where('province_id', request('province_id'));
        if(!empty(request('district_id')))
            $data   =   $data->where('district_id', request('district_id'));

        $data = $data->get();
        return v('freelancer.index', [
            'data'=>$data,
            'categories'=>$this->flcategories,
            'menuData'  =>  $this->menuFE
        ]);
    }
    public function show($id, $slug)
    {
        $data = Freelancer::find($id);
        if (!empty($data)) {
            return v('freelancer.show', [
                'data' => $data,
                'categories' => $this->flcategories,
                'menuData' => $this->menuFE
            ]);
        }
    }

    public function postCreate(CreateFreelancerRequest $request)
    {
        $data   =   new Freelancer();
        $data->user_id   =   auth()->user()->id;
        $data->category_id   =   $request->category_id;
        $data->title   =   $request->title;
        $data->end_at   =   Carbon::createFromFormat('d/m/Y',$request->end_at);
        $data->finish_at   =   Carbon::createFromFormat('d/m/Y',$request->finish_at);
        $data->budget  =   $request->budget;
        $data->note  =   $request->note;
        $data->short_description  =   $request->short_description;
        $data->description  =   $request->description;
        $data->re_type_id  =   $request->re_type_id;
        $data->province_id  =   $request->province_id;
        $data->district_id  =   $request->district_id;
        $data->ward_id  =   $request->ward_id;
        $data->address  =   $request->address;
        $data->street_id  =   $request->street_id;
        $data->direction_id  =   $request->direction_id;
        $data->construction_type_id  =   $request->construction_type_id;
        $data->width  =   $request->width;
        $data->length  =   $request->length;
        $data->bedroom  =   $request->bedroom;
        $data->area_of_premises  =   $request->area_of_premises;
        $data->area_of_use  =   $request->area_of_use;
        $data->floor  =   $request->floor;
        $data->created_at   =   Carbon::now();
        $data->save();
//        event_log('Tạo dự án mới id '.$data->id);
        set_notice(trans('freelancer.add_success'), 'success');
        return redirect()->back();
    }
}
