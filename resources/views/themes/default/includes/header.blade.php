{{-- top page --}}
<section class="section-header">
    <header class="site-header">
        <div class="site-header__left">
            <div class="site-header__phone site-header__left__item">
                <img src="source/images/header-phone-icon.png" alt="phone">
                <a href="callto:0989186179">
                    0989.186.179
                </a>
            </div>
            <div class="site-header__mail site-header__left__item">
                <img src="source/images/header-mail-icon.png" alt="mail">
                <a href="mailto:recbook.vn@gmail.com">
                    recbook.vn@gmail.com
                </a>
            </div>
        </div>
        <div class="site-header__logo">
            <a href="">
                <img src="sourceimages/logo.png" alt="logo">
            </a>
        </div>
        <div class="site-header__right">
            <a href="" class="batdongsan">
                BẤT ĐỘNG SẢN
            </a>
            <a href="" class="service">
                YÊU CẦU DỊCH VỤ
            </a>
            <a href="" class="user">
                <img src="source/images/header-user-icon.png" alt="user-icon">
            </a>
            <a href="" class="upload">
                <img src="source/images/header-upload-icon.png" alt="upload-icon">
                ĐĂNG TIN RAO
            </a>

        </div>
    </header>
</section>
{{-- end to page --}}
{{-- banner header --}}
<div class="banner-header">
    <div class="container">
        <div class="row">
            <div class="left col-xs-12 col-sm-4">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" class="img-responsive" alt="" style="max-height: 128px"/>
                </a>
            </div>
            <div class="right col-sm-8 hidden-xs">
                @foreach(\App\Banner::where('location', 8)->where('province_id', 0)->get() as $item)
                    @if($item->type==1)
                        <a href="{{$item->url}}">
                            <img src="http://{{env('DOMAIN_BACKEND', 'recbook.net')}}/{{$item->image}}" class="img-responsive" alt="{{$item->note}}">
                        </a>
                    @else
                        {!! $item->content !!}
                    @endif
                @endforeach
            </div>
            {{--<div class="clearfix"></div>--}}
        </div>
    </div>
