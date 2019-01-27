@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Danh sách dự án">
@endsection

@section('title')
    Danh sách dự án
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/user-info.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/news.css') }}"/>
    <link rel="stylesheet" href="{{ asset('common-css/left-menu.css') }}"/>
    <link rel="stylesheet" href="{{asset('common-css/magnific-popup.css')}}"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <style>
        .freelancer_tab {
            margin-bottom: 0px;
            margin-top: 0;
            background: #0c4da2;
            color: #fff;
            font-weight: 600;
            font-size: 13px;
            padding: 10px 15px;
            text-transform: uppercase;
        }

        .js-basic-single {
            width: 100%;
        }

        .select2-selection__rendered {
            line-height: 25px !important;
        }
    </style>
@endpush

@section('content')
    @include(theme(TRUE).'.includes.header')

    <div class="container">
        <div class="row subpage">

            <div class="col-xs-3 left">
                <p class="title-short-section">Giới thiệu</p>
                <div class="u-description border-block">
                    @if(auth()->check())
                    <p class=" text-center">Làm việc tại: {{ auth()->user()->userinfo->company?auth()->user()->userinfo->company:'' }}</p>
                    <p class=" text-center">Đánh giá: 87/100 điểm</p>
                    @if((\Auth::user() && \Auth::user()->id  ==  auth()->user()->id))
                        <p class=" text-center">Số dư: <strong>{{auth()->user()->credits}}</strong></p>
                        <p class=" text-center">Nhóm tài khoản: <strong>{{auth()->user()->group->name}}</strong></p>
                    @endif
                    <p class="user-desc">{{  auth()->user()->userinfo->description?auth()->user()->userinfo->description:'' }}</p>
                    @else
                        <p class="alert-title">Thông báo</p>
                        <p>Để chào giá, hãy <a
                                    href="{{route('login')}}">Đăng nhập</a> hoặc <a
                                    href="{{route('register')}}">Đăng ký</a>.</p>
                    @endif
                </div>
                <p class="title-short-section">Tin tức</p>
                <div class="u-description border-block">
                    @foreach(\App\Post::orderBy('created_at', 'desc')->take(3)->get() as $item)
                        <div class="item"><p><i class="fa fa-angle-double-right" aria-hidden="true"></i> <a
                                    href="{{ route('postdetail', ['slugchitiet' => $item->slugchitiet]) }}"
                                    style="color: black">{{$item->title}}</a></p></div>
                        <hr>
                    @endforeach
                </div>
            </div>
            <!--Begin right-->
            <div class="col-xs-9 right">
                @include(theme(TRUE).'.includes.message')
                <div>
                    <ul class="nav nav-tabs">
                        <li role="presentation" @if(url()->current() == asset('du-an/tu-van-bat-dong-san') || url()->current() == asset('du-an')) class="active" @endif><a class="freelancer_tab"
                                                                  href="/du-an/tu-van-bat-dong-san">Tư vấn bất động
                                sản</a></li>
                        <li role="presentation" @if(url()->current() == asset('du-an/tu-van-tai-chinh')) class="active" @endif><a class="freelancer_tab" href="/du-an/tu-van-tai-chinh">Tư vấn tài
                                chính</a></li>
                        <li role="presentation" @if(url()->current() == asset('du-an/tu-van-thiet-ke')) class="active" @endif><a class="freelancer_tab" href="/du-an/tu-van-thiet-ke">Tư vấn thiết
                                kế</a></li>
                        <li role="presentation" @if(url()->current() == asset('du-an/tu-van-phong-thuy')) class="active" @endif><a class="freelancer_tab" href="/du-an/tu-van-phong-thuy">Tư vấn phong
                                thủy</a></li>
                        @if(auth()->check())
                        <li role="presentation" class="pull-right"><a class="btn-add" style="background: #2db964; color: white" href="#a"><i class="fa fa-plus"
                                                                                               aria-hidden="true"></i>
                                Đăng dự án</a></li>
                        @endif
                    </ul>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-justified">
                        <div class="list_news">
                            @foreach($data as $item)
                                <dl>
                                    <dt class="text-center" style="width: 150px; height: 150px">
                                        <img width="100%" height="100%"
                                                          src="{{(\App\User::find($item->user_id)->userinfo->avatar())?(\App\User::find($item->user_id)->userinfo->avatar()):asset('/images/default-avatar.png')}}"
                                                          alt="">
                                        <p style="margin-top: 10px">{{(\App\User::find($item->user_id)->userinfo->full_name)?(\App\User::find($item->user_id)->userinfo->full_name) : ''}}</p>
                                    </dt>
                                    <dd style="margin-left: 180px">
                                        <h3><a style="text-transform: uppercase; color: #0c4da2; font-size: 18px" href="{{route('freelancerDetail', ['id'=>$item->id, 'slug'=>to_slug($item->title)])}}">{{$item->title}}</a></h3>
                                        <span class="info">Đánh giá: <span style="color: gold"><input type="hidden" class="rating" data-readonly value="{{auth()->user()->owner_rate()}}"/></span></span>
                                        <span
                                            class="info">Ngân sách: <span style="font-weight: bold">{{number_format($item->budget)}} {{\App\Currency::where("default",1)->first()->icon}}</span></span>
                                        <span
                                            class="info">Khu vực: <span style="font-weight: bold">{{\App\Province::find($item->province_id)->name}}</span></span>
                                        <span
                                            class="info">Thời hạn: <span style="font-weight: bold">{{\Carbon\Carbon::parse($item->end_at)->format('d/m/Y')}}</span></span>
                                        <p style="font-size: 15px" class="tablet-lg">{{trim_text($item->description,200)}} <a href="{{route('freelancerDetail', ['id'=>$item->id, 'slug'=>to_slug($item->title)])}}" style="color: #0c4da2; font-size: 15px"><em>Xem thêm</em></a></p>
                                        <a href="{{route('freelancerDetail', ['id'=>$item->id, 'slug'=>to_slug($item->title)])}}" class="btn btn-success pull-right">Chào giá</a>
                                    </dd>
                                </dl>
                            @endforeach
                        </div>
                    </ul>
                </div>

            </div>
            <!--End left-->

        </div>
    </div>
    <form method="post" action="{{asset('du-an/tao-moi')}}">
        {{csrf_field()}}
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content modal-lg">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Tạo mới dự án</h4>
                    </div>
                    <div class="modal-body">
                        <div class="panel-body ">
                            @if (!empty(session('message')))
                                <div
                                    class="alert alert-{{session('message.type')}} text-center">
                                    {{session('message.message')}}
                                </div>
                            @endif
                            {{--<textarea class="form-control" placeholder="Bán nhà ..." id="title-hold"></textarea>--}}

                            <div class="form-group clearfix">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control"
                                           name="title" id="title"
                                           value="{{ old('title') }}"
                                           placeholder="Tiêu đề *"/>
                                    <p class="text-red error"></p>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <div class="col-sm-12">
                                    <textarea name="description"
                                              rows="3"
                                              class="form-control autoExpand"
                                              id="description"
                                              placeholder="Mô tả *"></textarea>
                                    <p class="text-red error"></p>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer clearfix">
                            @include(theme(TRUE).'.includes.create-freelancer-collapse')
                            <div class="form-group" style="margin-bottom: 0px;">
                                <div class="col-xs-12">
                                    <button type="button"
                                            class="btn btn-default btn-collapse"
                                            data-target="#catSelect">Danh mục
                                    </button>
                                    <button type="button"
                                            class="btn btn-default btn-collapse"
                                            data-target="#addressSelect"><i
                                            class="fa fa-road"
                                            aria-hidden="true"></i> Khu vực
                                    </button>
                                    <button type="button"
                                            class="btn btn-default btn-collapse"
                                            data-target="#time">Thời gian
                                    </button>
                                    <button type="button"
                                            class="btn btn-default btn-collapse-second"
                                            data-toggle="collapse"
                                            data-target="#list-cl">
                                        <i class="fa fa-circle"></i>
                                        <i class="fa fa-circle"></i>
                                        <i class="fa fa-circle"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="collapse" id="list-cl">
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <button type="button"
                                                class="btn btn-default btn-collapse"
                                                data-target="#construction_type">
                                            Loại công trình
                                        </button>
                                        <button type="button"
                                                class="btn btn-default btn-collapse"
                                                data-target="#directionSelect">
                                            Hướng
                                        </button>
                                        <button type="button"
                                                class="btn btn-default btn-collapse"
                                                data-target="#budget">
                                            Ngân sách
                                        </button>
                                        <button type="button"
                                                class="btn btn-default btn-collapse"
                                                data-target="#note">Ghi chú
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <button type="button"
                                                class="btn btn-default btn-collapse"
                                                data-target="#room"><i
                                                class="fa fa-bed"
                                                aria-hidden="true"></i> Phòng
                                        </button>
                                        <button type="button"
                                                class="btn btn-default btn-collapse"
                                                data-target="#area"><i
                                                class="fa fa-area-chart"
                                                aria-hidden="true"></i> Diện
                                            tích
                                        </button>
                                        <button type="button"
                                                class="btn btn-default btn-collapse"
                                                data-target="#floorSelect">Số
                                            tầng
                                        </button>
                                        <button type="button"
                                                class="btn btn-default btn-collapse"
                                                data-target="#address">Địa chỉ chi tiết
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <button type="button"
                                                class="btn btn-default btn-collapse"
                                                data-target="#measurements"><i class="fa fa-arrows"></i> Số đo
                                        </button>
                                        <button type="button"
                                                class="btn btn-default btn-collapse"
                                                data-target="#short_description">
                                            Mô tả ngắn
                                        </button>
                                    </div>
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

    @include(theme(TRUE).'.includes.footer')

