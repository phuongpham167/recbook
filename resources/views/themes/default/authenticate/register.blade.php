@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Register Page" >
@endsection

@section('title')
{{trans('auth.login')}}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
@endpush

@section('content')
    @include(theme(TRUE).'.includes.header')

    <div class="col-xs-6 col-xs-offset-3">
        <div class="_form dangnhap_page bg_fdfdfd">
            @include(theme(TRUE).'.includes.message')
            <form class="_check_validate" id="register-form" method="post">
                {{csrf_field()}}
                <h3 class="title_form"><i class="fa fa-user-plus"></i> ĐĂNG KÝ THÀNH VIÊN</h3>

                <dl>
                    <dt>Tên đăng nhập <span class="required">*</span></dt>
                    <dd>
                        <input class="_required" name="name" id="name" type="text" value="{{old('name')}}" maxlength="200">
                    </dd>
                </dl>

                <dl>
                    <dt>Mật khẩu <span class="required">*</span></dt>
                    <dd>
                        <input class="_required" name="password" id="password" type="password" maxlength="50">
                    </dd>
                </dl>

                <dl>
                    <dt>Nhập lại mật khẩu <span class="required">*</span></dt>
                    <dd>
                        <input class="_required" name="repassword" id="repassword" type="password" maxlength="50">
                    </dd>
                </dl>

                <dl>
                    <dt>Họ tên/Tên công ty <span class="required">*</span></dt>
                    <dd>
                        <input class="_required" name="company_name" id="company_name" value="{{old('company_name')}}" type="text" maxlength="200">
                    </dd>
                </dl>

                <dl>
                    <dt>Số CMT/Mã số thuế <span class="required">*</span></dt>
                    <dd>
                        <input class="_required" name="taxcode" id="taxcode" value="{{old('taxcode')}}" type="text" maxlength="50">
                    </dd>
                </dl>

                <dl>
                    <dt>Email <span class="required">*</span></dt>
                    <dd>
                        <input class="_required" name="email" id="email" value="{{old('email')}}" type="text" maxlength="200">
                    </dd>
                </dl>

                <dl>
                    <dt>Điện thoại <span class="required">*</span></dt>
                    <dd>
                        <input class="_required" name="phone" id="phone" value="{{old('phone')}}" type="text" maxlength="50">
                    </dd>
                </dl>

                <dl>
                    <dt>Địa chỉ <span class="required">*</span></dt>
                    <dd>
                        <input class="_required" name="address" id="address" value="{{old('address')}}" type="text" maxlength="200">
                    </dd>
                </dl>

                <dl>
                    <dt>Nhóm </dt>
                    <dd>
                        <select class="form-control" name="group_id" id="group_id">
                            <option value="">--Chọn nhóm--</option>
                            @foreach(\App\Group::where('register_permission','1')->get() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </dd>
                </dl>

                <dl>
                    <dt>Website</dt>
                    <dd>
                        <input name="website" id="website" type="text" value="{{old('website')}}" maxlength="200">
                    </dd>
                </dl>

                <dl>
                    <dt></dt>
                    <dd>
                        <button type="submit" class="_btn bg_red"><i class="fa fa-pencil-square-o fa-lg fa-fw"></i> ĐĂNG KÝ</button>
                        <button type="reset" class="_btn bg_gray"><i class="fa fa-refresh fa-lg fa-fw"></i> LÀM LẠI</button>
                        <p><a href="/dang-nhap">Đăng nhập nếu bạn đã có tài khoản!</a></p>
                    </dd>
                </dl>

                <br class="cll">
            </form>
        </div>
    </div>
    @include(theme(TRUE).'.includes.footer')
@endsection

@section('js')

@endsection
