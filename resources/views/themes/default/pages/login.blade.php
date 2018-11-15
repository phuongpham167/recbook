@extends('layouts.app')

@section('meta-description')
    <meta name="description" content="Home page" >
@endsection

@section('title')
{{trans('auth.login')}}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}"/>
@endsection

@section('content')
    @include(theme(TRUE).'.includes.header')
    <div class="login-box">

        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">{{trans('auth.need_login')}}</p>

            <form method="post">
                {{csrf_field()}}
                <div class="row subpage">

                    <div class="col-xs-3"></div>
                    <div class="col-xs-6">
                        <div class="_form dangnhap_page bg_fdfdfd">
                            <form class="_check_validate" id="dangnhap-form" action="/site/dangnhap" method="post">
                                <h3 class="title_form"><i class="fa fa-sign-in"></i> THÀNH VIÊN ĐĂNG NHẬP</h3>


                                <dl>
                                    <dt>Tên đăng nhập <span class="required">*</span></dt>
                                    <dd>
                                        <input class="_required" name="DangNhap[username]" id="DangNhap_username" type="text">																	</dd>
                                </dl>

                                <dl>
                                    <dt>Mật khẩu <span class="required">*</span></dt>
                                    <dd>
                                        <input class="_required" name="DangNhap[password]" id="DangNhap_password" type="password">											</dd>
                                </dl>

                                <dl>
                                    <dt></dt>
                                    <dd>
                                        <button type="submit" class="_btn bg_red"><i class="fa fa-sign-in fa-lg fa-fw"></i> ĐĂNG NHẬP</button>
                                        <p>
                                            <a href="/quen-mat-khau.htm">Quên mật khẩu?</a> &nbsp;&nbsp;
                                            <a href="/dang-ky.htm">Đăng ký thành viên</a>
                                        </p>
                                    </dd>
                                </dl>

                            </form>		</div>
                    </div>
                    <div class="col-xs-3"></div>

                </div>
            </form>


            <!-- /.social-auth-links -->

            <a href="#">{{trans('auth.forgotpass')}}</a>


        </div>
        <!-- /.login-box-body -->
    </div>
    @include(theme(TRUE).'.includes.footer')
@endsection

@section('js')

@endsection