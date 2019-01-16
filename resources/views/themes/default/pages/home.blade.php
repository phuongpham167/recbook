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

    <link rel="stylesheet" href="{{ asset('plugins/OwlCarousel2-2.3.4/dist/owl.carousel.js') }}"/>
    <link rel="stylesheet" href="{{ asset('plugins/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css') }}"/>
@endpush

@section('content')
    @include(theme(TRUE).'.includes.header-home')
    <div class="sliderz">
        <div>
            <div class="owl-carousel owl-theme slide_carousel">
                @foreach(\App\Banner::where('location', 0)->get() as $item)
                    <div>
                        <a href="{{$item->url?$item->url:'#a'}}"><img src="http://{{env('DOMAIN_BACKEND','recbook.net')}}{{$item->image}}" alt="{{$item->note}}"></a>
                    </div>
                @endforeach
            </div>
            <div class="row d-none  d-md-block">
                <div class="col-4 offset-4">
                    <div class="owl-carousel owl-theme text_carousel">
                        <div class="item"><p>Bán bánh lạ bọc ống inox: Bám vỉa hè Hà Nội, chàng trai thu 70 triệu đồng/tháng</p></div>
                        <div class="item"><p>Philippines dè chừng với tất cả các dự án vay vốn của Trung Quốc</p></div>
                        <div class="item"><p>Sớm đưa Việt Nam vào nhóm các nước dẫn đầu ASEAN</p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="content-body">


        {{-- end smart search --}}
        <section class="hot-real-estate">
            <div class="container ">
                <div class="row title-hot-wrap">
                    <div class="col-xs-12 title-hot-real-estate">
                        <a href="{{ route('tin-noi-bat') }}" class="active">TIN BẤT ĐỘNG SẢN HOT</a>
                        <a class="pull-right postnew" href="{{route('free-real-estate')}}">ĐĂNG TIN HOT</a>
                    </div>
                </div>
                <div class="row list_product theend" id="hot_landbox">
                    <!--Begin right-->
                    @foreach($hotRealEstates as $item)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 item" data-id="266">
                            <div class="img_item">
                                <a href="{{ route('detail-real-estate', ['slug' => $item->slug . '-' . $item->id]) }}">
                                    @php
                                        $images = $item->images ? json_decode($item->images) : [];
                                        $imgThumbnail = $images ? $images[0]->link : '/images/default_real_estate_image.jpg';
                                        $imgAlt = $images ? $images[0]->alt : $item->title;
                                    @endphp
                                    <img src="{{asset($imgThumbnail)}}" alt="{{ $imgAlt }}"></a>
                                <img class="vip" src="/images/hot.png"
                                     alt="{{ $imgAlt }}"
                                     title="{{ $imgAlt }}">
                            </div>

                            <div class="brief_item">
                                <h3>
                                    <a href="{{ route('detail-real-estate', ['slug' => $item->slug . '-' . $item->id]) }}">{{ $item->title }}</a></h3>
                                <div><p>{{ $item->short_description }}</p></div>
                            </div>

                            <div class="row no-gutters info_item">
                                <div class="col-md-6 no-padding-left no-padding-right">
                                    <p class="area">DTMB: {{$item->area_of_premises ? $item->area_of_premises . 'm2' : '0m2'}}</p>
                                </div>
                                <div class="col-md-6 no-padding-left no-padding-right">
                                    <p class="direction">Hướng: {{$item->direction?$item->direction->name:''}}</p>
                                </div>
                                <div class="col-md-6 no-padding-left no-padding-right">
                                    <p class="area1">DTSD: {{$item->area_of_use ? $item->area_of_use . 'm2' : '0m2'}}</p>
                                </div>
                                <div class="col-md-6 no-padding-left no-padding-right">
                                    <p class="place">Giá: {{$item->price}} {{$item->unit ? $item->unit->name : 'VND'}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <div class="container d-none d-md-block">
            <div class="row adv_home">
                @foreach(\App\Banner::where('location', 1)->get() as $item)
                    <div class="col-md-4">
                        <a href="{{$item->url?$item->url:'#a'}}"><img src="http://{{env('DOMAIN_BACKEND','recbook.net')}}{{$item->image}}" alt="{{$item->note}}" title="{{$item->note}}"></a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="second_box">
            <div class="container">
                <div class="row">
                    <!-- Begin Tin Mới Nhất -->
                    <div class="col-12 col-md-6 item_sc">
                        <div class="tit_box3">
                            <strong>TIN MỚI NHẤT</strong>
                            @foreach($categories as $category)
                                <a class="d-none d-md-inline-block" href="{{'/danh-muc-bds/' . $category->slug . '-c' . $category->id}}">{{$category->name}}</a>
                            @endforeach
                        </div>
                        <div class="list_product2">
                            @foreach($newestRealEstates as $item)
                                @php
                                    $images = $item->images ? json_decode($item->images) : [];
                                    $imgThumbnail = $images ? $images[0]->link : '/images/default_real_estate_image.jpg';
                                    $imgAlt = $images ? $images[0]->alt : $item->title;
                                @endphp
                                <div class="row no-gutters item">

                                    <div class="col-md-3 img_th">
                                        <a href="{{ route('detail-real-estate', ['slug' => $item->slug . '-' . $item->id]) }}">
                                            <img src="{{$imgThumbnail}}" alt="{{ $item->title }}" title="{{ $item->title }}"></a>
                                    </div>

                                    <div class="col-md-6 brief_th">
                                        <h3>
                                            <strong><a href="{{ route('detail-real-estate', ['slug' => $item->slug . '-' . $item->id]) }}">{{ $item->title }}</a></strong>
                                            <img class="vip" src="/images/new.gif" alt="{{ $item->title }}" title="{{ $item->title }}">
                                        </h3>
                                        <div>{{ $item->short_description }}</div>
                                    </div>

                                    <div class="col-md-3 info_th">
                                        <p class="price"><strong>Giá:</strong> {{$item->price}} {{$item->unit ? $item->unit->name : 'VND'}}</p>
                                        <p><strong>DTMB:</strong> {{$item->area_of_premises ? $item->area_of_premises . 'm2' : '0m2'}}</p>
                                        <p><strong>Khu vực:</strong> {{$item->province?$item->province->name:''}}</p>
                                        <p><strong>Hướng:</strong> {{$item->direction?$item->direction->name:''}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <br class="d-md-none">
                    </div>
                    <!-- End Tin Mới Nhất -->
                    <!-- Begin vip_home -->
                    <div class="col-12 col-md-6 item_sc">
                        <div class="vip_home">
                            <p>TIN ĐĂNG VIP</p>
                            <div>
                                <div class="row list_vip">
                                    @foreach($vipRealEstates as $item)
                                        @php
                                            $images = $item->images ? json_decode($item->images) : [];
                                            $imgThumbnail = $images ? $images[0]->link : '/images/default_real_estate_image.jpg';
                                            $imgAlt = $images ? $images[0]->alt : $item->title;
                                        @endphp
                                        <div class="col-12 col-md-6 item">
                                            <h4>
                                                <strong><a href="{{ route('detail-real-estate', ['slug' => $item->slug . '-' . $item->id]) }}">{{ $item->title }}</a></strong>
                                                <img src="/images/vip2.gif" alt="vip">
                                            </h4>

                                            <div class="row no-gutters">
                                                <div class="col-md-4 item_l">
                                                    <a href="{{ route('detail-real-estate', ['slug' => $item->slug . '-' . $item->id]) }}">
                                                        <img src="{{$imgThumbnail}}" alt="{{ $item->title }}" title="{{ $item->title }}"></a>
                                                </div>
                                                <div class="col-md-8 item_r">
                                                    <strong>{{$item->price}} {{$item->unit ? $item->unit->name : 'VND'}}</strong>
                                                    <p>DTMB: {{$item->area_of_premises ? $item->area_of_premises . 'm2' : '0m2'}}</p>
                                                    <p>Hướng: {{$item->direction?$item->direction->name:''}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End vip_home -->

                </div><!--row-->
            </div><!--container-->
        </div>
        <div class="container d-none d-md-block">
            <div class="row adv_home">
                @foreach(\App\Banner::where('location', 2)->get() as $item)
                    <div class="col-md-4">
                        <a href="{{$item->url?$item->url:'#a'}}"><img src="http://{{env('DOMAIN_BACKEND', 'recbook.net')}}{{$item->image}}" alt="{{$item->note}}" title="{{$item->note}}"></a>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="third_box">
            <div class="container">
                <!-- Begin Tin giá hấp dẫn -->
                <div class="tit_box3">
                    <strong>TIN GIÁ HẤP DẪN</strong>
                    @foreach($categories as $category)
                        <a class="d-none d-md-inline-block" href="{{'/danh-muc-bds/' . $category->slug . '-c' . $category->id}}">{{$category->name}}</a>
                    @endforeach
                </div>
                <div class="list_vip three_land">
                    <div class="row">
                        @foreach($goodPriceRealEstate as $item)
                            @php
                                $itemClass = '';
                                if($item->is_hot && $item->is_vip) {
                                    $itemClass = '_vip_hot';
                                }
                                if($item->is_vip && !$item->is_hot) {
                                    $itemClass = '_vip';
                                }

                                $images = $item->images ? json_decode($item->images) : [];
                                $imgThumbnail = $images ? $images[0]->link : '/images/default_real_estate_image.jpg';
                                $imgAlt = $images ? $images[0]->alt : $item->title;
                            @endphp
                            <div class="col-md-12 col-md-4 item">
                                <div class="row no-gutters">
                                    <div class="col-md-5 item_l">
                                        <a href="{{ route('detail-real-estate', ['slug' => $item->slug . '-' . $item->id]) }}">
                                            <img src="{{ asset($imgThumbnail) }}" alt="{{ $item->title }}" title="{{ $item->title }}">
                                        </a>
                                    </div>
                                    <div class="col-md-7 item_r">
                                        <strong>{{$item->price}} {{$item->unit ? $item->unit->name : 'VND'}}</strong>
                                        <p>DTMB: {{$item->area_of_premises ? $item->area_of_premises . 'm2' : '0m2'}}</p>
                                        <p>DTSD: {{$item->area_of_use ? $item->area_of_use . 'm2' : '0m2'}}</p>
                                        <p>Khu vực: {{$item->province?$item->province->name.', ':''}}{{$item->district?$item->district->name:''}}</p>
                                        <p>Hướng: {{$item->direction?$item->direction->name:''}}</p>
                                    </div>
                                </div>
                                <h4><strong><a href="{{ route('detail-real-estate', ['slug' => $item->slug . '-' . $item->id]) }}">{{ $item->title }}</a></strong></h4>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- End Tin giá hấp dẫn -->
            </div>
        </div>
        <div class="container d-none d-md-block">
            <div class="row adv_home">
                @foreach(\App\Banner::where('location', 1)->get() as $item)
                    <div class="col-md-4">
                        <a href="{{$item->url?$item->url:'#a'}}"><img src="http://{{env('DOMAIN_BACKEND','recbook.net')}}{{$item->image}}" alt="{{$item->note}}" title="{{$item->note}}"></a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="third_box">
            <div class="container">
                <!-- Begin Tin đăng cộng đồng -->
                <div class="tit_box3">
                    <strong>TIN ĐĂNG CỘNG ĐỒNG</strong>
                    @foreach($categories as $category)
                        <a class="d-none d-md-inline-block" href="{{'/danh-muc-bds/' . $category->slug . '-c' . $category->id}}">{{$category->name}}</a>
                    @endforeach
                </div>
                <div class="list_vip">
                    <div class="row">
                        @foreach($freeRealEstates as $item)
                            @php
                                $images = $item->images ? json_decode($item->images) : [];
                                $imgThumbnail = $images ? $images[0]->link : '/images/default_real_estate_image.jpg';
                                $imgAlt = $images ? $images[0]->alt : $item->title;
                            @endphp
                            <div class="col-12 col-md-3 item">
                                <div class="row no-gutters">
                                    <div class="col-md-6 item_l">
                                        <a href="{{ route('detail-real-estate', ['slug' => $item->slug . '-' . $item->id]) }}">
                                            <img src="{{ asset($imgThumbnail) }}" alt="{{ $item->title }}" title="{{ $item->title }}">
                                        </a>
                                    </div>
                                    <div class="col-md-6 item_r">
                                        <strong>{{$item->price}} {{$item->unit ? $item->unit->name : 'VND'}}</strong>
                                        <p>DTMB: {{$item->area_of_premises ? $item->area_of_premises . 'm2' : '0m2'}}</p>
                                        <p>DTSD: {{$item->area_of_use ? $item->area_of_use . 'm2' : '0m2'}}</p>
                                        <p>Khu vực: {{$item->province?$item->province->name.', ':''}}{{$item->district?$item->district->name:''}}</p>
                                        <p>Hướng: {{$item->direction?$item->direction->name:''}}</p>
                                    </div>
                                </div>
                                <h4><strong><a href="{{ route('detail-real-estate', ['slug' => $item->slug . '-' . $item->id]) }}">{{ $item->title }}</a></strong></h4>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Begin Tin đăng cộng đồng -->
            </div>
        </div>
        <div class="container d-none d-md-block">
            <div class="row adv_home">
                @foreach(\App\Banner::where('location', 1)->get() as $item)
                    <div class="col-md-4">
                        <a href="{{$item->url?$item->url:'#a'}}"><img src="http://{{env('DOMAIN_BACKEND','recbook.net')}}{{$item->image}}" alt="{{$item->note}}" title="{{$item->note}}"></a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="third_box">
            <div class="container">
                <!-- Begin Tin đăng cộng đồng -->
                <div class="tit_box3">
                    <strong>TIN RAO DỰ ÁN</strong>
                    <a class="d-none d-md-inline-block pull-right"> Xem tất cả >></a>
                </div>
                <div class="list_vip">
                    <div class="row">
                        @foreach($freeRealEstates as $item)
                            @php
                                $images = $item->images ? json_decode($item->images) : [];
                                $imgThumbnail = $images ? $images[0]->link : '/images/default_real_estate_image.jpg';
                                $imgAlt = $images ? $images[0]->alt : $item->title;
                            @endphp
                            <div class="col-12 col-md-3 item">
                                <div class="row no-gutters">
                                    <div class="col-md-6 item_l">
                                        <a href="{{ route('detail-real-estate', ['slug' => $item->slug . '-' . $item->id]) }}">
                                            <img src="{{ asset($imgThumbnail) }}" alt="{{ $item->title }}" title="{{ $item->title }}">
                                        </a>
                                    </div>
                                    <div class="col-md-6 item_r">
                                        <strong>{{$item->price}} {{$item->unit ? $item->unit->name : 'VND'}}</strong>
                                        <p>DTMB: {{$item->area_of_premises ? $item->area_of_premises . 'm2' : '0m2'}}</p>
                                        <p>DTSD: {{$item->area_of_use ? $item->area_of_use . 'm2' : '0m2'}}</p>
                                        <p>Khu vực: {{$item->province?$item->province->name.', ':''}}{{$item->district?$item->district->name:''}}</p>
                                        <p>Hướng: {{$item->direction?$item->direction->name:''}}</p>
                                    </div>
                                </div>
                                <h4><strong><a href="{{ route('detail-real-estate', ['slug' => $item->slug . '-' . $item->id]) }}">{{ $item->title }}</a></strong></h4>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Begin Tin đăng cộng đồng -->
            </div>
        </div>
    </div>
    @include(theme(TRUE).'.includes.footer')
@endsection

@push('js')
    <script src="{{ asset('plugins/OwlCarousel2-2.3.4/dist/owl.carousel.js') }}"></script>
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
        $(window).on('load',function() {
            var owl_slide = $('.slide_carousel'),
                owl_text = $('.text_carousel');
            owl_slide.owlCarousel({
                loop: true,
                autoplay:false,
                margin:8,
                responsiveClass:true,
                responsive:{
                    0:{ items:1, nav:true, dots: false },
                    600:{ items:3, nav:true, dots: false },
                    1000:{ items:3, nav:true, dots: false }
                }
            });
            owl_text.owlCarousel({
                loop: true,
                autoplay:false,
                margin:0,
                nav : true,
                responsiveClass:true,
                responsive:{
                    0:{ items:1, nav:true, dots: false },
                    600:{ items:1, nav:true, dots: false },
                    1000:{ items:1, nav:true, dots: false }
                },
            });
        });
        $(document).ready(function(){

        });
    </script>
@endpush
