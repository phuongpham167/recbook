@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Create Customer Group Page" >
@endsection

@section('title')
    Tạo nhóm khách hàng mới
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
                    <p class="title_boxM"><strong><i class="fa fa-file-pdf-o"></i>Thêm mới nhóm khách hàng</strong> <a href="{{route('customerListGroup')}}" class="btn btn-xs btn-primary pull-right"><i class="fa fa-chevron-left"></i> Quay lại</a></p>
                    <div>
                        <div class="box-body">
                            <form class="form-horizontal" method="post">
                                {{csrf_field()}}

                                <div class="col-md-12">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">{{trans('customer.name')}}</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="name"
                                                       placeholder="{{trans('customer.nameGroup')}}"
                                                       value="{{old('name')}}"/>
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

    </script>
@endpush
