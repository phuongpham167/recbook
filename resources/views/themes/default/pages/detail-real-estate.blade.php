@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    @php
    $cat = $data->reCategory ? $data->reCategory->name . ' ' : '';
    $reType = $data->reType ? $data->reType->name . ' ' : '';
    $project = $data->project ? $data->project->name . ' ' : '';
    $street = $data->street ? $data->street->name . ' ' : '';
    $ward = $data->ward ? $data->ward->name . ' ' : '';
    $district = $data->district ? $data->district->name . ' ' : '';
    $province = $data->province ? $data->province->name . ' ' : '';
    $price = $data->price ? $data->price . ' ' : '';
    $direction = $data->direction ? $data->direction->name . ' ' : '';
    $mattien = $data->width ? $data->width . ' ' : '' . $data->length ? $data->length . ' ' : '';
    $area = $data->area_of_premises ? $data->area_of_premises . ' ' : '';
    $floor = $data->floor ? $data->floor . ' ' : '';
    $room = $data->bedroom ? $data->bedroom . ' ' : '' . $data->living_room ? $data->living_room . ' ' : '' . $data->wc ? $data->wc . ' ' : '';
    $postDate = \Carbon\Carbon::parse($data->post_date)->format('d-m-Y H:i');

    $des = $cat . $reType . $project . $street . $ward . $district
        . $province  . $price . $direction . $mattien . ' - ' . $area . $floor . $room
        . ' - ' . $postDate;

    $keywords = $cat . $street . ', ' . $cat . $reType . $project . ', ' . $cat . 'dưới ' . $price . ', ' .
        $cat . 'tầm ' .$price;

    $seeMore = '<b>Quý khách có thể tìm theo từ khóa:</b> ' . $cat . $reType . $project . $street;
    @endphp
    <meta name="description" content="{{$des}}">
    <meta name="keywords" content="{{$keywords}}">
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
                    <p class="title_box"><strong>{{ $data->reCategory ? $data->reCategory->name : '' }} @if($data->reCategory)<i class="fa fa-angle-right"></i>@endif {{ $data->reType ? $data->reType->name : '' }}</strong>
                    </p>
                    @include('themes.default.includes.message')
                    <div class="detail-content">
                        <div class="row" style="margin: 0px">
                            <h1 style="text-align:left;float:left;" class="title">{{$data->title}} {!!$data->verified ? '<i class="fa fa-check-circle verified" title="Tin đã xác thực"></i>' : '<i class="fa fa-question-circle none-verified" aria-hidden="true" title="Tin chưa xác thực"></i>'!!}</h1>
                            @if(auth()->check())
                                <a style="text-align:right;float:right;" id="{{$data->id}}" class="btn btn-sm btn-danger btn-report">Báo cáo</a>
                            @endif
                        </div>

                        <div class="title-short-section">Thông tin liên hệ:</div>
                        <div class="contact short-section">
                            <div class="row margin-0">
                                <div class="col-xs-12 description__item">
                                    <strong>Người liên hệ :</strong> {{$data->contact_person ? $data->contact_person : ($data->user->userinfo ? $data->user->userinfo->full_name : $data->user->name)}}
                                </div>
                            </div>
                            <div class="row margin-0">
                                <div class="col-xs-12 description__item">
                                    <strong>Địa chỉ :</strong> {{$data->contact_address ? $data->contact_address : ($data->user->userinfo ? $data->user->userinfo->address : '')}}
                                </div>
                            </div>
                            <div class="row margin-0">
                                <div class="col-xs-12 description__item">
                                    <strong>Điện thoại :</strong> {{$data->contact_phone_number ? $data->contact_phone_number: ($data->user->userinfo ? $data->user->userinfo->phone : '')}}
                                </div>
                            </div>
                        </div>
                        <div class="imgs_land_box slide-images row">
                            <div class="col-xs-10 slide-images__left">
                                <ul class="land_slider">
                                    @php
                                        $imgDf = [
                                            'link' => '/images/default_real_estate_image.jpg',
                                            'alt' => $data->title
                                        ];
                                        $thumbDf = [
                                            'link' => '/images/default_thumb.jpg'
                                        ];
                                        $images = $data->images ? json_decode($data->images) : [];
                                        $thumbs = [];
                                        if ($images) {
                                            foreach ($images as $img) {
                                                $thumbs[] = [
                                                    'link' => str_replace('uploads', 'thumbs', $img->link)
                                                ];
                                            }
                                        }
                                        $images = $images ? $images : [(object)$imgDf];
                                        $thumbs = $thumbs ? $thumbs : [$thumbDf];
                                    @endphp
                                    @foreach($images as $image)
                                        <li>
                                            <div>
                                                <img src="{{asset($image->link)}}" alt="{{$image->alt ? $image->alt : $data->title}}"/>
                                            </div>
                                        </li>
                                    @endforeach
                                    {{--<li>--}}
                                        {{--<div>--}}
                                            {{--<img src="http://nhadathaiphong.vn/images/attachment/46321.jpg"/>--}}
                                        {{--</div>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<div>--}}
                                            {{--<img src="http://nhadathaiphong.vn/images/attachment/315510.jpg"/>--}}
                                        {{--</div>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<div>--}}
                                            {{--<img src="http://nhadathaiphong.vn/images/attachment/17755.jpg"/>--}}
                                        {{--</div>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<div>--}}
                                            {{--<img src="http://nhadathaiphong.vn/images/attachment/25294.jpg"/>--}}
                                        {{--</div>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<div>--}}
                                            {{--<img src="http://nhadathaiphong.vn/images/attachment/98623.jpg"/>--}}
                                        {{--</div>--}}
                                    {{--</li>--}}
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
                                    @foreach($thumbs as $key => $thumb)
                                        <a data-slide-index="{{$key + 1}}" href="" class="">
                                           <span>
                                               <img src="{{ $thumb['link'] }}">
                                           </span>
                                        </a>
                                    @endforeach
                                    {{--<a data-slide-index="1" href="" class="">--}}
                                       {{--<span>--}}
                                           {{--<img src="http://nhadathaiphong.vn/images/attachment/thumb/315510.jpg">--}}
                                       {{--</span>--}}
                                    {{--</a>--}}
                                    {{--<a data-slide-index="2" href="" class="">--}}
                                       {{--<span>--}}
                                           {{--<img src="http://nhadathaiphong.vn/images/attachment/thumb/39599.jpg">--}}
                                       {{--</span>--}}
                                    {{--</a>--}}
                                    {{--<a data-slide-index="3" href="" class="">--}}
                                        {{--<span>--}}
                                            {{--<img src="http://nhadathaiphong.vn/images/attachment/thumb/31498.jpg">--}}
                                        {{--</span>--}}
                                    {{--</a>--}}
                                    {{--<a data-slide-index="4" href="" class="">--}}
                                        {{--<span>--}}
                                            {{--<img src="http://nhadathaiphong.vn/images/attachment/thumb/11767.jpg">--}}
                                        {{--</span>--}}
                                    {{--</a>--}}
                                    {{--<a data-slide-index="5" href="" class="">--}}
                                        {{--<span>--}}
                                            {{--<img src="http://nhadathaiphong.vn/images/attachment/thumb/35676.jpg">--}}
                                        {{--</span>--}}
                                    {{--</a>--}}
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
                        <h2 class="title-second">{{$data->title}} {!!$data->verified ? '<i class="fa fa-check-circle verified" title="Tin đã xác thực"></i>' : '<i class="fa fa-question-circle none-verified" aria-hidden="true" title="Tin chưa xác thực"></i>'!!}</h2>
                        <div class="brief_detail row">
                            <div class="col-xs-12 col-sm-8 brief_detail__left">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <p><strong>- Mã số tin:</strong> {{ $data->code }}</p>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <p><strong>- Ngày cập nhật:</strong> {{ \Carbon\Carbon::parse($data->post_date)->format('d/m/Y')}}</p>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <p><strong>- Lượt xem:</strong> {{$data->views}}</p>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <p><strong>- Ngày hết hạn:</strong> {{ $data->expire_date ? \Carbon\Carbon::parse($data->expire_date)->format('d/m/Y') : ''}}</p>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <p><strong>- DTMB:</strong> {{ $data->area_of_premises ? $data->area_of_premises . 'm2' : '0m2' }}</p>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <p><strong>- DTSD:</strong> {{ $data->area_of_use ? $data->area_of_use . 'm2' : '0m2' }}</p>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <p><strong>- Danh mục:</strong> {{ $data->reCategory ? $data->reCategory->name : '' }}</p>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <p><strong>- Loại BĐS:</strong> {{ $data->reType ? $data->reType->name : '' }}</p>
                                    </div>
                                    <div class="col-xs-12">
                                        <p><strong>- Địa chỉ:</strong> {{ $data->address }}
                                        </p>
                                    </div>
                                    <div class="col-xs-12">
                                        <p>{!! $seeMore !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 brief_detail__right">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <p class="price"><strong>{{ trans('detail-real-estate.briefDetail.price') }}
                                                :</strong> {{ convert_number_to_words($data->price) }} {{$data->unit ? $data->unit->name : 'VND'}}</p>
                                        <p class="is_deal">{{ $data->is_deal ? '(Có thỏa thuận)' : '' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="title-short-section">Mô tả chi tiết:</div>
                        <div class="description short-section">
                            <div class="row margin-0">
                                <div class="col-xs-12 col-sm-4 description__item"><strong>Chiều rộng:</strong> {{ $data->width ? $data->width : '0m' }}</div>
                                <div class="col-xs-12 col-sm-4 description__item"><strong>Chiều dài:</strong> {{ $data->length ? $data->length : '0m' }}</div>
                                <div class="col-xs-12 col-sm-4 description__item"><strong>Giấy tờ:</strong> Sổ đỏ Chính
                                    Chủ
                                </div>
                            </div>
                            <div class="row margin-0">
                                <div class="col-xs-12 col-sm-4 description__item"><strong>Diện tích MB:</strong> {{ $data->area_of_premises ? $data->area_of_premises . 'm2' : '0m2' }}
                                </div>
                                <div class="col-xs-12 col-sm-4 description__item"><strong>Diện tích SD:</strong> {{ $data->area_of_use ? $data->area_of_use . 'm2' : '0m2' }}
                                </div>
                                <div class="col-xs-12 col-sm-4 description__item"><strong>Hướng:</strong> {{ $data->direction ? $data->direction->name : '' }}</div>
                            </div>
                            <div class="row margin-0">
                                <div class="col-xs-12 description__item">
                                    <strong>Tên dự án:</strong> {{ $data->project ? $data->project->name : '' }}
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

                        <div class="title-short-section">Bản đồ vị trí:</div>
                        <div class="strike-title">
                            <strong>Dành cho quảng cáo</strong>
                        </div>
                        <div class="adv-content">
                            <div class="row">
                                <div class="col-xs-12">
                                    <a href="{{route('home')}}" target="_blank">
                                        <img class="img-responsive"
                                             src="http://nhadathaiphong.vn/images/partner/448tin-chi-tiet-phai-425x150.jpg"
                                             alt="TRANG CHI TIẾT - TRÁI">
                                    </a>
                                    {{--<a href="{{route('home')}}" target="_blank">--}}
                                        {{--<img class="img-responsive"--}}
                                             {{--src="http://nhadathaiphong.vn/images/partner/6586tin-chi-tiet-phai-425x150.jpg"--}}
                                             {{--alt="TRANG CHI TIẾT - PHẢI">--}}
                                    {{--</a>--}}
                                    <a href="{{route('home')}}"
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
                                        <img src="{{$data->user->avatar()}}"
                                             class="img-responsive post-by-info__avatar"/>
                                    </div>
                                    <div class="col-xs-12 col-sm-9 post-by-info__right">
                                        @php
                                            $userInfo = $data->user->userinfo;
                                        @endphp
                                        <p><strong>Họ và tên</strong>: <a href="{{ route('user.info', [$data->user->id])}} ">{{$userInfo->full_name}}</a></p>
                                        <p><strong>Công ty/cá nhân</strong>: {{$userInfo && $userInfo->company ? $userInfo->company : 'Nhà Đất Hải Phòng'}}</p>
                                        <p><strong>Địa chỉ email</strong>: {{$data->user && $data->user->email ? $data->user->email : 'recbook.vn@gmail.com'}}</p>
                                        <p><strong>Số điện thoại</strong>: {{$userInfo && $userInfo->phone ? $userInfo->phone : ''}}</p>
                                        <p><strong>Địa chỉ liên lạc</strong>: {{$userInfo && $userInfo->address ? $userInfo->address : ''}}</p>
                                        <p><strong>Website</strong>: <a href="{{$userInfo && $userInfo->website ? $userInfo->website : route('home')}}" target="_blank">{{$userInfo && $userInfo->website ? $userInfo->website : ''}}</a>
                                        </p>
                                        @if(\Auth::user())
                                            @if(\Auth::user()->id !== $userInfo->id)
                                                @if (\Auth::user()->group->chat_permission && $data->user->group->chat_permission)
                                                <form role="form" action="{{ route('conversation.store') }}" method="post" accept-charset="UTF-8">
                                                    @csrf
                                                    <input name="user_id" type="hidden" value="{{ $userInfo->id }}" />
                                                    <button type="submit" class="btn btn-success"><i class="fa fa-commenting-o"></i> {{trans('detail-real-estate.chat')}}</button>
                                                </form>
                                                @endif
                                            @endif
                                        @else
                                            <p><a href="{{ route('login') }}">Đăng nhập để chat ngay</a></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('Comment::comment', ['type'=>'realestate', 'id'=>$data->id])
                    <div class="same-result margin-top-20">
                        <p class="title_box1">
                            <strong>CÁC TIN CÙNG TIÊU CHÍ TÌM KIẾM</strong>
                        </p>
                        <div>
                            <div class="row body_top_box">
                                @foreach($relatedItems as $item)
                                    <div class="col-xs-12 col-sm-6  free_price_item_wrap">
                                        <div class="col-xs-12 re_item2 free_price_item">
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
                                            <div class="row {{$itemClass}}">
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
                                                        {{convert_number_to_words($item->price)}} {{$item->unit ? $item->unit->name : 'VND'}}
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @for ($i=0; $i<10; $i++)
                                    {{--<div class="col-xs-12 col-sm-6  free_price_item_wrap">--}}
                                        {{--<div class="col-xs-12 re_item2 free_price_item">--}}
                                            {{--<div class="row">--}}
                                                {{--<div class="col-xs-5 lgp_item">--}}
                                                    {{--<a href="#">--}}
                                                        {{--<img--}}
                                                            {{--src="http://nhadathaiphong.vn/images/attachment/thumb/4592d597efe08641661f3f50.jpg"--}}
                                                            {{--alt="Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng">--}}
                                                    {{--</a>--}}
                                                    {{--<div class="code_row">HP-36845</div>--}}
                                                {{--</div>--}}

                                                {{--<div class="col-xs-7 rgp_item">--}}
                                                    {{--<h3><a href="#">Cho thuê nhà số 9 Đoạn Xá, Đông Hải 1, Hải An, Hải--}}
                                                            {{--Phòng</a>--}}
                                                        {{--<span></span>--}}
                                                    {{--</h3>--}}
                                                    {{--<div>Nhà 1.5 tầng xây độc lập, sạch sẽ về ở ngay, ngõ rộng 2,2m, khu--}}
                                                        {{--dân cư đông đúc,--}}
                                                        {{--gần trường, chợ, bệnh viện, hướng Đông Nam, sổ hồng chính chủ--}}
                                                    {{--</div>--}}
                                                    {{--<p>--}}
                                                        {{--<strong>DTMB:</strong> 57.7 m2 - <strong>Giá:</strong>--}}
                                                        {{--<span>--}}
                                                                {{--1.87 tỷ VND--}}
                                                            {{--</span>--}}
                                                    {{--</p>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
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
                                @foreach($relatedItems as $item)
                                    <div class="col-xs-12 col-sm-6  free_price_item_wrap">
                                        <div class="col-xs-12 re_item2 free_price_item">
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
                                            <div class="row {{$itemClass}}">
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
                                                        {{convert_number_to_words($item->price)}} {{$item->unit ? $item->unit->name : 'VND'}}
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @for ($i=0; $i<10; $i++)
                                    {{--<div class="col-xs-12 col-sm-6  free_price_item_wrap">--}}
                                        {{--<div class="col-xs-12 re_item2 free_price_item">--}}
                                            {{--<div class="row">--}}
                                                {{--<div class="col-xs-5 lgp_item">--}}
                                                    {{--<a href="#">--}}
                                                        {{--<img--}}
                                                            {{--src="http://nhadathaiphong.vn/images/attachment/thumb/4592d597efe08641661f3f50.jpg"--}}
                                                            {{--alt="Bán nhà số 52/105 Trung Hành 7, Hải An, Hải Phòng">--}}
                                                    {{--</a>--}}
                                                    {{--<div class="code_row">HP-36845</div>--}}
                                                {{--</div>--}}

                                                {{--<div class="col-xs-7 rgp_item">--}}
                                                    {{--<h3><a href="#">Cho thuê nhà số 9 Đoạn Xá, Đông Hải 1, Hải An, Hải--}}
                                                            {{--Phòng</a>--}}
                                                        {{--<span></span>--}}
                                                    {{--</h3>--}}
                                                    {{--<div>Nhà 1.5 tầng xây độc lập, sạch sẽ về ở ngay, ngõ rộng 2,2m, khu--}}
                                                        {{--dân cư đông đúc,--}}
                                                        {{--gần trường, chợ, bệnh viện, hướng Đông Nam, sổ hồng chính chủ--}}
                                                    {{--</div>--}}
                                                    {{--<p>--}}
                                                        {{--<strong>DTMB:</strong> 57.7 m2 - <strong>Giá:</strong>--}}
                                                        {{--<span>--}}
                                                                {{--1.87 tỷ VND--}}
                                                            {{--</span>--}}
                                                    {{--</p>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
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
    <form method="post" action="{{route('re-report')}}">
        {{csrf_field()}}
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content modal-lg">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Báo cáo tin đăng</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <label class="col-sm-2 control-label">Loại lỗi</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="report_type" name="report_type">
                                    <option value="">--Chọn lỗi--</option>
                                    <option value="info_wrong">Thông tin sai</option>
                                    <option value="error">Tin đăng lỗi</option>
                                    <option value="other">Khác</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 control-label">Nội dung</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="report_content"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit"
                                class="search-btn-submit pull-right">BÁO CÁO
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </form>
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

        $('.detail-content').on('click', '.btn-report', function () {
            // console.log(check);
            var id      =   $(this).attr('id');

            $('.modal #id').val(id);
            $('#myModal').modal('show');
        });
    </script>
@endpush
