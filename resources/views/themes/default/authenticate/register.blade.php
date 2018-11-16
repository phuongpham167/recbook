@extends('layouts.app')

@section('meta-description')
    <meta name="description" content="Register Page" >
@endsection

@section('title')
{{trans('auth.login')}}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}"/>
@endsection

@section('content')
    @include('includes.header')

    <div class="col-xs-6 col-xs-offset-3">
        <div class="_form dangnhap_page bg_fdfdfd">

            <form class="_check_validate" id="register-form" action="/site/register" method="post">
                <h3 class="title_form"><i class="fa fa-user-plus"></i> ĐĂNG KÝ THÀNH VIÊN</h3>

                <div id="register-form_es_" class="errorSummary" style="display:none"><p>Xin hãy sửa lại những lỗi nhập liệu sau:</p>
                    <ul><li>dummy</li></ul></div>
                <dl>
                    <dt>Tên đăng nhập <span class="required">*</span></dt>
                    <dd>
                        <input class="_required" name="Account[username]" id="Account_username" type="text" maxlength="200">							<div class="errorMessage" id="Account_username_em_" style="display:none"></div>						</dd>
                </dl>

                <dl>
                    <dt>Mật khẩu <span class="required">*</span></dt>
                    <dd>
                        <input class="_required" name="Account[password]" id="Account_password" type="password" maxlength="50">							<div class="errorMessage" id="Account_password_em_" style="display:none"></div>						</dd>
                </dl>

                <dl>
                    <dt>Nhập lại mật khẩu <span class="required">*</span></dt>
                    <dd>
                        <input class="_required" name="Account[repassword]" id="Account_repassword" type="password" maxlength="50">							<div class="errorMessage" id="Account_repassword_em_" style="display:none"></div>						</dd>
                </dl>

                <dl>
                    <dt>Họ tên/Tên công ty <span class="required">*</span></dt>
                    <dd>
                        <input class="_required" name="Account[name]" id="Account_name" type="text" maxlength="200">							<div class="errorMessage" id="Account_name_em_" style="display:none"></div>						</dd>
                </dl>

                <dl>
                    <dt>Số CMT/Mã số thuế <span class="required">*</span></dt>
                    <dd>
                        <input class="_required" name="Account[tax_code]" id="Account_tax_code" type="text" maxlength="50">							<div class="errorMessage" id="Account_tax_code_em_" style="display:none"></div>						</dd>
                </dl>

                <dl>
                    <dt>Email <span class="required">*</span></dt>
                    <dd>
                        <input class="_required" name="Account[email]" id="Account_email" type="text" maxlength="200">							<div class="errorMessage" id="Account_email_em_" style="display:none"></div>						</dd>
                </dl>

                <dl>
                    <dt>Điện thoại <span class="required">*</span></dt>
                    <dd>
                        <input class="_required" name="Account[mobile]" id="Account_mobile" type="text" maxlength="50">							<div class="errorMessage" id="Account_mobile_em_" style="display:none"></div>						</dd>
                </dl>

                <dl>
                    <dt>Địa chỉ <span class="required">*</span></dt>
                    <dd>
                        <input class="_required" name="Account[address]" id="Account_address" type="text" maxlength="200">							<div class="errorMessage" id="Account_address_em_" style="display:none"></div>						</dd>
                </dl>

                <dl>
                    <dt>Website</dt>
                    <dd>
                        <input name="Account[website]" id="Account_website" type="text" maxlength="200">							<div class="errorMessage" id="Account_website_em_" style="display:none"></div>						</dd>
                </dl>

                <dl class="verifyCode">
                    <dt>Mã xác nhận <span class="required">*</span></dt>
                    <dd>
                        <input class="_required" style="width: 50%;" name="Account[verifyCode]" id="Account_verifyCode" type="text">							<p class="box_verify"><img id="yw0" src="/site/captcha?v=5be6a48b0d550" alt=""><a id="yw0_button" href="/site/captcha?refresh=1">Lấy code mới</a></p>
                        <div class="errorMessage" id="Account_verifyCode_em_" style="display:none"></div>						</dd>
                </dl>

                <dl>
                    <dt></dt>
                    <dd>
                        <button type="submit" class="_btn bg_red"><i class="fa fa-pencil-square-o fa-lg fa-fw"></i> ĐĂNG KÝ</button>
                        <button type="reset" class="_btn bg_gray"><i class="fa fa-refresh fa-lg fa-fw"></i> LÀM LẠI</button>
                        <p><a href="/dang-nhap.htm">Đăng nhập nếu bạn đã có tài khoản!</a></p>
                    </dd>
                </dl>

                <br class="cll">
            </form>
        </div>
    </div>
    @include('includes.footer')
@endsection

@section('js')

@endsection