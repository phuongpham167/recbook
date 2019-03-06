@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Customer Group Page">
@endsection

@section('title')
    Danh sách thành viên nhóm
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}"/>
    <style>
        .btn-is-disabled {
            pointer-events: none; /* Disables the button completely. Better than just cursor: default; */
            color: #ccc !important;
        }

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

        div.token-input-dropdown-bootstrap {
            position: absolute;
            width: 400px;
            background-color: #fff;
            overflow: hidden;
            border-left: 1px solid #ccc;
            border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            cursor: default;
            z-index: 11001;
        }

        li.token-input-token {
            max-width: 100% !important;
        }
    </style>
@endpush

@section('content')
    @include(theme(TRUE).'.includes.user-info-header')

    <div class="container-vina">
        <div class="row subpage">

            <div class="col-xs-3 left">
                @include(theme(TRUE).'.includes.left-menu')
            </div>

            <!--Begin left-->
            <div class="col-xs-9 right">
                <div>
                    <ul class="nav nav-tabs">
                        <li role="presentation" @if(url()->current() == asset('khach-hang')) class="active" @endif><a
                                    class="freelancer_tab" href="/khach-hang">Danh sách khách hàng</a></li>
                        <li role="presentation"
                            @if(url()->current() == asset('khach-hang/lich-hen')) class="active" @endif><a
                                    class="freelancer_tab" href="/khach-hang/lich-hen">Danh sách lịch hẹn</a></li>
                        <li role="presentation" @if(url()->current() == asset('nhom')) class="active" @endif><a
                                    class="freelancer_tab" href="{{asset('nhom')}}">Quản lý nhóm thành viên</a></li>
                    </ul>
                </div>
            @include('themes.default.includes.message')
            <!--begin manage_page-->
                <div class="listlandA_page">
                    <p class="title_boxM"><strong><i class="fa fa-users"></i>Danh sách thành viên nhóm</strong> <a
                                type="button" href="#a" class="btn btn-xs btn-primary pull-right" id="addMember"><i
                                    class="fa fa-plus"></i> Thêm thành viên</a></p>
                    <div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table" id="datatable">
                                    <thead>
                                    <tr>
                                        <th>Tên</th>
                                        <th>Số điện thoại</th>
                                        <th>Email</th>
                                        <th>Quản lý</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>
                <!--end manage_page-->

            </div>
            <!--End left-->

        </div>
    </div>
    <form action="{{route('addMember')}}" method="get">
        <div id="addMemberModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Thêm thành viên</h4>
                    </div>
                    <div class="modal-body">
                        <input class="i-id" value="" hidden>
                        <label class="control-label">Tên thành viên</label>
                        <div id="pathinput">
                            <input type="text" class="form-control member" name="user_id" value=""/>
                            <input type="text" class="form-control hidden" name="user_group_id" value="{{request('id')}}"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-default" data-dismiss="modal">{{trans('system.cancel')}}</a>
                        <button type="submit" class="btn btn-info" >Thêm</button>
                    </div>
                </div>

            </div>
        </div>
    </form>

    <link rel="stylesheet" href="{{asset('plugins/jquery.datatables/css/jquery.dataTables.min.css')}}"/>

    @include(theme(TRUE).'.includes.footer')
@endsection

@push('js')
    <script src="{{asset('plugins/moment-develop/moment.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('plugins/jquery.datatables/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/bootbox.min.js')}}"></script>
    <script>
        $(function () {
            datatable = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    'url': urlDatatable = '{!! route('memberData') !!}',
                    'type': 'GET',
                    'data': function (d) {
                        d.id = '{{request('id')}}';
                    },
                },
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'phone', name: 'phone'},
                    {data: 'email', name: 'email'},
                    {data: 'manage', name: 'manage', sortable: false, searchable: false}
                ]
            });
        });

        $('#addMember').on('click', function () {
            // console.log(check);

            $('#addMemberModal').modal('show');
            $('.member').tokenInput("{{asset('/ajax/user')}}", {
                theme: "bootstrap",
                queryParam: "term",
                zindex: 9999,
                onAdd: function (r) {
                    $('#method').val(r.method);
                }
            });
        });

    </script>
@endpush
