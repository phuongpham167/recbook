<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormUserRequest;
use App\Http\Requests\LoginRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticateController extends Controller
{
    public function getLogin()
    {
        return v('authenticate.login');
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
        return v('users.change-password');
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
        return v('users.manage');
    }

    public function getInfo()
    {
        return v('users.info');
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
        return v('authenticate.register');
    }

    public function postRegister(Request $request)
    {
        dd($request);
    }
}
