<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta-description')
    <title>@yield('title') - {{config('setting.system_sitename')}}</title>
    <link rel="stylesheet" href="{{ asset('common-css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('common-css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}"/>
    @stack('style')
</head>
<body>

    @yield('content')

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
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
