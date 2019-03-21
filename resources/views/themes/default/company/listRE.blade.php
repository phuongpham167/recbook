@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Company's RealEstate Page" >
@endsection

@section('title')
    Danh sách yêu cầu công ty
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <link rel="stylesheet" href="{{asset('plugins/loopj-jquery-tokeninput/styles/token-input.css')}}" />
    <link rel="stylesheet" href="{{asset('plugins/loopj-jquery-tokeninput/styles/token-input-bootstrap3.css')}}" />
    <style type="text/css">
        #token-input-subcribes {
            border: none;
        }
    </style>
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
          li.token-input-token {
              max-width: 100% !important;
          }

        ul.token-input-list {
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
                @include(theme(TRUE).'.includes.company_customer_manager_tabs', ['company_id'=>request('id')])
                @include('themes.default.includes.message')
                <!--begin manage_page-->
                <div class="listlandA_page">
                    <p class="title_boxM"><strong><i class="fa fa-user-o"></i>Danh sách yêu cầu công ty</strong><button class="btn btn-xs btn-primary pull-right" data-toggle="modal" style="margin-bottom: 5px" data-target="#modalAddCustomerInfoList">Thêm yêu cầu mới</button></p>
                    <div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table" id="datatable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tiêu đề</th>
                                        <th>Nhóm</th>
                                        <th>DTMB</th>
                                        <th>DTSD</th>
                                        <th>Giá</th>
                                        <th>Liên hệ</th>
                                        <th>Số điện thoại</th>
                                        <th>Ngày tạo</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
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
                <!--end manage_page-->

            </div>
            <!--End left-->

        </div>
    </div>

    @include(theme(TRUE).'.includes.create-customer-info-list-collapse', ['company_id'=>request('id')])
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
            $('#datatable').dataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    'url': urlDatatable = '{!! route('companyREData') !!}',
                    'type': 'GET',
                    'data': function (d) {
                        d.id = {{request('id')}};
                    },
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'type', name: 'type', sortable: false},
                    {data: 'area_of_premises', name: 'area_of_premises'},
                    {data: 'area_of_use', name: 'area_of_use'},
                    {data: 'price', name: 'price'},
                    {data: 'contact_person', name: 'contact_person'},
                    {data: 'contact_phone_number', name: 'contact_phone_number'},
                    {data: 'created_at', name: 'created_at'}
                ],
                initComplete: function () {
                    this.api().columns().every(function () {
                        var column = this;
                        var input = document.createElement("input");
                        if(column.index() != 0 && column.index() != 8 && column.index() != 2){
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
