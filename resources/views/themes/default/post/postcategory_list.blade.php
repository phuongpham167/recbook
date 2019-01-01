@extends('themes.default.layouts.app')

@section('meta-description')
    <meta name="description" content="{{trans('post.list')}}" >
@endsection

@section('title')
    Danh sách bài viết
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/news.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/normalize.css') }}"/>
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
                    <div class="list_news">
                        @foreach($data as $item)
                            <dl>
                                <dt><a href="{{ route('postdetail', ['slugchitiet' => $item->slugchitiet]) }}"><img width="110" height="75" src="http://dothigroupfe.vn/images/default_real_estate_image.jpg" alt="{{$item->title}}"></a></dt>
                                <dd>
                                    <h3><a href="{{ route('postdetail', ['slugchitiet' => $item->slugchitiet]) }}">{{$item->title}}</a></h3>
                                    <span class="info_news">Cập nhật: {{$item->created_at}} | <a href="{{ route('postcategorylist', ['slugdanhmuc' => \App\PostCategory::find($item->post_category_id)->slugdanhmuc]) }}">{{\App\PostCategory::find($item->post_category_id)->name}}</a></span>
                                    <p class="tablet-lg">{{text_limit($item->content)}}</p>
                                    <p><a href="{{ route('postdetail', ['slugchitiet' => $item->slugchitiet]) }}">Xem thêm</a></p>
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
