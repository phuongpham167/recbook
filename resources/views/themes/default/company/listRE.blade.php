@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Customer's RealEstate Page" >
@endsection

@section('title')
    Danh sách yêu cầu
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
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
                @include(theme(TRUE).'.includes.customer_manager_tabs')
                @include('themes.default.includes.message')
                <!--begin manage_page-->
                <div class="listlandA_page">
                    <p class="title_boxM"><strong><i class="fa fa-user-o"></i>Danh sách yêu cầu</strong></p>
                    <div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tên khách hàng</th>
                                            <th>Số điện thoại</th>
                                            <th>Phân loại</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </tfoot>
                                    <tbody>

                                    </tbody>

                                </table>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                    <p class="title_boxM"><strong><i class="fa fa-user-o"></i>Danh sách khách hàng được chia sẻ</strong></p>
                    <div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table" id="datatable2">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên khách hàng</th>
                                        <th>Số điện thoại</th>
                                        <th>Phân loại</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
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
                    'url': urlDatatable ='{!! route('customerData') !!}',
                    'type': 'GET',
                    'data': function (d) {
                        d.datefrom    =   $('#datefrom').val();
                        d.datefrom    =   $('#dateto').val();
                        d.re_category_id = $('#re_category_id').val();
                        d.re_type_id = $('#re_type_id').val();
                        d.district_id = $('#district_id').val();
                        d.post_type = $('#post_type').val();
                    },
                },
                columns: [
                    { data: 'id', name: 'id' , sortable:false},
                    { data: 'name', name: 'name' , sortable:false},
                    { data: 'phone', name: 'phone' , sortable:false},
                    { data: 'type', name: 'type' , sortable:false, searchable: false},
                    { data: 'manage', name: 'manage'  , sortable:false, searchable: false}
                ],
                initComplete: function () {
                    this.api().columns().every(function () {
                        console.log(this);
                        var column = this;
                        var input = document.createElement("input");
                        if(column.index() != 3 && column.index() != 4){
                            $(input).appendTo($(column.footer()).empty())
                                .on('keyup', function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                        }

                    });
                }
            });

            datatable = $('#datatable2').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    'url': urlDatatable ='{!! route('customerSharedData') !!}',
                    'type': 'GET',
                    'data': function (d) {
                        d.datefrom    =   $('#datefrom').val();
                        d.datefrom    =   $('#dateto').val();
                        d.re_category_id = $('#re_category_id').val();
                        d.re_type_id = $('#re_type_id').val();
                        d.district_id = $('#district_id').val();
                        d.post_type = $('#post_type').val();
                    },
                },
                columns: [
                    { data: 'id', name: 'id' , sortable:false},
                    { data: 'name', name: 'name' , sortable:false},
                    { data: 'phone', name: 'phone' , sortable:false},
                    { data: 'type', name: 'type' , sortable:false, searchable: false}
                ],
                initComplete: function () {
                    this.api().columns().every(function () {
                        console.log(this);
                        var column = this;
                        var input = document.createElement("input");
                        if(column.index() != 3 && column.index() != 4){
                            $(input).appendTo($(column.footer()).empty())
                                .on('keyup', function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                        }

                    });
                }
            });
        });

    </script>
@endpush
