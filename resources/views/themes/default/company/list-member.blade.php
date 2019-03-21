@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Company's Members Page" >
@endsection

@section('title')
    Danh sách thành viên công ty
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <link rel="stylesheet" href="{{asset('plugins/loopj-jquery-tokeninput/styles/token-input-facebook.css')}}" />
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
        tfoot {
            display: table-header-group;
        }
    </style>
    <style type="text/css">
        li.token-input-token {
            max-width: 100% !important;
        }

        ul.token-input-list {
            width: 100% !important;
        }
        .dataTable th>input { width: 50px}
        .dataTable th.title-th>input {
            width: 100% !important;
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
                @include(theme(TRUE).'.includes.company_customer_manager_tabs', ['company_id'=>$company_id])

                @include('themes.default.includes.message')
                <!--begin manage_page-->
                <div class="listlandA_page">
                    <p class="title_boxM"><strong><i class="fa fa-user-o"></i>Danh sách thành viên công ty</strong> @if(get_role($company_id, auth()->user()->id) == 'admin')<a href="#" class="btn btn-xs btn-primary pull-right" id="add-member"><i class="fa fa-plus"></i> Thêm thành viên</a> @endif</p>
                    <div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tên thành viên</th>
                                            <th>Nhóm</th>
                                            <th>Trạng thái</th>
                                            <th>Quyền</th>
                                            @if(get_role($company_id, auth()->user()->id) == 'admin')
                                                <th></th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th></th>
                                        <th class="title-th"></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        @if(get_role($company_id, auth()->user()->id) == 'admin')
                                        <th></th>
                                        @endif
                                    </tr>
                                    </tfoot>
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
    <form method="post" action="{{asset('doanh-nghiep/them-thanh-vien')}}">
        {{csrf_field()}}
        <div id="addMemberModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content modal-lg">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Thêm thành viên công ty</h4>
                    </div>
                    <div class="modal-body">
                        <div class="panel-body ">
                            <div class="form-group clearfix">
                                <input type="text" class="col-sm-12 form-control"
                                       name="user_id" id="add_input"
                                />
                                <input type="text" class="hidden"
                                       name="company_id" value="{{$company_id}}"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit"
                                class="_btn bg_red pull-right"><i
                                    class="fa fa-plus"></i> &nbsp;&nbsp;THÊM
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <link rel="stylesheet" href="{{asset('plugins/jquery.datatables/css/jquery.dataTables.min.css')}}" />

    @include(theme(TRUE).'.includes.footer')
@endsection

@push('js')
    <script src="{{asset('plugins/moment-develop/moment.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('plugins/jquery.datatables/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/bootbox.min.js')}}"></script>
    <script>
        $(function() {
            datatable = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    'url': urlDatatable ='{!! route('companyDetailData',['id'=>$company_id]) !!}',
                    'type': 'GET',
                    'data': function (d) {
                        d.id    =   {{request('id')}};
                    },
                },
                columns: [
                    { data: 'id', name: 'id' , sortable:false},
                    { data: 'name', name: 'name' , sortable:false},
                    { data: 'group', name: 'group' , sortable:false},
                    { data: 'status', name: 'status' , sortable:false},
                    { data: 'permission', name: 'permission' , sortable:false},
                    @if(get_role($company_id, auth()->user()->id) == 'admin')
                        { data: 'manage', name: 'manage'  , sortable:false, searchable: false}
                    @endif
                ],
                initComplete: function () {
                    this.api().columns().every(function () {
                        console.log(this);
                        var column = this;
                        var input = document.createElement("input");
                        if(column.index() != 4 && column.index() != 3) {
                            $(input).appendTo($(column.footer()).empty())
                                .on('keyup', function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                        }
                    });
                }
            });

            $('input[name=user_id]').tokenInput("{{asset('ajax/user')}}?except={{auth()->user()->id}}&role=friend", {
                queryParam: "term",
                zindex  :   1005,
                preventDuplicates   :   true,
                hintText: 'Nhập tên thành viên cần tìm kiếm'
            });

            $('#add-member').on('click', function () {
                // console.log(check);
                $('#addMemberModal').modal('show');
            });

            $(".token-input-dropdown").css("z-index","9999");
        });

    </script>
@endpush
