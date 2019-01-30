<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta-description')
    <title>@yield('title') - {{config('setting.system_sitename')}}</title>
    <link rel="stylesheet" href="{{ asset('common-css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('common-css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('common-css/jquery.bxslider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/loader.css') }}">
    {{--<link rel="stylesheet" href="{{ asset('css/theme.css') }}" />--}}
    <link rel="stylesheet" href="{{ asset('css/main.css') }}"/>
    @stack('style')
</head>
<body>

    @yield('content')
    <div class="loading"></div>
    {{--<script src="{{ asset('js/jquery.min.js') }}"></script>--}}
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    {{--<script type="text/javascript" src='https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyAxgnRkMsWPSqlxOz_kLga0hJ4eG2l0Vmo&callback=initMap'></script>--}}
    <script src="{{asset('plugins/moment-develop/min/moment.min.js')}}"></script>
    <script src="{{asset('plugins/moment-develop/locale/vi.js')}}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.bxslider.js') }}"></script>
    <script src="{{ asset('js/tinhtien.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
{{--    <script src="{{asset('plugins/jquery-locationpicker-plugin-master/dist/locationpicker.jquery.min.js')}}"></script>--}}
    <script>
        $(document).ready(function() {
            // Show or hide the sticky footer button
            $(window).scroll(function() {
                if ($(this).scrollTop() > 100) {
                    $('.main-menu').css({'position': 'fixed','top': '0px', 'left': '0px', 'width': '100%', 'z-index': '9999999'});
                } else {
                    $('.main-menu').css({'position': 'static','top': '0px', 'left': '0px'});
                }

            });
        });
    </script>
    @stack('js')
</body>
