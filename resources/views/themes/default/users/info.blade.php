@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Thông tin thành viên" >
@endsection

@section('title')
    {{trans('users.info')}}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />

@endpush

@section('content')
    @include(theme(TRUE).'.includes.header')

    <div class="container-vina">
        <div class="row subpage">

            <div class="col-xs-3 left">
                @include(theme(TRUE).'.includes.left-menu')
            </div>
        <!--End right-->

            <!--Begin left-->
            <div class="col-xs-9 right">
                @include(theme(TRUE).'.includes.message')
                <!--begin manage_page-->
                <div class="changeinfoA_page member_page">
                    <p class="title_boxM"><strong><i class="fa fa-file-pdf-o"></i> Cập nhật thông tin</strong></p>
                    <div>
                        <div class="_form">
                            <form id="dangnhap-form" method="post">
                                {{csrf_field()}}
                                <div id="dangnhap-form_es_" class="errorSummary" style="display:none"><p>Xin hãy sửa lại những lỗi nhập liệu sau:</p>
                                    <ul><li>dummy</li></ul></div>							<div class="row">

                                    <div class="col-xs-12">
                                        <dl>
                                            <dt class="txt_right">Họ và tên <span class="required">*</span></dt>
                                            <dd>
                                                <input class="_required" name="full_name" id="full_name" type="text" maxlength="200" value="{{auth()->user()->userinfo->full_name}}">											<div class="errorMessage" id="Account_name_em_" style="display:none"></div>										</dd>
                                        </dl>
                                    </div>
                                    <div class="col-xs-12">
                                        <dl>
                                            <dt class="txt_right">Nơi làm việc <span class="required">*</span></dt>
                                            <dd>
                                                <input class="_required" name="company" id="company" type="text" maxlength="200" value="{{auth()->user()->userinfo->company}}">											<div class="errorMessage" id="Account_name_em_" style="display:none"></div>										</dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-12">
                                        <dl>
                                            <dt class="txt_right">Số chứng minh/Mã số thuế <span class="required">*</span></dt>
                                            <dd>
                                                <input class="_required" name="identification" id="identification" type="text" maxlength="50" value="{{auth()->user()->userinfo->identification}}">
                                            </dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-12">
                                        <dl>
                                            <dt class="txt_right">Điện thoại <span class="required">*</span></dt>
                                            <dd>
                                                <input class="_required" name="phone" id="phone" type="text" maxlength="50" value="{{auth()->user()->userinfo->phone}}">
                                            </dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-12">
                                        <dl>
                                            <dt class="txt_right">Tỉnh/Thành <span class="required">*</span></dt>
                                            <dd>
                                                <select class="_required" name="province_id">
                                                    @foreach($provinces as $province)
                                                        <option value="{{$province->id}}" {{$province->id == auth()->user()->userinfo->province_id ? 'selected' : ''}}>{{$province->name}}</option>
                                                    @endforeach
                                                </select>
                                            </dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-12">
                                        <dl>
                                            <dt class="txt_right">Địa chỉ <span class="required">*</span></dt>
                                            <dd>
                                                <input class="_required" name="address" id="address" type="text" maxlength="200" value="{{auth()->user()->userinfo->address}}">
                                            </dd>
                                        </dl>
                                    </div>

                                    {{--<div class="col-xs-12">--}}
                                        {{--<dl>--}}
                                            {{--<dt class="txt_right">Email <span class="required">*</span></dt>--}}
                                            {{--<dd>--}}
                                                {{--<input class="_required" name="email" id="email" type="text" maxlength="200" value="{{auth()->user()->email}}">											<div class="errorMessage" id="Account_email_em_" style="display:none"></div>										</dd>--}}
                                        {{--</dl>--}}
                                    {{--</div>--}}

                                    <div class="col-xs-12">
                                        <dl>
                                            <dt class="txt_right">Website</dt>
                                            <dd>
                                                <input name="website" id="website" type="text" maxlength="200" value="{{ auth()->user()->userinfo->website }}">
                                            </dd>
                                        </dl>
                                    </div>
                                    <div class="col-xs-12">
                                        <dl>
                                            <dt class="txt_right">Giới thiệu <span class="required">*</span></dt>
                                            <dd>
                                                <textarea class="_required" name="description" >{{ auth()->user()->userinfo->description }}</textarea>
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
                            </form>					</div>



                        <div class="clearfix"></div>
                    </div>
                </div>
                <!--end manage_page-->

            </div>
            <!--End left-->

        </div>
    </div>

    @include(theme(TRUE).'.includes.footer')
@endsection

@section('js')

@endsection
