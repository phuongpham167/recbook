<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
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
            $('input[name=project_id]').tokenInput(function(){
                return "{{asset('/ajax/project')}}?addnew=0&province_id="+$('input[name=project_id]').data('province');
            }, {
                theme: "bootstrap",
                queryParam: "term",
                zindex  :   9999,
                tokenLimit  :   1,
                hintText : 'Nhập tên dự án để tìm kiếm',
                onAdd   :   function(r){
                    $('#method').val(r.method);
                }
            });
            $('#token-input-ip-kw').attr('placeholder', 'Tìm theo tên dự án');

            $(document).on('click', '.menu-search .dropdown-menu', function (e) {
                e.stopPropagation();
            });
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
