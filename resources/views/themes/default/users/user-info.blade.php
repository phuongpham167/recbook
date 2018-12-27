@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="{{object_get($data->userinfo, 'full_name')}}">
@endsection

@section('title')
    {{object_get($data->userinfo, 'full_name')}}
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
                <div class="col-xs-12 col-md-12 detail-content-wrap">
                    <p class="title_box"><strong>{{ $data->userinfo->full_name }}</strong>
                    </p>
                    <div class="user-info">
                        <div class="row">
                            <div class="col-xs-12 col-md-3">
                                <img class="img-responsive" src="{{asset('images/default-avatar.png')}}"/>
                                <h1 class="name">{{ $data->userinfo->full_name }} </h1>
                                <p>Làm việc tại: {{ $data->userinfo->company }}</p>
                                <p>Đánh giá: 87/100 điểm</p>
                                <p>{{ $data->userinfo->description }}</p>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="row">
                                    <div class="col-sm-6 social">
                                        <a href="#" class="btn btn-success"><i class="fa fa-commenting-o"></i> Chat ngay</a>
                                        <a href="#" class="btn btn-primary"><i class="fa fa-user-plus" aria-hidden="true"></i> Thêm bạn bè</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <div class="list-friend">
                                    <a href="#">Thang Pham</a>
                                </div>
                            </div>
                        </div>
                    </div>
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
