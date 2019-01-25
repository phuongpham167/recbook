@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Description page" >
@endsection

@section('title')
    500
@endsection

@push('style')
    {{-- Link css for page here --}}
    <link rel="stylesheet" href="{{ asset('css/main-1.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}"/>
@endpush

@section('content')
    {{-- Include Header --}}
    @include(theme(TRUE).'.includes.header')
    {{--Page html content --}}
    <div class="container">
        <div class="row subpage">

            <div class="col-xs-12 left">
                <p class="title-short-section">Ôi! Đã xảy ra lỗi rồi!</p>
                <div class="u-description border-block" style="min-height: 400px">
                    <h4>Đã xảy ra lỗi trong quá trình xử lý! Vui lòng thử lại sau hoặc trờ lại <a href="{{asset('')}}">Trang chủ</a></h4>
                </div>
            </div>

        </div>
    </div>
    {{-- Include footer --}}
    @include(theme(TRUE).'.includes.footer')
@endsection

@push('js')
    <script>

    </script>
@endpush
