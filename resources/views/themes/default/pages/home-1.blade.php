@extends(theme(TRUE).'.layouts.app-non-responsive')

@section('meta-description')
    <meta name="description" content="Home page" >
@endsection

@section('title')
    {{get_config('homeHeader', 'Recbook.vn')}}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('common-css/flexslider.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/home-1.css') }}"/>
    <style>
        .container {
            width: 1170px;
        }
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
        div.token-input-dropdown-bootstrap {
            position: absolute;
            width: 400px;
            background-color: #fff;
            overflow: hidden;
            border-left: 1px solid #ccc;
            border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            cursor: default;
            z-index: 11001;
        }
        li.token-input-token {
            max-width: 100% !important;
        }
        iframe  {
            max-width: 100%;
        }
    </style>
@endpush

@section('content')

    @include(theme(TRUE).'.includes.header-1')
    <div class="site-body">
<!--        <section class="slider container" style="margin-top: 20px">-->
<!--            <div class="col-xs-4"  style="-->
<!--    background: #000;-->
<!--    height: 274px;-->
<!--">-->
<!--                <div id="video_slide">-->
<!--                    {!! first_video_display() !!}-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-xs-2"  style="-->
<!--    background: #000;-->
<!--    height: 274px;-->
<!--">-->
<!--                <table class="table">-->
<!--                    @foreach(ads_display(1) as $k=>$item)-->
<!--                        <tr>-->
<!--                            <td style="border: black !important;"><a href="#a" class="video-list" data-content="{{$item->content}}"><strong>{{$item->note}}</strong></a></td>-->
<!--                        </tr>-->
<!--                    @endforeach-->
<!--                </table>-->
<!--            </div>-->
<!---->
<!--            <div class="col-xs-6 no-padding-left no-padding-right">-->
<!--                <div class="flexslider">-->
<!--                    <ul class="slides">-->
<!--                        @foreach(\App\Banner::where('location', 0)->get() as $item)-->
<!--                            <li>-->
<!--                                <a href="{{$item->url?$item->url:'#a'}}"><img src="http://{{env('DOMAIN_BACKEND','recbook.net')}}{{$item->image}}" height="300" /></a>-->
<!--                            </li>-->
<!--                        @endforeach-->
<!--                    </ul>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--        </section>-->
        <section class="image-section">
            <div class="row">
                <div class="col-md-3 member-register-item">
                    <div class="member-register">
                        <img src="source/images/register.png" alt="register-image">
                    </div>
                </div>
                <div class="col-md-7 vincity-itro-item">
                    <div class="vincity-intro">
