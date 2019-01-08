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
    @include(theme(TRUE).'.includes.user-info-header')
    <div class="content-body">
        <div class="container padding-bottom-30">
            <div class="row">
                <div class="col-xs-12 col-md-12 detail-content-wrap">
                    {{--<p class="title_box"><strong>{{ $data->userinfo->full_name }}</strong>--}}
                    {{--</p>--}}
                    <div class="row">
                        <div class="col-xs-12 col-md-9">
                            <div class="detail-top">
                                <div class="row row-wrap" >
                                    <div class="col-xs-12 cover-wrap">
                                        <div class="cover-content-wrap">
                                            {{--<img src="http://thuthuat123.com/uploads/2018/01/27/tong-hop-anh-bia-facebook-dep-50_101149.jpg" class="img-responsive" />--}}
                                        </div>
                                        <button class="btn btn-default btn-change-cover"><i class="fa fa-camera"></i> Thêm banner</button>
                                    </div>
                                    <div class="col-xs-12 av-and-name-wrap">
                                        @php
                                            $avatar = $data->userinfo->avatar ? $data->userinfo->avatar : '/images/default-avatar.png';
                                        @endphp
                                        <div class="av-wrap">
                                            <img class="img-responsive avatar" src="{{$avatar}}"/>
                                            @if (\Auth::user() && \Auth::user()->id  == $data->id)
                                                <input type="hidden" id="avatar" value="{{$avatar}}"/>
                                                <button data-toggle="modal" data-target="#modalAvatar" class="btn btn-default btn-change-av"><i class="fa fa-camera" aria-hidden="true"></i> Cập nhật</button>
                                            @endif
                                        </div>
                                        <h1 class="name">{{ $data->userinfo->full_name }} </h1>
                                        <div class="update-info-wrap">
                                            @if (\Auth::user() && \Auth::user()->id  == $data->id)
                                                <p class="text-center">
                                                    <a href="{{route('info')}}" ><i class="fa fa-pencil-square-o"></i> Cập nhật thông tin</a>
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">

                                    </div>
                                </div>
                            </div>
                            @php
                                $isFriend = false;
                                if(\Auth::user() && \Auth::user()->id  !== $data->id) {
                                    $isFriend = isFriend(\Auth::user()->id, $data->id);
                                }
                            @endphp
                            <div class="user-info">
                                <div class="row">
                                    <div class="col-xs-12 col-md-4">



                                        <p class="title-short-section">Giới thiệu</p>
                                        <div class="u-description border-block">
                                            <p class=" text-center">Làm việc tại: {{ $data->userinfo->company }}</p>
                                            <p class=" text-center">Đánh giá: 87/100 điểm</p>
                                            <p class="user-desc">{{ $data->userinfo->description }}</p>
                                        </div>
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
                                    <div class="col-xs-12 col-md-8">
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
                                                                {{--<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>--}}
                                                            </div>
                                                            <div class="panel-body ">
                                                                @if (!empty(session('message')))
                                                                    <div class="alert alert-{{session('message.type')}} text-center">
                                                                        {{session('message.message')}}
                                                                    </div>
                                                                @endif
                                                                <textarea class="form-control" placeholder="Bán nhà ..." id="title-hold"></textarea>
                                                                {{--@include(theme(TRUE).'.includes.create-re')--}}
                                                            </div>
                                                            <div class="panel-footer clearfix">
                                                                <div class="pull-right">
                                                                    <button type="button" class="btn btn-primary" id="btn-hold">Đăng</button>
                                                                </div>
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
                                                                    <p>
                                                                        <a href="{{ route('detail-real-estate', ['slug' => $re->slug . '-' . $re->id]) }}">
                                                                            {{$re->title}}
                                                                        </a>
                                                                    </p>
                                                                    @if($re->price)
                                                                        <p class="price">Giá: {{$re->price}}</p>
                                                                    @endif
                                                                </div>
                                                                <div class="col-xs-12 col-md-2 pull-right no-padding-right">
                                                                    @if($re->lat && $re->long)
                                                                        <a href="https://www.google.com/maps/search/?api=1&query={{$re->lat}},{{$re->long}}" target="_blank">Xem bản đồ</a>
                                                                    @endif
                                                                    @if (\Auth::user() && \Auth::user()->id == $data->id)
                                                                        <a href="{{route('get.edit-real-estate', ['id' => $re->id])}}" ><i class="fa fa-pencil-square-o"></i> Sửa tin</a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="panel-body">
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-md-4">Khu vực: {{$re->district ? $re->district->name : ''}}</div>
                                                                    <div class="col-xs-12 col-md-2">Số tầng: {{$re->floor}}</div>
                                                                    <div class="col-xs-12 col-md-6">Gần: {{$re->position}}</div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-md-3">{{$re->reCategory ? $re->reCategory->name : ''}}</div>
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
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-xs-12 contact-phone">
                                                                        <div class="pull-right">
                                                                            <a href="tel:{{$data->userinfo->phone}}" class="btn btn-success">Gọi điện</a>
                                                                            <a href="sms:{{$data->userinfo->phone}}" class="btn btn-info">Gửi SMS</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="row">
                                <div class="col-xs-12">
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

        </div>
        {{-- modal post tin --}}
        <div id="postReModal" class="modal1 fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" onclick="closemd()">&times;</button>
                        <h4 class="modal-title">Đăng tin mới</h4>
                    </div>
                    <div class="modal-body">
                        @include(theme(TRUE).'.includes.create-re')
                    </div>
                </div>

            </div>
        </div>
        {{-- end modal --}}
        @if (auth()->check())
        <div class="modal fade" id="modalAvatar" style="opacity: 1; overflow: visible; display: none;" aria-hidden="true">
            <div class="modal-dialog" style="width: 860px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Chọn ảnh</h4>
                    </div>
                    <div class="modal-body" style="padding:0px; margin:0px; width: 100%;">
                        <iframe width="100%" height="400" src="/plugins/filemanager/dialog.php?type=1&amp;field_id=avatar'&amp;fldr=" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        @endif

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
            $(document).on("focus","#title-hold", function(){
                // alert("textarea focus");
                $('body').append('<div class="modal1-backdrop fade in"></div>');
                $('#postReModal').addClass('in');
                $('#postReModal').attr('style', 'overflow: hidden auto !important; display: block');
                // $('#postReModal').modal('show');
                $(this).blur();
            });
            $('#btn-hold').on('click', function() {
                $('body').append('<div class="modal1-backdrop fade in"></div>');
                $('#postReModal').addClass('in');
                $('#postReModal').attr('style', 'overflow: hidden auto !important; display: block');
            });
            $('#myModal').on('hidden.bs.modal', function (e) {
                $('body.modal-backdrop').remove();
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
        $('#add-new-re').on('click', function() {
            let title = $('#title').val();
            // let reCategory = $('#re-category').val();
            // let reType = $('#re-type').val();
            // let district = $('#district').val();
            // let ward = $('#ward').val();
            // let street = $('#street').val();
            // let direction = $('#direction').val();
            // let exhibit = $('#exhibit').val();
            // let project = $('#project').val();
            // let areaOfPremises = $('#area-of-premises').val();
            // let postDate = $('#post-date-val').val();
            // let expireDate = $('#expire-date-val').val();
            let detail = $('textarea#detail').val();

            if(!title || !detail) {
                if (!title) {
                    console.log('title empty');
                    $('#title').parent().find('.error').html('Nhập tiêu đề tin');
                } else {
                    $('#title').parent().find('.error').html('');
                }
                // if (!reCategory) {
                //     console.log('title empty');
                //     $('#re-category').parent().find('.error').html('Chọn danh mục');
                // } else {
                //     $('#re-category').parent().find('.error').html('');
                // }
                // if (!reType) {
                //     console.log('title empty');
                //     $('#re-type').parent().find('.error').html('Chọn loại BĐS');
                // } else {
                //     $('#re-type').parent().find('.error').html('');
                // }
                // if (!district) {
                //     console.log('title empty');
                //     $('#district').parent().find('.error').html('Chọn quận/huyện');
                // } else {
                //     $('#district').parent().find('.error').html('');
                // }
                // if (!ward) {
                //     console.log('title empty');
                //     $('#ward').parent().find('.error').html('Chọn phường/xã');
                // } else {
                //     $('#ward').parent().find('.error').html('');
                // }
                // if (!street) {
                //     console.log('title empty');
                //     $('#street').parent().find('.error').html('Chọn đường phố');
                // } else {
                //     $('#street').parent().find('.error').html('');
                // }
                // if (!direction) {
                //     console.log('title empty');
                //     $('#direction').parent().find('.error').html('Chọn hướng');
                // } else {
                //     $('#direction').parent().find('.error').html('');
                // }
                // if (!exhibit) {
                //     console.log('title empty');
                //     $('#exhibit').parent().find('.error').html('Chọn giấy tờ');
                // } else {
                //     $('#exhibit').parent().find('.error').html('');
                // }
                // if (!project) {
                //     console.log('title empty');
                //     $('#project').parent().find('.error').html('Chọn dự án');
                // } else {
                //     $('#project').parent().find('.error').html('');
                // }
                // if (!areaOfPremises) {
                //     console.log('title empty');
                //     $('#area-of-premises').parent().find('.error').html('Nhập diện tích mặt bằng');
                // } else {
                //     $('#area-of-premises').parent().find('.error').html('');
                // }
                // if (!postDate) {
                //     console.log('title empty');
                //     $('#post-date').parent().find('.error').html('Chọn ngày đăng');
                // } else {
                //     $('#post-date').parent().find('.error').html('');
                // }
                // if (!expireDate) {
                //     console.log('title empty');
                //     $('#expire-date').parent().find('.error').html('Chọn ngày hết hạn');
                // } else {
                //     $('#expire-date').parent().find('.error').html('');
                // }
                if (!detail) {
                    console.log('detail empty');
                    $('textarea#detail').parent().find('.error').html('Nhập nội dung chi tiết');
                } else {
                    $('textarea#detail').parent().find('.error').html('');
                }

                return;
            }
            $(this).closest('form').submit();
        });
        function closemd() {
            $('body').find('.modal1-backdrop').remove();
            $('#postReModal').removeClass('in');
            $('#postReModal').attr('style', 'display: none;');
        }
    </script>
@endpush
