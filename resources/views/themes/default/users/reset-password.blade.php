@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Đổi mật khẩu" >
@endsection

@section('title')
    {{trans('users.change_pass')}}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}"/>
@endpush

@section('content')
    @include(theme(TRUE).'.includes.header')
    <div class="container-vina">
        <div class="row subpage">
            <div class="col-xs-6 col-xs-offset-3">
                @include(theme(TRUE).'.includes.message')
                <div class="_form dangnhap_page bg_fdfdfd">
                    <form class="_check_validate" id="dangnhap-form" method="post">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-xs-12">
                                <dl>
                                    <dt class="txt_right">Mật khẩu mới <span class="required">*</span></dt>
                                    <dd>
                                        <input class="_required" name="password" id="password" type="password" maxlength="50">
                                    </dd>
                                </dl>
                            </div>

                            <div class="col-xs-12">
                                <dl>
                                    <dt class="txt_right">Nhập lại mật khẩu <span class="required">*</span></dt>
                                    <dd>
                                        <input class="_required" name="password_confirmation" id="password_confirmation" type="password" maxlength="50">
                                    </dd>
                                </dl>
                            </div>

                            <div class="col-xs-12">
                                <dl>
                                    <dt></dt>
                                    <dd>
                                        <button type="submit" class="_btn bg_red"><i class="fa fa-pencil-square-o fa-lg fa-fw"></i> THAY ĐỔI</button>
                                        <button type="reset" class="_btn bg_black"><i class="fa fa-refresh fa-lg fa-fw"></i> LÀM LẠI</button>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    @include(theme(TRUE).'.includes.footer')
@endsection

@section('js')

@endsection