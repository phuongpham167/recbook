@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Group detail">
@endsection

@section('title')
    {{trans('company.group.detail')}} {{$data->name}}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}"/>
    <link rel="stylesheet" href="{{asset('plugins/jquery.datatables/css/jquery.dataTables.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('plugins/loopj-jquery-tokeninput/styles/token-input.css')}}" />
    <link rel="stylesheet" href="{{asset('plugins/loopj-jquery-tokeninput/styles/token-input-facebook.css')}}" />
    <style type="text/css">
        ul.token-input-list-facebook {
            height: 34px !important;
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
                @include('themes.default.includes.message')
                <div class="listlandA_page">
                    <div class="title_boxM">
                        <strong><i class="fa fa-list-alt"></i>{{trans('company.group.detail')}} {{$data->name}}</strong>
                        <div class="box-tools pull-right">

                        </div>
                    </div>



                    <div>
                        <div class="box-body">
                            <table class="table table-bordered" id="datatable">
                                <thead>
                                <tr>
                                    <th>{{trans('users.name')}}</th>
                                    <th>{{trans('company.group.role')}}</th>
                                    <th>{{trans('g.manage')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($data->users()->take(30)->get() as $item)
                                    <tr>
                                        <td>{{$item->name}}</td>
                                        <td>{{rolename($item->pivot->role)}}</td>
                                        <td>
                                            <a class="btn btn-xs btn-default" href="{{route('groupEdit', ['id'=>$item->id])}}">Sửa</a>
                                            <a class="btn btn-xs btn-danger" href="{{route('groupRemove', ['id'=>$item->id])}}">Xóa</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                <tr>
                                    <td colspan="3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="members" name="members" placeholder="">
                                            <span class="input-group-btn">
                                            <button class="btn btn-primary" type="button">Mời vào nhóm</button>
                                          </span>
                                        </div>
                                    </td>
                                </tr>
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
    <script src="{{asset('plugins/loopj-jquery-tokeninput/src/jquery.tokeninput.js')}}"></script>
    <script>
        $(function () {
            $('#datatable').dataTable();
        });
        $('input[name=members]').tokenInput("{{asset('ajax/user')}}?except={{auth()->user()->id}}&company={{$data->company_id}}", {
            queryParam: "term",
            zindex  :   1005,
            preventDuplicates   :   true,
            theme : 'facebook',
            hintText: 'Nhập tên thành viên cần tìm kiếm'
        });
    </script>
@endpush
