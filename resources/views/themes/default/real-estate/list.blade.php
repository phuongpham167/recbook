@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Register Page" >
@endsection

@section('title')
    {{trans('real-estate.list.pageTitle')}}
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
    @include(theme(TRUE).'.includes.user-info-header-1')

    <div class="container-vina">
        <div class="row subpage">

            <div class="col-xs-3 left">
                @include(theme(TRUE).'.includes.left-menu')
            </div>

            <!--Begin left-->
            <div class="col-xs-9 right">
                <div>
                    <ul class="nav nav-tabs">
                        <li role="presentation" @if(url()->current() == asset('bat-dong-san/')) class="active" @endif><a class="freelancer_tab" href="/bat-dong-san/">Danh sách tin đăng <span>({{\App\RealEstate::where('approved', 1)->where('draft','0')->where('expire_date','>=',\Carbon\Carbon::createFromFormat('m/d/Y H:i A', \Carbon\Carbon::now()->format('m/d/Y H:i A')))->where('posted_by', \Auth::user()->id)->count()}})</span></a></li>
                        <li role="presentation" @if(url()->current() == asset('bat-dong-san/tin-rao-het-han')) class="active" @endif><a class="freelancer_tab" href="/bat-dong-san/tin-rao-het-han">Tin rao hết hạn <span>({{\App\RealEstate::where('expire_date','<',\Carbon\Carbon::createFromFormat('m/d/Y H:i A', \Carbon\Carbon::now()->format('m/d/Y H:i A')))->where('posted_by', \Auth::user()->id)->count()}})</span></a></li>
                        <li role="presentation" @if(url()->current() == asset('bat-dong-san/tin-rao-cho-duyet')) class="active" @endif><a class="freelancer_tab" href="/bat-dong-san/tin-rao-cho-duyet">Tin rao chờ duyệt <span>({{\App\RealEstate::where('approved','0')->where('draft', 0)->where('expire_date','>=',\Carbon\Carbon::createFromFormat('m/d/Y H:i A', \Carbon\Carbon::now()->format('m/d/Y H:i A')))->where('posted_by', \Auth::user()->id)->count()}})</span></a></li>
                        <li role="presentation" @if(url()->current() == asset('bat-dong-san/tin-rao-nhap')) class="active" @endif><a class="freelancer_tab" href="/bat-dong-san/tin-rao-nhap">Tin rao nháp <span>({{\App\RealEstate::where('draft','1')->where('expire_date','>=',\Carbon\Carbon::createFromFormat('m/d/Y H:i A', \Carbon\Carbon::now()->format('m/d/Y H:i A')))->where('posted_by', \Auth::user()->id)->count()}})</span></a></li>
                        <li role="presentation" @if(url()->current() == asset('bat-dong-san/tin-rao-da-xoa')) class="active" @endif><a class="freelancer_tab" href="/bat-dong-san/tin-rao-da-xoa">Tin rao đã xóa <span>({{\App\RealEstate::onlyTrashed()->where('posted_by', \Auth::user()->id)->count()}})</span></a></li>
                    </ul>
                </div>
                @include('themes.default.includes.message')
                <!--begin manage_page-->
                <div class="listlandA_page">
                    <p class="title_boxM"><strong><i class="fa fa-file-pdf-o"></i>{{trans('real-estate.manage')}}</strong></p>
                    <div>
                        <div class="_form search_listlandA_page">
                            <form id="yw0" method="get">
                                <div class="row">

                                    <div class="col-xs-4">
                                        <dl>
                                            <dt>{{trans('page.datefrom')}}</dt>
                                            <dd>
                                                <input type="text" class="form-control input-sm datepicker" name="datefrom" id="datefrom" value="{{request('datefrom')}}">
                                            </dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-4">
                                        <dl>
                                            <dt>{{trans('page.dateto')}}</dt>
                                            <dd>
                                                <input type="text" class="form-control input-sm datepicker" name="dateto" id="dateto" value="{{request('dateto')}}">
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
                                                        <option value="{{$item->id}}" @if(request('re_category_id')==$item->id) selected @endif>{{$item->name}}</option>
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
                                                            <option value="{{$item->id}}"  @if(request('re_type_id')==$item->id) selected @endif>{{$item->name}}</option>
                                                        @endforeach
                                                </select>
                                            </dd>
                                        </dl>
                                    </div>

                                    {{--<div class="col-xs-4">--}}
                                        {{--<dl>--}}
                                            {{--<dt>{{trans('real-estate.formCreateLabel.district')}}</dt>--}}
                                            {{--<dd>--}}
                                                {{--<select name="district_id" id="district_id">--}}
                                                    {{--<option value="">{{trans('real-estate.all')}}</option>--}}
                                                    {{--@foreach(\App\District::all() as $item)--}}
                                                        {{--<option value="{{$item->id}}" >{{$item->name}}</option>--}}
                                                    {{--@endforeach--}}
                                                {{--</select>--}}
                                            {{--</dd>--}}
                                        {{--</dl>--}}
                                    {{--</div>--}}

                                    <div class="col-xs-4">
                                        <dl>
                                            <dt>{{trans('real-estate.post_type')}}</dt>
                                            <dd>
                                                <select name="post_type" id="post_type">
                                                    <option value="">Tất cả</option>
                                                    <option value="3"   @if(request('post_type')==3) selected @endif>Tin cần bán gấp</option>
                                                    <option value="2" @if(request('post_type')==2) selected @endif>Tin giá hấp dẫn</option>
                                                    <option value="1" @if(request('post_type')==1) selected @endif>Tin rao cộng đồng miễn phí</option>
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
                                        <th>{{trans('real-estate.list.column.code')}}</th>
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
    <form method="post" action="{{asset('bat-dong-san/gia-han')}}">
        {{csrf_field()}}
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content modal-lg">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Gia hạn tin đăng</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id-re" name="id">
                        <label class="control-label">Số ngày gia hạn thêm</label>
                        <select class="form-control" name="days">
                            <option value="">--Chọn số ngày gia hạn thêm--</option>
                            <option value="7">7 ngày</option>
                            <option value="30">30 ngày</option>
                            <option value="90">90 ngày</option>
                        </select>
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
    <form method="post" action="{{asset('bat-dong-san/sethotvip')}}">
        {{csrf_field()}}
        <div id="myModal2" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content modal-lg">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Nâng cấp hot/vip</h4>
                    </div>
                    <div class="modal-body">
                        <input type='hidden' name='id' id="id-re2" value="">
                        <label class="control-label">Chọn loại vip/hot</label>
                        <select class="form-control" name='vip_type' id='vip_type'>
                            @foreach(vip_type() as $k=>$item)
                            <option value='{{$k}}'>{{$item}}</option>
                            @endforeach
                        </select>
                        <label class="control-label">Chọn số ngày gia hạn</label>
                        <select class="form-control" name='vip_time' id='vip_time'>
                            <option value='1'>1 ngày</option>
                            <option value='7'>7 ngày</option>
                            <option value='30'>30 ngày</option>
                            <option value='90'>90 ngày</option>
                        </select>
                        <table class="table table-bordered" id="datatable-price">
                            <thead>
                            <tr>
                                <th>Giá tin vip</th>
                                <th>Giá tin vip nổi bật</th>
                                <th>Giá tin hot</th>
                                <th>Giá tin hot nổi bật</th>
                                <th>Giá tin hấp dẫn</th>
                                <th>Giá tin vip bên phải</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="submit"
                                class="_btn bg_red pull-right"><i
                                class="fa fa-plus"></i> &nbsp;&nbsp;NÂNG CẤP
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
                        d.dateto    =   $('#dateto').val();
                        d.re_category_id = $('#re_category_id').val();
                        d.re_type_id = $('#re_type_id').val();
                        d.district_id = $('#district_id').val();
                        d.post_type = $('#post_type').val();
                    }
                },
                columns: [
                    { data: 'code', name: 'code' },
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

            $('.table').on('click', '.btn-renewed', function(){
                var id      =   $(this).attr('id');

                $('#id-re').val(id);
                $('#myModal').modal('show');
            });
            $('.table').on('click', '.btn-hotvip', function(){
                var id      =   $(this).attr('id');
                var hot      =   $(this).attr('hot');
                var hot_hl      =   $(this).attr('hot_hl');
                var vip      =   $(this).attr('vip');
                var vip_hl      =   $(this).attr('vip_hl');
                var i_value      =   $(this).attr('i_value');
                var vip_right      =   $(this).attr('vip_right');

                $('#id-re2').val(id);
                $('.price').remove();
                $('#datatable-price').append('<tr class="price">\n' +
                    '                                <td>'+hot+'</td>\n' +
                    '                                <td>'+hot_hl+'</td>\n' +
                    '                                <td>'+vip+'</td>\n' +
                    '                                <td>'+vip_hl+'</td>\n' +
                    '                                <td>'+i_value+'</td>\n' +
                    '                                <td>'+vip_right+'</td>\n' +
                    '                            </tr>');
                $('#myModal2').modal('show');
            });
        });

    </script>
@endpush
