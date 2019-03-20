@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Company List">
@endsection

@section('title')
    {{trans('company.group.index')}}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}"/>
    <link rel="stylesheet" href="{{asset('plugins/jquery.datatables/css/jquery.dataTables.min.css')}}"/>
    <style>
        .freelancer_tab {
            margin-bottom: 0px;
            margin-top: 0;
            background: #0c4da2;
            color: #fff;
            font-weight: 500;
            font-size: 13px;
            padding: 10px 15px;
            text-transform: uppercase;
        }
    </style>
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
                @include(theme(TRUE).'.includes.company_customer_manager_tabs', ['company_id'=>$company_id])
                @include('themes.default.includes.message')
                <div class="listlandA_page">
                    <div class="title_boxM">
                        <strong><i class="fa fa-list-alt"></i>{{trans('company.group.index')}}</strong>
                        <div class="box-tools pull-right">
                            <a href="{{route('groupCreate', ['id'=>$company_id])}}" class="btn btn-sm btn-primary">{{trans('company.group.create')}}</a>
                        </div>
                    </div>



                    <div>
                        <div class="box-body">
                            <table class="table table-bordered" id="datatable">
                                <thead>
                                <tr>
                                    <th>{{trans('company.title')}}</th>
                                    <th>{{trans('company.description')}}</th>
                                    <th>{{trans('company.total_user')}}</th>
                                    <th>{{trans('g.manage')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($groups as $item)
                                    <tr>
                                        <td><a href="{{route('companyGroupDetail', ['id'=>$item->id])}}">{{$item->name}}</a></td>
                                        <td><a href="{{route('companyGroupDetail', ['id'=>$item->id])}}">{{$item->description}}</a></td>
                                        <td><a href="{{route('companyGroupDetail', ['id'=>$item->id])}}">{{$item->users()->count()}}</a></td>
                                        <td>
                                            <a class="btn btn-xs btn-default" href="{{route('groupEdit', ['id'=>$item->id])}}">Sửa</a>
                                            <a class="btn btn-xs btn-danger" href="{{route('groupRemove', ['id'=>$item->id])}}">Xóa</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
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
            $('#datatable').dataTable();
        });
    </script>
@endpush
