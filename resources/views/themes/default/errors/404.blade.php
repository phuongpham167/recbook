@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Description page" >
@endsection

@section('title')
    404
@endsection

@push('style')
    {{-- Link css for page here --}}
@endpush

@section('content')
    {{-- Include Header --}}
    @include(theme(TRUE).'.includes.header')
    {{--Page html content --}}
    <div class="content-body">
        <p>404 - Page not found</p>
    </div>
    {{-- Include footer --}}
    @include(theme(TRUE).'.includes.footer')
@endsection

@push('js')
    <script>

    </script>
@endpush
