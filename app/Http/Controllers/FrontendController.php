<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Events\WebCreatedEvent;
use App\Events\WebDeletedEvent;
use App\Frontend;
use App\Http\Requests\CreateFrontendRequest;
use App\Http\Requests\CreateWebRequest;
use App\Jobs\PublishWeb;
use App\Menu;
use App\User;
use App\Web;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FrontendController extends Controller
{
    protected $menuFE;

    public function __construct()
    {
        $web_id = get_web_id();
        $mmfe = config('menu.mainMenuFE');
        $this->menuFE = Menu::where('web_id', $web_id)->where('menu_type', $mmfe)->first();
    }

    public function getList() {
        event_log('Truy cập trang ['.trans('frontend.index').']');
        return v('frontend.list',['menuData' => $this->menuFE]);
    }

    public function dataList() {
        $data   =   Frontend::query();

//        if(auth()->user()->id != 1)
//            $data = $data->where('user_id',auth()->user()->id);

        $result = Datatables::of($data)
            ->addColumn('manage', function($frontend) {
                return a('frontend/del', 'id='.$frontend->id,trans('g.delete'), ['class'=>'btn btn-xs btn-danger'],'#',"return bootbox.confirm('".trans('system.delete_confirm')."', function(result){if(result==true){window.location.replace('".asset('frontend/del?id='.$frontend->id)."')}})").'  '.a('frontend_web/'.$frontend->id,'',trans('g.edit'), ['class'=>'btn btn-xs btn-default']);
            })->rawColumns(['manage']);

//        if(get_web_id() == 1) {
//            $result = $result->addColumn('web_id', function(Branch $branch) {
//                return Web::find($branch->web_id)->name;
//            });
//        }

        return $result->make(true);
    }

    public function getCreate()
    {
        event_log('Truy cập trang ['.trans('frontend.create').']');
        return v('frontend.create',['menuData' => $this->menuFE]);
    }

    public function postCreate(CreateFrontendRequest $request)
    {
        $data   =   new Frontend();
//        print_r($request->all());
        $data->user_id   =   auth()->user()->id;
        $data->title   =   $request->title;
        $data->domain   =   $request->domain;
        $data->theme   =   $request->theme;
        $data->created_at   =   Carbon::now();
        $data->save();
        event_log('Tạo website frontend đơn vị mới '.$data->domain.' id '.$data->id);
//        set_notice(trans('frontend.add_success'), 'success');
        frontendweb_create($data->id, $data->theme, $data->title);
        return response()->json(['status'=>0, 'url'=>asset('frontend_web/'.$data->id)]);
    }
    public function getEdit()
    {
        $data   =   Frontend::find(request('id'));
        if(!empty($data)){
            event_log('Truy cập trang ['.trans('frontend.edit').']');
            return v('frontend.edit', compact('data'), ['menuData' => $this->menuFE]);
        }else{
            set_notice(trans('system.not_exist'), 'warning');
            return redirect()->back();
        }
    }
    public function postEdit(CreateFrontendRequest $request)
    {
        $data   =   Frontend::find($request->id);
        if(!empty($data)){
            $data->user_id   =   auth()->user()->id;
            $data->title   =   $request->title;
            $data->domain   =   $request->domain;
            $data->theme   =   $request->theme;
            $data->save();
            event_log('Sửa website frontend đơn vị '.$data->domain.' id '.$data->id);
            set_notice(trans('system.edit_success'), 'success');
        }else
            set_notice(trans('system.not_exist'), 'warning');
        return redirect()->back();
    }
    public function getDelete()
    {
        $data   =   Frontend::find(request('id'));
        if(!empty($data)){
            event_log('Xóa website frontend đơn vị id '.$data->id);
            $data->domain  =   '';
            $data->save();
            $data->delete();

            set_notice(trans('system.delete_success'), 'success');
        }else
            set_notice(trans('system.not_exist'), 'warning');
        return redirect()->back();
    }
    public function saveProject(){
        $id =   request('id');
        $web    =   Frontend::where('user_id', auth()->user()->id)->where('id', $id)->get();
        if($web->count())
            saveProject($id, request('project'));
    }
    public function exportProject(){
        $id =   request('id');
        $web    =   Frontend::where('user_id', auth()->user()->id)->where('id', $id)->get();
        if($web->count()){
            PublishWeb::dispatch($web->first());
            return response()->json(['domain'=>$web->first()->domain]);
//            if (file_exists($destination)){
//                unlink($destination);
//            }
//            if ($z=zip($sourceUrl, $destination)){
//                echo json_encode(array( "download_file" => "temp/" . basename($destination)));
//            } else var_dump($z);
        }else echo 'z';

    }
    public function saveProjectByParts(){
        $id =   request('id');
        $web    =   Frontend::where('user_id', auth()->user()->id)->where('id', $id)->get();
        if($web->count())
            saveProjectByParts($id, request('part'), request('index'), \request('lastChunk'));
    }
}
