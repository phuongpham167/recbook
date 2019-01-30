@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Home page" >
@endsection

@section('title')
    Đặt lại mật khẩu
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}"/>
@endpush

@section('content')
    @include(theme(TRUE).'.includes.header')
    <div class="content-body">
        <div class="slider">
            <div class="smart-search">

            </div>
        </div>
        <section class="featured-real-estate">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        Đường dẫn đặt lại mật khẩu hết hạn!
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include(theme(TRUE).'.includes.footer')
@endsection

@section('js')
    <script>

    </script>
@endsection
