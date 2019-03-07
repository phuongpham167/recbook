@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Customer Page">
@endsection

@section('title')
    Danh sách khách hàng
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}"/>
    <style>
        .btn-is-disabled {
            pointer-events: none; /* Disables the button completely. Better than just cursor: default; */
            color: #ccc !important;
        }

        .listlandA_page .form-control {
            font-size: 12px;
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
            @include('themes.default.includes.message')
            <!--begin manage_page-->
                <div class="listlandA_page">
                    <p class="title_boxM"><strong><i class="fa fa-file-pdf-o"></i>Chăm sóc khách hàng</strong></p>
                    <div>
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Thông tin khách hàng</div>
                                    <div class="panel-body">
                                        <div class="form-group col-md-6">
                                            <label>Mã khách hàng</label>
                                            <input type="text" class="form-control" value="{{$customer->id}}" disabled>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Tên khách hàng</label>
                                            <input type="text" class="form-control" value="{{$customer->name}}"
                                                   disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Số điện thoại</label>
                                            <input type="text" class="form-control" value="{{$customer->phone}}"
                                                   disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" value="{{$customer->email}}"
                                                   disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Địa chỉ</label>
                                            <input type="text" class="form-control" value="{{$customer->address}}"
                                                   disabled>
                                        </div>
                                        <div class="table-responsive">
                                            <div class="">
                                                <button class="btn btn-info" data-toggle="modal"
                                                        data-target="#modalAddCustomerInfoList">Thêm
                                                </button>
                                            </div>
                                            <table class="table table-bordered" id="datatable">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th style="min-width: 200px">Tiêu đề</th>
                                                    <th>Nhóm</th>
                                                    <th>DTMB</th>
                                                    <th>DTSD</th>
                                                    <th>Giá</th>
                                                    <th>Liên hệ</th>
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
                                                </tr>
                                                </tfoot>
                                                <tbody>
                                                @foreach($data as $item)
                                                    <?php
                                                    $detail = [
                                                        'id' => $item->id,
                                                        'title' => $item->title,
                                                        'type' => $item->reType ? $item->reType->name : '',
                                                        'category' => $item->reCategory ? $item->reCategory->name : '',
                                                        'address' => $item->address,
                                                        'ward' => $item->ward ? $item->ward->name : '',
                                                        'district' => $item->district ? $item->district->name : '',
                                                        'province' => $item->province ? $item->province->name : '',
                                                        'direction' => $item->direction ? $item->direction->name : '',
                                                        'width' => $item->width,
                                                        'length' => $item->length,
                                                        'premises' => $item->area_of_premises,
                                                        'use' => $item->area_of_use,
                                                        'price' => $item->price,
                                                        'unit' => $item->unit ? $item->unit->name : '',
                                                        'contact_person' => $item->contact_person,
                                                        'post_date' => $item->post_date
                                                    ];
                                                    ?>
                                                    <tr style="cursor: pointer" class="get-detail"
                                                        data-id="{{$item->id}}"
                                                        data-detail="{{json_encode($detail)}}">
                                                        <td>{{$detail['id']}}</td>
                                                        <td>{{$detail['title']}}</td>
                                                        <td>{{$detail['category']}}</td>
                                                        <td>{{$detail['premises']}}</td>
                                                        <td>{{$detail['use']}}</td>
                                                        <td>{{$detail['price']}}</td>
                                                        <td>{{$detail['contact_person']}}</td>
                                                        <td>{{$detail['post_date']}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">Khách hàng liên quan</div>
                                <div class="panel-body">
                                    @foreach($related_customers as $ctm)
                                        @php
                                                $c = \App\Customer::find($ctm->customer_id1);
                                                if($ctm->customer_id1 == $customer->id){
                                                    $c = \App\Customer::find($ctm->customer_id2);
                                                }
                                        @endphp
                                        <p style="margin: 0 0 10px;">
                                            <a href="{{ route('user.info', [$c->id])}} ">{{$c->name}}</a>
                                            <a type="button" class="pull-right" href="{{route('deleteRelatedCustomer',['ctm1' => $c->id,'ctm2' => $customer->id])}}"><i class="fa fa-window-close" aria-hidden="true"></i></a>
                                        </p>
                                    @endforeach
                                </div>
                                <div class="panel-footer">
                                    <form method="get" action="{{asset('khach-hang/khach-hang-lien-quan')}}">
                                        {{csrf_field()}}
                                        <input type="text" class="form-control"
                                               name="related_customer_id" id="related_customer_id"
                                        />
                                        <input type="text" class="form-control hidden"
                                               name="customer_id" value="{{$customer->id}}"
                                        />
                                        <button type="submit" class="btn btn-info btn-sm" style="margin-top: 5px">Thêm</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">Chi tiết yêu cầu</div>
                                <div class="panel-body">
                                    <div class="form-group col-md-12">
                                        <label>Mã yêu cầu</label>
                                        <span class="form-control" id="code"></span>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Tiêu đề</label>
                                        <span class="form-control" id="title"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Loại</label>
                                        <span class="form-control" id="type"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Nhóm</label>
                                        <span class="form-control" id="category"></span>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Địa chỉ</label>
                                        <span class="form-control" id="address"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Phường</label>
                                        <span class="form-control" id="ward"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Quận huyện</label>
                                        <span class="form-control" id="district"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Tỉnh thành</label>
                                        <span class="form-control" id="province"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Hướng</label>
                                        <span class="form-control" id="direction"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Chiều rộng</label>
                                        <span class="form-control" id="width"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Chiều dài</label>
                                        <span class="form-control" id="length"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>DTMB</label>
                                        <span class="form-control" id="premises"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>DTSD</label>
                                        <span class="form-control" id="use"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Giá</label>
                                        <span class="form-control" id="price"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Đơn vị</label>
                                        <span class="form-control" id="unit"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">Lịch sử chăm sóc <a class="btn btn-xs btn-info pull-right"
                                                                               style="display: none" data-id=""
                                                                               id="addcare"><i
                                                class="fa fa-plus"></i> Chăm sóc</a></div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="care_table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nội dung</th>
                                                <th>Phản hồi</th>
                                                <th>Thời gian</th>
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
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">Danh sách đáp ứng</div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="response_table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th style="min-width: 200px">Tiêu đề</th>
                                                <th>Nhóm</th>
                                                <th>DTMB</th>
                                                <th>DTSD</th>
                                                <th>Giá</th>
                                                <th>Liên hệ</th>
                                                <th>SĐT</th>
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
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Danh sách lịch hẹn <a class="btn btn-xs btn-info pull-right"
                                                                                 data-id="{{$customer->id}}"
                                                                                 id="addschedule"><i
                                                class="fa fa-plus"></i> Thêm lịch hẹn</a></div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="schedule_table">
                                            <thead>
                                            <tr>
                                                <th style="min-width: 200px">Nội dung</th>
                                                <th>Thời gian</th>
                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end manage_page-->

            </div>
            <!--End left-->

        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="myModal">

        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Thêm chăm sóc</h4>
                </div>
                <div class="modal-body row form-horizontal">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">* Nội dung chăm sóc</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control required" id="modal-content" required
                                       placeholder="nội dung chăm sóc">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">* Phản hồi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control required" id="modal-feedback" required
                                       placeholder="nội dung phản hồi">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">* Mã yêu cầu</label>
                            <div class="col-sm-4">
                                <span class="form-control" id="modal-code"></span>
                            </div>
                            <label class="col-sm-2 control-label">* Mã đáp ứng</label>
                            <div class="col-sm-4">
                                <span class="form-control" id="modal-response-code"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">* Số điện thoại</label>
                            <div class="col-sm-4">
                                <input class="form-control" id="modal-phone"/>
                            </div>
                            <label class="col-sm-4">
                                <a class="btn btn-default" id="modal-search"><i class="fa fa-search"></i> Tìm kiếm</a>
                                <a class="btn btn-success" id="modal-suggest"><i class="fa fa-check"></i> Xem gợi ý</a>
                            </label>
                        </div>
                        <hr/>
                        <h4>Chọn đáp ứng</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="suggest_table">
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
                            </table>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Đóng
                    </button>
                    <button type="button" class="btn btn-primary" id="submit_btn"><i class="fa fa-plus"></i> Cập nhật
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <form method="post" action="{{asset('khach-hang/lich-hen/tao-moi')}}">
        {{csrf_field()}}
        <div id="myModal2" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content modal-lg">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Tạo mới lịch hẹn</h4>
                    </div>
                    <div class="modal-body">
                        <div class="panel-body ">
                            <div class="form-group clearfix">
                                <input type="text" class="col-sm-12 form-control"
                                       name="customer_id" id="customer_id"
                                       value="{{$customer->id}}"
                                />
                            </div>
                            <div class="form-group clearfix">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control datepicker"
                                           name="time" id="time"
                                           placeholder="Thời gian"
                                    />
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <div class="col-sm-12">
                                    <textarea name="content"
                                              rows="3"
                                              class="form-control autoExpand"
                                              id="content"
                                              placeholder="Nội dung"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="add_new"
                                id="add-new-re"
                                class="_btn bg_red pull-right"><i
                                    class="fa fa-plus"></i> &nbsp;&nbsp;ĐĂNG
                            TIN
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </form>
    <style type="text/css">
        li.token-input-token {
            max-width: 100% !important;
        }

        ul.token-input-list {
            width: 100% !important;
        }
    </style>
    @include(theme(TRUE).'.includes.create-customer-info-list-collapse')

    <link rel="stylesheet" href="{{asset('plugins/jquery.datatables/css/jquery.dataTables.min.css')}}"/>

    @include(theme(TRUE).'.includes.footer')
@endsection

@push('js')
    <script src="{{asset('plugins/moment-develop/moment.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('plugins/jquery.datatables/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/bootbox.min.js')}}"></script>
    <script>
        $('.datepicker').datetimepicker({format: 'YYYY-MM-DD HH:mm'});

        $('#customer_id').tokenInput("{{asset('ajax/customer')}}", {
            queryParam: "term",
            zindex: 1005,
            preventDuplicates: true,
            tokenLimit: 1,
            @if(!empty($customer->id))
            prePopulate: [
                {id: "{{$customer->id}}", name: "{{\App\Customer::find($customer->id)->name}}"}
            ]
            @endif
        });

        $('#related_customer_id').tokenInput("{{asset('ajax/customer')}}", {
            queryParam: "term",
            zindex: 1005,
            preventDuplicates: true,
            tokenLimit: 1,
            hintText: 'Nhập tên khách hàng cần tìm'
        });

        function fill_detail(detail) {
            $('#addcare').show();
            console.log(detail.title);
            $('#code').html(detail.id);
            $('#title').html(detail.title);
            $('#type').html(detail.type);
            $('#category').html(detail.category);
            $('#address').html(detail.address);
            $('#ward').html(detail.ward);
            $('#district').html(detail.district);
            $('#province').html(detail.province);
            $('#direction').html(detail.direction);
            $('#width').html(detail.width);
            $('#length').html(detail.length);
            $('#premises').html(detail.premises);
            $('#use').html(detail.use);
            $('#price').html(detail.price);
            $('#unit').html(detail.unit);
        }

        function get_cares(id) {
            $('#care_table').DataTable().destroy();
            $('#care_table').dataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    'url': urlDatatable = '{!! route('careData') !!}',
                    'type': 'GET',
                    'data': function (d) {
                        d.id = id
                    },
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'content', name: 'content'},
                    {data: 'feedback', name: 'feedback'},
                    {data: 'created_at', name: 'created_at'}
                ],
                initComplete: function () {
                    this.api().columns().every(function () {
                        console.log(this);
                        var column = this;
                        var input = document.createElement("input");
                        if(column.index() != 0){
                            $(input).appendTo($(column.footer()).empty())
                                .on('keyup', function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                        }

                    });
                }
            });
        }

        function get_response(id) {
            $('#response_table').DataTable().destroy();
            $('#response_table').dataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    'url': urlDatatable = '{!! route('responseList') !!}',
                    'type': 'GET',
                    'data': function (d) {
                        d.id = id;
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
                        if(column.index() != 0 && column.index() != 8){
                            $(input).appendTo($(column.footer()).empty())
                                .on('keyup', function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                        }

                    });
                }
            });
        }
        $(function() {
            $('#datatable').dataTable({
                initComplete: function () {
                this.api().columns().every(function () {
                    console.log(this);
                    var column = this;
                    var input = document.createElement("input");
                    if(column.index() != 0 && column.index() != 7){
                        $(input).appendTo($(column.footer()).empty())
                            .on('keyup', function () {
                                column.search($(this).val(), false, false, true).draw();
                            });
                    }

                });
            }
            });
            if ($('.get-detail').first().data('detail') != null) {
                fill_detail($('.get-detail').first().data('detail'));
                get_cares($('.get-detail').first().data('id'));
                console.log($('.get-detail').first().data('id'));
                get_response($('.get-detail').first().data('id'));
                $('#addcare').data('id', $('.get-detail').first().data('id'));
            }

            $('.get-detail').click(function () {
                fill_detail($(this).data('detail'));
                get_cares($(this).data('id'));
                get_response($(this).data('id'));
                $('#addcare').data('id', $(this).data('id'));
            });
            $('#addcare').click(function () {
                var id = $(this).data('id');
                $('#modal-code').html(id);
                $('#myModal').modal('show');
            });
            $('#modal-search').click(function () {
                $('#suggest_table').DataTable().destroy();
                $('#suggest_table').dataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        'url': urlDatatable = '{!! route('suggestResponse') !!}?phone=' + $('#modal-phone').val(),
                        'type': 'GET'
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
                        {data: 'created_at', name: 'created_at'},
                    ]
                });
            });
            $('#submit_btn').click(function () {
                var content = $('#modal-content').val();
                var feedback = $('#modal-feedback').val();
                var realestate_id = $('#modal-code').html();
                var response_id = $('#modal-response-code').html();
                if (content != '' && feedback != '') {
                    $.post('{{route('careCreate')}}', {
                        content,
                        feedback,
                        realestate_id,
                        response_id,
                        _token: '{{csrf_token()}}'
                    }, function (r) {
                        if (r.status == 0) {
                            get_cares(r.id);
                            get_response(r.id);
                            $('#myModal').modal('hide');
                        }
                    });
                }

            });
            $('#suggest_table').on('click', '.picksuggest', function () {
                var id = $(this).data('id');
                $('#modal-response-code').html(id);
            });

            $('#schedule_table').dataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    'url': urlDatatable = '{!! route('scheduleData') !!}' + '?customer_id=' +{{$customer->id}},
                    'type': 'GET',
                    'data': function (d) {
                    }
                },
                columns: [
                    {data: 'content', name: 'content'},
                    {data: 'time', name: 'time'},
                ],
                initComplete: function () {
                    this.api().columns().every(function () {
                        console.log(this);
                        var column = this;
                        var input = document.createElement("input");
                        $(input).appendTo($(column.footer()).empty())
                            .on('keyup', function () {
                                column.search($(this).val(), false, false, true).draw();
                            });
                    });
                }
            });

            $('.panel-heading').on('click', '#addschedule', function () {
                // console.log(check);
                $('#myModal2').modal('show');
            });
        });

    </script>
@endpush
