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
                                            <a class="btn btn-xs btn-default editUser" data-userid="{{$item->id}}" role="{{$item->pivot->role}}">Sửa</a>
                                            <a class="btn btn-xs btn-danger" href="{{route('groupUserRemove', ['id'=>$item->id,'group_id'=>$data->id])}}">Xóa</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                <tr>
                                    <form method="post" action="{{route('setUserToGroup',['group_id'=>$data->id])}}">
                                        {{csrf_field()}}
                                        <td colspan="3">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="members" name="members" placeholder="">
                                                <span class="input-group-btn">
                                            <button class="btn btn-primary" type="submit">Mời vào nhóm</button>
                                          </span>
                                            </div>
                                        </td>
                                    </form>
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
    <form method="post" action="{{route('groupUserEdit')}}">
        {{csrf_field()}}
        <div id="editUserModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content modal-lg">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Sửa cấp độ thành viên</h4>
                    </div>
                    <div class="modal-body">
                        <div class="panel-body ">
                            <div class="form-group clearfix">
                                <select class="form-control" id="role" name="role">
                                    <option value="user">{{rolename('user')}}</option>
                                    <option value="agency">{{rolename('agency')}}</option>
                                    <option value="manager">{{rolename('manager')}}</option>
                                    <option value="admin">{{rolename('admin')}}</option>
                                </select>
                                <input type="text" class="hidden"
                                       name="group_id" value="{{$data->id}}"
                                />
                                <input type="text" class="hidden"
                                       name="id" id="useid"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit"
                                class="_btn bg_red pull-right"><i
                                class="fa fa-floppy-o"></i> &nbsp;&nbsp;LƯU
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
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

        $('.editUser').on('click', function () {
            // console.log(check);
            var user_id    =   $(this).data('userid');
            var role    =   $(this).attr('role');
            $('#useid').val(user_id);
            $('#role').val(role);

            $('#editUserModal').modal('show');
        });
    </script>
@endpush
