@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="{{object_get($data, 'title')}}">
@endsection

@section('title')
    {{object_get($data, 'title')}}
@endsection

@push('style')
    {{-- Link css for page here --}}
    <link rel="stylesheet" href="{{ asset('css/detail-real-estate.css') }}"/>
@endpush

@section('content')
    {{-- Include Header --}}
    @include(theme(TRUE).'.includes.header')
    {{--Page html content --}}
    <div class="content-body">
        <div class="container padding-top-30 padding-bottom-30">
            <div class="row">
                <div class="col-xs-12 col-md-9 detail-content-wrap">
                    <p class="title_box"><strong>{{ $data->reCategory->name }} <i class="fa fa-angle-right"></i> {{ $data->reType->name }} (1416)</strong>
                    </p>
                    <div class="detail-content">
                        <h1 class="title">{{$data->title}}</h1>
                        <div class="imgs_land_box slide-images row">
                            <div class="col-xs-10 slide-images__left">
                                <ul class="land_slider">
                                    <li>
                                        <div>
                                            <img src="http://nhadathaiphong.vn/images/attachment/46321.jpg"/>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <img src="http://nhadathaiphong.vn/images/attachment/315510.jpg"/>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <img src="http://nhadathaiphong.vn/images/attachment/17755.jpg"/>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <img src="http://nhadathaiphong.vn/images/attachment/25294.jpg"/>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <img src="http://nhadathaiphong.vn/images/attachment/98623.jpg"/>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xs-2 slide-images__right no-padding-right">
                                <div id="land_slider_pager">
                                    <a data-slide-index="0" href="" class="">
                                       <span>
                                           <em style="display: block; line-height: 70px; width: 75px; text-align: center; font-weight: bold; font-size: 16px; color: #000;">
                                               VIDEO
                                           </em>
                                       </span>
                                    </a>
                                    <a data-slide-index="1" href="" class="">
                                       <span>
                                           <img src="http://nhadathaiphong.vn/images/attachment/thumb/315510.jpg">
                                       </span>
                                    </a>
                                    <a data-slide-index="2" href="" class="">
                                       <span>
                                           <img src="http://nhadathaiphong.vn/images/attachment/thumb/39599.jpg">
                                       </span>
                                    </a>
                                    <a data-slide-index="3" href="" class="">
                                        <span>
                                            <img src="http://nhadathaiphong.vn/images/attachment/thumb/31498.jpg">
                                        </span>
                                    </a>
                                    <a data-slide-index="4" href="" class="">
                                        <span>
                                            <img src="http://nhadathaiphong.vn/images/attachment/thumb/11767.jpg">
                                        </span>
                                    </a>
                                    <a data-slide-index="5" href="" class="">
                                        <span>
                                            <img src="http://nhadathaiphong.vn/images/attachment/thumb/35676.jpg">
                                        </span>
                                    </a>
                                    {{--<a data-slide-index="6" href="" class="">--}}
                                    {{--<span>--}}
                                    {{--<img src="images/attachment/thumb/41785.jpg">--}}
                                    {{--</span>--}}
                                    {{--</a>--}}
                                    {{--<a data-slide-index="7" href="" class="">--}}
                                    {{--<span>--}}
                                    {{--<img src="images/attachment/thumb/14944.jpg">--}}
                                    {{--</span>--}}
                                    {{--</a>--}}
                                    {{--<a data-slide-index="8" href="" class="active">--}}
                                    {{--<span>--}}
                                    {{--<img src="images/attachment/thumb/90082.jpg">--}}
                                    {{--</span>--}}
                                    {{--</a>--}}
                                    {{--<a data-slide-index="9" href="" class="">--}}
                                    {{--<span>--}}
                                    {{--<img src="images/attachment/thumb/8713.jpg">--}}
                                    {{--</span>--}}
                                    {{--</a>--}}
                                    {{--<a data-slide-index="10" href="">--}}
                                    {{--<span>--}}
                                    {{--<img src="images/attachment/thumb/46321.jpg">--}}
                                    {{--</span>--}}
                                    {{--</a>							--}}
                                </div>
                            </div>
                        </div>
                        <h2 class="title-second">{{$data->title}}</h2>
                        <div class="brief_detail row">
                            <div class="col-xs-12 col-sm-8 brief_detail__left">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <p><strong>- Mã số tin:</strong> HP-9047</p>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <p><strong>- Ngày cập nhật:</strong> {{ \Carbon\Carbon::parse($data->updated_at)->format('d/m/Y')}}</p>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <p><strong>- Lượt xem:</strong> 7909</p>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <p><strong>- Ngày hết hạn:</strong> {{ \Carbon\Carbon::parse($data->expire_date)->format('d/m/Y')}}</p>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <p><strong>- DTMB:</strong> {{ $data->area_of_premises }}</p>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <p><strong>- DTSD:</strong> {{ $data->area_of_use }}</p>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <p><strong>- Danh mục:</strong> {{ $data->reCategory->name }}</p>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <p><strong>- Loại BĐS:</strong> {{ $data->reType->name }}</p>
                                    </div>
                                    <div class="col-xs-12">
                                        <p><strong>- Địa chỉ:</strong> {{ $data->address }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 brief_detail__right">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <p class="price"><strong>{{ trans('detail-real-estate.briefDetail.price') }}
                                                :</strong> {{ $data->price }} {{ $data->unit->name }}</p>
                                        <p class="is_deal">{{ $data->is_deal ? '(Có thỏa thuận)' : '' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="title-short-section">Mô tả chi tiết:</div>
                        <div class="description short-section">
                            <div class="row margin-0">
                                <div class="col-xs-12 col-sm-4 description__item"><strong>Chiều rộng:</strong> {{ $data->width ? $data->width : '0m2' }}</div>
                                <div class="col-xs-12 col-sm-4 description__item"><strong>Chiều dài:</strong> {{ $data->length ? $data->length : '0m2' }}</div>
                                <div class="col-xs-12 col-sm-4 description__item"><strong>Giấy tờ:</strong> Sổ đỏ Chính
                                    Chủ
                                </div>
                            </div>
                            <div class="row margin-0">
                                <div class="col-xs-12 col-sm-4 description__item"><strong>Diện tích MB:</strong> {{ $data->area_of_premises ? $data->area_of_premises : '0m2' }}
                                </div>
                                <div class="col-xs-12 col-sm-4 description__item"><strong>Diện tích SD:</strong> {{ $data->area_of_use ? $data->area_of_use : '0m2' }}
                                </div>
                                <div class="col-xs-12 col-sm-4 description__item"><strong>Hướng:</strong> {{ $data->direction->name }}</div>
                            </div>
                            <div class="row margin-0">
                                <div class="col-xs-12 description__item">
                                    <strong>Tên dự án:</strong> {{ $data->project->name }}
                                </div>
                            </div>
                            <div class="row margin-0">
                                <div class="col-xs-12 description__item">
                                    <h3 class="description__title">Thông tin chi tiết:</h3>
                                    <div class="description__body">
                                            {!! $data->detail !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="title-short-section">Thông tin liên hệ:</div>
                        <div class="contact short-section">
                            <div class="row margin-0">
                                <div class="col-xs-12 description__item">
                                    <strong>Người liên hệ :</strong> {{$data->contact_person}}
                                </div>
                            </div>
                            <div class="row margin-0">
                                <div class="col-xs-12 description__item">
                                    <strong>Địa chỉ :</strong> {{$data->contact_address}}
                                </div>
                            </div>
                            <div class="row margin-0">
                                <div class="col-xs-12 description__item">
                                    <strong>Điện thoại :</strong> {{$data->contact_phone_number}}
                                </div>
                            </div>
                        </div>
                        <div class="title-short-section">Bản đồ vị trí:</div>
                        <div class="strike-title">
                            <strong>Dành cho quảng cáo</strong>
                        </div>
                        <div class="adv-content">
                            <div class="row">
                                <div class="col-xs-12">
                                    <a href="http://nhadathaiphong.vn/tin-tuc-l2.htm" target="_blank">
                                        <img class="img-responsive"
                                             src="http://nhadathaiphong.vn/images/partner/448tin-chi-tiet-phai-425x150.jpg"
                                             alt="TRANG CHI TIẾT - TRÁI">
                                    </a>
                                    <a href="http://nhadathaiphong.vn/tin-tuc-l2.htm" target="_blank">
                                        <img class="img-responsive"
                                             src="http://nhadathaiphong.vn/images/partner/6586tin-chi-tiet-phai-425x150.jpg"
                                             alt="TRANG CHI TIẾT - PHẢI">
                                    </a>
                                    <a href="http://nhadathaiphong.vn/tim-kiem.htm?txtkeyword=cho+thu%C3%AA"
                                       target="_blank">
                                        <img class="img-responsive"
                                             src="http://nhadathaiphong.vn/images/partner/3638cho-thue-nha-mat-pho-tin-chi-tiet-900x150.jpg"
                                             alt="CHO THUÊ NHÀ MẶT PHỐ - TIN CHI TIẾT">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="strike-title">
                            <strong>Thông tin người đăng</strong>
                        </div>
                        <div class="post-by-info">
                            <div class="row margin-0">
                                <div class="col-xs-12 padding-0">
                                    <div class="col-xs-12 col-sm-3 no-padding-left post-by-info__left">
                                        <img src="http://nhadathaiphong.vn/css/images/noimage.jpg"
                                             class="img-responsive post-by-info__avatar"/>
                                    </div>
                                    <div class="col-xs-12 col-sm-9 post-by-info__right">
                                        <p><strong>Công ty/cá nhân</strong>: Nhà Đất Hải Phòng</p>
                                        <p><strong>Địa chỉ email</strong>: dothigroup.vn@gmail.com</p>
                                        <p><strong>Số điện thoại</strong>: 02253.68.67.68 - 02253.68.67.69 -
                                            0986.186.179</p>
                                        <p><strong>Địa chỉ liên lạc</strong>: Trụ sở: Số 50 lô 16 MR, Lê Hồng Phong, Hải
                                            An, Hải Phòng</p>
                                        <p><strong>Website</strong>: <a href="www.nhadathaiphong.vn" target="_blank">www.nhadathaiphong.vn</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="same-result margin-top-20">
                        <p class="title_box1">
                            <strong>CÁC TIN CÙNG TIÊU CHÍ TÌM KIẾM</strong>
                        </p>
                        <div>
                            <div class="row body_top_box">
                                @for ($i=0; $i<10; $i++)
                                    <div class="col-xs-12 col-sm-6  free_price_item_wrap">
                                        <div class="col-xs-12 re_item2 free_price_item">
                                            <div class="row">
                                                <div class="col-xs-5 lgp_item">
                                                    <a href="#">
                                                        <img
                                                            src="http://nhadathaiphong.vn/images/attachment/thumb/28489.jpg"
                                                            alt="Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng">
                                                    </a>
                                                    <div class="code_row">HP-36845</div>
                                                </div>

                                                <div class="col-xs-7 rgp_item">
                                                    <h3><a href="#">Cho thuê nhà số 9 Đoạn Xá, Đông Hải 1, Hải An, Hải
                                                            Phòng</a>
                                                        <span></span>
                                                    </h3>
                                                    <div>Nhà 1.5 tầng xây độc lập, sạch sẽ về ở ngay, ngõ rộng 2,2m, khu
                                                        dân cư đông đúc,
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
                                    <div class="col-xs-12 col-sm-6  free_price_item_wrap">
                                        <div class="col-xs-12 re_item2 free_price_item">
                                            <div class="row">
                                                <div class="col-xs-5 lgp_item">
                                                    <a href="#">
                                                        <img
                                                            src="http://nhadathaiphong.vn/images/attachment/thumb/568z106.jpg"
                                                            alt="Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng">
                                                    </a>
                                                    <div class="code_row">HP-36845</div>
                                                </div>

                                                <div class="col-xs-7 rgp_item">
                                                    <h3><a href="#">Cho thuê nhà số 9 Đoạn Xá, Đông Hải 1, Hải An, Hải
                                                            Phòng</a>
                                                        <span></span>
                                                    </h3>
                                                    <div>Nhà 1.5 tầng xây độc lập, sạch sẽ về ở ngay, ngõ rộng 2,2m, khu
                                                        dân cư đông đúc,
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
                                    <div class="col-xs-12 col-sm-6  free_price_item_wrap">
                                        <div class="col-xs-12 re_item2 free_price_item">
                                            <div class="row">
                                                <div class="col-xs-5 lgp_item">
                                                    <a href="#">
                                                        <img
                                                            src="http://nhadathaiphong.vn/images/attachment/thumb/2960486327MHT3.jpg"
                                                            alt="Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng">
                                                    </a>
                                                    <div class="code_row">HP-36845</div>
                                                </div>

                                                <div class="col-xs-7 rgp_item">
                                                    <h3><a href="#">Cho thuê nhà số 9 Đoạn Xá, Đông Hải 1, Hải An, Hải
                                                            Phòng</a>
                                                        <span></span>
                                                    </h3>
                                                    <div>Nhà 1.5 tầng xây độc lập, sạch sẽ về ở ngay, ngõ rộng 2,2m, khu
                                                        dân cư đông đúc,
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
                                    <div class="col-xs-12 col-sm-6  free_price_item_wrap">
                                        <div class="col-xs-12 re_item2 free_price_item">
                                            <div class="row">
                                                <div class="col-xs-5 lgp_item">
                                                    <a href="#">
                                                        <img
                                                            src="http://nhadathaiphong.vn/images/attachment/thumb/4592d597efe08641661f3f50.jpg"
                                                            alt="Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng">
                                                    </a>
                                                    <div class="code_row">HP-36845</div>
                                                </div>

                                                <div class="col-xs-7 rgp_item">
                                                    <h3><a href="#">Cho thuê nhà số 9 Đoạn Xá, Đông Hải 1, Hải An, Hải
                                                            Phòng</a>
                                                        <span></span>
                                                    </h3>
                                                    <div>Nhà 1.5 tầng xây độc lập, sạch sẽ về ở ngay, ngõ rộng 2,2m, khu
                                                        dân cư đông đúc,
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
                    <div class="related-real-estate margin-top-20">
                        <p class="title_box1">
                            <strong>CÁC TIN LIÊN QUAN</strong>
                        </p>
                        <div>
                            <div class="row body_top_box">
                                @for ($i=0; $i<10; $i++)
                                    <div class="col-xs-12 col-sm-6  free_price_item_wrap">
                                        <div class="col-xs-12 re_item2 free_price_item">
                                            <div class="row">
                                                <div class="col-xs-5 lgp_item">
                                                    <a href="#">
                                                        <img
                                                            src="http://nhadathaiphong.vn/images/attachment/thumb/28489.jpg"
                                                            alt="Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng">
                                                    </a>
                                                    <div class="code_row">HP-36845</div>
                                                </div>

                                                <div class="col-xs-7 rgp_item">
                                                    <h3><a href="#">Cho thuê nhà số 9 Đoạn Xá, Đông Hải 1, Hải An, Hải
                                                            Phòng</a>
                                                        <span></span>
                                                    </h3>
                                                    <div>Nhà 1.5 tầng xây độc lập, sạch sẽ về ở ngay, ngõ rộng 2,2m, khu
                                                        dân cư đông đúc,
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
                                    <div class="col-xs-12 col-sm-6  free_price_item_wrap">
                                        <div class="col-xs-12 re_item2 free_price_item">
                                            <div class="row">
                                                <div class="col-xs-5 lgp_item">
                                                    <a href="#">
                                                        <img
                                                            src="http://nhadathaiphong.vn/images/attachment/thumb/568z106.jpg"
                                                            alt="Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng">
                                                    </a>
                                                    <div class="code_row">HP-36845</div>
                                                </div>

                                                <div class="col-xs-7 rgp_item">
                                                    <h3><a href="#">Cho thuê nhà số 9 Đoạn Xá, Đông Hải 1, Hải An, Hải
                                                            Phòng</a>
                                                        <span></span>
                                                    </h3>
                                                    <div>Nhà 1.5 tầng xây độc lập, sạch sẽ về ở ngay, ngõ rộng 2,2m, khu
                                                        dân cư đông đúc,
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
                                    <div class="col-xs-12 col-sm-6  free_price_item_wrap">
                                        <div class="col-xs-12 re_item2 free_price_item">
                                            <div class="row">
                                                <div class="col-xs-5 lgp_item">
                                                    <a href="#">
                                                        <img
                                                            src="http://nhadathaiphong.vn/images/attachment/thumb/2960486327MHT3.jpg"
                                                            alt="Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng">
                                                    </a>
                                                    <div class="code_row">HP-36845</div>
                                                </div>

                                                <div class="col-xs-7 rgp_item">
                                                    <h3><a href="#">Cho thuê nhà số 9 Đoạn Xá, Đông Hải 1, Hải An, Hải
                                                            Phòng</a>
                                                        <span></span>
                                                    </h3>
                                                    <div>Nhà 1.5 tầng xây độc lập, sạch sẽ về ở ngay, ngõ rộng 2,2m, khu
                                                        dân cư đông đúc,
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
                                    <div class="col-xs-12 col-sm-6  free_price_item_wrap">
                                        <div class="col-xs-12 re_item2 free_price_item">
                                            <div class="row">
                                                <div class="col-xs-5 lgp_item">
                                                    <a href="#">
                                                        <img
                                                            src="http://nhadathaiphong.vn/images/attachment/thumb/4592d597efe08641661f3f50.jpg"
                                                            alt="Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng">
                                                    </a>
                                                    <div class="code_row">HP-36845</div>
                                                </div>

                                                <div class="col-xs-7 rgp_item">
                                                    <h3><a href="#">Cho thuê nhà số 9 Đoạn Xá, Đông Hải 1, Hải An, Hải
                                                            Phòng</a>
                                                        <span></span>
                                                    </h3>
                                                    <div>Nhà 1.5 tầng xây độc lập, sạch sẽ về ở ngay, ngõ rộng 2,2m, khu
                                                        dân cư đông đúc,
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
                <div class="col-xs-12 col-md-3">
                    @include(theme(TRUE).'.includes.right-sidebar')
                    @include(theme(TRUE).'.includes.vip-slide')
                </div>
            </div>
        </div>
    </div>
    {{-- Include footer --}}
    @include(theme(TRUE).'.includes.footer')
@endsection

@push('js')
    <script>
        $('.land_slider').bxSlider({
            pagerCustom: '#land_slider_pager',
            auto: true,
        });
        $(".detail-content .imgs_land_box>ul li a").click(function () {
            console.log($(this));
            $(".detail-content .imgs_land_box>ul li").removeClass("active");
            $(this).parent().addClass("active");
            var divBox = $(".detail-content .imgs_land_box .hide_imgsBox");
            divBox.hide().filter($(this).attr("href")).show();
            return false;
        });
    </script>
@endpush
