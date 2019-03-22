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
                            @if(auth()->user()->group()->first()->company_create)
                            <a href="{{route('companyCreate')}}" class="btn btn-sm btn-primary">Tạo doanh nghiệp</a>
                            @endif
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
                                    <th>{{trans('company.email')}}</th>
                                    <th>{{trans('company.phone')}}</th>
                                    <th>{{trans('company.status')}}</th>
                                    <th>{{trans('g.manage')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $item)
                                    <tr>
                                        <td><a href="{{route('companyDetail', ['id'=>$item->id])}}">{{$item->name}}</a></td>
                                        <td><a href="{{route('companyDetail', ['id'=>$item->id])}}">{{$item->description}}</a></td>
                                        <td><a href="{{route('companyDetail', ['id'=>$item->id])}}">{{$item->address}}</a></td>
                                        <td><a href="{{route('companyDetail', ['id'=>$item->id])}}">{{$item->email}}</a></td>
                                        <td><a href="{{route('companyDetail', ['id'=>$item->id])}}">{{$item->phone}}</a></td>
                                        <td><a href="{{route('companyDetail', ['id'=>$item->id])}}">{{$item->status}}</a></td>
                                        <td>
                                            @if(get_role($item->id, auth()->user()->id) == 'admin')
                                                <a class="btn btn-xs btn-default" href="{{route('companyEdit', ['id'=>$item->id])}}">Sửa</a>
                                                <a class="btn btn-xs btn-danger" href="{{route('companyRemove', ['id'=>$item->id])}}">Xóa</a>
                                            @endif
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