<!--                        <img src="source/images/vincity.png" alt="vincity-image">-->
                        <div class="flexslider">
                            <ul class="slides">
                                @foreach(\App\Banner::where('location', 0)->get() as $item)
                                <li>
                                    <a href="{{$item->url?$item->url:'#a'}}"><img src="http://{{env('DOMAIN_BACKEND','recbook.net')}}{{$item->image}}" height="330px" /></a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 vin-list-item">
                    <div class="vin-list">
                        <ul>
                            <li>
                                <a href="">VinCity Gia Lâm</a>
                            </li>
                            <li>
                                <a href="">VinCity Đại Mỗ</a>
                            </li>
                            <li>
                                <a href="">VinHomes West Point</a>
                            </li>
                            <li>
                                <a href="">VinHomes Imperia</a>
                            </li>
                            <li>
                                <a href="">VinHomes Central Park</a>
                            </li>
                            <li>
                                <a href="">VinHomes The Harmony</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="hot-real-estate-section">
            <div class="section-title">
                BẤT ĐỘNG SẢN HOT
            </div>
            <div class="section-content ">
                <div class="section-content__list slider slider-section" id="real-estate">
                    @foreach($vip[1] as $item)
                        <div class="section-content__item">
                        <div class="section-content__item__image">
                            <div class="item__image">
                                <a href="{{ route('detail-real-estate', ['slug' => $item->slug . '-' . $item->id]) }}">
                                    @php
                                    $images = $item->images ? json_decode($item->images) : [];
                                    $imgThumbnail = $images ? $images[0]->link : '/images/default_real_estate_image.jpg';
                                    $imgAlt = $images ? $images[0]->alt : $item->title;
                                    @endphp
                                    <img src="{{asset($imgThumbnail)}}" alt="{{ $imgAlt }}">
                                </a>
                            </div>
                            <div class="section-content__image__label__top">
                                <div class="label__top__type">
                                    <img src="source/images/label-hot-icon.png" alt="">
                                    <span>HOT</span>
                                </div>
                                <div class="label__top__id">
                                    {{ $item->code }}
                                </div>
                            </div>
                            <div class="section-content__image__label__bottom">
                                <div class= "label__bottom__type">
                                    <span>{{$item->re_category_id?$item->reCategory->name:'BÁN'}}</span>
                                </div>
                                <div class="label__bottom__price">
                                    <span>
                                        @if($item->price)
                                            {{convert_number_to_words($item->price)}} {{$item->unit ? $item->unit->name : 'VND'}}
                                        @else
                                            {{'Thỏa thuận'}}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="section-content__item__description">
                            <div class="item__description__type" style="text-transform: uppercase;">
                                [{{$item->re_type_id?$item->reType->name:'NHA RIENG'}}]
                            </div>
                            <div class="item__description__title">
                                <a href="{{ route('detail-real-estate', ['slug' => $item->slug . '-' . $item->id]) }}">
                                    {{ $item->title }}
                                </a>
                            </div>
                            <div class="item__description__info">
                                <div class="item__description__date item__description__info__item">
                                    <img src="source/images/time-icon.png">
                                    {{ $item->post_date }}
                                </div>
                                <div class="item__description__location item__description__info__item">
                                    <img src="source/images/location-icon.png">
                                    {{$item->district?$item->district->name:''}}
                                    {{$item->district?',':''}}
                                    {{$item->province?$item->province->name:''}}
                                </div>
                                <div class="item__description__direction item__description__info__item">
                                    <img src="source/images/direction-icon.png">
                                    {{$item->direction?$item->direction->name:''}}
                                </div>
                                <div class="item__description__house-inform item__description__info__item">
                                    <div class="item__inform__bedroom house-inform__item">
                                        <img src="source/images/bedroom-icon.png">
                                        PN:{{$item->living_room?$item->living_room:'Liên hệ'}}
                                    </div>
                                    <div class="item__inform__bathroom house-inform__item">
                                        <img src="source/images/bathroom-icon.ong.png">
                                        PT:{{$item->living_room?$item->wc:'Liên hệ'}}
                                    </div>
                                    <div class="item__inform__acreage house-inform__item">
                                        <img src="source/images/acreage-icon.png">
                                        DT:{{$item->area_of_premises?$item->area_of_premises:'Liên hệ'}}m2
                                    </div>
                                </div>
                                <div class="item__description__website item__description__info__item">
                                    <img src="source/images/website-icon.png">
                                    {{$item->customer_id?$item->customer->name:'Batdongsan.vn'}}
                                    <img src="source/images/tick-icon.png" alt="" style="margin-left: 5px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="link-section">
            <div class="section-title">
                SÀN LIÊN KẾT
            </div>
            <div class="section-content">
                <div class="section-content__list slider slider-section">
                    <div class="section-content__item">
                        <a href="">
                            <img src="source/images/sanlienket.png" alt="">
                        </a>
                    </div>
                    <div class="section-content__item">
                        <a href="">
                            <img src="source/images/sanlienket.png" alt="">
                        </a>
                    </div>
                    <div class="section-content__item">
                        <a href="">
                            <img src="source/images/sanlienket.png" alt="">
                        </a>
                    </div>
                    <div class="section-content__item">
                        <a href="">
                            <img src="source/images/sanlienket.png" alt="">
                        </a>
                    </div>
                    <div class="section-content__item">
                        <a href="">
                            <img src="source/images/sanlienket.png" alt="">
                        </a>
                    </div>
                    <div class="section-content__item">
                        <a href="">
                            <img src="source/images/sanlienket.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="broker-section">
            <div class="section-title">
                NHÀ MÔI GIỚI CÁ NHÂN
            </div>
            <div class="section-content">
                <div class="section-content__list slider slider-section">
                    <div class="section-content__item">
                        <div class="section-content__item__image">
                            <div class="item__image">
                                <img src="source/images/nhamoigioi.png" alt="">
                            </div>
                        </div>
                        <div class="section-content__item__infomation">
                            <div class="item__infomation__name">
                                Janet Richmond
                            </div>
                            <div class="item__infomation__phone">
                                <img src="source/images/broker-phone.png" alt="">
                                <a href="callto: 849888888888">+84 988 888 8888</a>
                            </div>
                            <div class="item__infomation__mail">
                                <img src="source/images/broker-mail.png" alt="">
                                <a href="mailto:janet.richmond@gmail.com">janet.richmond@gmail.com</a>
                            </div>
                        </div>
                    </div>
                    <div class="section-content__item">
                        <div class="section-content__item__image">
                            <div class="item__image">
                                <img src="source/images/nhamoigioi.png" alt="">
                            </div>
                        </div>
                        <div class="section-content__item__infomation">
                            <div class="item__infomation__name">
                                Janet Richmond
                            </div>
                            <div class="item__infomation__phone">
                                <img src="source/images/broker-phone.png" alt="">
                                <a href="callto: 849888888888">+84 988 888 8888</a>
                            </div>
                            <div class="item__infomation__mail">
                                <img src="source/images/broker-mail.png" alt="">
                                <a href="mailto:janet.richmond@gmail.com">janet.richmond@gmail.com</a>
                            </div>
                        </div>
                    </div>
                    <div class="section-content__item">
                        <div class="section-content__item__image">
                            <div class="item__image">
                                <img src="source/images/nhamoigioi.png" alt="">
                            </div>
                        </div>
                        <div class="section-content__item__infomation">
                            <div class="item__infomation__name">
                                Janet Richmond
                            </div>
                            <div class="item__infomation__phone">
                                <img src="source/images/broker-phone.png" alt="">
                                <a href="callto: 849888888888">+84 988 888 8888</a>
                            </div>
                            <div class="item__infomation__mail">
                                <img src="source/images/broker-mail.png" alt="">
                                <a href="mailto:janet.richmond@gmail.com">janet.richmond@gmail.com</a>
                            </div>
                        </div>
                    </div>
                    <div class="section-content__item">
                        <div class="section-content__item__image">
                            <div class="item__image">
                                <img src="source/images/nhamoigioi.png" alt="">
                            </div>
                        </div>
                        <div class="section-content__item__infomation">
                            <div class="item__infomation__name">
                                Janet Richmond
                            </div>
                            <div class="item__infomation__phone">
                                <img src="source/images/broker-phone.png" alt="">
                                <a href="callto: 849888888888">+84 988 888 8888</a>
                            </div>
                            <div class="item__infomation__mail">
                                <img src="source/images/broker-mail.png" alt="">
                                <a href="mailto:janet.richmond@gmail.com">janet.richmond@gmail.com</a>
                            </div>
                        </div>
                    </div>
                    <div class="section-content__item">
                        <div class="section-content__item__image">
                            <div class="item__image">
                                <img src="source/images/nhamoigioi.png" alt="">
                            </div>
                        </div>
                        <div class="section-content__item__infomation">
                            <div class="item__infomation__name">
                                Janet Richmond
                            </div>
                            <div class="item__infomation__phone">
                                <img src="source/images/broker-phone.png" alt="">
                                <a href="callto: 849888888888">+84 988 888 8888</a>
                            </div>
                            <div class="item__infomation__mail">
                                <img src="source/images/broker-mail.png" alt="">
                                <a href="mailto:janet.richmond@gmail.com">janet.richmond@gmail.com</a>
                            </div>
                        </div>
                    </div>
                    <div class="section-content__item">
                        <div class="section-content__item__image">
                            <div class="item__image">
                                <img src="source/images/nhamoigioi.png" alt="">
                            </div>
                        </div>
                        <div class="section-content__item__infomation">
                            <div class="item__infomation__name">
                                Janet Richmond
                            </div>
                            <div class="item__infomation__phone">
                                <img src="source/images/broker-phone.png" alt="">
                                <a href="callto: 849888888888">+84 988 888 8888</a>
                            </div>
                            <div class="item__infomation__mail">
                                <img src="source/images/broker-mail.png" alt="">
                                <a href="mailto:janet.richmond@gmail.com">janet.richmond@gmail.com</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="vip-news-section">
            <div class="row">
                <div class="col-md-8">
                    <div class="hightlights-vip-news">
                        <div class="section-title">
                            TIN VIP NỔI BẬT
                            <div class="search-form">
                                <form>
                                    <input type="text" placeholder="Tìm kiếm mã số tin, sđt, từ khóa">
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="hightlights-vip-news__content">
                            <div class="row vip-news__list">
                                @foreach($goodPriceRealEstateVipHot as $item)
                                    <div class="col-md-4 vip-news__item">
                                        <div class="section-content__item">
                                            <div class="section-content__item__image">
                                                <div class="item__image">
                                                    <a href="{{ route('detail-real-estate', ['slug' => $item->slug . '-' . $item->id]) }}">
                                                        @php
                                                        $images = $item->images ? json_decode($item->images) : [];
                                                        $imgThumbnail = $images ? $images[0]->link : '/images/default_real_estate_image.jpg';
                                                        $imgAlt = $images ? $images[0]->alt : $item->title;
                                                        @endphp
                                                        <img src="{{asset($imgThumbnail)}}" alt="{{ $imgAlt }}">
                                                    </a>
                                                </div>
                                                <div class="section-content__image__label__top">
                                                    <div class="label__top__type">
                                                        <img src="source/images/label-vip-icon.png" alt="">
                                                        <span>VIP</span>
                                                    </div>
                                                    <div class="label__top__id">
                                                        {{ $item->code }}
                                                    </div>
                                                </div>
                                                <div class="section-content__image__label__bottom">
                                                    <div class= "label__bottom__type">
                                                        <span>{{$item->re_category_id?$item->reCategory->name:'BÁN'}}</span>
                                                    </div>
                                                    <div class="label__bottom__price">
                                                    <span>
                                                        @if($item->price)
                                                            {{convert_number_to_words($item->price)}} {{$item->unit ? $item->unit->name : 'VND'}}
                                                        @else
                                                            {{'Thỏa thuận'}}
                                                        @endif
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="section-content__item__description">
                                                <div class="item__description__type">
                                                    [{{$item->re_type_id?$item->reType->name:'NHA RIENG'}}]
                                                </div>
                                                <div class="item__description__title content-title">
                                                    <a href="">
                                                        <p>{{ $item->title }}</p>
                                                    </a>
                                                </div>
                                                <div class="item__description__info">
                                                    <div class="item__description__date item__description__info__item">
                                                        <img src="source/images/time-icon.png">
                                                        {{ $item->post_date }}
                                                    </div>
                                                    <div class="item__description__location item__description__info__item">
                                                        <img src="source/images/location-icon.png">
                                                        {{$item->district?$item->district->name:''}}
                                                        {{$item->district?',':''}}
                                                        {{$item->province?$item->province->name:''}}
                                                    </div>
                                                    <div class="item__description__direction item__description__info__item">
                                                        <img src="source/images/direction-icon.png">
                                                        {{$item->direction?$item->direction->name:''}}
                                                    </div>
                                                    <div class="item__description__house-inform item__description__info__item">
                                                        <div class="item__inform__bedroom house-inform__item">
                                                            <img src="source/images/bedroom-icon.png">
                                                            PN:{{$item->living_room?$item->living_room:'Liên hệ'}}
                                                        </div>
                                                        <div class="item__inform__bathroom house-inform__item">
                                                            <img src="source/images/bathroom-icon.ong.png">
                                                            PT:{{$item->living_room?$item->wc:'Liên hệ'}}
                                                        </div>
                                                        <div class="item__inform__acreage house-inform__item">
                                                            <img src="source/images/acreage-icon.png">
                                                            DT:{{$item->area_of_premises?$item->area_of_premises:'Liên hệ'}}m2
                                                        </div>
                                                    </div>
                                                    <div class="item__description__website item__description__info__item">
                                                        <img src="source/images/website-icon.png">
                                                        {{$item->customer_id?$item->customer->name:'Batdongsan.vn'}}
                                                        <img src="source/images/tick-icon.png" alt="" style="margin-left: 5px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="vip-news">
                        <div class="section-title">
                            TIN VIP
                        </div>
                        <div class="vip-news__content">
                            <div class="row vip-news__list">
                                @foreach($vipRealEstates as $item)
                                <div class="col-md-6 vip-news__item">
                                    <div class="section-content__item">
                                        <div class="section-content__item__image">
                                            <div class="item__image">
                                                <a href="{{ route('detail-real-estate', ['slug' => $item->slug . '-' . $item->id]) }}">
                                                    @php
                                                    $images = $item->images ? json_decode($item->images) : [];
                                                    $imgThumbnail = $images ? $images[0]->link : '/images/default_real_estate_image.jpg';
                                                    $imgAlt = $images ? $images[0]->alt : $item->title;
                                                    @endphp
                                                    <img src="{{asset($imgThumbnail)}}" alt="{{ $imgAlt }}">
                                                </a>
                                            </div>
                                            <div class="section-content__image__label__top">
                                                <div class="label__top__type">
                                                    <img src="source/images/label-vip-icon.png" alt="">
                                                    <span>VIP</span>
                                                </div>
                                                <div class="label__top__id">
                                                    {{ $item->code }}
                                                </div>
                                            </div>
                                            <div class="section-content__image__label__bottom">
                                                <div class= "label__bottom__type">
                                                    <span>{{$item->re_category_id?$item->reCategory->name:'BÁN'}}</span>
                                                </div>
                                                <div class="label__bottom__price">
                                                    <span>
                                                        @if($item->price)
                                                            {{convert_number_to_words($item->price)}} {{$item->unit ? $item->unit->name : 'VND'}}
                                                        @else
                                                            {{'Thỏa thuận'}}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="section-content__item__description">
                                            <div class="item__description__type">
                                                [{{$item->re_type_id?$item->reType->name:'NHA RIENG'}}]
                                            </div>
                                            <div class="item__description__title content-title">
                                                <a href="">
                                                    <p>{{ $item->title }}</p>
                                                </a>
                                            </div>
                                            <div class="item__description__info">
                                                <div class="item__description__date item__description__info__item">
                                                    <img src="source/images/time-icon.png">
                                                    {{ $item->post_date }}
                                                </div>
                                                <div class="item__description__location item__description__info__item">
                                                    <img src="source/images/location-icon.png">
                                                    {{$item->district?$item->district->name:''}}
                                                    {{$item->district?',':''}}
                                                    {{$item->province?$item->province->name:''}}
                                                </div>
                                                <div class="item__description__direction item__description__info__item">
                                                    <img src="source/images/direction-icon.png">
                                                    {{$item->direction?$item->direction->name:''}}
                                                </div>
                                                <div class="item__description__house-inform item__description__info__item">
                                                    <div class="item__inform__bedroom house-inform__item">
                                                        <img src="source/images/bedroom-icon.png">
                                                        PN:{{$item->living_room?$item->living_room:'x'}}
                                                    </div>
                                                    <div class="item__inform__bathroom house-inform__item">
                                                        <img src="source/images/bathroom-icon.ong.png">
                                                        PT:{{$item->living_room?$item->wc:'x'}}
                                                    </div>
                                                    <div class="item__inform__acreage house-inform__item">
                                                        <img src="source/images/acreage-icon.png">
                                                        DT:{{$item->area_of_premises?$item->area_of_premises:'x'}}m2
                                                  </div>
                                                </div>
                                                <div class="item__description__website item__description__info__item">
                                                    <img src="source/images/website-icon.png">
                                                    {{$item->customer_id?$item->customer->name:'Batdongsan.vn'}}
                                                    <img src="source/images/tick-icon.png" alt="" style="margin-left: 5px;">
                                                </div>
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
        </section>

        <section class="banner-section">
            <div class="row banner-list">
                <div class="col-md-6 banner-item-1">
                    <img src="source/images/condotel.png" alt="condotel-image">
                </div>
                <div class="col-md-6 banner-item-2">
                    <img src="source/images/metropolis.png" alt="metropolis-image">
                </div>
            </div>
        </section>

        <section class="price-news-section">
            <div class="section-title">
                TIN GIÁ HẤP DẪN
                <div class="search-form">
                    <form>
                        <input type="text" placeholder="Tìm kiếm mã số tin, sđt, từ khóa">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="section-content">
                <div class="section-content__list">
                    <div class="row price-news__list">
                        @foreach($vip[4] as $item)
                            <div class="col-md-2 price-news__item">
                                <div class="section-content__item">
                                <div class="section-content__item__image">
                                    <div class="item__image">
                                        <a href="{{ route('detail-real-estate', ['slug' => $item->slug . '-' . $item->id]) }}">
                                            @php
                                            $images = $item->images ? json_decode($item->images) : [];
                                            $imgThumbnail = $images ? $images[0]->link : '/images/default_real_estate_image.jpg';
                                            $imgAlt = $images ? $images[0]->alt : $item->title;
                                            @endphp
                                            <img src="{{asset($imgThumbnail)}}" alt="{{ $imgAlt }}">
                                        </a>
                                    </div>
                                    <div class="section-content__image__label__top">
                                        <div class="label__top__id">
                                            {{ $item->code }}
                                        </div>
                                    </div>
                                    <div class="section-content__image__label__bottom">
                                        <div class= "label__bottom__type">
                                            <span>{{$item->re_category_id?$item->reCategory->name:'BÁN'}}</span>
                                        </div>
                                        <div class="label__bottom__price">
                                            <span>
                                                @if($item->price)
                                                    {{convert_number_to_words($item->price)}} {{$item->unit ? $item->unit->name : 'VND'}}
                                                @else
                                                    {{'Thỏa thuận'}}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="section-content__item__description">
                                    <div class ="item__description__top">
                                        <div class="item__description__type">
                                            [{{$item->re_type_id?$item->reType->name:'NHA RIENG'}}]
                                        </div>
                                        <div class="item__description__location">
                                            <img src="source/images/location-icon.png">
                                            {{$item->province?$item->province->name:''}}
                                        </div>
                                    </div>
                                    <div class="item__description__title content-title">
                                        <a href="">
                                            <p>{{ $item->title }}</p>
                                        </a>
                                    </div>
                                    <div class="item__description__info">

                                        <div class="item__description__direction item__description__info__item">
                                            <img src="source/images/direction-icon.png">
                                            {{$item->direction?$item->direction->name:''}}
                                        </div>
                                        <div class="item__description__house-inform item__description__info__item">
                                            <div class="item__inform__acreage house-inform__item">
                                                <img src="source/images/acreage-icon.png">
                                                {{$item->area_of_premises?$item->area_of_premises:'x'}}m2
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

