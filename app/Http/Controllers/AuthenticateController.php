<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Currency;
use App\MemberGroup;
use App\UserGroup;
use App\Group;
use App\Http\Requests\UserGroupRequest;
use App\Http\Requests\FormUserInfoRequest;
use App\Http\Requests\FormUserRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Menu;
use App\PasswordReset;
use App\ReCategory;
use App\Services\BlockService;
use App\Services\ConstructionTypeService;
use App\Services\DirectionService;
use App\Services\DistrictService;
use App\Services\ExhibitService;
use App\Services\ProjectService;
use App\Services\ProvinceService;
use App\Services\RangePriceService;
use App\Services\RealEstateService;
use App\Services\ReCategoryService;
use App\Services\ReSourceService;
use App\Services\ReTypeService;
use App\Services\StreetService;
use App\Services\UnitService;
use App\Services\WardService;
use App\TransactionLog;
use App\User;
use App\UserInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use \DataTables;
use Illuminate\Support\Facades\Storage;
use Kreait\Firebase\Auth;
use Sabberworm\CSS\Settings;


class AuthenticateController extends Controller
{
    protected $reCategoryService;
    protected $reTypeService;
    protected $provinceService;
    protected $districtService;
    protected $wardService;
    protected $streetService;
    protected $directionService;
    protected $exhibitService;
    protected $projectService;
    protected $blockService;
    protected $constructionTypeService;
    protected $unitService;
    protected $rangePriceService;
    protected $reSourceService;

    protected $menuFE,$categories;
    protected $provinces, $districts, $wards, $streets, $directions, $projects, $reTypes, $rangePrices;

    public function __construct(
        RealEstateService $realEstateService,
        ReCategoryService $reCategoryService,
        ReTypeService $reTypeService,
        ProvinceService $provinceService,
        DistrictService $districtService,
        WardService $wardService,
        StreetService $streetService,
        DirectionService $directionService,
        ExhibitService $exhibitService,
        ProjectService $projectService,
        BlockService $blockService,
        ConstructionTypeService $constructionTypeService,
        UnitService $unitService,
        RangePriceService $rangePriceService,
        ReSourceService $reSourceService
    )
    {
        $this->reCategoryService = $reCategoryService;
        $this->reTypeService = $reTypeService;
        $this->provinceService = $provinceService;
        $this->districtService = $districtService;
        $this->wardService = $wardService;
        $this->streetService = $streetService;
        $this->directionService = $directionService;
        $this->exhibitService = $exhibitService;
        $this->projectService = $projectService;
        $this->blockService = $blockService;
        $this->constructionTypeService = $constructionTypeService;
        $this->unitService = $unitService;
        $this->rangePriceService = $rangePriceService;
        $this->reSourceService = $reSourceService;

        $web_id = get_web_id();
        $mmfe = config('menu.mainMenuFE');
        $this->menuFE = Menu::where('web_id', $web_id)->where('menu_type', $mmfe)->first();
        $this->categories = ReCategory::select('id', 'name', 'slug')
            ->orderBy('id', 'asc')
            ->get();

        $this->provinces = $this->provinceService->getListDropDown();
        $this->districts = $this->districtService->getListDropDown();
        $this->wards = $this->wardService->getListDropDown();
        $this->streets = $this->streetService->getListDropDown();
        $this->directions = $this->directionService->getListDropDown();
        $this->projects = $this->projectService->getListDropDown();

        $firstCat = $this->categories->first();
        $this->reTypes = $this->reTypeService->getReTypeByCat($firstCat->id);

        $this->rangePrices = $this->rangePriceService->getListDropDown();
    }

    public function getLogin()
    {
        return v('authenticate.login', ['menuData' => $this->menuFE, 'categories' => $this->categories,]);
    }

