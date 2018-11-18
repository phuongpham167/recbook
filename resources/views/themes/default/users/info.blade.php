@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Thông tin thành viên" >
@endsection

@section('title')
    {{trans('users.info')}}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}"/>

@endsection

@section('content')
    @include(theme(TRUE).'.includes.header')

    <div class="container-vina">
        <div class="row subpage">

            <!--Begin right-->
        @include(theme(TRUE).'.includes.left-menu')
        <!--End right-->

            <!--Begin left-->
            <div class="col-xs-9 right">
                @include(theme(TRUE).'.includes.message')
                <!--begin manage_page-->
                <div class="changeinfoA_page member_page">
                    <p class="title_boxM"><strong><i class="fa fa-file-pdf-o"></i> THAY ĐỔI MẬT KHẨU</strong></p>
                    <div>

                        <div class="_form">
                            <form id="dangnhap-form" method="post">
                                {{csrf_field()}}
                                <div id="dangnhap-form_es_" class="errorSummary" style="display:none"><p>Xin hãy sửa lại những lỗi nhập liệu sau:</p>
                                    <ul><li>dummy</li></ul></div>							<div class="row">

                                    <div class="col-xs-12">
                                        <dl>
                                            <dt class="txt_right">Cá nhân/Tổ chức <span class="required">*</span></dt>
                                            <dd>
                                                <input class="_required" name="name" id="name" type="text" maxlength="200" value="{{auth()->user()->name}}">											<div class="errorMessage" id="Account_name_em_" style="display:none"></div>										</dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-12">
                                        <dl>
                                            <dt class="txt_right">Số chứng minh/Mã số thuế <span class="required">*</span></dt>
                                            <dd>
                                                <input class="_required" name="taxcode" id="taxcode" type="text" maxlength="50" value="{{auth()->user()->taxcode}}">
                                            </dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-12">
                                        <dl>
                                            <dt class="txt_right">Điện thoại <span class="required">*</span></dt>
                                            <dd>
                                                <input class="_required" name="phone" id="phone" type="text" maxlength="50" value="{{auth()->user()->phone}}">
                                            </dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-12">
                                        <dl>
                                            <dt class="txt_right">Địa chỉ</dt>
                                            <dd>
                                                <input name="address" id="address" type="text" maxlength="200" value="{{auth()->user()->address}}">
                                            </dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-12">
                                        <dl>
                                            <dt class="txt_right">Email <span class="required">*</span></dt>
                                            <dd>
                                                <input class="_required" name="email" id="email" type="text" maxlength="200" value="{{auth()->user()->email}}">											<div class="errorMessage" id="Account_email_em_" style="display:none"></div>										</dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-12">
                                        <dl>
                                            <dt class="txt_right">Website</dt>
                                            <dd>
                                                <input name="web_id" id="web_id" type="text" maxlength="200" value="{{\App\Web::find(auth()->user()->web_id)->name}}">
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