@endsection

@push('js')
    <script type="text/javascript" src="{{asset('/js/bootstrap-rating.js')}}"></script>
    <script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{asset('plugins/moment-develop/moment.js')}}"></script>
    <script
        src="{{asset('plugins/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.js-basic-single').select2({width: 'resolve'});

            $('.datepicker').datetimepicker({format: "DD/MM/YYYY"});

            $('#province_id').change(function () {
                var id = $(this).val();

                // console.log(id);
                $.post('<?php echo asset('search-area'); ?>', {
                    province_id: id,
                    _token: '{{csrf_token()}}'
                }, function (r) {
                    $('#district_id').html('');
                    $("#district_id").append('<option value="">--Chọn Quận/Huyện/TP--</option>');
                    $.each(r, function (i, item) {
                        // console.log(r);
                        $("#district_id").append('<option value="' + item.id + '">' + item.name + '</option>');
                    });
                });
            });
            $('#district_id').change(function () {
                var id = $(this).val();

                $.post('<?php echo asset('search-area'); ?>', {
                    district_id: id,
                    _token: '{{csrf_token()}}'
                }, function (r) {
                    $('#ward_id').html('');
                    $("#ward_id").append('<option value="">--Chọn Phường/Xã--</option>');
                    $.each(r, function (i, item) {
                        $("#ward_id").append('<option value="' + item.id + '">' + item.name + '</option>');
                    });
                });
            });
            $('#ward_id').change(function () {
                var id = $(this).val();

                $.post('<?php echo asset('search-area'); ?>', {ward_id: id, _token: '{{csrf_token()}}'}, function (r) {
                    $('#street_id').html('');
                    $("#street_id").append('<option value="">--Chọn Đường phố--</option>');
                    $.each(r, function (i, item) {
                        $("#street_id").append('<option value="' + item.id + '">' + item.name + '</option>');
                    });
                });
            });
        });
        $('.nav-tabs').on('click', '.btn-add', function () {
            // console.log(check);
            $('#myModal').modal('show');
        });

        function closemd() {
            $('body').find('.modal1-backdrop').remove();
            $('#postReModal').removeClass('in');
            $('#postReModal').attr('style', 'display: none;');
        }

        $(function () {
            $('input.check').on('change', function () {
                alert('Rating: ' + $(this).val());
            });
            $('#programmatically-set').click(function () {
                $('#programmatically-rating').rating('rate', $('#programmatically-value').val());
            });
            $('#programmatically-get').click(function () {
                alert($('#programmatically-rating').rating('rate'));
            });
            $('#programmatically-reset').click(function () {
                $('#programmatically-rating').rating('rate', '');
            });
            $('.rating-tooltip').rating({
                extendSymbol: function (rate) {
                    $(this).tooltip({
                        container: 'body',
                        placement: 'bottom',
                        title: 'Rate ' + rate
                    });
                }
            });
            $('.rating-tooltip-manual').rating({
                extendSymbol: function () {
                    var title;
                    $(this).tooltip({
                        container: 'body',
                        placement: 'bottom',
                        trigger: 'manual',
                        title: function () {
                            return title;
                        }
                    });
                    $(this).on('rating.rateenter', function (e, rate) {
                        title = rate;
                        $(this).tooltip('show');
                    })
                        .on('rating.rateleave', function () {
                            $(this).tooltip('hide');
                        });
                }
            });
            $('.rating').each(function () {
                $('<span class="label label-default"></span>')
                    .text($(this).val() || ' ')
                    .insertAfter(this);
            });
            $('.rating').on('change', function () {
                $(this).next('.label').text($(this).val());
            });
        });
    </script>
@endpush
