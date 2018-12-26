@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="{{object_get($data, 'name')}}">
@endsection

@section('title')
    {{object_get($data, 'name')}}
@endsection

@push('style')
    {{-- Link css for page here --}}
    <link rel="stylesheet" href="{{ asset('css/user-info.css') }}"/>
@endpush

@section('content')
    {{-- Include Header --}}
    @include(theme(TRUE).'.includes.header')
    <div class="content-body">
        <div class="container padding-top-30 padding-bottom-30">
            <div class="row">
                <div class="col-xs-12 col-md-9 detail-content-wrap">
                    <p class="title_box"><strong>{{ $data->name }}</strong>
                    </p>
                    <div class="user-info">
                        <div class="row">
                            <div class="col-xs-12 col-md-3">
                                <img class="img-responsive" src="{{asset('images/default-avatar.png')}}"/>
                            </div>
                            <div class="col-xs-12 col-md-9">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h1 class="name">{{ $data->name }} </h1><span>(UID: {{ $data->id }})</span>
                                        <p class="address">Địa chỉ: {{ $data->userInfo->address }}</p>
                                        <p>Bạn bè: 2</p>
                                    </div>
                                    <div class="col-sm-6 social">
                                        <a href="#" class="btn btn-success"><i class="fa fa-commenting-o"></i> Chat ngay</a>
                                        <a href="#" class="btn btn-primary"><i class="fa fa-user-plus" aria-hidden="true"></i> Thêm bạn bè</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h2 class="description-label">Giới thiệu</h2>

                        </div>
                        <div class="row">
                            <h2 class="rate-label">Đánh giá</h2>

                        </div>
                        <div class="row">
                            <h2 class="posted-real-estate-label">Tin đã đăng</h2>

                        </div>
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
