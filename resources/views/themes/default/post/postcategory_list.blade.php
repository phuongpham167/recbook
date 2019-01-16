@extends('themes.default.layouts.app')

@section('meta-description')
    <meta name="description" content="Dothigroup" >
@endsection

@section('title')
    Dothigroup
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
                            {{\App\PostCategory::find($id)->name}}
                        </strong>
                    </p>
                    <div class="list_news">
                        @foreach($data as $item)
                            <dl>
                                <dt><a href="{{ route('postdetail', ['slugchitiet' => $item->slugchitiet]) }}"><img width="110" height="75" @if(!empty($item->thumbnail)) src="{{$item->thumbnail}}" @else src="{{asset('/images/default_real_estate_image.jpg')}}" @endif alt="{{$item->title}}"></a></dt>
                                <dd>
                                    <h3><a href="{{ route('postdetail', ['slugchitiet' => $item->slugchitiet]) }}">{{$item->title}}</a></h3>
                                    <span class="info_news">Cập nhật: {{$item->created_at}} | <a href="{{ route('postcategorylist', ['slugdanhmuc' => \App\PostCategory::find($item->post_category_id)->slugdanhmuc]) }}">{{\App\PostCategory::find($item->post_category_id)->name}}</a></span>
                                    <p class="tablet-lg">{{$item->brief}}</p>
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
