@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Đổi mật khẩu" >
@endsection

@section('title')
    {{trans('users.change_pass')}}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
@endpush

@section('content')
    @include(theme(TRUE).'.includes.user-info-header-1')
    <div class="container-vina">
        <div class="row subpage">

            <div class="col-xs-3 left">
                @include(theme(TRUE).'.includes.left-menu')
            </div>

            <!--Begin left-->
            <div class="col-xs-9 right">
                @include(theme(TRUE).'.includes.message')
                <!--begin manage_page-->
                <div class="changepwA_page member_page">
                    <p class="title_boxM"><strong><i class="fa fa-file-pdf-o"></i> THAY ĐỔI MẬT KHẨU</strong></p>
                    <div>

                        <div class="_form">
                            <form id="dangnhap-form" method="post">
                                {{csrf_field()}}
                                <div id="dangnhap-form_es_" class="errorSummary" style="display:none"><p>Xin hãy sửa lại những lỗi nhập liệu sau:</p>
                                    <ul><li>dummy</li></ul></div>							<div class="row">
                                    <div class="col-xs-12">
                                        <dl>
                                            <dt class="txt_right">Mật khẩu cũ <span class="required">*</span></dt>
                                            <dd>
                                                <input class="_required" name="old_password" id="old_password" type="password" maxlength="50">						                    	<div class="errorMessage" id="Account_old_password_em_" style="display:none"></div>											</dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-12">
                                        <dl>
                                            <dt class="txt_right">Mật khẩu mới <span class="required">*</span></dt>
                                            <dd>
                                                <input class="_required" name="new_password" id="new_password" type="password" maxlength="50">				                    		<div class="errorMessage" id="Account_new_password_em_" style="display:none"></div>										</dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-12">
                                        <dl>
                                            <dt class="txt_right">Nhập lại mật khẩu <span class="required">*</span></dt>
                                            <dd>
                                                <input class="_required" name="confirm_password" id="confirm_password" type="password" maxlength="50">				                    		<div class="errorMessage" id="Account_repassword_em_" style="display:none"></div>										</dd>
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
