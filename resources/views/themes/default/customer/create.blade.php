@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Customer Page" >
@endsection

@section('title')
    Danh sách khách hàng
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <style>
        .btn-is-disabled {
            pointer-events: none; /* Disables the button completely. Better than just cursor: default; */
            color: #ccc !important;
        }
    </style>
@endpush

@section('content')
    @include(theme(TRUE).'.includes.header')

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
                    <p class="title_boxM"><strong><i class="fa fa-file-pdf-o"></i>Thêm mới khách hàng</strong> <a href="{{route('customerList')}}" class="btn btn-xs btn-primary pull-right"><i class="fa fa-chevron-left"></i> Quay lại</a></p>
                    <div>
                        <div class="box-body">
                            <form class="form-horizontal" method="post">
                                {{csrf_field()}}
                                <div class="panel panel-primary">
                                    <div class="panel-heading">Thông tin cá nhân</div>

                                    <div class="panel-body">
                                        <div class="col-md-12">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">{{trans('customer.name')}}</label>

                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="name"
                                                               placeholder="{{trans('customer.name')}}"
                                                               value="{{old('name')}}"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">{{trans('customer.birthday')}}</label>

                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control datepicker"
                                                               name="birthday" value="{{old("birthday")}}"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">{{trans('customer.gender')}}</label>

                                                    <div class="col-sm-10">
                                                        <select class="form-control" name="gender">
                                                            <option value="">--Chọn giới tính--</option>
                                                            <option value="0">Nam</option>
                                                            <option value="1">Nữ</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-primary">
                                    <div class="panel-heading">Thông tin liên lạc</div>

                                    <div class="panel-body">
                                        <div class="col-md-6">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">{{trans('customer.phone')}}</label>

                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="phone"
                                                               placeholder="{{trans('customer.phone')}}"
                                                               value="{{old('phone')}}"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">{{trans('customer.email')}}</label>

                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="email"
                                                               placeholder="{{trans('customer.email')}}"
                                                               value="{{old('email')}}"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">{{trans('customer.province')}}</label>

                                                    <div class="col-md-9">
                                                        <select class="js-basic-single form-control" name="province_id"
                                                                id="province_id">
                                                            <option value="">--Chọn Tỉnh--</option>
                                                            @foreach(\App\Province::all() as $item)
                                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">{{trans('customer.district')}}</label>

                                                    <div class="col-md-9">
                                                        <select class="js-basic-single form-control" name="district_id"
                                                                id="district_id">
                                                            <option value="">--Vui lòng chọn Tỉnh--</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">{{trans('customer.ward')}}</label>

                                                    <div class="col-md-9">
                                                        <select class="js-basic-single form-control" name="ward_id" id="ward_id">
                                                            <option value="">--Vui lòng chọn Quận/Huyện/TP--</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">{{trans('customer.address')}}</label>

                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="address"
                                                               placeholder="{{trans('customer.address')}}"
                                                               value="{{old('address')}}"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">{{trans('customer.source')}}</label>

                                                    <div class="col-md-9">
                                                        <select class="js-basic-single form-control" name="source_id" id="source_id">
                                                            <option value="">--Chọn nguồn--</option>
                                                            @foreach(\App\Source::all() as $item)
                                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">{{trans('customer.type')}}</label>

                                                    <div class="col-md-9">
                                                        <select class="js-basic-single form-control" name="type_id" id="type_id">
                                                            <option value="">--Chọn phân loại--</option>
                                                            @foreach(\App\Type::all() as $item)
                                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="reset" class="btn btn-default">{{trans('system.cancel')}}</button>
                                    <button type="submit"
                                            class="btn btn-info pull-right">{{trans('system.submit')}}</button>
                                </div>
                                <!-- /.box-footer -->
                            </form>
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(function() {
            $('.datepicker').datetimepicker({format: 'YYYY-MM-DD'});
            $('.js-basic-single').select2();
            $('#province_id').change(function(){
                var id= $(this).val();

                console.log(id);
                $.post('<?php echo asset('search-area'); ?>', {province_id: id, _token: '{{csrf_token()}}'}, function(r){
                    $('#district_id').html('');
                    $("#district_id").append('<option value="">--Chọn Quận/Huyện/TP--</option>');
                    $.each(r, function(i, item) {
                        console.log(r);
                        $("#district_id").append('<option value="'+item.id+'">'+item.name+'</option>');
                    });
                });
            });
            $('#district_id').change(function(){
                var id= $(this).val();

                $.post('<?php echo asset('search-area'); ?>', {district_id: id, _token: '{{csrf_token()}}'}, function(r){
                    $('#ward_id').html('');
                    $("#ward_id").append('<option value="">--Chọn Phường/Xã--</option>');
                    $.each(r, function(i, item) {
                        $("#ward_id").append('<option value="'+item.id+'">'+item.name+'</option>');
                    });
                });
            });
        });

    </script>
@endpush
