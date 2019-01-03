@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="{{object_get($data->userinfo, 'full_name')}}">
@endsection

@section('title')
    {{object_get($data->userinfo, 'full_name')}}
@endsection

@push('style')
    {{-- Link css for page here --}}
    <link rel="stylesheet" href="{{ asset('common-css/left-menu.css') }}" />
    <link rel="stylesheet" href="{{asset('common-css/magnific-popup.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/user-info.css') }}"/>
@endpush
@php
//dd($listFriends);
@endphp

@section('content')
    {{-- Include Header --}}
    @include(theme(TRUE).'.includes.header')
    <div class="content-body">
        <div class="container padding-top-30 padding-bottom-30">
            <div class="row">
                <div class="col-xs-12 col-md-12 detail-content-wrap">
                    <p class="title_box"><strong>{{ $data->userinfo->full_name }}</strong>
                    </p>
                    @php
                        $isFriend = false;
                        if(\Auth::user() && \Auth::user()->id  !== $data->id) {
                            $isFriend = isFriend(\Auth::user()->id, $data->id);
                        }
                    @endphp
                    <div class="user-info">
                        <div class="row">
                            <div class="col-xs-12 col-md-3">
                                @php
                                    $avatar = $data->userinfo->avatar ? $data->userinfo->avatar : '/images/default-avatar.png';
                                @endphp
                                <img class="img-responsive avatar" src="{{$avatar}}"/>
                                <h1 class="name text-center">{{ $data->userinfo->full_name }} </h1>
                                <p class=" text-center">Làm việc tại: {{ $data->userinfo->company }}</p>
                                <p class=" text-center">Đánh giá: 87/100 điểm</p>
                                <p class="title-short-section">Giới thiệu</p>
                                <p class="user-desc">{{ $data->userinfo->description }}</p>
                                @if ( (\Auth::user() && \Auth::user()->id  == $data->id) || $isFriend)
                                <p class="title-short-section">Tin đã đăng</p>
                                <div class="posted-re border-block">
                                        @foreach($listPostedRe as $re)
                                            <p><a href="{{ route('detail-real-estate', ['slug' => $re->slug . '-' . $re->id]) }}">{{$re->title}}</a></p>
                                        @endforeach
                                </div>
                                @endif
                                @if ((\Auth::user() && \Auth::user()->id  == $data->id))
                                    @include(theme(TRUE).'.includes.left-menu')
                                @endif
                                @if ((\Auth::user() && \Auth::user()->id  == $data->id)|| $isFriend)
                                <p class="title-short-section">Dự án giao dịch thành công</p>
                                <div class="success-project border-block">
                                        {{--<a href="#">Bán nhà số 44/54 Bạch Đằng</a>--}}
                                </div>
                                @endif
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="row">
                                    <div class="col-xs-12">
                                        @if (!\Auth::user())
                                            <div class="col-xs-12 center-top">
                                                <p class="alert-title">Cảnh báo</p>
                                                <p>Bạn đang xem trang cá nhân của thành viên {{ $data->userinfo->full_name }} với tư cách là khách.</p>
                                                <p>Để xem và liên lạc với thành viên, hãy <a href="{{route('login')}}">Đăng nhập</a> hoặc <a href="{{route('register')}}">Đăng ký</a>.</p>
                                            </div>
                                        @else
                                            @if(\Auth::user()->id == $data->id)
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">Đăng tin mới </h4>
                                                        <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                                                    </div>
                                                    <div class="panel-body">
                                                        @include(theme(TRUE).'.includes.create-re')
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-xs-12">
                                                    @php
                                                        $checkSendFRequest1 = \App\Friend::where('user1', \Auth::user()->id)->where('user2', $data->id)->first();
                                                    $checkSendFRequest2 = \App\Friend::where('user2', \Auth::user()->id)->where('user1', $data->id)->first();
                                                    @endphp
                                                    @if($checkSendFRequest1)
                                                        @if(!$checkSendFRequest1->confirmed)
                                                            <a class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Đã gửi lời mời kết bạn</a>
                                                        @else
                                                            @if (\Auth::user()->group->chat_permission && $data->group->chat_permission)
                                                                <form role="form" action="{{ route('conversation.store') }}" method="post" accept-charset="UTF-8">
                                                                    @csrf
                                                                    <input name="user_id" type="hidden" value="{{ $data->id }}" />
                                                                    <button type="submit" class="btn btn-success pull-right"><i class="fa fa-commenting-o"></i> {{trans('detail-real-estate.chat')}}</button>
                                                                </form>
                                                            @endif
                                                        @endif
                                                    @elseif($checkSendFRequest2)
                                                        @if(!$checkSendFRequest2->confirmed)
                                                            <a href="{{route('friend.confirm.request', [$checkSendFRequest2->id])}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Chấp nhận lời mời</a>
                                                        @else
                                                            @if (\Auth::user()->group->chat_permission && $data->group->chat_permission)
                                                                <form role="form" action="{{ route('conversation.store') }}" method="post" accept-charset="UTF-8">
                                                                    @csrf
                                                                    <input name="user_id" type="hidden" value="{{ $data->id }}" />
                                                                    <button type="submit" class="btn btn-success pull-right"><i class="fa fa-commenting-o"></i> {{trans('detail-real-estate.chat')}}</button>
                                                                </form>
                                                            @endif
                                                        @endif
                                                    @else
                                                    <a href="{{route('friend.request', [$data->id])}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Thêm bạn bè</a>
                                                    @endif
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="row list-re">
                                    @if((\Auth::user() && \Auth::user()->id == $data->id)|| $isFriend)
                                        @foreach($listRe as $re)
                                            <div class="col-xs-12">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading clearfix">
                                                        <div class="col-xs-12 col-md-8 left no-padding-left">
                                                            <p>{{$re->title}}</p>
                                                            @if($re->price)
                                                                <p class="price">Giá: {{$re->price}}</p>
                                                            @endif
                                                        </div>
                                                        <div class="col-xs-12 col-md-2 pull-right no-padding-right">
                                                            @if($re->lat && $re->long)
                                                            <a href="https://www.google.com/maps/search/?api=1&query={{$re->lat}},{{$re->long}}" target="_blank">Xem bản đồ</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-xs-12 col-md-4">Khu vực: {{$re->district->name}}</div>
                                                            <div class="col-xs-12 col-md-2">Số tầng: {{$re->floor}}</div>
                                                            <div class="col-xs-12 col-md-6">Gần: {{$re->position}}</div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-12 col-md-3">{{$re->reCategory->name}}</div>
                                                            <div class="col-xs-12 col-md-9">Phòng ngủ: {{$re->bedroom}}, Phòng khách: {{$re->living_room}}, WC: {{$re->wc}}</div>
                                                        </div>
                                                        <div class="row">
                                                            @php
                                                                $imgDf = [
                                                                    'link' => '/images/default_real_estate_image.jpg',
                                                                    'alt' => $re->title,
                                                                    'thumb' => '/images/default_thumb.jpg'
                                                                ];
                                                                $thumbDf = [
                                                                    'link' => '/images/default_thumb.jpg'
                                                                ];
                                                                $images = $re->images ? json_decode($re->images) : [];
                                                                $thumbs = [];
                                                                if ($images) {
                                                                    foreach ($images as $img) {
                                                                        $img->thumb = str_replace('uploads', 'thumbs', $img->link);
                                                                    }
                                                                }
                                                                $images = $images ? $images : [(object)$imgDf];

                                                            @endphp
                                                            <div class="popup-gallery">
                                                                @foreach($images as $image)
                                                                    <a href="{{asset($image->link)}}" title="{{$image->alt ? $image->alt : $re->title}}" class="pg-item"><img src="{{asset($image->thumb)}}" width="122" height="91"></a>
                                                                @endforeach
                                                                {{--<a href="http://farm9.staticflickr.com/8242/8558295633_f34a55c1c6_b.jpg" title="The Cleaner"><img src="http://farm9.staticflickr.com/8242/8558295633_f34a55c1c6_s.jpg" width="75" height="75"></a>--}}
                                                                {{--<a href="http://farm9.staticflickr.com/8382/8558295631_0f56c1284f_b.jpg" title="Winter Dance"><img src="http://farm9.staticflickr.com/8382/8558295631_0f56c1284f_s.jpg" width="75" height="75"></a>--}}
                                                                {{--<a href="http://farm9.staticflickr.com/8225/8558295635_b1c5ce2794_b.jpg" title="The Uninvited Guest"><img src="http://farm9.staticflickr.com/8225/8558295635_b1c5ce2794_s.jpg" width="75" height="75"></a>--}}
                                                                {{--<a href="http://farm9.staticflickr.com/8383/8563475581_df05e9906d_b.jpg" title="Oh no, not again!"><img src="http://farm9.staticflickr.com/8383/8563475581_df05e9906d_s.jpg" width="75" height="75"></a>--}}
                                                                {{--<a href="http://farm9.staticflickr.com/8235/8559402846_8b7f82e05d_b.jpg" title="Swan Lake"><img src="http://farm9.staticflickr.com/8235/8559402846_8b7f82e05d_s.jpg" width="75" height="75"></a>--}}
                                                                {{--<a href="http://farm9.staticflickr.com/8235/8558295467_e89e95e05a_b.jpg" title="The Shake"><img src="http://farm9.staticflickr.com/8235/8558295467_e89e95e05a_s.jpg" width="75" height="75"></a>--}}
                                                                {{--<a href="http://farm9.staticflickr.com/8378/8559402848_9fcd90d20b_b.jpg" title="Who's that, mommy?"><img src="http://farm9.staticflickr.com/8378/8559402848_9fcd90d20b_s.jpg" width="75" height="75"></a>--}}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-12 contact-phone">
                                                                <div class="pull-right">
                                                                    <a href="tel:{{$re->contact_phone_number}}" class="btn btn-success">Gọi điện</a>
                                                                    <a href="sms://{{$re->contact_phone_number}}" class="btn btn-info">Gửi SMS</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    {{--<div class="col-xs-12">--}}
                                        {{--<div class="panel panel-default">--}}
                                            {{--<div class="panel-heading clearfix">--}}
                                                {{--<div class="col-xs-12 col-md-8 left no-padding-left"> Nhà số 3 Bạch Đằng</div>--}}
                                                {{--<div class="col-xs-12 col-md-2 pull-right no-padding-right">--}}
                                                    {{--<a href="#">Xem bản đồ</a>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="panel-body">--}}
                                                {{--<div class="row">--}}
                                                    {{--<div class="col-xs-12 col-md-3">Khu vực: Bình Thạnh</div>--}}
                                                    {{--<div class="col-xs-12 col-md-4">Số tầng: 4</div>--}}
                                                    {{--<div class="col-xs-12 col-md-5">Gần: chợ 200m</div>--}}
                                                {{--</div>--}}
                                                {{--<div class="row">--}}
                                                    {{--<div class="col-xs-12 col-md-3">Nhà mặt phố</div>--}}
                                                    {{--<div class="col-xs-12 col-md-4">Số phòng</div>--}}
                                                {{--</div>--}}
                                                {{--<div class="row">--}}
                                                    {{--<div class="popup-gallery">--}}
                                                        {{--<a href="http://farm9.staticflickr.com/8242/8558295633_f34a55c1c6_b.jpg" title="The Cleaner"><img src="http://farm9.staticflickr.com/8242/8558295633_f34a55c1c6_s.jpg" width="75" height="75"></a>--}}
                                                        {{--<a href="http://farm9.staticflickr.com/8382/8558295631_0f56c1284f_b.jpg" title="Winter Dance"><img src="http://farm9.staticflickr.com/8382/8558295631_0f56c1284f_s.jpg" width="75" height="75"></a>--}}
                                                        {{--<a href="http://farm9.staticflickr.com/8225/8558295635_b1c5ce2794_b.jpg" title="The Uninvited Guest"><img src="http://farm9.staticflickr.com/8225/8558295635_b1c5ce2794_s.jpg" width="75" height="75"></a>--}}
                                                        {{--<a href="http://farm9.staticflickr.com/8383/8563475581_df05e9906d_b.jpg" title="Oh no, not again!"><img src="http://farm9.staticflickr.com/8383/8563475581_df05e9906d_s.jpg" width="75" height="75"></a>--}}
                                                        {{--<a href="http://farm9.staticflickr.com/8235/8558295467_e89e95e05a_b.jpg" title="The Shake"><img src="http://farm9.staticflickr.com/8235/8558295467_e89e95e05a_s.jpg" width="75" height="75"></a>--}}
                                                        {{--<a href="http://farm9.staticflickr.com/8378/8559402848_9fcd90d20b_b.jpg" title="Who's that, mommy?"><img src="http://farm9.staticflickr.com/8378/8559402848_9fcd90d20b_s.jpg" width="75" height="75"></a>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                                {{--<div class="row">--}}
                                                    {{--<div class="col-xs-12">--}}
                                                        {{--<div class="pull-right">--}}
                                                            {{--<a href="#" class="btn btn-success">Gọi điện</a>--}}
                                                            {{--<a href="#" class="btn btn-info">Gửi SMS</a>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-3">
                                @if ((\Auth::user() && \Auth::user()->id  == $data->id)|| $isFriend)
                                <p class="title-short-section">Bạn bè</p>
                                <div class="list-friend border-block">
                                    @foreach($listFriends as $friend)
                                        @php
                                        $f = $friend->fuser1;
                                        if($friend->user1 == $data->id){
                                            $f = $friend->fuser2;
                                        }
                                        @endphp
                                        <p>
                                            <a href="{{ route('user.info', [$f->id])}} ">{{$f->userinfo->full_name}}</a>
                                        </p>
                                    @endforeach
                                </div>
                                @endif
                                @if ((\Auth::user() && \Auth::user()->id  == $data->id)|| $isFriend)
                                <p class="title-short-section">Dự án tham gia</p>
                                <div class="joined-project border-block">

                                        {{--<a href="#">Bán nhà số 34/65 Bạch Đằng</a>--}}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- modal post tin --}}
        <div id="postReModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <form role="form">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Đăng tin</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input class="form-control" type="text" name="title" placeholder="{{trans('real-estate.formCreateLabel.title')}}*">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="short_description" placeholder="{{trans('real-estate.formCreateLabel.shortDescription')}}*">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <input type="number" class="form-control" id="contact_phone_number" name="contact_phone_number" placeholder="{{trans('real-estate.formCreateLabel.contactPhone')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Đăng</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        {{-- end modal --}}

    </div>
    {{-- Include footer --}}
    @include(theme(TRUE).'.includes.footer')
@endsection

@push('js')
    <script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('.popup-gallery').each(function() {
                $(this).magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    tLoading: 'Loading image #%curr%...',
                    mainClass: 'mfp-img-mobile',
                    gallery: {
                        enabled: true,
                        navigateByImgClick: true,
                        preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
                    },
                    image: {
                        tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                        titleSrc: function (item) {
                            return item.el.attr('title') + '<small></small>';
                        }
                    }
                });
            });
        });
        $(document).on('click', '.panel-heading span.clickable', function(e){
            var $this = $(this);
            if(!$this.hasClass('panel-collapsed')) {
                $this.parents('.panel').find('.panel-body').slideUp();
                $this.addClass('panel-collapsed');
                $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
            } else {
                $this.parents('.panel').find('.panel-body').slideDown();
                $this.removeClass('panel-collapsed');
                $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
            }
        });
    </script>
@endpush
