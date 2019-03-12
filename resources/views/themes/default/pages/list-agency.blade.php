@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Danh sách nhà môi giới" >
@endsection

@section('title')
    Danh sách nhà môi giới
@endsection

@push('style')
    {{-- Link css for page here --}}
    <link rel="stylesheet" href="{{ asset('css/list-real-estate.css') }}"/>
@endpush

@section('content')
    {{-- Include Header --}}
    @include(theme(TRUE).'.includes.header')
    {{--Page html content --}}
    <div class="content-body">
        <div class="container padding-top-30 padding-bottom-30">
            <div class="row">
                {{--<div class="col-md-12">--}}
                    {{--{{$data->appends($_GET)->render()}}--}}
                {{--</div>--}}
                <div class="col-xs-12 col-md-9 list-content-wrap">
                    <p class="title_box">
                        <strong>
                            Nhà môi giới
                        </strong>
                    </p>
                    {{--@if(isset($isSearch) && $isSearch)--}}
                    {{--<div>--}}
                        {{--<p style="margin: 10px 0 20px 0; font-weight: bold;">Có <strong style="color: #e00;">{{$data->count()}}</strong> kết quả tìm kiếm phù hợp.</p>--}}
                    {{--</div>--}}
                    {{--@endif--}}
                    <div class="row list-re-item" style="margin-left: -15px; margin-right: -15px;">
                        @foreach($data as $item)
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="col-xs-12 re-item">
                                    <a href="{{asset('user/'.$item->id)}}" style="height: 300px" class="text-center">
                                        <img src="{{$item->avatar()}}" alt="" class="img-responsive">
                                    </a>
                                    <h3 class="text-center">
                                        <a style="font-size: 12px" href="{{asset('user/'.$item->id)}}">{{$item->userinfo?$item->userinfo->full_name:$item->name}}</a>
                                    </h3>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-12">
                        {{$data->appends($_GET)->render()}}
                    </div>
                </div>

                <div class="col-xs-12 col-md-3">
                    @include(theme(TRUE).'.includes.right-sidebar')
                    @include(theme(TRUE).'.includes.vip-slide')
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
