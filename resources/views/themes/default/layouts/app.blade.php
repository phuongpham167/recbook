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
    <form method="post" action="{{route('interested-provinces')}}">
        {{csrf_field()}}
        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="myModal" style="margin-top: 100px; border-radius: 0 !important;">
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
    <link rel="stylesheet" href="{{asset('plugins/jquery.tokenInput/token-input.css')}}" />
    <link rel="stylesheet" href="{{asset('plugins/loopj-jquery-tokeninput/styles/token-input.css')}}" />
    <link rel="stylesheet" href="{{asset('plugins/loopj-jquery-tokeninput/styles/token-input-bootstrap3.css')}}" />
    <script src="{{asset('plugins\loopj-jquery-tokeninput\src\jquery.tokeninput.js')}}" ></script>
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