<!--        phuongend-->



        <section class="addition_info">
            <div class="container">
                <div class="row  three_cols">
                    <div class="col-xs-12 col-sm-12 three_i brokers">

                        <p class="title_col">
                            <a href="{{ route('tin-noi-bat') }}"><i class="fa fa-users"></i> BẤT ĐỘNG SẢN NỔI BẬT</a>
                        </p>
                        <div class="" style="margin-top: 10px">
                            <div class="vip3 list-re-item list-hot">
                                @foreach($vip[2] as $item)
                                    <div class="col-xs-3 item">
                                        <div class="col-xs-12 re-item hot">
                                            <a href="{{ route('detail-real-estate', ['slug' => $item->slug . '-' . $item->id]) }}">
                                                @php
                                                    $images = $item->images ? json_decode($item->images) : [];
                                                    $imgThumbnail = $images ? $images[0]->link : '/images/default_real_estate_image.jpg';
                                                    $imgAlt = $images ? $images[0]->alt : $item->title;
                                                @endphp
                                                <img src="{{asset($imgThumbnail)}}" alt="{{ $imgAlt }}">
                                            </a>
                                            <div class="code_row">{{ $item->code }}</div>

                                            <h3>
                                                <a style="font-size: 12px" href="{{ route('detail-real-estate', ['slug' => $item->slug . '-' . $item->id]) }}">{{ $item->title }}</a>
                                            </h3>

                                            @php
                                                $shortDes = trim_text($item->detail, 130);
                                            @endphp

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="content col-xs-12 no-padding-left no-padding-right broker_slider">

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="good_price">
            <div class="container">
                <div class="row two_cols">
                    <div class="col-xs-12 col-xs-9 col_left no-padding-left">
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
                                    @foreach($vip[4] as $item)
                                        <div class="col-xs-12 col-sm-6 col-xs-6  good_price_item_wrap">
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
                                                <div class="row _vip_hot">
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
                                                        @php
                                                            $shortDes = trim_text($item->detail, 130);
                                                        @endphp
                                                        <div class="short-des">{!! $item->short_description ? $item->short_description : ($shortDes ? $shortDes : '') !!}
                                                        </div>
                                                        <p>
                                                            <strong>DTMB:</strong> {{$item->area_of_premises ? ( (ceil($item->area_of_premises) - $item->area_of_premises) != 0 ? $item->area_of_premises : ceil($item->area_of_premises)) . 'm2' : '0m2'}}</p><p> <strong>Giá:</strong>
                                                            <span>
                                                                @if ($item->price)
                                                                    {{convert_number_to_words($item->price)}} {{$item->unit ? $item->unit->name : 'VND'}}
                                                                @else
                                                                    {{'Thỏa thuận'}}
                                                                @endif
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
                                    @foreach($vip[3] as $item)
                                        <div class="col-xs-12 col-sm-6 col-xs-6  good_price_item_wrap">
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
                                                <div class="row _vip">
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
                                                        @php
                                                            $shortDes = trim_text($item->detail, 130);
                                                        @endphp
                                                        <div class="short-des">{!! $item->short_description ? $item->short_description : ($shortDes ? $shortDes : '') !!}
                                                        </div>
                                                        <p>
                                                            <strong>DTMB:</strong> {{$item->area_of_premises ? ( (ceil($item->area_of_premises) - $item->area_of_premises) != 0 ? $item->area_of_premises : ceil($item->area_of_premises)) . 'm2' : '0m2'}} </p><p><strong>Giá:</strong>
                                                            <span>
                                                                @if ($item->price)
                                                                {{convert_number_to_words($item->price)}} {{$item->unit ? $item->unit->name : 'VND'}}
                                                                @else
                                                                    {{'Thỏa thuận'}}
                                                                @endif
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
                                    @foreach($vip[5] as $item)
                                        <div class="col-xs-12 col-sm-6 col-xs-6  good_price_item_wrap">
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
                                                        @php
                                                            $shortDes = trim_text($item->detail, 130);
                                                        @endphp
                                                        <div class="short-des">{!! $item->short_description ? $item->short_description : ($shortDes ? $shortDes : '') !!}
                                                        </div>
                                                        <p>
                                                            <strong>DTMB:</strong> {{$item->area_of_premises ? ( (ceil($item->area_of_premises) - $item->area_of_premises) != 0 ? $item->area_of_premises : ceil($item->area_of_premises)) . 'm2' : '0m2'}} </p><p><strong>Giá:</strong>
                                                            <span>
                                                                @if ($item->price)
                                                                {{convert_number_to_words($item->price)}} {{$item->unit ? $item->unit->name : 'VND'}}
                                                                @else
                                                                    {{'Thỏa thuận'}}
                                                                @endif
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
                    <div class="col-xs-3 col_right no-padding-right">
                    @include(theme(TRUE).'.includes.vip-slide', ['vipRealEstates'=>$vip[6]])
                        <div class="agency list-re-item" style="margin-top: 10px">
                            <p class="title_box">
                                <a href="{{route('nha-moi-gioi')}}">
                                    <strong>NHÀ MÔI GIỚI</strong>
                                </a>
                            </p>
                            @foreach($agencies as $agency)
                                <div class="col-xs-6 no-padding-left no-padding-right">
                                    <div class="col-xs-12 re-item hot" style="border: 1px solid #eee;
    background: #fffce6;">
                                        <a href="{{asset('user/'.$agency->id)}}" style="height: 100px; overflow: hidden;" class="text-center">
                                            <?php
                                                if(!empty($size = getimagesize($agency->avatar()))){
                                                    $w = $size[0];
                                                    $h = $size[1];
                                                    if($w > $h)
                                                        $css = 'height: 100%; width: auto';
                                                    else
                                                        $css = 'width: 100%; height: auto';
                                                }
                                                else
                                                    $w = $h = 1024;
                                            ?>
                                            <img src="{{$agency->avatar()}}" style="{{$css}}" alt="" class="img-responsive">
                                        </a>
                                        <h3>
                                            <a style="font-size: 12px" href="{{asset('user/'.$agency->id)}}">{{$agency->userinfo?$agency->userinfo->full_name:$agency->name}}</a>
                                        </h3>

                                        @php
                                            $shortDes = trim_text($item->detail, 130);
                                        @endphp
                                    </div>
                                </div>
                            @endforeach
                        </div>
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
                                                        @php
                                                            $shortDes = trim_text($item->detail, 130);
                                                        @endphp
                                                        <div class="short-des">{!! $item->short_description ? $item->short_description : ($shortDes ? $shortDes : '') !!}
                                                        </div>
                                                        <p>
                                                            <strong>DTMB:</strong> {{$item->area_of_premises ? ( (ceil($item->area_of_premises) - $item->area_of_premises) != 0 ? $item->area_of_premises : ceil($item->area_of_premises)) . 'm2' : '0m2'}} </p><p> <strong>Giá:</strong>
                                                            <span>
                                                                @if ($item->price)
                                                                {{convert_number_to_words($item->price)}} {{$item->unit ? $item->unit->name : 'VND'}}
                                                                @else
                                                                    {{'Thỏa thuận'}}
                                                                @endif
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
                        <div class="col-xs-4">
                            <p class="title_box">
                                <strong>Tin tức</strong>
                            </p>
                                @foreach(\App\Post::orderBy('created_at', 'desc')->take(3)->get() as $item)
                                    <dl>
                                        <div class="row">
                                            <dt class="col-xs-4"><a href="{{ route('postdetail', ['slugchitiet' => $item->slugchitiet]) }}"><img width="100px" height="100px" src="/images/default_thumb.jpg" alt="DỰ ÁN LÀNG VIỆT KIỀU QUỐC TẾ HẢI PHÒNG"></a></dt>
                                            <dd class="col-xs-8">
                                                <a style="color: #0c4da2; font-size: 14px; font-weight: bold; text-transform: uppercase" href="{{ route('postdetail', ['slugchitiet' => $item->slugchitiet]) }}">{{$item->title}}</a>
                                                <p style="color: grey"><em>{{\Carbon\Carbon::parse($item->created_at)->format('d/m/Y')}}</em></p>
                                                <div>{!! trim_text($item->content,130) !!}</div>
                                            </dd>
                                        </div>
                                    </dl>
                                @endforeach
                        </div>
                        <div class="col-xs-8">
                            <p class="title_box">
                                <strong>YÊU CẦU</strong>
                            </p>
                            <div>

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#all" aria-controls="home" role="tab" data-toggle="tab">Tất cả dự án</a></li>
                                    <li role="presentation"><a href="#realestate" aria-controls="home" role="tab" data-toggle="tab">Bất động sản</a></li>
                                    <li role="presentation"><a href="#finance" aria-controls="profile" role="tab" data-toggle="tab">Tư vấn tài chính</a></li>
                                    <li role="presentation"><a href="#design" aria-controls="messages" role="tab" data-toggle="tab">Thiết kế</a></li>
                                    <li role="presentation"><a href="#phongthuy" aria-controls="settings" role="tab" data-toggle="tab">Phong thuỷ</a></li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="all">
                                        <table class="table">
                                            <tr>
                                                <th width="50%">Tiêu đề</th>
                                                <th>Ngân sách</th>
                                                <th>Mở chào giá đến</th>
                                                <th>Chào giá</th>
                                            </tr>
                                            @foreach($freelancer['all'] as $item)
                                                <tr>
                                                    <td><a href="{{route('freelancerDetail', ['id'=>$item->id, 'slug'=>to_slug($item->title)])}}"><strong>{{$item->title}}</strong></a></td>
                                                    <td><a href="{{route('freelancerDetail', ['id'=>$item->id, 'slug'=>to_slug($item->title)])}}">{{convert_number_to_words($item->budget)}}</a></td>
                                                    <td><a href="{{route('freelancerDetail', ['id'=>$item->id, 'slug'=>to_slug($item->title)])}}">{{Carbon\Carbon::parse($item->end_at)->diffForHumans(\Carbon\Carbon::now())}}</a></td>
                                                    <td><a href="{{route('freelancerDetail', ['id'=>$item->id, 'slug'=>to_slug($item->title)])}}">{{$item->deals()->count()}}</a></td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="realestate">
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
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    @include(theme(TRUE).'.includes.footer')

    <link rel="stylesheet" href="{{ asset('css/main-1.css') }}"/>
    <link rel="stylesheet" href="{{asset('plugins/jquery.tokenInput/token-input.css')}}" />
    <link rel="stylesheet" href="{{asset('plugins/loopj-jquery-tokeninput/styles/token-input.css')}}" />
    <link rel="stylesheet" href="{{asset('plugins/loopj-jquery-tokeninput/styles/token-input-bootstrap3.css')}}" />
