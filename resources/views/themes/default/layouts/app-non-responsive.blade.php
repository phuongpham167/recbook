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


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&amp;subset=vietnamese" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Barlow+Semi+Condensed:400,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="source/styles/main.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.0/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.0/slick/slick-theme.css"/>
    @stack('style')
</head>
<body>

    @yield('content')
    <form method="post" action="{{route('interested-provinces')}}">
        {{csrf_field()}}
        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="quantamtinhthanhModal" style="margin-top: 100px; border-radius: 0 !important;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="border-radius: 0 !important;">
                    <div class="modal-header" style="background: #0c4da2; color: white">
                        {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                        {{--<span aria-hidden="true">&times;</span>--}}
                        {{--</button>--}}
                        <h4 class="modal-title">Bạn quan tâm đến bất động sản ở tỉnh thành nào?</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            @foreach(\App\Province::orderBy('order', 'ASC')->get() as $item)
                                <div class="col-xs-2" style="margin-bottom: 2px">
                                    <button type="submit" name="provinces" value="{{$item->id}}" class="btn btn-default btn-xs">{{str_replace('Tỉnh ', '', str_replace('Thành phố', '', $item->name))}}</button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="loading"></div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.0/slick/slick.min.js"></script>
    <script type="text/javascript" src="source/index.js"></script>


    {{--<script src="{{ asset('js/jquery.min.js') }}"></script>--}}
<!--    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>-->
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
