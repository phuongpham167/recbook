@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Home page" >
@endsection

@section('title')
    Dothigroup
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('common-css/flexslider.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/home-1.css') }}"/>
    <style>
        .btn:focus, .btn:active, button:focus, button:active {
            outline: none !important;
            box-shadow: none !important;
        }

        #image-gallery .modal-footer{
            display: block;
        }

        .thumb{
            margin-top: 15px;
            margin-bottom: 15px;
        }
        iframe  {
            max-width: 100%;
        }
    </style>
@endpush

@section('content')

    @include(theme(TRUE).'.includes.header-1')
    <div class="content-body">
        <section class="slider container" style="margin-top: 20px">
            <div class="col-md-4"  style="
    background: #000;
    height: 274px;
">
                @foreach(ads_display(1) as $item)
                    {!! $item->content !!}
                @endforeach
            </div>
            <div class="col-md-8 no-padding-left no-padding-right">
                <div class="flexslider">
                    <ul class="slides">
                        @foreach(\App\Banner::where('location', 0)->get() as $item)
                            <li>
                                <a href="{{$item->url?$item->url:'#a'}}"><img src="http://{{env('DOMAIN_BACKEND','recbook.net')}}{{$item->image}}" height="300" /></a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </section>

        {{--<div class="smart-search hidden-xs">--}}
            {{--<div class="container search-wrap">--}}
                {{--<div class="search-content search_slide">--}}
                    {{--<ul>--}}
                        {{--@foreach($categories as $key => $category)--}}
                            {{--<li @if($key == 0) class="active" @endif>--}}
                                {{--<a href="{{ $category->id }}">{{$category->name}}</a><span></span>--}}
                            {{--</li>--}}
                        {{--@endforeach--}}
                        {{--<li class="active">--}}
                        {{--<a href="#">Cần bán</a><span></span>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                        {{--<a href="#">Cho thuê</a><span></span>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                        {{--<a href="#">Cần mua</a><span></span>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                        {{--<a href="#">Cần thuê</a><span></span>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<form action="{{route('search')}}" method="GET">--}}
                                {{--<input placeholder="{{trans('system.searchPlaceholder')}}" autocomplete="off" type="text" value="" name="txtkeyword" id="txtkeyword">--}}
                                {{--<button type="submit"><i class="fa fa-search"></i></button>--}}
                            {{--</form>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                    {{--<div class="clearfix"></div>--}}
                    {{--<form action="{{route('smart-search')}}" method="GET">--}}
                        {{--@php--}}
                            {{--if($categories) {--}}
                                {{--$firstCat = $categories[0];--}}
                            {{--}--}}
                        {{--@endphp--}}
                        {{--<input name="Search[cat_id]" id="Search_kind_id" type="hidden" value="{{ $firstCat ? $firstCat->id : 1 }}">--}}
                        {{--<div class="row search-select-wrap">--}}
                            {{--<div class="col-xs-2 item">--}}
                                {{--<select id="re-type" name="Search[type_id]">--}}
                                    {{--@foreach($reTypes as $reType)--}}
                                        {{--<option value="{{$reType->id}}">{{$reType->name}}</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="col-xs-2 item">--}}
                                {{--<input value="1" name="Search[province_id]" id="Search_province_id" type="hidden">--}}
                                {{--<select name="Search[district_id]" id="Search_district_id">--}}
                                    {{--@foreach($districts as $district)--}}
                                        {{--<option value="{{$district->id}}">{{$district->name}}</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="col-xs-2 item">--}}
                                {{--<select name="Search[street_id]" id="Search_street_id">--}}
                                    {{--@foreach($streets as $street)--}}
                                        {{--<option value="{{$street->id}}">{{$street->name}}</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="col-xs-2 item">--}}
                                {{--<select name="Search[direction_id]" id="Search_direction_id">--}}
                                    {{--@foreach($directions as $direction)--}}
                                        {{--<option value="{{$direction->id}}">{{$direction->name}}</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="col-xs-2 item">--}}
                                {{--<select id="range-price" name="Search[range_price_id]">--}}
                                    {{--@foreach($rangePrices as $rangePrice)--}}
                                        {{--<option value="{{$rangePrice->id}}">{{$rangePrice->name}}</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="col-xs-2 item">--}}
                                {{--<button type="submit"><i class="fa fa-search"></i> tìm kiếm</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{-- end smart search --}}
        <section class="hot-real-estate">
            <div class="container ">
                <div class="row title-hot-wrap">
                    <div class="col-xs-12 title-hot-real-estate">
                        <a href="{{ route('tin-noi-bat') }}" class="active">BẤT ĐỘNG SẢN NỔI BẬT <span></span></a>
                        <a href="{{route('newest-real-estate')}}">TIN MỚI NHẤT <span></span></a>
                        <a href="{{route('free-real-estate')}}">TIN RAO VẶT CỘNG ĐỒNG MIỄN PHÍ <span></span></a>
                    </div>
                </div>
                <div class="row list-re-item list-hot">
                    @foreach($hotRealEstates as $item)
                        <div class="col-xs-12 col-sm-6 col-md-3 item">
                            <div class="col-xs-12 re-item hot">
                                <a href="{{ route('detail-real-estate', ['slug' => $item->slug . '-' . $item->id]) }}">
                                    @php
                                        $images = $item->images ? json_decode($item->images) : [];
                                        $imgThumbnail = $images ? $images[0]->link : '/images/default_real_estate_image.jpg';
                                        $imgAlt = $images ? $images[0]->alt : $item->title;
                                    @endphp
                                    <img src="{{asset($imgThumbnail)}}" alt="{{ $imgAlt }}">
                                </a>
                                <div class="icon_viphot">
                                    <img src="{{ asset('images/vip1.gif') }}" alt="Bán nhà số 23/11 Hàng Kênh, Lê Chân, Hải Phòng">
                                </div>

                                <div class="code_row">{{ $item->code }}</div>

                                <h3>
                                    <a href="{{ route('detail-real-estate', ['slug' => $item->slug . '-' . $item->id]) }}">{{ $item->title }}</a>
                                </h3>

                                <p>{{ $item->short_description }}
                                </p>
                                <div class="row area">
                                    <div class="col-xs-6 larea">DTMB: {{$item->area_of_premises ? $item->area_of_premises . 'm2' : '0m2'}}</div>
                                    <div class="col-xs-6 rarea">DTSD: {{$item->area_of_use ? $item->area_of_use . 'm2' : '0m2'}}</div>
                                </div>
                                <div class="row price">
                                    <div class="col-xs-12 lprice">
                                        <i class="fa fa-map-marker"></i> {{$item->district->name}}
                                    </div>
                                    <div class="col-xs-12 rprice">
                                        {{convert_number_to_words($item->price)}} {{$item->unit ? $item->unit->name : 'VND'}}{{$item->don_vi ? '/'.$item->don_vi : ''}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="addition_info">
            <div class="container">
                <div class="row  three_cols">
                    <div class="col-xs-12 col-sm-12 three_i brokers">

                        <p class="title_col">
                            <a href="#"><i class="fa fa-users"></i> NHÀ MÔI GIỚI</a>
                        </p>
                        <div class="content col-xs-12 no-padding-left no-padding-right broker_slider">
                            @foreach($agencies as $agency)
                                <div class="col-xs-4 broker-item">
                                    <div class="col-md-3" style="padding: 0">
                                        <a href="{{asset('user/'.$agency->id)}}">
                                            <img class="img-responsive b_img" src="{{$agency->avatar()}}" alt="">
                                        </a>
                                    </div>
                                    <div class="col-md-9">
                                        <b class="name"><a href="{{asset('user/'.$agency->id)}}">{{$agency->userinfo?$agency->userinfo->full_name:$agency->name}}</a></b>
                                        <p class="phone">{{$agency->userinfo?$agency->userinfo->phone:$agency->phone}}</p>
                                        <p class="des">{{$agency->userinfo?$agency->userinfo->description:''}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="good_price">
            <div class="container">
                <div class="row two_cols">
                    <div class="col-xs-12 col-md-9 col_left no-padding-left">
                        <div class="left_box">
                            <div class="row" style="margin-right: 0; margin-left: 0">
                                <p class="title_box">
                                    <strong>TIN GIÁ HẤP DẪN</strong>

                                </p> <form action="{{route('search')}}" method="GET">
                                    <input placeholder="{{trans('system.searchPlaceholder')}}" autocomplete="off" type="text" value="" name="txtkeyword" id="txtkeyword">
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </form>
                            </div>

                            <div>
                                <div class="cat_top_box">
                                    @foreach($categories as $category)
                                        <a href="{{'/danh-muc-bds/' . $category->slug . '-c' . $category->id}}">{{$category->name}}</a>
                                    @endforeach
                                    <a href="{{route('tin-vip')}}">Tin VIP</a>

                                </div>
                                <div class="row body_top_box">
                                    @foreach($goodPriceRealEstateVip as $item)
                                        <div class="col-xs-12 col-sm-6 col-md-6  good_price_item_wrap">
                                            <div class="col-xs-12  re_item2 good_price_item">
                                                @php
                                                    $itemClass = '';
                                                    if($item->is_hot) {
                                                        $itemClass = '_vip_hot';
                                                    }
                                                    if($item->is_vip && !$item->is_hot) {
                                                        $itemClass = '_vip';
                                                    }

                                                    $images = $item->images ? json_decode($item->images) : [];
                                                    $imgThumbnail = $images ? $images[0]->link : '/images/default_real_estate_image.jpg';
                                                    $imgAlt = $images ? $images[0]->alt : $item->title;
                                                @endphp
                                                <div class="row {{$itemClass}}">
                                                    <div class="col-xs-5 lgp_item">
                                                        <a href="{{ route('detail-real-estate', ['slug' => $item->slug . '-' . $item->id]) }}">
                                                            <img src="{{ asset($imgThumbnail) }}" alt="{{ $imgAlt }}">
                                                        </a>
                                                        <div class="code_row">{{$item->code}}</div>
                                                    </div>

                                                    <div class="col-xs-7 rgp_item">
                                                        <h3>
                                                            <a href="{{ route('detail-real-estate', ['slug' => $item->slug . '-' . $item->id]) }}">{{ $item->title }}
                                                            </a>
                                                            <span></span>
                                                        </h3>
                                                        <div>{{ $item->short_description }}
                                                        </div>
                                                        <p>
                                                            <strong>DTMB:</strong> {{$item->area_of_premises ? $item->area_of_premises . 'm2' : '0m2'}} - <strong>Giá:</strong>
                                                            <span>
                                                                {{convert_number_to_words($item->price)}} {{$item->unit ? $item->unit->name : 'VND'}}{{$item->don_vi ? '/'.$item->don_vi : ''}}
                                                            </span>
                                                        </p>
                                                    </div>
                                                </div>
                                                @if($item->is_vip)
                                                    <div class="icon_viphot">
                                                        <img src="{{ asset('images/vip2.gif') }}" alt="">
                                                    </div>
                                                @endif
                                            </div>

                                        </div>
                                    @endforeach
                                    @foreach($goodPriceRealEstateHot as $item)
                                        <div class="col-xs-12 col-sm-6 col-md-6  good_price_item_wrap">
                                            <div class="col-xs-12  re_item2 good_price_item">
                                                @php
                                                    $itemClass = '';
                                                    if($item->is_hot) {
                                                        $itemClass = '_vip_hot';
                                                    }
                                                    if($item->is_vip && !$item->is_hot) {
                                                        $itemClass = '_vip';
                                                    }

                                                    $images = $item->images ? json_decode($item->images) : [];
                                                    $imgThumbnail = $images ? $images[0]->link : '/images/default_real_estate_image.jpg';
                                                    $imgAlt = $images ? $images[0]->alt : $item->title;
                                                @endphp
                                                <div class="row {{$itemClass}}">
                                                    <div class="col-xs-5 lgp_item">
                                                        <a href="{{ route('detail-real-estate', ['slug' => $item->slug . '-' . $item->id]) }}">
                                                            <img src="{{ asset($imgThumbnail) }}" alt="{{ $imgAlt }}">
                                                        </a>
                                                        <div class="code_row">{{$item->code}}</div>
                                                    </div>

                                                    <div class="col-xs-7 rgp_item">
                                                        <h3>
                                                            <a href="{{ route('detail-real-estate', ['slug' => $item->slug . '-' . $item->id]) }}">{{ $item->title }}
                                                            </a>
                                                            <span></span>
                                                        </h3>
                                                        <div>{{ $item->short_description }}
                                                        </div>
                                                        <p>
                                                            <strong>DTMB:</strong> {{$item->area_of_premises ? $item->area_of_premises . 'm2' : '0m2'}} - <strong>Giá:</strong>
                                                            <span>
                                                            {{convert_number_to_words($item->price)}} {{$item->unit ? $item->unit->name : 'VND'}}{{$item->don_vi ? '/'.$item->don_vi : ''}}
                                                        </span>
                                                        </p>
                                                    </div>
                                                </div>
                                                @if($item->is_vip)
                                                    <div class="icon_viphot">
                                                        <img src="{{ asset('images/vip2.gif') }}" alt="Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng">
                                                    </div>
                                                @endif
                                            </div>

                                        </div>
                                    @endforeach
                                    @foreach($goodPriceRealEstateNormal as $item)
                                        <div class="col-xs-12 col-sm-6 col-md-6  good_price_item_wrap">
                                            <div class="col-xs-12  re_item2 good_price_item">
                                                @php
                                                    $itemClass = '';
                                                    if($item->is_hot) {
                                                        $itemClass = '_vip_hot';
                                                    }
                                                    if($item->is_vip && !$item->is_hot) {
                                                        $itemClass = '_vip';
                                                    }

                                                    $images = $item->images ? json_decode($item->images) : [];
                                                    $imgThumbnail = $images ? $images[0]->link : '/images/default_real_estate_image.jpg';
                                                    $imgAlt = $images ? $images[0]->alt : $item->title;
                                                @endphp
                                                <div class="row {{$itemClass}}">
                                                    <div class="col-xs-5 lgp_item">
                                                        <a href="{{ route('detail-real-estate', ['slug' => $item->slug . '-' . $item->id]) }}">
                                                            <img src="{{ asset($imgThumbnail) }}" alt="{{ $imgAlt }}">
                                                        </a>
                                                        <div class="code_row">{{$item->code}}</div>
                                                    </div>

                                                    <div class="col-xs-7 rgp_item">
                                                        <h3>
                                                            <a href="{{ route('detail-real-estate', ['slug' => $item->slug . '-' . $item->id]) }}">{{ $item->title }}
                                                            </a>
                                                            <span></span>
                                                        </h3>
                                                        <div>{{ $item->short_description }}
                                                        </div>
                                                        <p>
                                                            <strong>DTMB:</strong> {{$item->area_of_premises ? $item->area_of_premises . 'm2' : '0m2'}} - <strong>Giá:</strong>
                                                            <span>
                                                            {{convert_number_to_words($item->price)}} {{$item->unit ? $item->unit->name : 'VND'}}{{$item->don_vi ? '/'.$item->don_vi : ''}}
                                                        </span>
                                                        </p>
                                                    </div>
                                                </div>
                                                @if($item->is_vip)
                                                    <div class="icon_viphot">
                                                        <img src="{{ asset('images/vip2.gif') }}" alt="Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng">
                                                    </div>
                                                @endif
                                            </div>

                                        </div>
                                    @endforeach
                                    <div class="col-xs-12" style="border-bottom: 0; margin-bottom: 0; padding-bottom: 0; margin-top: 15px;">
                                        @php
                                            $cat = $categories[0];
                                        @endphp
                                        <p class="more"><a href="{{'/danh-muc-bds/' . $cat->slug . '-c' . $cat->id}}"><i class="fa fa-angle-double-right"></i> Xem thêm</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-3 col_right no-padding-right">
                    @include(theme(TRUE).'.includes.vip-slide')
                        <div class="adv_box">
                            @foreach(\App\Banner::where('location', 4)->where('province_id', 0)->get() as $item)
                                @if($item->type==1)
                                    <a href="{{$item->url}}" style="margin-bottom: 5px"><img src="http://{{env('DOMAIN_BACKEND', 'recbook.net')}}/{{$item->image}}" alt="{{$item->note}}"></a>
                                @else
                                    {!! $item->content !!}
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container adv_box adv_home_hot">
            @foreach(\App\Banner::where('location', 5)->where('province_id', 0)->get() as $item)
            <a class="" href="{{$item->url}}">
                <img src="http://{{env('DOMAIN_BACKEND', 'recbook.net')}}/{{$item->image}}" alt="{{$item->note}}">
            </a>
            @endforeach
        </div>
        <section class="free_price" style="    margin-top: 20px;">
            <div class="container">
                <div class="row margin-0">
                    <div class="">
                        <div class="free_price_box">
                            <p class="title_box1">
                                <strong>{{ trans('home.free_real_estate') }}</strong>
                            </p>
                            <div >
                                <div class="row body_top_box">
                                    @foreach($freeRealEstates as $item)
                                        <div class="col-xs-12 col-sm-4  free_price_item_wrap">
                                            <div class="col-xs-12 re_item2 free_price_item">
                                                <div class="row">
                                                    @php
                                                        $images = $item->images ? json_decode($item->images) : [];
                                                        $imgThumbnail = $images ? $images[0]->link : '/images/default_real_estate_image.jpg';
                                                        $imgAlt = $images ? $images[0]->alt : $item->title;
                                                    @endphp
                                                    <div class="col-xs-5 lgp_item">
                                                        <a href="{{ route('detail-real-estate', ['slug' => $item->slug . '-' . $item->id]) }}">
                                                            <img src="{{ asset($imgThumbnail) }}" alt="{{ $imgAlt }}">
                                                        </a>
                                                        <div class="code_row">{{$item->code}}</div>
                                                    </div>

                                                    <div class="col-xs-7 rgp_item">
                                                        <h3><a href="{{ route('detail-real-estate', ['slug' => $item->slug . '-' . $item->id]) }}">{{ $item->title }}</a>
                                                            <span></span>
                                                        </h3>
                                                        <div>{{$item->short_description ? $item->short_description : ''}}
                                                        </div>
                                                        <p>
                                                            <strong>DTMB:</strong> {{$item->area_of_premises ? $item->area_of_premises . 'm2' : '0m2'}} - <strong>Giá:</strong>
                                                            <span>
                                                            {{convert_number_to_words($item->price)}} {{$item->unit ? $item->unit->name : 'VND'}}{{$item->don_vi ? '/'.$item->don_vi : ''}}
                                                        </span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container" style="margin-top: 20px">
            <div class="row  three_cols">
                <div class="col-xs-12 col-sm-12 three_i brokers">
                    <div class="content col-xs-12 no-padding-left no-padding-right broker_slider">
                        <div class="col-md-4">
                            <p class="title_box">
                                <strong>Tin tức</strong>
                            </p>
                                @foreach(\App\Post::orderBy('created_at', 'desc')->take(3)->get() as $item)
                                    <dl>
                                        <div class="row">
                                            <dt class="col-md-4"><a href="{{ route('postdetail', ['slugchitiet' => $item->slugchitiet]) }}"><img width="100px" height="100px" src="/images/default_thumb.jpg" alt="DỰ ÁN LÀNG VIỆT KIỀU QUỐC TẾ HẢI PHÒNG"></a></dt>
                                            <dd class="col-md-8">
                                                <a style="color: #0c4da2; font-size: 14px; font-weight: bold; text-transform: uppercase" href="{{ route('postdetail', ['slugchitiet' => $item->slugchitiet]) }}">{{$item->title}}</a>
                                                <p style="color: grey"><em>{{\Carbon\Carbon::parse($item->created_at)->format('d/m/Y')}}</em></p>
                                                <div>{!! trim_text($item->content,100) !!}</div>
                                            </dd>
                                        </div>
                                    </dl>
                                @endforeach
                        </div>
                        <div class="col-md-8">
                            <p class="title_box">
                                <strong>YÊU CẦU</strong>
                            <div>

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#realestate" aria-controls="home" role="tab" data-toggle="tab">Bất động sản</a></li>
                                    <li role="presentation"><a href="#finance" aria-controls="profile" role="tab" data-toggle="tab">Tư vấn tài chính</a></li>
                                    <li role="presentation"><a href="#design" aria-controls="messages" role="tab" data-toggle="tab">Thiết kế</a></li>
                                    <li role="presentation"><a href="#phongthuy" aria-controls="settings" role="tab" data-toggle="tab">Phong thuỷ</a></li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="realestate">
                                        <table class="table">
                                            <tr>
                                                <th width="50%">Tiêu đề</th>
                                                <th>Ngân sách</th>
                                                <th>Mở chào giá đến</th>
                                                <th>Chào giá</th>
                                            </tr>
                                            @foreach($freelancer['re'] as $item)
                                            <tr>
                                                <td><a href="{{route('freelancerDetail', ['id'=>$item->id, 'slug'=>to_slug($item->title)])}}"><strong>{{$item->title}}</strong></a></td>
                                                <td><a href="{{route('freelancerDetail', ['id'=>$item->id, 'slug'=>to_slug($item->title)])}}">{{convert_number_to_words($item->budget)}}</a></td>
                                                <td><a href="{{route('freelancerDetail', ['id'=>$item->id, 'slug'=>to_slug($item->title)])}}">{{Carbon\Carbon::parse($item->end_at)->diffForHumans(\Carbon\Carbon::now())}}</a></td>
                                                <td><a href="{{route('freelancerDetail', ['id'=>$item->id, 'slug'=>to_slug($item->title)])}}">{{$item->deals()->count()}}</a></td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="finance">
                                        <table class="table">
                                            <tr>
                                                <th width="50%">Tiêu đề</th>
                                                <th>Ngân sách</th>
                                                <th>Mở chào giá đến</th>
                                                <th>Chào giá</th>
                                            </tr>
                                            @foreach($freelancer['finance'] as $item)
                                                <tr>
                                                    <td><a href="{{route('freelancerDetail', ['id'=>$item->id, 'slug'=>to_slug($item->title)])}}"><strong>{{$item->title}}</strong></a></td>
                                                    <td><a href="{{route('freelancerDetail', ['id'=>$item->id, 'slug'=>to_slug($item->title)])}}">{{convert_number_to_words($item->budget)}}</a></td>
                                                    <td><a href="{{route('freelancerDetail', ['id'=>$item->id, 'slug'=>to_slug($item->title)])}}">{{Carbon\Carbon::parse($item->end_at)->diffForHumans(\Carbon\Carbon::now())}}</a></td>
                                                    <td><a href="{{route('freelancerDetail', ['id'=>$item->id, 'slug'=>to_slug($item->title)])}}">{{$item->deals()->count()}}</a></td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="design">
                                        <table class="table">
                                            <tr>
                                                <th width="50%">Tiêu đề</th>
                                                <th>Ngân sách</th>
                                                <th>Mở chào giá đến</th>
                                                <th>Chào giá</th>
                                            </tr>
                                            @foreach($freelancer['design'] as $item)
                                                <tr>
                                                    <td><a href="{{route('freelancerDetail', ['id'=>$item->id, 'slug'=>to_slug($item->title)])}}"><strong>{{$item->title}}</strong></a></td>
                                                    <td><a href="{{route('freelancerDetail', ['id'=>$item->id, 'slug'=>to_slug($item->title)])}}">{{convert_number_to_words($item->budget)}}</a></td>
                                                    <td><a href="{{route('freelancerDetail', ['id'=>$item->id, 'slug'=>to_slug($item->title)])}}">{{Carbon\Carbon::parse($item->end_at)->diffForHumans(\Carbon\Carbon::now())}}</a></td>
                                                    <td><a href="{{route('freelancerDetail', ['id'=>$item->id, 'slug'=>to_slug($item->title)])}}">{{$item->deals()->count()}}</a></td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="phongthuy">
                                        <table class="table">
                                            <tr>
                                                <th width="50%">Tiêu đề</th>
                                                <th>Ngân sách</th>
                                                <th>Mở chào giá đến</th>
                                                <th>Chào giá</th>
                                            </tr>
                                            @foreach($freelancer['phongthuy'] as $item)
                                                <tr>
                                                    <td><a href="{{route('freelancerDetail', ['id'=>$item->id, 'slug'=>to_slug($item->title)])}}"><strong>{{$item->title}}</strong></a></td>
                                                    <td><a href="{{route('freelancerDetail', ['id'=>$item->id, 'slug'=>to_slug($item->title)])}}">{{convert_number_to_words($item->budget)}}</a></td>
                                                    <td><a href="{{route('freelancerDetail', ['id'=>$item->id, 'slug'=>to_slug($item->title)])}}">{{Carbon\Carbon::parse($item->end_at)->diffForHumans(\Carbon\Carbon::now())}}</a></td>
                                                    <td><a href="{{route('freelancerDetail', ['id'=>$item->id, 'slug'=>to_slug($item->title)])}}">{{$item->deals()->count()}}</a></td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>

                            </div>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include(theme(TRUE).'.includes.footer')

    <link rel="stylesheet" href="{{ asset('css/main-1.css') }}"/>
@endsection

@push('js')
    <script src="{{ asset('js/jquery.flexslider.js') }}"></script>
    <script>
        $('.search_slide ul li a').click(function() {
            $('.search_slide ul li').removeClass('active');
            $(this).parent().addClass('active');
            $('.search_slide>form>input[type="hidden"]').val($(this).attr('href'));
            // getCatPrice('.search_slide>form>input[type="hidden"]', '#search_cat_id', '#search_price_id', '/site/LoadCat');
            changeReCategory($(this).attr('href'));
            return false;
        });

        function changeReCategory(cat) {
            console.log(cat);
            let catId = cat;

            $.ajax({
                url: "/re-type/list-dropdown/" + catId,
                method: 'GET',
                success: function (result) {
                    console.log('success');
                    console.log(result);
                    let html = '';
                    if (result) {
                        for (let r of result) {
                            html += '<option value="'+ r.id +'">' + r.name + '</option>';
                        }
                    }
                    if (html) {
                        $('#re-type').html(html);
                    }
                }
            });

            $.ajax({
                url: '/range-price/list-dropdown/' + catId,
                method: 'GET',
                success: function (result) {
                    console.log('success');
                    console.log(result);
                    let html = '';
                    if (result) {
                        for (let r of result) {
                            html += '<option value="'+ r.id +'">' + r.name + '</option>';
                        }
                    }
                    $('#range-price').html(html);
                }
            });
        }

        $(window).on('load', function(){
            $('.flexslider').flexslider({
                animation: "slide",
                start: function(slider){
                    $('body').removeClass('loading');
                }
            });
        });
        $('.vip_slider').bxSlider({
            mode: 'vertical',
            auto: true,
            minSlides: 30,
            maxSlides: 30,
            moveSlides: 1,
            pager: false
        });

        let modalId = $('#image-gallery');

        $(document)
            .ready(function () {

                loadGallery(true, 'a.thumbnail');

                //This function disables buttons when needed
                function disableButtons(counter_max, counter_current) {
                    $('#show-previous-image, #show-next-image')
                        .show();
                    if (counter_max === counter_current) {
                        $('#show-next-image')
                            .hide();
                    } else if (counter_current === 1) {
                        $('#show-previous-image')
                            .hide();
                    }
                }

                /**
                 *
                 * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
                 * @param setClickAttr  Sets the attribute for the click handler.
                 */

                function loadGallery(setIDs, setClickAttr) {
                    let current_image,
                        selector,
                        counter = 0;

                    $('#show-next-image, #show-previous-image')
                        .click(function () {
                            if ($(this)
                                    .attr('id') === 'show-previous-image') {
                                current_image--;
                            } else {
                                current_image++;
                            }

                            selector = $('[data-image-id="' + current_image + '"]');
                            updateGallery(selector);
                        });

                    function updateGallery(selector) {
                        let $sel = selector;
                        current_image = $sel.data('image-id');
                        $('#image-gallery-title')
                            .text($sel.data('title'));
                        $('#image-gallery-image')
                            .attr('src', $sel.data('image'));
                        disableButtons(counter, $sel.data('image-id'));
                    }

                    if (setIDs == true) {
                        $('[data-image-id]')
                            .each(function () {
                                counter++;
                                $(this)
                                    .attr('data-image-id', counter);
                            });
                    }
                    $(setClickAttr)
                        .on('click', function () {
                            updateGallery($(this));
                        });
                }
            });

        // build key actions
        $(document)
            .keydown(function (e) {
                switch (e.which) {
                    case 37: // left
                        if ((modalId.data('bs.modal') || {})._isShown && $('#show-previous-image').is(":visible")) {
                            $('#show-previous-image')
                                .click();
                        }
                        break;

                    case 39: // right
                        if ((modalId.data('bs.modal') || {})._isShown && $('#show-next-image').is(":visible")) {
                            $('#show-next-image')
                                .click();
                        }
                        break;

                    default:
                        return; // exit this handler for other keys
                }
                e.preventDefault(); // prevent the default action (scroll / move caret)
            });

    </script>
@endpush
