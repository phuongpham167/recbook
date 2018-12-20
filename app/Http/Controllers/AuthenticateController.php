<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Group;
use App\Http\Requests\FormUserRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Menu;
use App\PasswordReset;
use App\User;
use App\UserInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthenticateController extends Controller
{
    protected $menuFE;

    public function __construct()
    {
        $web_id = get_web_id();
        $mmfe = config('menu.mainMenuFE');
        $this->menuFE = Menu::where('web_id', $web_id)->where('menu_type', $mmfe)->first();
    }

    public function getLogin()
    {
        return v('authenticate.login', ['menuData' => $this->menuFE]);
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
//            event_log(trans('eventlog.accesssystem'));
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function postLogin(LoginRequest $request)
    {
        if($this->login($request->input('id'),$request->input('password'),$request->has('remember'))){
            return redirect()->to(asset('/quan-ly-tin-rao'));
        } else {
            return redirect()->back()->withErrors(trans('auth.failed'));
        }
    }

    public function getLogout()
    {
//        event_log(trans('eventlog.logout'));
        auth()->logout();
        return redirect()->to(asset('/'));
    }

    public function getChangepassword()
    {
//        event_log('Truy cập trang ['.trans('page.editpassword').']');
        return v('users.change-password',['menuData' => $this->menuFE]);
    }
    public function postChangepassword()
    {
        if (!empty(request('old_password')) && !empty(request('new_password')) && !empty(request('confirm_password'))) {
            if(auth()->attempt(['name'=>auth()->user()->name,'password'=>request('old_password')])) {
                if(request('new_password')==request('confirm_password')) {
                    auth()->user()->password = Hash::make(request('new_password'));
                    auth()->user()->save();
                    set_notice(trans('users.change_pass_success'), 'success');
                }
                else
                    set_notice(trans('users.confirm_password_not_correct'), 'warning');
            }
            else
                set_notice(trans('users.password_not_correct'), 'warning');
        }
        else
            set_notice(trans('users.fill_all'), 'warning');

        return redirect()->back();
    }

    public function getManage()
    {
        return v('users.manage', ['menuData' => $this->menuFE]);
    }

    public function getInfo()
    {
        return v('users.info', ['menuData' => $this->menuFE]);
    }

    public function postInfo(FormUserRequest $request)
    {
        auth()->user()->name   =   $request->name;
        auth()->user()->taxcode    =   $request->taxcode;
        auth()->user()->phone    =   $request->phone;
        auth()->user()->address    =   $request->address;
        auth()->user()->email    =   $request->email;
        auth()->user()->save();
//        event_log('Sửa thành viên '.auth()->user()->name.' id '.auth()->user()->id);
        set_notice(trans('system.edit_success'), 'success');

        return redirect()->back();
    }

    public function getRegister()
    {
        return v('authenticate.register', ['menuData' => $this->menuFE]);
    }

    public function postRegister(FormUserRequest $request)
    {
        $data   =   new User();
        $data->name   =   $request->name;
        $data->email    =   $request->email;
        if($request->password == $request->repassword)
            $data->password =   Hash::make($request->password);
        else {
            set_notice(trans('users.confirm_password_not_correct'), 'warning');
            return redirect()->back();
        }
        if(!empty(Group::find($request->group_id)) && Group::find($request->group_id)->register_permission == 1)
            $data->group_id =   $request->group_id;
        else {
            set_notice(trans('users.dont_allow'), 'warning');
            return redirect()->back();
        }
        $data->branch_id =   Branch::where('is_head','1')->first()->id;
        $data->web_id   =   get_web_id();
        $data->created_at   =   Carbon::now();
        $data->save();

        $user_info = new UserInfo();
        $user_info->user_id = $data->id;
        $user_info->company = $request->company_name;
        $user_info->identification = $request->taxcode;
        $user_info->phone = $request->phone;
        $user_info->address = $request->address;
        $user_info->website = $request->website;

        $user_info->save();

//        event_log('Tạo thành viên mới '.$data->name.' id '.$data->id);
        set_notice(trans('users.add_success'), 'success');
        return redirect()->route('login');
    }

    public function getForgotPassword()
    {
        return v('authenticate.forgot_password', ['menuData' => $this->menuFE]);
    }

    public function postForgotPassword()
    {
        $code = str_random(10);
        $email  =   request('email');

        $data = new PasswordReset();
        $data->code = md5($code);

        $user = User::where('email',$email)->first();
        if(!empty($user))
            $data->email    =   request('email');
        else {
            set_notice(trans('page.dont_exits'), 'warning');
            return redirect()->back();
        }

        $data->expire_at = Carbon::now()->addHours(24);
        $data->save();

        Mail::send('mail.mail_password', ['name'=>\request('email'),'code'=>$code], function($message){
            $message->to( \request('email'), 'Visitor')->subject('Đặt lại mật khẩu tài khoản DoThiGroup');
        });

        set_notice(trans('page.send_success'), 'success');
        return redirect()->back();
    }

    public function getPassword()
    {
        $data = PasswordReset::where('code',md5(\request('code')))->where('expire_at','>=',Carbon::now())->first();

        if(empty($data)) {
            set_notice(trans('page.expired_code'), 'warning');
            return v('users.change_password_noti', ['menuData' => $this->menuFE]);
        }

        return v('users.reset-password', ['menuData' => $this->menuFE]);
    }

    public function postPassword(ResetPasswordRequest $request)
    {
        $email  =   PasswordReset::where('code',md5(\request('code')))->first()->email;

        $user   =   User::where('email',$email)->first();

//        echo '<pre>';
//        print_r($user);
//        echo '</pre>';
//        exit();

        $user->password = Hash::make($request->password);
        $user->save();

        PasswordReset::where('email',$email)->update(['expire_at'=>Carbon::now()]);

        set_notice(trans('users.account_change_pass_success', ['email'  =>  $user->email]), 'success');
        return redirect()->to(asset('/dang-nhap'));
    }
}
