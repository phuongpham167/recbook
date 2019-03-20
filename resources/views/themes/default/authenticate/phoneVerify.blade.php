@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Company List">
@endsection

@section('title')
    {{trans('company.index')}}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}"/>
    <link rel="stylesheet" href="{{asset('plugins/jquery.datatables/css/jquery.dataTables.min.css')}}"/>
@endpush

@section('content')
    @php
        $guigannhat =   \App\Verify::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->first();
        if(!$guigannhat)
            $timegannhat = '2018-01-01 12:00:00';
        else
            $timegannhat = $guigannhat->created_at;
        $thoigiangui = \Carbon\Carbon::now()->diffInSeconds(\Carbon\Carbon::parse($timegannhat), true);
    @endphp

    @include(theme(TRUE).'.includes.user-info-header')
    <div class="container-vina">
        <div class="row subpage">
            <!--Begin left-->
            <div class="col-xs-3 left">
                @include(theme(TRUE).'.includes.left-menu')
            </div>
            <!--End left-->

            <div class="col-xs-9 right">
                @include('themes.default.includes.message')
                <div class="listlandA_page">
                    <div class="title_boxM">
                        <strong><i class="fa fa-list-alt"></i>Xác thực số điện thoại</strong>
                        <div class="box-tools pull-right">

                        </div>
                    </div>
                    <div>
                        <div class="box-body">
                            <h4>Mã xác thực đã được gửi về số điện thoại của bạn. Vui lòng nhập mã vào ô bên dưới để xác thực.</h4>
                            <form method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <input class="form-control" name="verify_code" placeholder="mã xác thực" />
                                </div>
                                <a id="countdown" href="{{route('resend.verify')}}"
                                   class="btn pull-right @if($thoigiangui<60) disabled @endif"><i
                                        class="fa fa-refresh"></i> Gửi lại mã
                                </a>
                                <button type="submit"
                                        class="_btn bg_red pull-right"><i
                                        class="fa fa-plus"></i> XÁC THỰC
                                </button>
                            </form>

                            <form method="post">
                                <div>

                                </div>
                                <div class="text-center">

                                </div>
                            </form>

                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include(theme(TRUE).'.includes.footer')

@endsection

@push('js')
    <script src="{{asset('plugins/bootbox.min.js')}}"></script>
    <script src="{{asset('plugins/jquery.datatables/js/jquery.dataTables.js')}}"></script>
    <script>
        $(function () {

        });
    </script>
    <script>
        // Set the date we're counting down to
            @if($thoigiangui<60)
        var countDownDate = new Date("{{\Carbon\Carbon::now()->addSecond(60-$thoigiangui)->format("M d, Y H:i:s")}}").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get todays date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("countdown").innerHTML = '<i class="fa fa-refresh"></i> Gửi lại sau '+seconds + " giây ";

            // If the count down is over, write some text
            if (distance < 0) {
                clearInterval(x);
                $('#countdown').removeClass('disabled');
                $('#countdown').html('<i class="fa fa-refresh"></i> Gửi lại mã');
            }
        }, 1000);
        @endif
    </script>
@endpush