</div>
{{-- end banner header --}}
<nav class="navbar navbar-inverse main-menu">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand visible-xs" href="{{ route('home') }}">Recbook.vn</a>
        </div>
        <div class="collapse navbar-collapse main-menu-list" id="myNavbar">
            <ul class="nav navbar-nav">
                @php
                    $menuData = json_decode(menu()->data);
                    $quantam    =   session('tinhthanhquantam',0);
                    if($quantam!=0)
                        $tentinh = \App\Province::findOrFail(session('tinhthanhquantam', 0))?str_replace('Tỉnh ', '', str_replace('Thành phố', '', \App\Province::find(session('tinhthanhquantam'))->name)):'Tất cả';
                    else
                        $tentinh    =   'Tất cả';
                @endphp
                <li class=""><a href="{{ route('home') }}"><i class="fa fa-home"></i> Trang chủ</a></li>
                @foreach($menuData as $md)
                    @if (isset($md->children) && $children = $md->children)
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ $md->name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                @foreach($children as $child)
                                    <li><a href="{{ route('danh-muc', ['tag' => $child->path]) }}">{{ $child->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li class=""><a href="{{ route('danh-muc', ['tag' => $md->path]) }}"> {{ $md->name }}</a></li>
                    @endif
                @endforeach
                <li class=""><a href="{{ route('freelancerList') }}"> Yêu cầu dịch vụ</a></li>
                {{--<li class=""><a href="{{ route('contact') }}"> {{ trans('menu.contact') }}</a></li>--}}
                {{--<li class=""><a href="{{ route('get.create-real-estate') }}">{{ trans('menu.create_real_estate') }}</a></li>--}}
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li >
                    <a href="#a" data-toggle="modal" data-target="#quantamtinhthanhModal">{{$tentinh}} <i class="fa fa-sort"></i></a>
                </li>
                <div class="menu-search">
                    <div class="pull-right wrap">
                        <form action="{{route('searchProject')}}" method="get" style="float: left">
                            <input id="ip-kw" name="project_id" class="form-control pull-left" type="text" data-province="{{session('tinhthanhquantam', 0)}}" placeholder="Tìm theo tên dự án">
                            <button type="submit" class="pull-left"><i class="fa fa-search"></i></button>
                        </form>
                        <form action="{{route('search')}}" method="get" style="float: left">
                            <input id="ip-keyword" name="txtkeyword" class="form-control pull-left" style="width: 170px; font-size: 13px; margin-left: 5px" type="text" placeholder="{{trans('system.searchPlaceholder')}}">
                            <button type="submit" class="pull-left"><i class="fa fa-search"></i></button>
                        </form>
                        <div class="dropdown" style="float: left">
                            <a class="pull-left btn btn-sm btn-primary" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Tìm kiếm nâng cao
                                <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dLabel" style="background: #0856ac">
                                <div class="smart-search">
                                    <form action="{{route('smart-search')}}" method="get">
                                        <div class=" search-wrap">
                                            <div class="search_slide">
                                                <ul style="padding-inline-start: 16px;">
                                                    @php
                                                        $categories =   \App\ReCategory::select('id', 'name', 'slug')
                    ->orderBy('id', 'asc')
        //            ->where('web_id', $web_id)
                    ->get();
                                                    @endphp
                                                    @foreach($categories as $key => $category)
                                                        <li @if($key == 0) class="active" @endif>
                                                            <a href="{{ $category->id }}">{{$category->name}}</a><span></span>
                                                        </li>
                                                    @endforeach
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
                                                </ul>
                                                <div class="clearfix"></div>
                                                <form action="{{route('smart-search')}}" method="GET">
                                                    @php

                                                            if($categories) {
                                                                $firstCat = $categories[0];
                                                            }
                                                    @endphp
                                                    <input name="Search[cat_id]" id="Search_kind_id" type="hidden" value="{{ $firstCat ? $firstCat->id : 1 }}">
                                                    <div class="row search-select-wrap">
                                                        <div class="col-md-2 col-xs-12 item">
                                                            <select id="re-type" name="Search[type_id]">
                                                                <option value="0">Tất cả loại hình</option>
                                                                @foreach(\App\ReType::get() as $reType)
                                                                    <option value="{{$reType->id}}">{{$reType->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <input value="{{session('tinhthanhquantam', 0)}}" name="Search[province_id]" id="Search_province_id" type="hidden">
                                                        <div class="col-md-2 col-xs-12  item">
                                                            <select name="Search[district_id]" id="Search_district_id">
                                                                <option value="0">Tất cả quận huyện</option>
                                                                @foreach(\App\District::where('province_id', session('tinhthanhquantam', 0))->get() as $district)
                                                                    <option value="{{$district->id}}">{{$district->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        {{--<div class="col-xs-2 item">--}}
                                                            {{--<select name="Search[street_id]" id="Search_street_id">--}}
                                                                {{--<option value="0">Tất cả đường phố</option>--}}
                                                                {{--@foreach(Stre as $street)--}}
                                                                    {{--<option value="{{$street->id}}">{{$street->name}}</option>--}}
                                                                {{--@endforeach--}}
                                                            {{--</select>--}}
                                                        {{--</div>--}}
                                                        <div class="col-md-2 col-xs-12 item">
                                                            <select name="Search[direction_id]" id="Search_direction_id">
                                                                <option value="0">Tất cả các hướng</option>
                                                                @foreach(\App\Direction::all() as $direction)
                                                                    <option value="{{$direction->id}}">{{$direction->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        {{--<div class="col-xs-2 item">--}}
                                                        {{--<select name="Search[direction_id]" id="Search_direction_id">--}}
                                                        {{--@foreach($directions as $direction)--}}
                                                        {{--<option value="{{$direction->id}}">{{$direction->name}}</option>--}}
                                                        {{--@endforeach--}}
                                                        {{--</select>--}}
                                                        {{--</div>--}}
                                                        <div class="col-md-2 col-xs-12 item">
                                                            <select id="range-price" name="Search[range_price_id]">
                                                                <option value="0">Không lọc theo giá</option>
                                                                @foreach(\App\RangePrice::all() as $rangePrice)
                                                                    <option value="{{$rangePrice->id}}">{{$rangePrice->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2 col-xs-12 item">
                                                            <div class="input-group"> <input class="form-control" name="Search[keyword]" placeholder="Tên/SDT.." style="width: 100%;">
                                                                <span class="input-group-btn"> <button class="btn btn-default" type="submit" style="    height: 30px;top: 0;margin-bottom: 9px;">
                                                                    <i class="fa fa-search"></i></button>
                                                            </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </ul>
        </div>
    </div>
</nav>
