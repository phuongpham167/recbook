@extends('themes.default.layouts.app')

@section('meta-description')
    <meta name="description" content="{{trans('post.list')}}" >
@endsection

@section('title')
    {{trans('users.info')}}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/news.css') }}"/>
@endpush

@section('content')
    @include(theme(TRUE).'.includes.header')

    <div class="container-vina">
        <div class="row subpage">

            <!--Begin left-->
            <div class="col-xs-12 col-md-9 left catland_page">

                <!--Begin land_box-->
                <div class="_box">


                    <p class="title_box"><strong>{{trans('post.list')}}</strong></p>
                    <div class="">

                        <div class="news_page">
                            @foreach($data as $item)
                                <li><a href="{{ route('postdetail', ['slugdanhmuc' => $item->slugdanhmuc,'slugchitiet' => $item->slugchitiet . '?id=' . $item->id]) }}">{{$item->title}}</a></li>
                            @endforeach

                            {{--<div class="tags_news_page"><strong>Tags:</strong>--}}
                                {{--<a href="/tim-kiem.htm?txtkeyword=B%E1%BA%A3ng+gi%C3%A1+qu%E1%BA%A3ng+c%C3%A1o+nh%C3%A0+%C4%91%E1%BA%A5t+ch%C3%ADnh+ch%E1%BB%A7">Bảng giá quảng cáo nhà đất chính chủ</a>, <a href="/tim-kiem.htm?txtkeyword=+qu%E1%BA%A3ng+c%C3%A1o+banner"> quảng cáo banner</a>, <a href="/tim-kiem.htm?txtkeyword=+nh%C3%A0+%C4%91%E1%BA%A5t+h%E1%BA%A3i+ph%C3%B2ng"> nhà đất hải phòng</a>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
                <!--End detail_land-->


            </div>
            <!--End left-->

            <!--Begin right-->
            <div class="col-xs-12 col-md-3">
                @include(theme(TRUE).'.includes.right-sidebar')
                @include(theme(TRUE).'.includes.vip-slide')
            </div>
            <!--End right-->

        </div>
    </div>

    @include(theme(TRUE).'.includes.footer')
@endsection

@section('js')

@endsection
