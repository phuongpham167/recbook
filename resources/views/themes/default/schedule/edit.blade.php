@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Customer Page" >
@endsection

@section('title')
    Danh sách lịch hẹn
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <link rel="stylesheet" href="{{asset('plugins/loopj-jquery-tokeninput/styles/token-input.css')}}" />
    <link rel="stylesheet" href="{{asset('plugins/loopj-jquery-tokeninput/styles/token-input-bootstrap3.css')}}" />
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
                    <p class="title_boxM"><strong><i class="fa fa-file-pdf-o"></i>Thêm mới lịch hẹn</strong> <a href="{{route('scheduleList')}}" class="btn btn-xs btn-primary pull-right"><i class="fa fa-chevron-left"></i> Quay lại</a></p>
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
                                                        <input type="text" class="form-control" name="customer_id" id="customer_id"
                                                               placeholder="{{trans('customer.name')}}"
                                                               value="{{old('customer_id', $data->customer_id)}}"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Thời gian</label>

                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control datepicker"
                                                               name="time" value="{{old("time", \Carbon\Carbon::parse($data->time)->format('d/m/Y'))}}"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Nội dung</label>
                                                    <div class="col-sm-10">
                                                        <textarea name="content" class="form-control" rows="4">{{$data->content}}</textarea>
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
    <link rel="stylesheet" href="{{asset('plugins/jquery.tokenInput/token-input.css')}}" />

    <style type="text/css">
        li.token-input-token {
            max-width: 100% !important;
        }

        ul.token-input-list {
            width: 100% !important;
        }
    </style>
    <link rel="stylesheet" href="{{asset('plugins/jquery.datatables/css/jquery.dataTables.min.css')}}" />
    @include(theme(TRUE).'.includes.footer')
@endsection

@push('js')
    <script src="{{asset('plugins/moment-develop/moment.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('plugins/jquery.datatables/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/loopj-jquery-tokeninput/src/jquery.tokeninput.js')}}"></script>
    <script src="{{asset('plugins/bootbox.min.js')}}"></script>
    <script>
        $(function() {
            $('.datepicker').datetimepicker({format: 'YYYY-MM-DD'});

            $('#customer_id').tokenInput("{{asset('ajax/customer')}}", {
                queryParam: "term",
                zindex  :   1005,
                preventDuplicates   :   true,
                tokenLimit: 1,
                @if(!empty($data->customer_id))
                prePopulate: [
                    {id: "{{$data->customer_id}}", name: "{{\App\Customer::find($data->customer_id)->name}}"}
                ]
                @endif
            });
        });

    </script>
@endpush
