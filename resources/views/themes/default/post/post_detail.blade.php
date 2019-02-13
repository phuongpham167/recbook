@extends('themes.default.layouts.app')

@section('meta-description')
    <meta name="description" content="{{\App\PostCategory::find($data->post_category_id)->name}}" >
@endsection

@section('title')
    {{$data->title}}
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


                    <p class="title_box"><strong>{{\App\PostCategory::find($data->post_category_id)->name}}</strong></p>
                    <div class="">
                        <div class="news_page">
                            <h1>{{$data->title}}</h1>
                            <p class="info_news">Cập nhật: {{$data->created_at}} | <a href="{{ route('postcategorylist', ['slugdanhmuc' => \App\PostCategory::find($data->post_category_id)->slugdanhmuc]) }}">{{\App\PostCategory::find($data->post_category_id)->name}}</a></p>
                            <div class="clearfix"></div>
                            <br>
                            <div class="content_news_page"><p>&nbsp;</p>
                                {!! $data->content !!}
                            </div>
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