@endsection

@push('js')
    <script src="{{ asset('js/jquery.flexslider.js') }}"></script>
    <script src="{{asset('plugins\loopj-jquery-tokeninput\src\jquery.tokeninput.js')}}" ></script>
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

        // auto modal
        $('.table').on('click', '.video-list', function () {
            // console.log(check);
            var content   =   $(this).data('content');

            console.log(content);

            $('#video_slide').html(content);
        });

        $(document).ready(function(){


            @if (empty(session('tinhthanhquantam')))
            // $(window).load(function() {
            $('#myModal').modal({backdrop: 'static', keyboard: false});
            $('#myModal').modal('show');
            $('.province').tokenInput("{{asset('/ajax/province')}}", {
                theme: "bootstrap",
                queryParam: "term",
                zindex  :   9999,
                tokenLimit  :   1,
                hintText : 'Nhập tên tỉnh thành để tìm kiếm',
                onAdd   :   function(r){
                    $('#method').val(r.method);
                }
            });

            // });
            @endif
            $('.vip3').bxSlider({
                auto: true,
                speed: 500,
                slideSelector: 'div.item',
                minSlides: 1,
                maxSlides: 5,
                moveSlides: 5,
                slideWidth: 225,
                pager: false
            });
        });
    </script>
@endpush
