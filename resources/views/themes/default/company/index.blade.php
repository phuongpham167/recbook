@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Company List">
@endsection

@section('title')
    {{trans('company.index')}}
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
                        <strong><i class="fa fa-list-alt"></i>{{trans('company.index')}}</strong>
                        <div class="box-tools pull-right">
                            <a href="{{route('companyCreate')}}" class="btn btn-sm btn-primary">Tạo doanh nghiệp</a>
                        </div>
                    </div>



                    <div>
                        <div class="box-body">
                            <table class="table table-bordered" id="datatable">
                                <thead>
                                <tr>
                                    <th>{{trans('company.title')}}</th>
                                    <th>{{trans('company.description')}}</th>
                                    <th>{{trans('company.address')}}</th>
                                    <th>{{trans('company.status')}}</th>
                                    <th>{{trans('g.manage')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $item)
                                    <tr>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->description}}</td>
                                        <td>{{$item->address}}</td>
                                        <td>{{$item->status}}</td>
                                        <td>
                                            <a class="btn btn-xs btn-default" href="{{route('companyEdit', ['id'=>$item->id])}}">Sửa</a>
                                            <a class="btn btn-xs btn-danger" href="{{route('companyRemove', ['id'=>$item->id])}}">Xóa</a>
                                            <a class="btn btn-xs btn-info" href="{{route('companyMember', ['id'=>$item->id])}}">Quản lý</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$data->appends($_GET)->render()}}
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
