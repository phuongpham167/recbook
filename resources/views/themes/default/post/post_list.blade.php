@extends('themes.default.layouts.app')

@section('meta-description')
    <meta name="description" content="{{trans('post.list')}}" >
@endsection

@section('title')
    Danh sách bài viết
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/news.css') }}"/>
@endpush

@section('content')
    @include(theme(TRUE).'.includes.header')

    <div class="content-body">
        <div class="container padding-top-30 padding-bottom-30">
            <div class="row">
                <div class="col-xs-12 col-md-9 list-content-wrap">
                    <p class="title_box">
                        <strong>
                            Danh sách bài viết
                        </strong>
                    </p>
                    @if(isset($isSearch) && $isSearch)
                        <div>
                            <p style="margin: 10px 0 20px 0; font-weight: bold;">Có <strong style="color: #e00;">80</strong> kết quả tìm kiếm cho từ khóa hoặc mã số tin: <strong style="color: #e00;">"{{\request('txtkeyword')}}"</strong></p>
                        </div>
                    @endif
                    <div class="row list-re-item" style="margin-left: -15px; margin-right: -15px;">
                        @foreach($data as $item)
                            <dl>
                                <dt><a href="/tin-tuc/nhung-chuyen-ke-ve-sinh-nhat-bac-n225.htm"><img width="110" height="75" src="/images/news/1625images1163920_19_5_02.jpg" alt="Những chuyện kể về sinh nhật Bác"></a></dt>
                                <dd>
                                    <h3><a href="/tin-tuc/nhung-chuyen-ke-ve-sinh-nhat-bac-n225.htm">Những chuyện kể về sinh nhật Bác</a></h3>
                                    <span class="info_news">Cập nhật: 19-05-2018 | <a href="/tin-tuc-l2.htm">Giới thiệu về Doanh nghiệp</a> | xem: 470</span>
                                    <p class="tablet-lg"> <a href="/tin-tuc/nhung-chuyen-ke-ve-sinh-nhat-bac-n225.htm">Xem thêm</a></p>
                                </dd>
                            </dl>
                        @endforeach
                    </div>
                </div>
                <div class="col-xs-12 col-md-3">
                    @include(theme(TRUE).'.includes.right-sidebar')
                    @include(theme(TRUE).'.includes.vip-slide')
                </div>
            </div>
        </div>
    </div>

    @include(theme(TRUE).'.includes.footer')
@endsection

@section('js')

@endsection
