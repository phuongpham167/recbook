<?php

namespace App\Http\Controllers;

use App\Currency;
use App\FLCategory;
use App\FLDeal;
use App\Freelancer;
use App\Http\Requests\CreateFreelancerRequest;
use App\Menu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \DataTables;

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

    public function list($filter = null)
    {
        return v('freelancer.list',['menuData' => $this->menuFE], compact('filter'));
    }

    public function data()
    {
        $data   =   new Freelancer();
//        $data   =   $data->orderBy(request('sort','end_at'),request('order','DESC'));

        if(!empty(\request('filter'))) {
            if(\request('filter') == 'da-dang')
                $data = $data->where('user_id',auth()->user()->id);

            if(\request('filter') == 'da-chao-gia')
                $data = $data->whereHas('deals', function ($q) {$q->where('user_id',auth()->user()->id);});

            if(\request('filter') == 'da-tham-gia')
                $data = $data->whereHas('deals', function ($q) {$q->where('user_id',auth()->user()->id)->where('is_choosen', 1);});
        }

//        $start  =   !empty(\request('datefrom'))?Carbon::createFromFormat('d/m/Y',\request('datefrom'))->startOfDay():'';
//        $end    =   !empty(\request('dateto'))?Carbon::createFromFormat('d/m/Y',\request('dateto'))->endOfDay():'';
//
//        if($start != '' && $end != '')
//            $data   =   $data->where('created_at', '>=', $start)->where('created_at', '<=', $end);

        $result = Datatables::of($data)
            ->addColumn('end_at', function($dt) {
                return $dt->end_at ? Carbon::parse($dt->end_at)->format('d/m/Y'): '';
            })
            ->addColumn('finish_at', function($dt) {
                return $dt->finish_at ? Carbon::parse($dt->finish_at)->format('d/m/Y'): '';
            })
            ->addColumn('budget', function($dt) {
                return number_format($dt->budget). ' ' . Currency::where('default',1)->first()->icon;
            })
            ->addColumn('manage', function($dt) {
                $manage = null;

                if(\request('filter') == 'da-dang') {
                    $deal = FLDeal::where('freelancer_id', $dt->id)->where('is_choosen', 1)->first();
                    if($dt->status != 'ended' && $dt->status != 'finished'){
                        $manage .=   a('du-an/dong', 'id='.$dt->id,trans('g.close'), ['class'=>'btn btn-xs btn-danger'],'#',"return bootbox.confirm('".trans('system.close_confirm')."', function(result){if(result==true){window.location.replace('".asset('du-an/dong?id='.$dt->id)."')}})");
                        if(!empty($deal)){
                            if(($dt->status == 'processing' || $dt->status=='pending')  && empty($deal->rate) && empty($deal->review)) {
                                $manage .=' '. a('#a', '', trans('g.done'), ['class' => 'btn btn-xs btn-default btn-done', 'id' => $deal->id, 'data-type' => '0']);
                            }
                        }
                    }
                    else if($dt->status == 'ended')
                        $manage = 'Đã đóng';
                    else if($dt->status == 'finished')
                        $manage = 'Đã hoàn thành';
                }
                if(\request('filter') == 'da-chao-gia') {
                    if($dt->status == 'processing' || $dt->status=='pending')
                        $manage = 'Đang xử lý';
                    else if($dt->status == 'ended')
                        $manage = 'Đã đóng';
                    else if($dt->status == 'finished')
                        $manage = 'Đã hoàn thành';
                }
                if(\request('filter') == 'da-tham-gia') {
                    if(($dt->status == 'processing' || $dt->status=='pending') && empty($dt->rate) && empty($dt->review)) {
                        $manage .= a('#a', '', trans('g.done'), ['class' => 'btn btn-xs btn-default btn-done', 'id' => $dt->id, 'data-type' => '1']);
                    }
                    else if($dt->status == 'ended')
                        $manage = 'Đã đóng';
                    else if($dt->status == 'finished')
                        $manage = 'Đã hoàn thành';
                }

                return $manage;
            })->rawColumns(['manage','title']);

        return $result->make(true);
    }

    public function close()
    {
        $data = Freelancer::where('user_id',auth()->user()->id)->where('id',\request('id'))->first();
        if (!empty($data)) {
            $data->status = 'ended';
            $data->save();
            set_notice(trans('freelancer.close_success'), 'success');
            return redirect()->back();
        }
        set_notice(trans('freelancer.close_fail'), 'warning');
        return redirect()->back();
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
        $data->status  =   'open';
        $data->created_at   =   Carbon::now();
        $data->save();
//        event_log('Tạo dự án mới id '.$data->id);
        set_notice(trans('freelancer.add_success'), 'success');
        return redirect()->back();
    }
    public function deal($id){
        $data   =   Freelancer::where('end_at', '>=', Carbon::now())->whereNotIn('status', ['finished','ended','processing'])->where('id', $id);
        if(!empty($data->count())){
            $data   =   $data->first();
            $deal   =   new FLDeal();
            $deal->freelancer_id    =   $data->id;
            $deal->user_id  =   auth()->user()->id;
            $deal->selfIntro    =   request('selfIntro');
            $deal->road =   request('road');
            $deal->price    =   request('price');
            $deal->is_vip   =   0;
            $deal->is_choosen   =   0;
            $deal->days =   request('days');
            $deal->finished_at  =   null;
            $deal->created_at   =   Carbon::now();
            $deal->save();
            set_notice('Đặt giá thành công!', 'success');

        }
        else set_notice('Tin đăng không tồn tại hoặc đã hết hạn!', 'warning');
        return redirect()->back();
    }
    public function review(){
        $data   =   Freelancer::where('end_at', '>=', Carbon::now())->whereNotIn('status', ['finished','ended'])->where('id', \request('id'))->first();
        if(\request('type') == 0) {
            if(!empty($data)){
                $deal   =   FLDeal::where('freelancer_id', $data->id)->first();
                $deal->rate    =   \request('rate');
                $deal->review  =   \request('review');
                $deal->save();

                set_notice('Đánh giá và nhận xét thành công!', 'success');
            }
            else set_notice('Đánh giá và nhận xét không thành công!', 'warning');
        }
        if(\request('type') ==1) {
            if(!empty($data)){
                $data->rate    =   \request('rate');
                $data->review  =   \request('review');
                $data->save();
                set_notice('Đánh giá và nhận xét thành công!', 'success');

            }
            else set_notice('Đánh giá và nhận xét không thành công!', 'warning');
        }
        if($data->status == 'processing')
            $data->status = 'pending';
        else if($data->status == 'pending') {
            $data->status = 'finished';
            $data->finished_at = Carbon::now();
        }
        $data->save();

        return redirect()->back();
    }

    public function choosen($fl_id, $deal_id){
        $data   =   Freelancer::where('end_at', '>=', Carbon::now())->whereNotIn('status', ['finished','ended','processing'])->where('id', $fl_id)->where('user_id', auth()->user()->id);
        if(!empty($data->count())){
            $data   =   $data->first();
            $deal   =   FLDeal::where('id', $deal_id)->where('freelancer_id', $fl_id);
            if(!empty($deal->count())){
                $deal   =   $deal->first();
                $deal->is_choosen   =   1;
                $deal->save();

                $data->status   =   'processing';
                $data->save();
                set_notice('Chọn chào giá thành công!','success');
            }
            else set_notice('Chào giá vừa chọn không thuộc dự án này!','warning');
        }
        else set_notice('Tin đăng không tồn tại hoặc đã hết hạn!', 'warning');
        return redirect()->back();
    }
}
