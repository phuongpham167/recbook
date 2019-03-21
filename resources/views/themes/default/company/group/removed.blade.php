@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Removed">
@endsection

@section('title')
    {{trans('company.group.removed')}}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}"/>
    <link rel="stylesheet" href="{{asset('plugins/jquery.datatables/css/jquery.dataTables.min.css')}}"/>
@endpush

@section('content')
    @include(theme(TRUE).'.includes.user-info-header')
    <div class="container-vina">
        <div class="row subpage">
            <!--Begin left-->
            <div class="col-xs-3 left">
                @include(theme(TRUE).'.includes.left-menu')
            </div>
            <!--End left-->

            <div class="col-xs-9 right">
                @include('themes.default.includes.message')
                <div class="listlandA_page">
                    <div class="title_boxM">
                        <strong><i class="fa fa-list-alt"></i>{{trans('company.group.removed')}}</strong>
                        <div class="box-tools pull-right">

                        </div>
                    </div>
                    <div>
                        <div class="box-body">
                            <h3 class="text-center">Bạn đã bị xóa khỏi danh sách thành viên nhóm!</h3>
                            <p class="text-center">
                                <a class="btn btn-xs btn-primary" href="#a">Trở về</a>
                            </p>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include(theme(TRUE).'.includes.footer')

@endsection

@push('js')
    <script src="{{asset('plugins/bootbox.min.js')}}"></script>
    <script src="{{asset('plugins/jquery.datatables/js/jquery.dataTables.js')}}"></script>
    <script>
        $(function () {

        });
    </script>
@endpush
