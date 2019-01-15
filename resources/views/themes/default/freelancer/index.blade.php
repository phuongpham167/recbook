@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Danh sách dự án" >
@endsection

@section('title')
    Danh sách dự án
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />

@endpush

@section('content')
    @include(theme(TRUE).'.includes.header')

    <div class="container">
        <div class="row subpage">

            <div class="col-xs-3 left">
                @include(theme(TRUE).'.includes.left-menu')
            </div>
            <!--End right-->

            <!--Begin left-->
            <div class="col-xs-9 right">
            @include(theme(TRUE).'.includes.message')
            <!--begin manage_page-->

                <!--end manage_page-->

            </div>
            <!--End left-->

        </div>
    </div>

    @include(theme(TRUE).'.includes.footer')
@endsection

@section('js')

@endsection
