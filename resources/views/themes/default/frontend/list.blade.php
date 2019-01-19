@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Frontend List">
@endsection

@section('title')
    {{trans('frontend.index')}}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}"/>
    <link rel="stylesheet" href="{{asset('plugins/jquery.datatables/css/jquery.dataTables.min.css')}}"/>
@endpush

@section('content')
    @include(theme(TRUE).'.includes.header')
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
                    <p class="title_boxM"><strong><i class="fa fa-list-alt"></i>{{trans('frontend.index')}}</strong></p>

                    <div class="box-tools pull-right">
                        {!! a('frontend/create', '', '<i class="fa fa-plus"></i> '.trans('system.add'), ['class'=>'_btn bg_red'],'')  !!}
                    </div>

                    <div>
                        <div class="box-body">
                            <table class="table table-bordered" id="datatable">
                                <thead>
                                <tr>
                                    <th>{{trans('frontend.title')}}</th>
                                    <th>{{trans('frontend.domain')}}</th>
                                    <th>{{trans('frontend.theme')}}</th>
                                    <th>{{trans('frontend.ended_at')}}</th>
                                    <th>{{trans('g.manage')}}</th>
                                </tr>
                                </thead>
                            </table>
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
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! asset('frontend/data') !!}',
                columns: [
                    {data: 'title', name: 'title'},
                    {data: 'domain', name: 'domain'},
                    {data: 'theme', name: 'theme'},
                    {data: 'ended_at', name: 'ended_at'},
                    {data: 'manage', name: 'manage', sortable: false, searchable: false}
                ]
            });
        });
    </script>
@endpush
