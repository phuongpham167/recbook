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

        </div>
        <section class="featured-real-estate">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        Bat dong san noi bat
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
