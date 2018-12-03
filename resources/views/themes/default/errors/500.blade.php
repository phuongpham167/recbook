@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Description page" >
@endsection

@section('title')
    500
@endsection

@push('style')
    {{-- Link css for page here --}}
@endpush

@section('content')
    {{-- Include Header --}}
    @include(theme(TRUE).'.includes.header')
    {{--Page html content --}}
    <div class="content-body">
        <p>500 - Server error</p>
    </div>
    {{-- Include footer --}}
    @include(theme(TRUE).'.includes.footer')
@endsection

@push('js')
    <script>

    </script>
@endpush
