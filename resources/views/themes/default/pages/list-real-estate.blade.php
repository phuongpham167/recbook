@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Danh sách tin bất động sản" >
@endsection

@section('title')
    Danh sách tin bất động sản
@endsection

@push('style')
    {{-- Link css for page here --}}
    <link rel="stylesheet" href="{{ asset('css/home.css') }}"/>
@endpush

@section('content')
    {{-- Include Header --}}
    @include(theme(TRUE).'.includes.header')
    {{--Page html content --}}
    <div class="content-body">
        <p>Code html here</p>
    </div>
    {{-- Include footer --}}
    @include(theme(TRUE).'.includes.footer')
@endsection

@push('js')
    <script>

    </script>
@endpush