    public function login($username, $password, $remember=false,$api=false)
    {
        $logins =   json_decode(settings('system_loginas', json_encode(['id'])), 'true');
        $loginPhone =   auth()->attempt(['phone'=>$username,'password'=>$password], $remember);
        if(in_array('username',$logins))
            $loginUsername   =   auth()->attempt(['name'=>$username,'password'=>$password], $remember);
        if(in_array('email',$logins))
            $loginEmail  =   auth()->attempt(['email'=>$username,'password'=>$password], $remember);
        if(in_array('id',$logins))
            $loginId  =   auth()->attempt(['id'=>$username,'password'=>$password], $remember);
        if(!empty($loginEmail) || !empty($loginUsername) || !empty($loginId) || !empty($loginPhone)){
            if($api==true){
                if(!empty($loginUsername))
                    return 'username';
                if(!empty($loginId))
                    return 'id';
                if(!empty($loginEmail))
                    return 'email';
            }
            session(['tinhthanhquantam' => implode(',', auth()->user()->subcribes()->pluck('province_subcribes.province_id')->toArray())]);
//            event_log(trans('eventlog.accesssystem'));
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function postLogin(LoginRequest $request)
    {
        if($this->login($request->input('id'),$request->input('password'),$request->has('remember'))){
//            return redirect()->to(asset('/quan-ly-tin-rao'));
            return redirect()->route('user.info', [auth()->user()->id]);
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
        return v('users.change-password',[
            'menuData' => $this->menuFE,
            'categories' => $this->categories,
            'reTypes' => $this->reTypes,
            'streets' => $this->streets,
            'directions' => $this->directions,
            'rangePrices' => $this->rangePrices
        ]);
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
        return v('users.manage', [
            'menuData' => $this->menuFE,
            'categories' => $this->categories,
            'reTypes' => $this->reTypes,
            'streets' => $this->streets,
            'directions' => $this->directions,
            'rangePrices' => $this->rangePrices
        ]);
    }

    public function getInfo()
    {
        $provinces = $this->provinceService->getListDropDown();
        return v('users.info', [
            'menuData' => $this->menuFE,
            'provinces' => $provinces,
            'categories' => $this->categories,
            'reTypes' => $this->reTypes,
            'streets' => $this->streets,
            'directions' => $this->directions,
            'rangePrices' => $this->rangePrices
        ]);
    }

    public function postInfo(FormUserInfoRequest $request)
    {
        $userInfo = auth()->user()->userinfo;
        if($userInfo->full_name != $request->full_name){
            if(!empty($userInfo->changed_name_at)){
                if(Carbon::now()->diffInDays($userInfo->changed_name_at) < get_config('changeNameTime', 6)){
                    set_notice(trans('system.changed_name_error'), 'danger');
                    return redirect()->back();
                }
            }
            $userInfo->changed_name_at = Carbon::now();
        }
        $userInfo->full_name   =   $request->full_name;
        $userInfo->company    =   $request->company;
        $userInfo->identification    =   $request->identification;
        $userInfo->phone    =   $request->phone;
        $userInfo->province_id    =   $request->province_id;
        $userInfo->address    =   $request->address;
        $userInfo->website    =   $request->website;
        $userInfo->description    =   $request->description;
        if(!empty($request->certificate))    {
            if(!empty($userInfo->certificate))
                Storage::disk('public_path')->delete($userInfo->certificate);
            $request->certificate->move(public_path('uploads/certificate/'.$userInfo->id), $request->certificate->getClientOriginalName());
            $userInfo->certificate    =   'uploads/certificate/'.$userInfo->id.'/'.$request->certificate->getClientOriginalName();
        }
        $userInfo->seo_title = isset($request->seo_title) ? $request->seo_title : '';
        $userInfo->seo_keyword = isset($request->seo_keyword) ? $request->seo_keyword : '';
        $userInfo->seo_description = isset($request->seo_description) ? $request->seo_description : '';
        $userInfo->save();
        $user   =   auth()->user();
        if($user->phone != $request->phone){
            $user->phone_verify = null;
        }
        $user->phone    =   $request->phone;
        $user->address  =   $request->address;
        $user->save();
        if(!empty($request->subcribes)){
            auth()->user()->subcribes()->sync(explode(',',$request->subcribes));
            session(['tinhthanhquantam' => implode(',', auth()->user()->subcribes()->pluck('province_subcribes.province_id')->toArray())]);
        }
//        event_log('Sửa thành viên '.auth()->user()->name.' id '.auth()->user()->id);
        set_notice(trans('system.edit_success'), 'success');

        return redirect()->back();
    }

    public function getRegister()
    {
        $provinces = $this->provinceService->getListDropDown();
        return v('authenticate.register', [
            'menuData' => $this->menuFE,
            'provinces' => $provinces
        ]);
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
        $data->phone =  $request->phone;
        $data->branch_id =   Branch::where('is_head','1')->first()->id;
        $data->web_id   =   get_web_id();
        $data->created_at   =   Carbon::now();
        $data->save();

        $user_info = new UserInfo();
        $user_info->user_id = $data->id;
        $user_info->full_name = $request->full_name;
        $user_info->company = $request->company;
        $user_info->identification = $request->identification;
        $user_info->phone = $request->phone;
        $user_info->province_id = $request->province_id;
        $user_info->address = $request->address;
        $user_info->description = $request->description;
        $user_info->website = $request->website;

        $user_info->save();

//        event_log('Tạo thành viên mới '.$data->name.' id '.$data->id);
        set_notice(trans('users.add_success'), 'success');

        auth()->login($data);
//        auth()->attempt(['id'=>$data->id, 'password'=>$request->password]);
        createVerifyCode($data->id);
        return redirect()->route('phoneVerify');
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
            $message->to( \request('email'), 'Visitor')->subject('Đặt lại mật khẩu tài khoản Recbook');
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

    public function transactionList() {
        return v('users.tran-list', ['menuData' => $this->menuFE]);
    }
    public function dataTran() {
        $data   =   TransactionLog::query();

        $data   =   $data->where('user_id',auth()->user()->id);

        if(!empty(\request('type_tran')))
            $data   =   $data->where('type_tran',\request('type_tran'));

        $result = Datatables::of($data)
            ->addColumn('type', function($transaction) {
                if($transaction->type==0)
                    return '+';
                if($transaction->type==1)
                    return '-';
                return '';
            })
            ->addColumn('user_id', function($transaction) {
                return User::find($transaction->user_id)->name;
            })
            ->addColumn('currency', function($transaction) {
                return Currency::find($transaction->currency)->code;
            })->addColumn('value', function($transaction) {
                return number_format($transaction->value);
            });

//        if(get_web_id() == 1) {
//            $result = $result->addColumn('web_id', function(Branch $branch) {
//                return Web::find($branch->web_id)->name;
//            });
//        }

        return $result->make(true);
    }

    public function getListGroup(){
        return v('users.groupList');
    }

    public function dataListGroup(){
        $data   =   UserGroup::with('user');
        $data   =   $data->where('user_id', auth()->user()->id);
        $result = Datatables::of($data)
            ->addColumn('name', function(UserGroup $group){
                return "<a href='".route('getUser', ['id'=>$group->id])."'>".$group->name."</a>";
            })
            ->addColumn('count', function(UserGroup $group) {
                return $group->members()->count();
            })
            ->addColumn('manage', function(UserGroup $group) {
                return a('nhom/xoa', 'id='.$group->id,trans('g.delete'), ['class'=>'btn btn-xs btn-danger'],'#',"return bootbox.confirm('".trans('system.delete_confirm')."', function(result){if(result==true){window.location.replace('".asset('nhom/xoa?id='.$group->id)."')}})").'  '.a('nhom/sua', 'id='.$group->id,trans('g.edit'), ['class'=>'btn btn-xs btn-default']);
            })->rawColumns(['manage','name']);

        return $result->make(true);
    }
    public function getDeleteGroup(){
        $data   =   UserGroup::find(request('id'));
        if(!empty($data) && $data->user_id == auth()->user()->id){
            $data->delete();
            set_notice('Xoá nhóm khách hàng thành công!', 'success');
        } else set_notice('Nhóm khách hàng không tồn tại hoặc bạn không có quyền xoá!', 'warning');
        return redirect()->back();
    }
    public function getCreateGroup(){
        return v('users.createGroup');
    }
    public function postCreateGroup(UserGroupRequest $request)
    {
        $data   =   new UserGroup();
        $data->name   =   $request->name;
        $data->user_id  =   auth()->user()->id;
        $data->web_id   =   get_web_id();
        $data->created_at   =   Carbon::now();
        $data->save();
        event_log('Tạo nhóm mới '.$data->name.' id '.$data->id);
        set_notice(trans('customer.add_group_success'), 'success');
        return redirect()->back();
    }
    public function getEditGroup()
    {
        $data   =   UserGroup::find(request('id'));
        if(!empty($data) && $data->user_id == auth()->user()->id){
            event_log('Truy cập trang [Sửa nhóm]');
            return v('users.editGroup', compact('data'));
        }else{
            set_notice("Nhóm không tồn tại hoặc không thuộc quyền quản lý của bạn", 'warning');
            return redirect()->back();
        }
    }
    public function postEditGroup(UserGroupRequest $request)
    {
        $data   =   UserGroup::find($request->id);
        if(!empty($data) && $data->user_id == auth()->user()->id){
            $data->name   =   $request->name;
            $data->save();
            event_log('Sửa nhóm '.$data->name.' id '.$data->id);
            set_notice(trans('system.edit_success'), 'success');
        }else
            set_notice(trans('system.not_exist'), 'warning');
        return redirect()->back();
    }
    public function postAddMember()
    {
        $user_group_id = UserGroup::find(\request('user_group_id'));
        foreach ( explode(',',\request('user_id')) as $item) {
            $user_group_id->members()->attach($item);
        }
//        event_log('Thêm thành viên vào nhóm '.$data->name.' id '.$data->id);
        set_notice(trans('system.add_success'), 'success');
        return redirect()->back();
    }

    public function getMember(){
        return v('users.groupMemberList');
    }

    public function getDataMember(){
        $data = UserGroup::where('id',(\request('id')))->where('user_id',auth()->user()->id)->first();
        $result = [];
        if(!empty($data)){
            $data = $data->members();
            $result = Datatables::of($data)
                ->addColumn('name', function($user) {
                    return $user->name;
                })->addColumn('phone', function($user) {
                    return $user->phone;
                })->addColumn('email', function($user) {
                    return $user->email;
                })->addColumn('manage', function($user) {
                    return a('nhom/thanh-vien/xoa', 'id='.$user->user_id.'&user_group_id='.request('id'),trans('g.delete'), ['class'=>'btn btn-xs btn-danger'],'#',"return bootbox.confirm('".trans('system.delete_confirm')."', function(result){if(result==true){window.location.replace('".asset('nhom/thanh-vien/xoa?id='.$user->user_id.'&user_group_id='.request('id'))."')}})");
                })->rawColumns(['manage']);
            return $result->make(true);
        }

        return Datatables::of([])->make(true);
    }
    public function postDeleteMember(){
        $user_group_id = UserGroup::find(\request('user_group_id'));
        if($user_group_id->user_id == auth()->user()->id){
            $user_group_id->members()->detach([\request('id')]);
            set_notice('Xoá thành viên thành công!', 'success');
        } else set_notice('Thành viên không tồn tại hoặc bạn không có quyền xoá!', 'warning');
        return redirect()->back();
    }

    public function postVerify()
    {
        $verify =   confirmVerifyCode(\request('verify_code'));
//        echo $verify;
//        exit();
        if($verify==1){
            set_notice(trans('system.verify_success').'1', 'success');
        }
        else
            set_notice(trans('system.verify_failed')." Lý do: $verify", 'danger');
//        return response('a');
        return redirect()->back();
    }

    public function resendVerify()
    {
        if(createVerifyCode()){
            session(['codeSend'=>'send']);
        }
        return redirect()->back();
    }

    public function getVerify()
    {
        $user   =   auth()->user();
        if($user->phone_verify == 1){
            set_notice('Tài khoản này đã xác thực số điện thoại thành công!', 'success');
            return redirect()->route('user.info', [auth()->user()->id]);
        }

        return v('authenticate.phoneVerify');
    }

//    public function postVerify()
//    {
//
//    }
}
