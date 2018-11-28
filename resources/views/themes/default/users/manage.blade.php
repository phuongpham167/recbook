@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Quản lý tin rao" >
@endsection

@section('title')
    {{trans('real-estate.user_manage')}}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />

@endpush

@section('content')
    @include(theme(TRUE).'.includes.header')
    <div class="container-vina">
        <div class="row subpage">

            <!--Begin right-->
        @include(theme(TRUE).'.includes.left-menu')
        <!--End right-->

            <!--Begin left-->
            <div class="col-xs-9 right">

                <!--begin manage_page-->
                <div class="manageA_page member_page">
                    <p class="title_boxM"><strong><i class="fa fa-file-pdf-o"></i>{{trans('real-estate.user_manage')}}</strong></p>
                    <div>

                        <ul>
                            <li class="add_bds"><a href="/bat-dong-san/tao-moi"><i class="fa fa-file-pdf-o fa-lg"></i>  Thêm mới nhà đất</a></li>
                            <li class="manage_bds"><a href="/bat-dong-san"><i class="fa fa-list fa-lg"></i>  Danh sách tin rao (0)</a></li>
                            <li class="change_pw_bds"><a href="/doi-mat-khau"><i class="fa fa-unlock-alt fa-lg"></i>  Thay đổi mật khẩu</a></li>
                            <li class="change_info_bds"><a href="/thong-tin-thanh-vien"><i class="fa fa-user fa-lg"></i>  Thay đổi thông tin</a></li>
                        </ul>

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
