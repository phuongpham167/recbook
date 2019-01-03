<?php

namespace App\Http\Controllers;

use App\AccessHistory;
use App\Branch;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\FormUserRequest;
use App\Http\Requests\LoginRequest;
use App\Province;
use App\TransactionLog;
use App\User;
use App\Web;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \DataTables;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Namshi\JOSE\JWT;
use JWTAuth;

class UserController extends Controller
{
    public function getLogin()
    {
        return v('pages.login');
    }

    public function login($username, $password, $remember=false,$api=false)
    {
        $logins =   json_decode(settings('system_loginas', json_encode(['id'])), 'true');
        if(in_array('username',$logins))
            $loginUsername   =   auth()->attempt(['name'=>$username,'password'=>$password], $remember);
        if(in_array('email',$logins))
            $loginEmail  =   auth()->attempt(['email'=>$username,'password'=>$password], $remember);
        if(in_array('id',$logins))
            $loginId  =   auth()->attempt(['id'=>$username,'password'=>$password], $remember);
        if(!empty($loginEmail) || !empty($loginUsername) || !empty($loginId)){
            if($api==true){
                if(!empty($loginUsername))
                    return 'username';
                if(!empty($loginId))
                    return 'id';
                if(!empty($loginEmail))
                    return 'email';
            }
            event_log(trans('eventlog.accesssystem'));
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function postLogin(LoginRequest $request)
    {
        if($this->login($request->input('id'),$request->input('password'),$request->has('remember'))){
            Event::fire('event.login', []);
            return redirect()->to(asset('/'));
        } else {
            return redirect()->back()->withErrors(trans('auth.failed'));
        }
    }

    public function getLogout()
    {
        event_log(trans('eventlog.logout'));
        auth()->logout();
        return redirect()->to(asset('/'));
    }
    public function getList() {
        event_log(trans('page.userlist'));
        return v('users.list');
    }
    public function dataList() {
        $data   =   User::with('group');

        $result = Datatables::of($data)
            ->addColumn('group', function(User $user) {
                return $user->group->name;
            })->addColumn('branch', function(User $user) {
                return Branch::find($user->branch_id)->first()->name;
            })->addColumn('manage', function($user) {
                return a('config/user/del', 'id='.$user->id,trans('g.delete'), ['class'=>'btn btn-xs btn-danger'],'#',"return bootbox.confirm('".trans('system.delete_confirm')."', function(result){if(result==true){window.location.replace('".asset('config/user/del?id='.$user->id)."')}})").'  '.a('config/user/edit', 'id='.$user->id,trans('g.edit'), ['class'=>'btn btn-xs btn-default']);
            })->rawColumns(['manage']);

        if(get_web_id() == 1) {
            $result = $result->addColumn('web_id', function(User $user) {
                return Web::find($user->web_id)->name;
            });
        }

        return $result->make(true);
    }

    public function getEvent() {
        event_log('Truy cập trang ['.trans('page.eventlog').']');
        return v('pages.access_history');
    }
    public function getEventData() {
        $data   =   AccessHistory::query();
        $start  =   !empty(request('datefrom'))?Carbon::createFromFormat('d/m/Y',request('datefrom'))->startOfDay():Carbon::now()->startOfMonth();
        $end    =   !empty(request('dateto'))?Carbon::createFromFormat('d/m/Y',request('dateto'))->endOfDay():Carbon::now();
        $data   =   $data->where('created_at', '>=', $start)->where('created_at', '<=', $end);
        if(!empty(request('ip')))
            $data   =   $data->where('ip',request('ip'));
        if(!empty(request('user_id')))
            $data   =   $data->where('user_id',request('user_id'));

        $result = Datatables::of($data)
            ->addColumn('user_id', function(AccessHistory $data) {
                if(!empty($data->user_id))
                    return $data->user->name;
                else
                    return trans('users.guest');
            });

        if(get_web_id() == 1) {
            $result = $result->addColumn('web_id', function(AccessHistory $data) {
                return Web::find($data->web_id)->name;
            });
        }

        return $result->make(true);
    }

    public function getCreate()
    {
        event_log('Truy cập trang ['.trans('page.createuser').']');
        return v('users.create');
    }

    public function postCreate(FormUserRequest $request)
    {
        $data   =   new User();
        $data->name   =   $request->name;
        $data->email    =   $request->email;
        $data->password =   Hash::make($request->password);
        $data->branch_id    =   $request->branch_id;
        $data->group_id =   $request->group_id;
        $data->web_id   =   get_web_id();
        $data->created_at   =   Carbon::now();
        $data->save();

        event_log('Tạo thành viên mới '.$data->name.' id '.$data->id);
        set_notice(trans('users.add_success'), 'success');
        return redirect()->back();
    }
    public function getEdit()
    {
        $data   =   User::find(request('id'));
        if(!empty($data)){
            event_log('Truy cập trang ['.trans('page.editeuser').']');
            return v('users.edit', compact('data'));
        }else{
            set_notice(trans('system.not_exist'), 'warning');
            return redirect()->back();
        }
    }
    public function postEdit(EditUserRequest $request)
    {
        $data   =   User::find($request->id);
        if(!empty($data)){
            $data->name   =   $request->name;
            $data->email    =   $request->email;
            if($request->has('password'))
                $data->password =   Hash::make($request->password);
            $data->branch_id    =   $request->branch_id;
            $data->group_id =   $request->group_id;
            $data->save();
            event_log('Sửa thành viên '.$data->name.' id '.$data->id);
            set_notice(trans('system.edit_success'), 'success');
        }else
            set_notice(trans('system.not_exist'), 'warning');
        return redirect()->back();
    }
    public function getDelete()
    {
        $data   =   User::find(request('id'));
        if(!empty($data)){
            event_log('Xóa thành viên '.$data->name.' id '.$data->id);
            $data->delete();
            set_notice(trans('system.delete_success'), 'success');
        }else
            set_notice(trans('system.not_exist'), 'warning');
        return redirect()->back();
    }

    public function apiLogin(LoginRequest $request)
    {
//        print_r($request->input());
        if($info = $this->login($request->input('id'),$request->input('password'),$request->has('remember'), true)){
            $api_token  =   str_random(60);
            User::where('id',auth()->user()->id)->update(['api_token'=>$api_token]);
            return response()->json(['status'=>'success', 'token'=>$api_token]);
        } else {
            return response()->json(['status'=>'wrong'],422);
        }
    }
}
