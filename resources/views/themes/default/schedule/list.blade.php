@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Schedule Page" >
@endsection

@section('title')
    Danh sách lịch hẹn
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
                <ul class="nav nav-tabs">
                    <li role="presentation" @if(url()->current() == asset('khach-hang')) class="active" @endif><a class="freelancer_tab" href="/khach-hang">Danh sách khách hàng</a></li>
                    <li role="presentation" @if(url()->current() == asset('khach-hang/lich-hen')) class="active" @endif><a class="freelancer_tab" href="/khach-hang/lich-hen">Danh sách lịch hẹn</a></li>
                    <li role="presentation" @if(url()->current() == asset('nhom')) class="active" @endif><a class="freelancer_tab" href="nhom">Quản lý nhóm thành viên</a></li>
                </ul>
                @include('themes.default.includes.message')
                <!--begin manage_page-->
                <div class="listlandA_page">
                    <p class="title_boxM"><strong><i class="fa fa-calendar-o"></i>Danh sách lịch hẹn</strong> <a href="{{route('scheduleCreate')}}" class="btn btn-xs btn-primary pull-right"><i class="fa fa-plus"></i> Thêm lịch hẹn</a></p>
                    <div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>Nội dung</th>
                                            <th>Tên khách</th>
                                            <th>Thời gian</th>
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
                    'url': urlDatatable ='{!! route('scheduleData') !!}',
                    'type': 'GET',
                    'data': function (d) {
                        d.datefrom    =   $('#datefrom').val();
                        d.datefrom    =   $('#dateto').val();
                    }
                },
                columns: [
                    { data: 'content', name: 'content' },
                    { data: 'customer_id', name: 'customer_id' },
                    { data: 'time', name: 'time' },
                    { data: 'manage', name: 'manage'  , sortable:false, searchable: false}
                ]
            });
        });

    </script>
@endpush
