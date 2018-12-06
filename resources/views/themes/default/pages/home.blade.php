@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Home page" >
@endsection

@section('title')
    Dothigroup
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('common-css/flexslider.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}"/>
@endpush

@section('content')
    @include(theme(TRUE).'.includes.header')
    <div class="content-body">
        <section class="slider">
            <div class="flexslider">
                <ul class="slides">
                    <li>
                        <img src="{{ asset('images/slider/8226anhbia1.gif') }}" />
                    </li>
                    <li>
                        <img src="{{ asset('images/slider/9742anhbia4.gif') }}" />
                    </li>
                    <li>
                        <img src="{{ asset('images/slider/7070anhbia5.gif') }}" />
                    </li>
                    <li>
                        <img src="{{ asset('images/slider/8292anhbia6.gif') }}" />
                    </li>
                    <li>
                        <img src="{{ asset('images/slider/3691anhbia7.gif') }}" />
                    </li>
                </ul>
            </div>
        </section>
        <div class="smart-search hidden-xs">
            <div class="container search-wrap">
                <div class="search-content">
                    <ul>
                        <li class="active">
                            <a href="1">Cần bán</a><span></span>
                        </li>
                        <li>
                            <a href="5">Cho thuê</a><span></span>
                        </li>
                        <li>
                            <a href="4">Cần mua</a><span></span>
                        </li>
                        <li>
                            <a href="2">Cần thuê</a><span></span>
                        </li>
                        <li>
                            <form action="/tim-kiem.htm" method="GET">
                                <input placeholder="Từ khóa, mã số tin, số điện thoại" autocomplete="off" type="text" value="" name="txtkeyword" id="txtkeyword">							            <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                    <form action="" method="GET">
                        <input name="Search[kind_id]" id="Search_kind_id" type="hidden" value="1">
                        <div class="row search-select-wrap">
                            <div class="col-xs-2 item">
                                <select id="search_cat_id" name="Search[cat_id]">
                                    <option value="">Tất cả các nhóm</option>
                                    <option value="72">Condotel - Căn hộ Khách sạn</option>
                                </select>
                            </div>
                            <div class="col-xs-2 item">
                                <input value="1" name="Search[province_id]" id="Search_province_id" type="hidden"><select name="Search[district_id]" id="Search_district_id">
                                    <option value="">Tất cả quận huyện</option>
                                    <option value="66">Lê Chân</option>
                                </select>
                            </div>
                            <div class="col-xs-2 item">
                                <select name="Search[street_id]" id="Search_street_id">
                                    <option value="">Tất cả các đường phố</option>
                                    <option value="264">An Dương</option>
                                </select>
                            </div>
                            <div class="col-xs-2 item">
                                <select name="Search[direction_id]" id="Search_direction_id">
                                    <option value="">Tất cả các hướng</option>
                                    <option value="15,17,1,2,3,4,11,10,9,13,19,20,21,22,27">Đông tứ trạch (Đông nam, Nam, Bắc, Đông)</option>
                                    <option value="16,18,5,8,7,6,23,24,25,26,28">Tây tứ trạch (Tây, Tây bắc, Tây nam, Đông bắc)</option>
                                    <option value="16">Tây Tây Bắc</option>
                                </select>
                            </div>
                            <div class="col-xs-2 item">
                                <select id="search_price_id" name="Search[price_id]">
                                    <option value="">Tất cả các giá</option>
                                    <option value="36">Dưới 500 triệu</option>
                                </select>
                            </div>
                            <div class="col-xs-2 item">
                                <button type="submit"><i class="fa fa-search"></i> tìm kiếm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- end smart search --}}
        <section class="hot-real-estate">
            <div class="container ">
                <div class="row title-hot-wrap">
                    <div class="col-xs-12 title-hot-real-estate">
                            <a href="/tin-noi-bat.htm" class="active">BẤT ĐỘNG SẢN NỔI BẬT <span></span></a>
                            <a href="/tin-dang-moi-nhat.htm">TIN MỚI NHẤT <span></span></a>
                            <a href="/tin-rao-cong-dong-mien-phi.htm">TIN RAO VẶT CỘNG ĐỒNG MIỄN PHÍ <span></span></a>
                    </div>
                </div>
                <div class="row list-re-item list-hot">
                    @foreach($hotRealEstates as $item)
                        <div class="col-xs-12 col-sm-6 col-md-3">
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
                                    <div class="col-xs-6 larea">DTMB: {{$item->area_of_premises ? $item->area_of_premises : '0m2'}}</div>
                                    <div class="col-xs-6 rarea">DTSD: {{$item->area_of_use ? $item->area_of_use : '0m2'}}</div>
                                </div>
                                <div class="row price">
                                    <div class="col-xs-12 lprice">
                                        <i class="fa fa-map-marker"></i> {{$item->district->name}}
                                    </div>
                                    <div class="col-xs-12 rprice">
                                        {{$item->price}} {{$item->unit->name}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <section class="good_price">
            <div class="container">
                <div class="row two_cols">
                    <div class="col-xs-12 col-md-9 col_left">
                        <div class="left_box">
                            <p class="title_box">
                                <strong>TIN GIÁ HẤP DẪN</strong>
                            </p>
                            <div>
                                <div class="cat_top_box">
                                    <a href="#">Cần bán</a>
                                    <a href="#">Cho thuê</a>
                                    <a href="#">Cần mua</a>
                                    <a href="#">Cần thuê</a>
                                    <a href="#">Tin VIP</a>
                                    <form action="" method="GET">
                                        <input placeholder="Từ khóa, mã số tin, số điện thoại" autocomplete="off" type="text" value="" name="txtkeyword" id="txtkeyword">
                                        <button type="submit"><i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                                <div class="row body_top_box">
                                    <div class="col-xs-12 col-sm-6  good_price_item_wrap">
                                        <div class="col-xs-12  re_item2 good_price_item">
                                            <div class="row _vip">
                                                <div class="col-xs-5 lgp_item">
                                                    <a href="#">
                                                        <img src="http://nhadathaiphong.vn/images/attachment/thumb/565610.jpg" alt="Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng">
                                                    </a>
                                                    <div class="code_row">HP-36845</div>
                                                </div>

                                                <div class="col-xs-7 rgp_item">
                                                    <h3>
                                                        <a href="#">Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng
                                                        </a>
                                                        <span></span>
                                                    </h3>
                                                    <div>Nhà xây 4 tầng kiên cố, chắc chắn, thiết kế hiện đại, ngõ rộng 4m, sân cổng riêng
                                                        biệt, gần trường, chợ, hướng Tây, an ninh tốt, sổ đỏ chính chủ
                                                    </div>
                                                    <p>
                                                        <strong>DTMB:</strong> 57.7 m2 - <strong>Giá:</strong>
                                                        <span>
                                                            1.87 tỷ VND
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="icon_viphot">
                                                <img src="{{ asset('images/vip2.gif') }}" alt="Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-xs-12 col-sm-6  good_price_item_wrap">
                                        <div class="col-xs-12  re_item2 good_price_item">
                                            <div class="row _vip_hot">
                                                <div class="col-xs-5 lgp_item">
                                                    <a href="#">
                                                        <img src="http://nhadathaiphong.vn/images/attachment/thumb/4951.jpg" alt="Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng">
                                                    </a>											<div class="code_row">HP-36845</div>
                                                </div>

                                                <div class="col-xs-7 rgp_item">
                                                    <h3>
                                                        <a href="#">Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng
                                                        </a>
                                                        <span></span>
                                                    </h3>
                                                    <div>Nhà xây 4 tầng kiên cố, chắc chắn, thiết kế hiện đại, ngõ rộng 4m, sân cổng riêng
                                                        biệt, gần trường, chợ, hướng Tây, an ninh tốt, sổ đỏ chính chủ
                                                    </div>
                                                    <p>
                                                        <strong>DTMB:</strong> 57.7 m2 - <strong>Giá:</strong>
                                                        <span>
                                                            1.87 tỷ VND
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="icon_viphot">
                                                <img src="{{ asset('images/vip2.gif') }}" alt="Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6  good_price_item_wrap">
                                        <div class="col-xs-12  re_item2 good_price_item">
                                            <div class="row">
                                                <div class="col-xs-5 lgp_item">
                                                    <a href="#">
                                                        <img src="http://nhadathaiphong.vn/images/attachment/thumb/69375.jpg" alt="Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng">
                                                    </a>											<div class="code_row">HP-36845</div>
                                                </div>

                                                <div class="col-xs-7 rgp_item">
                                                    <h3><a href="#">Bán nhà số 18/5/40 Nguyễn Hữu Tuệ, Ngô Quyền, Hải Phòng</a>
                                                        <span></span>
                                                    </h3>
                                                    <div>Nhà 1.5 tầng xây độc lập,  sạch sẽ về ở ngay, ngõ rộng 2,2m, khu dân cư đông đúc,
                                                        gần trường, chợ, bệnh viện, hướng Đông Nam, sổ hồng chính chủ
                                                    </div>
                                                    <p>
                                                        <strong>DTMB:</strong> 57.7 m2 - <strong>Giá:</strong>
                                                        <span>
                                                            1.87 tỷ VND
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="icon_viphot">
                                                <img src="{{ asset('images/vip2.gif') }}" alt="Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6  good_price_item_wrap">
                                        <div class="col-xs-12  re_item2 good_price_item">
                                            <div class="row">
                                                <div class="col-xs-5 lgp_item">
                                                    <a href="#">
                                                        <img src="http://nhadathaiphong.vn/images/attachment/thumb/28489.jpg" alt="Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng">
                                                    </a>											<div class="code_row">HP-36845</div>
                                                </div>

                                                <div class="col-xs-7 rgp_item">
                                                    <h3><a href="#">Cho thuê nhà số 9 Đoạn Xá, Đông Hải 1, Hải An, Hải Phòng</a>
                                                        <span></span>
                                                    </h3>
                                                    <div>Nhà 1.5 tầng xây độc lập,  sạch sẽ về ở ngay, ngõ rộng 2,2m, khu dân cư đông đúc,
                                                        gần trường, chợ, bệnh viện, hướng Đông Nam, sổ hồng chính chủ
                                                    </div>
                                                    <p>
                                                        <strong>DTMB:</strong> 57.7 m2 - <strong>Giá:</strong>
                                                        <span>
                                                            1.87 tỷ VND
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="icon_viphot">
                                                <img src="{{ asset('images/vip2.gif') }}" alt="Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6  good_price_item_wrap">
                                        <div class="col-xs-12  re_item2 good_price_item">
                                            <div class="row _vip">
                                                <div class="col-xs-5 lgp_item">
                                                    <a href="#">
                                                        <img src="http://nhadathaiphong.vn/images/attachment/thumb/565610.jpg" alt="Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng">
                                                    </a>
                                                    <div class="code_row">HP-36845</div>
                                                </div>

                                                <div class="col-xs-7 rgp_item">
                                                    <h3>
                                                        <a href="#">Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng
                                                        </a>
                                                        <span></span>
                                                    </h3>
                                                    <div>Nhà xây 4 tầng kiên cố, chắc chắn, thiết kế hiện đại, ngõ rộng 4m, sân cổng riêng
                                                        biệt, gần trường, chợ, hướng Tây, an ninh tốt, sổ đỏ chính chủ
                                                    </div>
                                                    <p>
                                                        <strong>DTMB:</strong> 57.7 m2 - <strong>Giá:</strong>
                                                        <span>
                                                            1.87 tỷ VND
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="icon_viphot">
                                                <img src="{{ asset('images/vip2.gif') }}" alt="Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-xs-12 col-sm-6  good_price_item_wrap">
                                        <div class="col-xs-12  re_item2 good_price_item">
                                            <div class="row">
                                                <div class="col-xs-5 lgp_item">
                                                    <a href="#">
                                                        <img src="http://nhadathaiphong.vn/images/attachment/thumb/28489.jpg" alt="Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng">
                                                    </a>											<div class="code_row">HP-36845</div>
                                                </div>

                                                <div class="col-xs-7 rgp_item">
                                                    <h3><a href="#">Cho thuê nhà số 9 Đoạn Xá, Đông Hải 1, Hải An, Hải Phòng</a>
                                                        <span></span>
                                                    </h3>
                                                    <div>Nhà 1.5 tầng xây độc lập,  sạch sẽ về ở ngay, ngõ rộng 2,2m, khu dân cư đông đúc,
                                                        gần trường, chợ, bệnh viện, hướng Đông Nam, sổ hồng chính chủ
                                                    </div>
                                                    <p>
                                                        <strong>DTMB:</strong> 57.7 m2 - <strong>Giá:</strong>
                                                        <span>
                                                            1.87 tỷ VND
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="icon_viphot">
                                                <img src="{{ asset('images/vip2.gif') }}" alt="Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 good_price_item_wrap">
                                        <div class="col-xs-12 re_item2 good_price_item">
                                            <div class="row _vip_hot">
                                                <div class="col-xs-5 lgp_item">
                                                    <a href="#">
                                                        <img src="http://nhadathaiphong.vn/images/attachment/thumb/4951.jpg" alt="Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng">
                                                    </a>											<div class="code_row">HP-36845</div>
                                                </div>

                                                <div class="col-xs-7 rgp_item">
                                                    <h3>
                                                        <a href="#">Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng
                                                        </a>
                                                        <span></span>
                                                    </h3>
                                                    <div>Nhà xây 4 tầng kiên cố, chắc chắn, thiết kế hiện đại, ngõ rộng 4m, sân cổng riêng
                                                        biệt, gần trường, chợ, hướng Tây, an ninh tốt, sổ đỏ chính chủ
                                                    </div>
                                                    <p>
                                                        <strong>DTMB:</strong> 57.7 m2 - <strong>Giá:</strong>
                                                        <span>
                                                            1.87 tỷ VND
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="icon_viphot">
                                                <img src="{{ asset('images/vip2.gif') }}" alt="Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 good_price_item-wrap">
                                        <div class="col-xs-12 re_item2 good_price_item">
                                            <div class="row _vip_hot">
                                                <div class="col-xs-5 lgp_item">
                                                    <a href="#">
                                                        <img src="http://nhadathaiphong.vn/images/attachment/thumb/4951.jpg" alt="Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng">
                                                    </a>											<div class="code_row">HP-36845</div>
                                                </div>

                                                <div class="col-xs-7 rgp_item">
                                                    <h3>
                                                        <a href="#">Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng
                                                        </a>
                                                        <span></span>
                                                    </h3>
                                                    <div>Nhà xây 4 tầng kiên cố, chắc chắn, thiết kế hiện đại, ngõ rộng 4m, sân cổng riêng
                                                        biệt, gần trường, chợ, hướng Tây, an ninh tốt, sổ đỏ chính chủ
                                                    </div>
                                                    <p>
                                                        <strong>DTMB:</strong> 57.7 m2 - <strong>Giá:</strong>
                                                        <span>
                                                            1.87 tỷ VND
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="icon_viphot">
                                                <img src="{{ asset('images/vip2.gif') }}" alt="Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6  good_price_item_wrap">
                                        <div class="col-xs-12 re_item2 good_price_item">
                                            <div class="row _vip_hot">
                                                <div class="col-xs-5 lgp_item">
                                                    <a href="#">
                                                        <img src="http://nhadathaiphong.vn/images/attachment/thumb/4951.jpg" alt="Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng">
                                                    </a>											<div class="code_row">HP-36845</div>
                                                </div>

                                                <div class="col-xs-7 rgp_item">
                                                    <h3>
                                                        <a href="#">Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng
                                                        </a>
                                                        <span></span>
                                                    </h3>
                                                    <div>Nhà xây 4 tầng kiên cố, chắc chắn, thiết kế hiện đại, ngõ rộng 4m, sân cổng riêng
                                                        biệt, gần trường, chợ, hướng Tây, an ninh tốt, sổ đỏ chính chủ
                                                    </div>
                                                    <p>
                                                        <strong>DTMB:</strong> 57.7 m2 - <strong>Giá:</strong>
                                                        <span>
                                                            1.87 tỷ VND
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="icon_viphot">
                                                <img src="{{ asset('images/vip2.gif') }}" alt="Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12" style="border-bottom: 0; margin-bottom: 0; padding-bottom: 0; margin-top: 15px;">
                                        <p class="more"><a href="#"><i class="fa fa-angle-double-right"></i> Xem thêm</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-3 col_right">
                        @include(theme(TRUE).'.includes.vip-slide')
                        {{--<div class="right_box vip_box">--}}
                            {{--<p class="title_box">--}}
                                {{--<a href="#">--}}
                                    {{--<strong>TIN VIP</strong>--}}
                                {{--</a>--}}
                            {{--</p>--}}
                            {{--<div>--}}

                                {{--<ul class="vip_slider">--}}
                                    {{--<li>--}}
                                        {{--<dl class=" _hot">--}}
                                            {{--<dt>--}}
                                                {{--<a href="#"><img src="http://nhadathaiphong.vn/images/attachment/thumb/183011.jpg" alt="Bán nhà mặt đường Tô Hiệu (6x20) Lê Chân Hải Phòng"></a>--}}
                                                {{--<div class="icon_viphot">--}}
                                                    {{--<img src="{{ asset('images/vip2.gif') }}" alt="Bán nhà mặt đường Tô Hiệu (6x20) Lê Chân Hải Phòng">								</div>--}}
                                            {{--</dt>--}}
                                            {{--<dd>--}}
                                                {{--<h3><a href="#">Bán nhà mặt đường Tô Hiệu (6x20) Lê Chân Hải Phòng</a></h3>--}}
                                                {{--<p><strong>Diện tích:</strong> 120 m2</p>--}}
                                                {{--<p><strong>Giá:</strong> <span>Thỏa thuận</span></p>--}}
                                                {{--<p><strong>Hướng:</strong> Liên hệ</p>--}}
                                            {{--</dd>--}}
                                        {{--</dl>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<dl class=" _hot">--}}
                                            {{--<dt>--}}
                                                {{--<a href="#"><img src="http://nhadathaiphong.vn/images/attachment/thumb/183011.jpg" alt="Bán nhà mặt đường Tô Hiệu (6x20) Lê Chân Hải Phòng"></a>--}}
                                                {{--<div class="icon_viphot">--}}
                                                    {{--<img src="{{ asset('images/vip2.gif') }}" alt="Bán nhà mặt đường Tô Hiệu (6x20) Lê Chân Hải Phòng">								</div>--}}
                                            {{--</dt>--}}
                                            {{--<dd>--}}
                                                {{--<h3><a href="#">Bán nhà mặt đường Tô Hiệu (6x20) Lê Chân Hải Phòng</a></h3>--}}
                                                {{--<p><strong>Diện tích:</strong> 120 m2</p>--}}
                                                {{--<p><strong>Giá:</strong> <span>Thỏa thuận</span></p>--}}
                                                {{--<p><strong>Hướng:</strong> Liên hệ</p>--}}
                                            {{--</dd>--}}
                                        {{--</dl>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<dl class=" _hot">--}}
                                            {{--<dt>--}}
                                                {{--<a href="#"><img src="http://nhadathaiphong.vn/images/attachment/thumb/183011.jpg" alt="Bán nhà mặt đường Tô Hiệu (6x20) Lê Chân Hải Phòng"></a>--}}
                                                {{--<div class="icon_viphot">--}}
                                                    {{--<img src="{{ asset('images/vip2.gif') }}" alt="Bán nhà mặt đường Tô Hiệu (6x20) Lê Chân Hải Phòng">								</div>--}}
                                            {{--</dt>--}}
                                            {{--<dd>--}}
                                                {{--<h3><a href="#">Bán nhà mặt đường Tô Hiệu (6x20) Lê Chân Hải Phòng</a></h3>--}}
                                                {{--<p><strong>Diện tích:</strong> 120 m2</p>--}}
                                                {{--<p><strong>Giá:</strong> <span>Thỏa thuận</span></p>--}}
                                                {{--<p><strong>Hướng:</strong> Liên hệ</p>--}}
                                            {{--</dd>--}}
                                        {{--</dl>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<dl class=" _hot">--}}
                                            {{--<dt>--}}
                                                {{--<a href="#"><img src="http://nhadathaiphong.vn/images/attachment/thumb/183011.jpg" alt="Bán nhà mặt đường Tô Hiệu (6x20) Lê Chân Hải Phòng"></a>--}}
                                                {{--<div class="icon_viphot">--}}
                                                    {{--<img src="{{ asset('images/vip2.gif') }}" alt="Bán nhà mặt đường Tô Hiệu (6x20) Lê Chân Hải Phòng">								</div>--}}
                                            {{--</dt>--}}
                                            {{--<dd>--}}
                                                {{--<h3><a href="#">Bán nhà mặt đường Tô Hiệu (6x20) Lê Chân Hải Phòng</a></h3>--}}
                                                {{--<p><strong>Diện tích:</strong> 120 m2</p>--}}
                                                {{--<p><strong>Giá:</strong> <span>Thỏa thuận</span></p>--}}
                                                {{--<p><strong>Hướng:</strong> Liên hệ</p>--}}
                                            {{--</dd>--}}
                                        {{--</dl>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<dl class=" _hot">--}}
                                            {{--<dt>--}}
                                                {{--<a href="#"><img src="http://nhadathaiphong.vn/images/attachment/thumb/183011.jpg" alt="Bán nhà mặt đường Tô Hiệu (6x20) Lê Chân Hải Phòng"></a>--}}
                                                {{--<div class="icon_viphot">--}}
                                                    {{--<img src="{{ asset('images/vip2.gif') }}" alt="Bán nhà mặt đường Tô Hiệu (6x20) Lê Chân Hải Phòng">								</div>--}}
                                            {{--</dt>--}}
                                            {{--<dd>--}}
                                                {{--<h3><a href="#">Bán nhà mặt đường Tô Hiệu (6x20) Lê Chân Hải Phòng</a></h3>--}}
                                                {{--<p><strong>Diện tích:</strong> 120 m2</p>--}}
                                                {{--<p><strong>Giá:</strong> <span>Thỏa thuận</span></p>--}}
                                                {{--<p><strong>Hướng:</strong> Liên hệ</p>--}}
                                            {{--</dd>--}}
                                        {{--</dl>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}

                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        </section>
        <section class="free_price">
            <div class="container">
                <div class="row margin-0">
                    <div class="col-xs-12">
                        <div class="free_price_box">
                            <p class="title_box1">
                                <strong>TIN RAO VẶT CỘNG ĐỒNG MIỄN PHÍ</strong>
                            </p>
                            <div >
                                <div class="row body_top_box">
                                    @for ($i=0; $i<10; $i++)
                                    <div class="col-xs-12 col-sm-4  free_price_item_wrap">
                                        <div class="col-xs-12 re_item2 free_price_item">
                                            <div class="row">
                                                <div class="col-xs-5 lgp_item">
                                                    <a href="#">
                                                        <img src="http://nhadathaiphong.vn/images/attachment/thumb/28489.jpg" alt="Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng">
                                                    </a>											<div class="code_row">HP-36845</div>
                                                </div>

                                                <div class="col-xs-7 rgp_item">
                                                    <h3><a href="#">Cho thuê nhà số 9 Đoạn Xá, Đông Hải 1, Hải An, Hải Phòng</a>
                                                        <span></span>
                                                    </h3>
                                                    <div>Nhà 1.5 tầng xây độc lập,  sạch sẽ về ở ngay, ngõ rộng 2,2m, khu dân cư đông đúc,
                                                        gần trường, chợ, bệnh viện, hướng Đông Nam, sổ hồng chính chủ
                                                    </div>
                                                    <p>
                                                        <strong>DTMB:</strong> 57.7 m2 - <strong>Giá:</strong>
                                                        <span>
                                                            1.87 tỷ VND
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4  free_price_item_wrap">
                                        <div class="col-xs-12 re_item2 free_price_item">
                                            <div class="row">
                                                <div class="col-xs-5 lgp_item">
                                                    <a href="#">
                                                        <img src="http://nhadathaiphong.vn/images/attachment/thumb/568z106.jpg" alt="Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng">
                                                    </a>											<div class="code_row">HP-36845</div>
                                                </div>

                                                <div class="col-xs-7 rgp_item">
                                                    <h3><a href="#">Cho thuê nhà số 9 Đoạn Xá, Đông Hải 1, Hải An, Hải Phòng</a>
                                                        <span></span>
                                                    </h3>
                                                    <div>Nhà 1.5 tầng xây độc lập,  sạch sẽ về ở ngay, ngõ rộng 2,2m, khu dân cư đông đúc,
                                                        gần trường, chợ, bệnh viện, hướng Đông Nam, sổ hồng chính chủ
                                                    </div>
                                                    <p>
                                                        <strong>DTMB:</strong> 57.7 m2 - <strong>Giá:</strong>
                                                        <span>
                                                                1.87 tỷ VND
                                                            </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4  free_price_item_wrap">
                                        <div class="col-xs-12 re_item2 free_price_item">
                                            <div class="row">
                                                <div class="col-xs-5 lgp_item">
                                                    <a href="#">
                                                        <img src="http://nhadathaiphong.vn/images/attachment/thumb/2960486327MHT3.jpg" alt="Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng">
                                                    </a>											<div class="code_row">HP-36845</div>
                                                </div>

                                                <div class="col-xs-7 rgp_item">
                                                    <h3><a href="#">Cho thuê nhà số 9 Đoạn Xá, Đông Hải 1, Hải An, Hải Phòng</a>
                                                        <span></span>
                                                    </h3>
                                                    <div>Nhà 1.5 tầng xây độc lập,  sạch sẽ về ở ngay, ngõ rộng 2,2m, khu dân cư đông đúc,
                                                        gần trường, chợ, bệnh viện, hướng Đông Nam, sổ hồng chính chủ
                                                    </div>
                                                    <p>
                                                        <strong>DTMB:</strong> 57.7 m2 - <strong>Giá:</strong>
                                                        <span>
                                                                1.87 tỷ VND
                                                            </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4  free_price_item_wrap">
                                        <div class="col-xs-12 re_item2 free_price_item">
                                            <div class="row">
                                                <div class="col-xs-5 lgp_item">
                                                    <a href="#">
                                                        <img src="http://nhadathaiphong.vn/images/attachment/thumb/4592d597efe08641661f3f50.jpg" alt="Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng">
                                                    </a>											<div class="code_row">HP-36845</div>
                                                </div>

                                                <div class="col-xs-7 rgp_item">
                                                    <h3><a href="#">Cho thuê nhà số 9 Đoạn Xá, Đông Hải 1, Hải An, Hải Phòng</a>
                                                        <span></span>
                                                    </h3>
                                                    <div>Nhà 1.5 tầng xây độc lập,  sạch sẽ về ở ngay, ngõ rộng 2,2m, khu dân cư đông đúc,
                                                        gần trường, chợ, bệnh viện, hướng Đông Nam, sổ hồng chính chủ
                                                    </div>
                                                    <p>
                                                        <strong>DTMB:</strong> 57.7 m2 - <strong>Giá:</strong>
                                                        <span>
                                                                1.87 tỷ VND
                                                            </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{--<section class="addition_info">--}}
            {{--<div class="container">--}}
                {{--<div class="row margin-0 three_cols">--}}
                    {{--<div class="col-xs-12 col-sm-4 three_i brokers">--}}

                            {{--<p class="title_col">--}}
                                {{--<a href="#"><i class="fa fa-users"></i> NHÀ MÔI GIỚI</a>--}}
                            {{--</p>--}}
                            {{--<div class="content col-xs-12 no-padding-left no-padding-right broker_slider">--}}
                                {{--@for($i=0; $i<2; $i++)--}}
                                {{--<div class="col-xs-12 broker-item">--}}
                                    {{--<div class="ct_left">--}}
                                        {{--<a href="#">--}}
                                            {{--<img class="img-responsive b_img" src="http://nhadathaiphong.vn/images/lander/49521-Ki%C3%AAn.jpg" alt="">--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                    {{--<div class="ct_right">--}}
                                        {{--<h3 class="name"><a href="#">Nguyen Van A</a></h3>--}}
                                        {{--<p class="phone">0999.0880.32</p>--}}
                                        {{--<p class="des">GĐ Kinh Doanh - Chuyên Viên tư vấn mua bán, cho thuê, định giá BĐS Lê Hồng Phong, Mặt Phố Chính (Xem hồ sơ và sản phẩm phụ trách)</p>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--@endfor--}}
                            {{--</div>--}}
                            {{--<div class="col-xs-12 broker_see_all">--}}
                                {{--<a href="#">Xem tất cả</a>--}}
                            {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-xs-12 col-sm-4 three_i statistic">--}}
                        {{--<p class="title_col">--}}
                            {{--<a href="#">{{ trans('home.statistic_col') }}</a>--}}
                        {{--</p>--}}
                        {{--<div class="col-xs-12 content">--}}
                            {{--<p>{{ trans('home.num_of_user') }}: 111</p>--}}
                            {{--<p>{{ trans('home.num_of_real_estate') }}: 111</p>--}}
                            {{--<p>{{ trans('home.num_of_success_transaction') }}: 111</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-xs-12 col-sm-4 three_i design">--}}
                        {{--<p class="title_col">--}}
                            {{--<a href="#"><i class="fa fa-desktop" aria-hidden="true"></i> {{ trans('home.design_col') }}</a>--}}
                        {{--</p>--}}
                        {{--<div class="col-xs-12 content design_content">--}}
                                {{--<p>Cách xác định hướng nhà theo phong thủy tốt nhất</p>--}}
                                {{--<a href="#">--}}
                                    {{--<img class="img-responsive" src="http://nhadathaiphong.vn/images/partner/9998cach-xac-dinh-huong-nha-theo-phong-thuy-tot-nhat-2.jpg" alt="Cách xác định hướng nhà theo phong thủy tốt nhất">--}}
                                {{--</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</section>--}}
    </div>
    @include(theme(TRUE).'.includes.footer')
@endsection

@push('js')
    <script src="{{ asset('js/jquery.flexslider.js') }}"></script>
    <script>
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
