@extends('layouts.app')

@section('meta-description')
    <meta name="description" content="Login Page" >
@endsection

@section('title')
{{trans('auth.login')}}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}"/>
@endsection

@section('content')
    @include(theme(TRUE).'.includes.header')

    <div class="container-vina">
        <div class="row subpage">
            <div class="col-xs-6 col-xs-offset-3">
                @include('themes.default.includes.message')
                <div class="_form dangnhap_page bg_fdfdfd">
                    <form class="_check_validate" id="dangnhap-form" method="post">
                        {{csrf_field()}}
                        <h3 class="title_form"><i class="fa fa-sign-in"></i> THÀNH VIÊN ĐĂNG NHẬP</h3>


                        <dl>
                            <dt>Tên đăng nhập <span class="required">*</span></dt>
                            <dd>
                                <input type="text" name="id" class="form-control" required placeholder="ID" />
                            </dd>
                        </dl>

                        <dl>
                            <dt>Mật khẩu <span class="required">*</span></dt>
                            <dd>
                                <input type="password" name="password" class="form-control" min="6" placeholder="{{trans('auth.password')}}">
                            </dd>
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
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include(theme(TRUE).'.includes.footer')
@endsection

@section('js')

@endsection