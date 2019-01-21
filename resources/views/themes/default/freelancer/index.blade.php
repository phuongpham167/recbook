@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Danh sách dự án" >
@endsection

@section('title')
    Danh sách dự án
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/user-info.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/news.css') }}"/>
    <style>
        .freelancer_tab {
            margin-bottom: 0px;
            margin-top: 0;
            background: #e40b00;
            color: #fff;
            font-weight: 600;
            font-size: 16px;
            padding: 10px 15px;
            text-transform: uppercase;
        }
    </style>
@endpush

@section('content')
    @include(theme(TRUE).'.includes.header')

    <div class="container">
        <div class="row subpage">

            <div class="col-xs-3 left">
                <p class="title-short-section">Giới thiệu</p>
                <div class="u-description border-block">
                    <p class=" text-center">Làm việc tại: {{ auth()->user()->userinfo->company }}</p>
                    <p class=" text-center">Đánh giá: 87/100 điểm</p>
                    @if((\Auth::user() && \Auth::user()->id  ==  auth()->user()->id))
                        <p class=" text-center">Số dư: <strong>{{auth()->user()->credits}}</strong></p>
                        <p class=" text-center">Nhóm tài khoản: <strong>{{auth()->user()->group->name}}</strong></p>
                    @endif
                    <p class="user-desc">{{  auth()->user()->userinfo->description }}</p>
                </div>
                <p class="title-short-section">Tin tức</p>
                <div class="u-description border-block">
                    @foreach(\App\Post::orderBy('created_at', 'desc')->take(3)->get() as $item)
                        <div class="item"><p><i class="fa fa-angle-double-right" aria-hidden="true"></i> <a href="{{ route('postdetail', ['slugchitiet' => $item->slugchitiet]) }}" style="color: black">{{$item->title}}</a></p></div>
                        <hr>
                    @endforeach
                </div>
            </div>
            <!--Begin right-->
            <div class="col-xs-9 right">
            @include(theme(TRUE).'.includes.message')
                <div>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#home" class="freelancer_tab" aria-controls="home" role="tab" data-toggle="tab">Tư vấn Bất động sản</a></li>
                        <li role="presentation"><a href="#profile" class="freelancer_tab" aria-controls="profile" role="tab" data-toggle="tab">Tư vấn tài chính</a></li>
                        <li role="presentation"><a href="#messages" class="freelancer_tab" aria-controls="messages" role="tab" data-toggle="tab">Tư vấn thiết kế</a></li>
                        <li role="presentation"><a href="#settings" class="freelancer_tab" aria-controls="settings" role="tab" data-toggle="tab">Tư vấn phong thủy</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <div class="list_news">
                                <dl>
                                    <dt class="text-center">
                                        <a href="#a"><img width="110" height="75" src="{{asset('/images/default_real_estate_image.jpg')}}" alt=""></a>
                                        <p>Nguyễn Văn A</p>
                                    </dt>
                                    <dd>
                                        <h3><a href="#a">Cần thiết kế nhà 3 tầng tại Hà Nội</a></h3>
                                        <span class="info">Đánh giá:<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></span>
                                        <span class="info">Ngân sách: 2 tỷ</span>
                                        <span class="info">Khu vực: Hà Nội</span>
                                        <span class="info">Thời hạn: 11/09/2020</span>
                                        <p class="tablet-lg">Tôi muốn thiết kế nội thất cho nhà 3 tầng, diện tích mặt bằng 5x12m. Hướng tây tứ trạch nên khá nóng ...</p>
                                        <button href="#" class="btn btn-success pull-right">Chào giá</button>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt class="text-center">
                                        <a href="#a"><img width="110" height="75" src="{{asset('/images/default_real_estate_image.jpg')}}" alt=""></a>
                                        <p>Nguyễn Văn A</p>
                                    </dt>
                                    <dd>
                                        <h3><a href="#a">Cần thiết kế nhà 3 tầng tại Hà Nội</a></h3>
                                        <span class="info">Đánh giá:<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></span>
                                        <span class="info">Ngân sách: 2 tỷ</span>
                                        <span class="info">Khu vực: Hà Nội</span>
                                        <span class="info">Thời hạn: 11/09/2020</span>
                                        <p class="tablet-lg">Tôi muốn thiết kế nội thất cho nhà 3 tầng, diện tích mặt bằng 5x12m. Hướng tây tứ trạch nên khá nóng ...</p>
                                        <button href="#" class="btn btn-success pull-right">Chào giá</button>
                                    </dd>
                                </dl>
                            </div>

                        </div>
                        <div role="tabpanel" class="tab-pane" id="profile">Tư vấn tài chính</div>
                        <div role="tabpanel" class="tab-pane" id="messages">Tư vấn thiết kế</div>
                        <div role="tabpanel" class="tab-pane" id="settings">Tư vấn phong thủy</div>
                    </div>

                </div>

            </div>
            <!--End left-->

        </div>
    </div>

    @include(theme(TRUE).'.includes.footer')
@endsection

@push('js')
    <script>
        $('#myTabs a').click(function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    </script>
@endpush
