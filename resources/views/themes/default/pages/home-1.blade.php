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
                                        {{$item->price}} {{$item->unit ? $item->unit->name : 'VND'}}
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
                            <p class="title_box">
                                <strong>TIN GIÁ HẤP DẪN</strong>
                            </p>
                            <div>
                                <div class="cat_top_box">
                                    @foreach($categories as $category)
                                        <a href="{{'/danh-muc-bds/' . $category->slug . '-c' . $category->id}}">{{$category->name}}</a>
                                    @endforeach
                                    <a href="{{route('tin-vip')}}">Tin VIP</a>
                                    <form action="{{route('search')}}" method="GET">
                                        <input placeholder="{{trans('system.searchPlaceholder')}}" autocomplete="off" type="text" value="" name="txtkeyword" id="txtkeyword">
                                        <button type="submit"><i class="fa fa-search"></i></button>
                                    </form>
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
                                                                {{$item->price}} {{$item->unit ? $item->unit->name : 'VND'}}
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
                                                            {{$item->price}} {{$item->unit ? $item->unit->name : 'VND'}}
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
                                                            {{$item->price}} {{$item->unit ? $item->unit->name : 'VND'}}
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
        <section class="free_price">
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
                                                            {{$item->price}} {{$item->unit ? $item->unit->name : 'VND'}}
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
                        <div class="col-md-4">
                            <p class="title_box">
                                <strong>Đối tác</strong>
                                <div class="container">
{{--                                    {!! \App\Banner::where('location', 6)->where('province_id', 0)->first()->content !!}--}}
                                <img width="150px" height="110px" src="data:image/png;base64,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">
                                <img width="150px" height="110px" src="data:image/png;base64,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">
                                <br>
                                <img width="150px" height="110px" src="data:image/png;base64,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">
                                <img width="150px" height="110px" src="data:image/png;base64,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">
                            </div>
                            </p>
                        </div>
                        <div class="col-md-4">
                            <p class="title_box">
                                <strong>Hình ảnh</strong>
                            </p>
                            <div class="row">
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                                           data-image="https://images.pexels.com/photos/853168/pexels-photo-853168.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                           data-target="#image-gallery">
                                            <img class="img-thumbnail"
                                                 src="https://images.pexels.com/photos/853168/pexels-photo-853168.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                                 alt="Another alt text">
                                        </a>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                                           data-image="https://images.pexels.com/photos/158971/pexels-photo-158971.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                           data-target="#image-gallery">
                                            <img class="img-thumbnail"
                                                 src="https://images.pexels.com/photos/158971/pexels-photo-158971.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                                 alt="Another alt text">
                                        </a>
                                    </div>

                                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                                           data-image="https://images.pexels.com/photos/305070/pexels-photo-305070.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                           data-target="#image-gallery">
                                            <img class="img-thumbnail"
                                                 src="https://images.pexels.com/photos/305070/pexels-photo-305070.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                                 alt="Another alt text">
                                        </a>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Test1"
                                           data-image="https://images.pexels.com/photos/853168/pexels-photo-853168.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                           data-target="#image-gallery">
                                            <img class="img-thumbnail"
                                                 src="https://images.pexels.com/photos/853168/pexels-photo-853168.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                                 alt="Another alt text">
                                        </a>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Im so nice"
                                           data-image="https://images.pexels.com/photos/158971/pexels-photo-158971.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                           data-target="#image-gallery">
                                            <img class="img-thumbnail"
                                                 src="https://images.pexels.com/photos/158971/pexels-photo-158971.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                                 alt="Another alt text">
                                        </a>
                                    </div>



                                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Im so nice"
                                           data-image="https://images.pexels.com/photos/305070/pexels-photo-305070.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                           data-target="#image-gallery">
                                            <img class="img-thumbnail"
                                                 src="https://images.pexels.com/photos/305070/pexels-photo-305070.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                                 alt="Another alt text">
                                        </a>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Im so nice"
                                           data-image="https://images.pexels.com/photos/853168/pexels-photo-853168.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                           data-target="#image-gallery">
                                            <img class="img-thumbnail"
                                                 src="https://images.pexels.com/photos/853168/pexels-photo-853168.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                                 alt="Another alt text">
                                        </a>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Im so nice"
                                           data-image="https://images.pexels.com/photos/158971/pexels-photo-158971.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                           data-target="#image-gallery">
                                            <img class="img-thumbnail"
                                                 src="https://images.pexels.com/photos/158971/pexels-photo-158971.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                                 alt="Another alt text">
                                        </a>
                                    </div>



                                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Im so nice"
                                           data-image="https://images.pexels.com/photos/305070/pexels-photo-305070.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                           data-target="#image-gallery">
                                            <img class="img-thumbnail"
                                                 src="https://images.pexels.com/photos/305070/pexels-photo-305070.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                                 alt="Another alt text">
                                        </a>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Im so nice"
                                           data-image="https://images.pexels.com/photos/853168/pexels-photo-853168.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                           data-target="#image-gallery">
                                            <img class="img-thumbnail"
                                                 src="https://images.pexels.com/photos/853168/pexels-photo-853168.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                                 alt="Another alt text">
                                        </a>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Im so nice"
                                           data-image="https://images.pexels.com/photos/158971/pexels-photo-158971.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                           data-target="#image-gallery">
                                            <img class="img-thumbnail"
                                                 src="https://images.pexels.com/photos/158971/pexels-photo-158971.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                                 alt="Another alt text">
                                        </a>
                                    </div>
                                </div>


                                <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="image-gallery-title"></h4>
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <img id="image-gallery-image" class="img-responsive col-md-12" src="">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>
                                                </button>

                                                <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

    </script>
@endpush
