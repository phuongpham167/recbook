@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Register Page" >
@endsection

@section('title')
    {{trans('real-estate.list.pageTitle')}}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />

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
                    <p class="title_boxM"><strong><i class="fa fa-file-pdf-o"></i>{{trans('real-estate.manage')}}</strong></p>
                    <div>

                        <div class="_form search_listlandA_page">
                            <form enctype="multipart/form-data" id="yw0" method="post">
                                <div class="row">

                                    <div class="col-xs-4">
                                        <dl>
                                            <dt>{{trans('page.datefrom')}}</dt>
                                            <dd>
                                                <input type="text" class="form-control input-sm datepicker" name="datefrom" id="datefrom" value="{{request('datefrom', \Carbon\Carbon::now()->startOfMonth()->format('d/m/Y'))}}">
                                            </dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-4">
                                        <dl>
                                            <dt>{{trans('page.dateto')}}</dt>
                                            <dd>
                                                <input type="text" class="form-control input-sm datepicker" name="dateto" id="dateto" value="{{request('dateto', \Carbon\Carbon::now()->format('d/m/Y'))}}">
                                            </dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-4">
                                        <dl>
                                            <dt>{{trans('real-estate.formCreateLabel.reCategory')}}</dt>
                                            <dd>
                                                <select name="re_category_id" id="re_category_id">
                                                    <option value="">{{trans('real-estate.all')}}</option>
                                                    @foreach(\App\ReCategory::all() as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-4">
                                        <dl>
                                            <dt>{{trans('real-estate.formCreateLabel.reType')}}</dt>
                                            <dd>
                                                <select name="re_type_id" id="re_type_id">
                                                    <option value="">{{trans('real-estate.all')}}</option>
                                                        @foreach(\App\ReType::all() as $item)
                                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach
                                                </select>
                                            </dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-4">
                                        <dl>
                                            <dt>{{trans('real-estate.formCreateLabel.district')}}</dt>
                                            <dd>
                                                <select name="district_id" id="district_id">
                                                    <option value="">{{trans('real-estate.all')}}</option>
                                                    @foreach(\App\District::all() as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-4">
                                        <dl>
                                            <dt>{{trans('real-estate.post_type')}}</dt>
                                            <dd>
                                                <select name="post_type" id="post_type">
                                                    <option value="">Tất cả</option>
                                                    <option value="3">Tin cần bán gấp</option>
                                                    <option value="2">Tin giá hấp dẫn</option>
                                                    <option value="1">Tin rao cộng đồng miễn phí</option>
                                                </select></dd>
                                        </dl>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-8">
                                        <dl>
                                            <dd class="list_checkbox">
                                                &nbsp;
                                            </dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-4" style="text-align: right;">
                                        <button type="submit" class="_btn bg_red" style="padding: 6px 15px;"><i class="fa fa-search fa-fw"></i>{{trans('page.search')}}</button>
                                    </div>
                                </div>

                            </form>
                        </div>

                        <div class="box-body">
                            <div class="table-responsive">
                            <table class="table table-bordered" id="datatable">
                                <thead>
                                    <tr>
                                        <th>{{trans('real-estate.list.column.title')}}</th>
                                        <th>{{trans('real-estate.list.column.category')}}</th>
                                        <th>{{trans('real-estate.list.column.type')}}</th>
                                        <th>{{trans('real-estate.list.column.district')}}</th>
                                        <th>{{trans('real-estate.list.column.post_date')}}</th>
                                        <th>{{trans('real-estate.list.column.manage')}}</th>
                                    </tr>
                                </thead>
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
            $('.datepicker').datetimepicker({format: 'DD/MM/YYYY'});

            $(document).on('click', '.btn-save-menu', function(e){
                var data = window.JSON.stringify(nestable.nestable('serialize'));
                var name = $('.form-group #menu-name').val();
                console.log(data);
                $.get('<?php echo asset('config/menu/data?id='.request('id')); ?>', {data: data, name, _token: '{{csrf_token()}}'}, function(r){
                    window.location.reload();
                });
            });

            datatable = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    'url': urlDatatable ='{!! route('realEstateData') !!}?filter={{$filter}}',
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
                    { data: 'title', name: 'title' },
                    { data: 're_category_id', name: 're_category_id' },
                    { data: 're_type_id', name: 're_type_id' },
                    { data: 'district_id', name: 'district_id' },
                    { data: 'post_date', name: 'post_date' },
                    { data: 'manage', name: 'manage'  , sortable:false, searchable: false}
                ]
            });
            datatable.on( 'draw', function () {
                $('[data-toggle="popover"]').popover({
                    html: true
                });
            } );
        });

    </script>
@endpush
