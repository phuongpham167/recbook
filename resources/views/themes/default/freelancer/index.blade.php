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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <style>
        .freelancer_tab {
            margin-bottom: 0px;
            margin-top: 0;
            background: #e40b00;
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
                    <p class=" text-center">Làm việc tại: {{ auth()->user()->userinfo->company }}</p>
                    <p class=" text-center">Đánh giá: 87/100 điểm</p>
                    @if((\Auth::user() && \Auth::user()->id  ==  auth()->user()->id))
                        <p class=" text-center">Số dư: <strong>{{auth()->user()->credits}}</strong></p>
                        <p class=" text-center">Nhóm tài khoản: <strong>{{auth()->user()->group->name}}</strong></p>
                    @endif
                    <p class="user-desc">{{  auth()->user()->userinfo->description }}</p>
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
                        <li role="presentation" class="active"><a class="freelancer_tab"
                                                                  href="/du-an/tu-van-bat-dong-san">Tư vấn bất động
                                sản</a></li>
                        <li role="presentation"><a class="freelancer_tab" href="/du-an/tu-van-tai-chinh">Tư vấn tài
                                chính</a></li>
                        <li role="presentation"><a class="freelancer_tab" href="/du-an/tu-van-thiet-ke">Tư vấn thiết
                                kế</a></li>
                        <li role="presentation"><a class="freelancer_tab" href="/du-an/tu-van-phong-thuy">Tư vấn phong
                                thủy</a></li>
                        <li role="presentation"><a class="freelancer_tab btn-add" href="#a"><i class="fa fa-plus"
                                                                                               aria-hidden="true"></i>
                                Đăng dự án</a></li>
                    </ul>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-justified">
                        <div class="list_news">
                            @foreach($data as $item)
                                <dl>
                                    <dt class="text-center">
                                        <a href="#a"><img width="110" height="110"
                                                          src="{{\App\User::find($item->user_id)->userinfo->avatar()?\App\User::find($item->user_id)->userinfo->avatar():asset('/images/default-avatar.png')}}"
                                                          alt=""></a>
                                        <p>{{\App\User::find($item->user_id)->userinfo->full_name}}</p>
                                    </dt>
                                    <dd>
                                        <h3><a href="#a">{{$item->title}}</a></h3>
                                        <span class="info">Đánh giá: <i class="fa fa-star" aria-hidden="true"></i><i
                                                class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star"
                                                                                             aria-hidden="true"></i><i
                                                class="fa fa-star-half-o" aria-hidden="true"></i><i class="fa fa-star-o"
                                                                                                    aria-hidden="true"></i></span>
                                        <span
                                            class="info">Ngân sách: {{number_format($item->budget)}} {{\App\Currency::where("default",1)->first()->icon}}</span>
                                        <span
                                            class="info">Khu vực: {{\App\Province::find($item->province_id)->name}}</span>
                                        <span
                                            class="info">Thời hạn: {{\Carbon\Carbon::parse($item->end_at)->format('d/m/Y')}}</span>
                                        <p class="tablet-lg">{{$item->short_description}}...</p>
                                        <button href="#" class="btn btn-success pull-right">Chào giá</button>
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

                        <label class="control-label">{{trans('freelancer.title')}}</label>
                        <input type="text" class="form-control" name="title" id="title"
                               placeholder="{{trans('freelancer.title')}}" value="{{old('title')}}"/>
                        <hr>
                        <label class="control-label">{{trans('freelancer.category')}}</label>
                        <select class="form-control" name="category_id" id="category_id">
                            <option value="">--Chọn danh mục--</option>
                            @foreach(\App\FreelancerCategory::all() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        <hr>
                        <label class="control-label">{{trans('freelancer.end_at')}}</label>

                        <input type="text" class="form-control input-sm datepicker" name="end_at" id="end_at"
                               value="{{request('end_at', \Carbon\Carbon::now()->format('d/m/Y'))}}"
                               placeholder="Từ ngày">
                        <hr>
                        <label class="control-label">{{trans('freelancer.finish_at')}}</label>

                        <input type="text" class="form-control input-sm datepicker" name="finish_at" id="finish_at"
                               value="{{request('finish_at', \Carbon\Carbon::now()->format('d/m/Y'))}}"
                               placeholder="Từ ngày">
                        <hr>
                        <label class="control-label">{{trans('freelancer.budget')}}</label>

                        <input type="number" class="form-control" name="budget" id="budget"
                               placeholder="{{trans('freelancer.budget')}}" value="{{old('budget')}}"/>
                        <hr>
                        <label class="control-label">{{trans('freelancer.note')}}</label>

                        <textarea class="form-control" name="note" rows="3"></textarea>
                        <hr>
                        <label class="control-label">{{trans('freelancer.short_description')}}</label>

                        <textarea class="form-control" name="short_description" rows="3"></textarea>
                        <hr>
                        <label class="control-label">{{trans('freelancer.description')}}</label>

                        <textarea class="form-control" name="description" rows="3"></textarea>

                        <label class="control-label">{{trans('freelancer.re_type_id')}}</label>

                        <select class="form-control" name="re_type_id" id="re_type_id">
                            <option value="">--Chọn danh mục--</option>
                            @foreach(\App\ReType::all() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        <hr>
                        <label class="control-label">{{trans('freelancer.province')}}</label>

                        <select class="js-basic-single" name="province_id" id="province_id" style="width:100%">
                            <option value="">--Chọn Tỉnh--</option>
                            @foreach(\App\Province::all() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        <hr>
                        <label class="control-label">{{trans('freelancer.district')}}</label>

                        <select class="js-basic-single" name="district_id" id="district_id" style="width:100%">
                            <option value="">--Vui lòng chọn Tỉnh--</option>
                        </select>
                        <hr>
                        <label class="control-label">{{trans('freelancer.ward')}}</label>

                        <select class="js-basic-single" name="ward_id" id="ward_id" style="width:100%">
                            <option value="">--Vui lòng chọn Quận/Huyện/TP--</option>
                        </select>
                        <hr>
                        <label class="control-label">{{trans('freelancer.street')}}</label>

                        <select class="js-basic-single" name="street_id" id="street_id" style="width:100%">
                            <option value="">--Vui lòng chọn Đường phố--</option>
                        </select>
                        <hr>
                        <label class="control-label">{{trans('freelancer.address')}}</label>

                        <input type="text" class="form-control" name="address"
                               placeholder="{{trans('freelancer.address')}}" value="{{old('address')}}"/>
                        <hr>
                        <label class="control-label">{{trans('freelancer.construction_type')}}</label>

                        <select class="js-basic-single" name="construction_type_id" id="construction_type_id" style="width:100%">
                            <option value="">--Chọn loại công trình--</option>
                            @foreach(\App\ConstructionType::all() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        <hr>
                        <label class="control-label">{{trans('freelancer.direction')}}</label>

                        <select class="js-basic-single" name="direction_id" id="direction_id" style="width:100%">
                            <option value="">--Chọn hướng--</option>
                            @foreach(\App\Direction::all() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        <hr>
                        <label class="control-label">{{trans('freelancer.width')}} (m)</label>

                        <input type="number" class="form-control" name="width"
                               placeholder="{{trans('freelancer.width')}}" value="{{old('width')}}"/>
                        <hr>
                        <label class="control-label">{{trans('freelancer.length')}} (m)</label>

                        <input type="number" class="form-control" name="length"
                               placeholder="{{trans('freelancer.length')}}" value="{{old('length')}}"/>
                        <hr>
                        <label class="control-label">{{trans('freelancer.areaOfPremises')}} (m<sup>2</sup>)</label>

                        <input type="number" class="form-control" name="area_of_premises"
                               placeholder="{{trans('freelancer.areaOfPremises')}}"
                               value="{{old('area_of_premises')}}"/>
                        <hr>
                        <label class="control-label">{{trans('freelancer.areaOfUse')}} (m<sup>2</sup>)</label>

                        <input type="number" class="form-control" name="area_of_use"
                               placeholder="{{trans('freelancer.areaOfUse')}}" value="{{old('area_of_use')}}"/>
                        <hr>
                        <label class="control-label">{{trans('freelancer.bedroom')}}</label>

                        <input type="number" class="form-control" name="bedroom"
                               placeholder="{{trans('freelancer.bedroom')}}" value="{{old('bedroom')}}"/>
                        <hr>
                        <label class="control-label">{{trans('freelancer.floor')}}</label>

                        <input type="number" class="form-control" name="floor"
                               placeholder="{{trans('freelancer.floor')}}" value="{{old('floor')}}"/>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('system.cancel')}}</button>
                        <button type="submit" class="btn btn-info">{{trans('system.submit')}}</button>
                    </div>
                </div>

            </div>
        </div>
    </form>

    @include(theme(TRUE).'.includes.footer')
@endsection

@push('js')
    <script src="{{asset('plugins/moment-develop/moment.js')}}"></script>
    <script
        src="{{asset('plugins/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.js-basic-single').select2({ width: 'resolve' });

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
    </script>
@endpush
