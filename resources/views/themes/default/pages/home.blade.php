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
    <div class="content-body" style="height: 1000px;">
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
        <div class="smart-search">
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
        <section class="featured-real-estate">
            <div class="container ">
                <div class="row title-featured-wrap">
                    <div class="col-xs-12 title-featured-real-estate">
                            <a href="/tin-noi-bat.htm" class="active">BẤT ĐỘNG SẢN NỔI BẬT <span></span></a>
                            <a href="/tin-dang-moi-nhat.htm">TIN MỚI NHẤT <span></span></a>
                            <a href="/tin-rao-cong-dong-mien-phi.htm">TIN RAO VẶT CỘNG ĐỒNG MIỄN PHÍ <span></span></a>
                    </div>
                </div>
            </div>
        </section>
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
    </script>
@endpush
