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
    <link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}" />
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
                                            @php
                                                $cover = $data->userinfo->cover ? $data->userinfo->cover : '';
                                            @endphp
                                            <img src="{{$cover}}" class="img-responsive cover {{$cover ? '' : 'hidden'}}" />
                                        </div>
                                        @if (\Auth::user() && \Auth::user()->id  == $data->id)
                                            <input type="file" name="cover" class="hidden" id="cover-change" accept="image/*"/>
                                        <button class="btn btn-default btn-change-cover"><i class="fa fa-camera"></i> {{$cover ? 'Cập nhật' : 'Thêm banner'}}</button>
                                        <div class="cfr-change-cv"><a onclick="acceptChangeCv()">Lưu </a><a onclick="cancelChangeCv()"><i class="fa fa-times"></i> </a></div>
                                        @endif
                                    </div>
                                    <div class="col-xs-12 av-and-name-wrap">
                                        @php
                                            $avatar = $data->userinfo->avatar ? $data->userinfo->avatar : '/images/default-avatar.png';
                                        @endphp
                                        <div class="av-wrap">
                                            <img class="img-responsive avatar" src="{{$avatar}}"/>
                                            @if (\Auth::user() && \Auth::user()->id  == $data->id)
                                                <input type="file" class="hidden" name="av_change" id="avatar-change" value="{{$avatar}}" accept="image/*"/>
                                                <button class="btn btn-default btn-change-av"><i class="fa fa-camera" aria-hidden="true"></i> Cập nhật</button>
                                                <div class="cfr-change-av"><a onclick="acceptChangeAv()">Lưu </a><a onclick="cancelChange()"><i class="fa fa-times"></i> </a></div>
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
                                            <p class=" text-center">Chứng chỉ: </p>
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
                                                            <form class="form-horizontal form-create-re" method="post" action="{{route('post.create-real-estate')}}" enctype="multipart/form-data">
                                                                {{csrf_field()}}
                                                                <div class="panel-body ">
                                                                    @if (!empty(session('message')))
                                                                        <div class="alert alert-{{session('message.type')}} text-center">
                                                                            {{session('message.message')}}
                                                                        </div>
                                                                    @endif
                                                                    {{--<textarea class="form-control" placeholder="Bán nhà ..." id="title-hold"></textarea>--}}

                                                                    <div class="form-group">
                                                                        <div class="col-sm-12">
                                                                            <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" placeholder="Tiêu đề *"/>
                                                                            <p class="text-red error"></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="col-sm-12">
                                                                            <textarea name="detail" class="form-control autoExpand" id="detail" placeholder="Nội dung tin *"></textarea>
                                                                            <p class="text-red error"></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="panel-footer clearfix">
                                                                    @include(theme(TRUE).'.includes.create-re-collapse')
                                                                    <div class="form-group" style="margin-bottom: 0px;">
                                                                        <div class="col-xs-12">
                                                                            <button type="button" class="btn btn-default btn-collapse" data-target="#catSelect">Danh mục</button>
                                                                            <button type="button" class="btn btn-default btn-collapse" data-target="#addressSelect"><i class="fa fa-road" aria-hidden="true"></i> Khu vực</button>
                                                                            <button type="button" class="btn btn-default btn-collapse" data-target="#nearBy">Gần</button>
                                                                            <button type="button" class="btn btn-default btn-collapse-second" data-toggle="collapse" data-target="#list-cl">
                                                                                <i class="fa fa-circle"></i>
                                                                                <i class="fa fa-circle"></i>
                                                                                <i class="fa fa-circle"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="collapse" id="list-cl">
                                                                        <div class="form-group">
                                                                            <div class="col-xs-12">
                                                                                <button type="button" class="btn btn-default btn-collapse" data-target="#nearBy">Gần</button>
                                                                                <button type="button" class="btn btn-default btn-collapse" data-target="#directionSelect">Hướng</button>
                                                                                <button type="button" class="btn btn-default btn-collapse" data-target="#exhibitSelect">Giấy tờ</button>
                                                                                <button type="button" class="btn btn-default btn-collapse" data-target="#projectSelect">Dự án</button>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="col-xs-12">
                                                                                <button type="button" class="btn btn-default btn-collapse" data-target="#room"><i class="fa fa-bed" aria-hidden="true"></i> Phòng</button>
                                                                                <button type="button" class="btn btn-default btn-collapse" data-target="#area"><i class="fa fa-area-chart" aria-hidden="true"></i> Diện tích</button>
                                                                                <button type="button" class="btn btn-default btn-collapse" data-target="#floorSelect">Số tầng</button>
                                                                                <button type="button" class="btn btn-default btn-collapse" data-target="#priceSelect">Giá</button>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="col-xs-12">
                                                                                <button type="button" class="btn btn-default btn-collapse" data-target="#mapSelect"><i class="fa fa-map-marker"></i> Vị ví</button>
                                                                                <button type="button" class="btn btn-default btn-collapse" data-target="#imageSelect"><i class="fa fa-picture-o"></i> Hình ảnh</button>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-xs-12">
                                                                            <div class="pull-right">
                                                                                <button type="button" name="add_new" id="add-new-re" class="_btn bg_red"><i class="fa fa-plus"></i> &nbsp;&nbsp;ĐĂNG TIN
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </form>
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
                                                                    @if($re->district)
                                                                    <div class="col-xs-12 col-md-4">
                                                                            Khu vực: {{$re->district->name}}
                                                                    </div>
                                                                    @endif
                                                                    @if($re->floor)
                                                                    <div class="col-xs-12 col-md-2">
                                                                            Số tầng: {{$re->floor}}
                                                                    </div>
                                                                    @endif
                                                                    @if($re->position)
                                                                    <div class="col-xs-12 col-md-6">
                                                                            Gần: {{$re->position}}
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                                <div class="row">
                                                                    @if($re->reCategory)
                                                                        <div class="col-xs-12 col-md-3">{{$re->reCategory ? $re->reCategory->name : ''}}</div>
                                                                    @endif
                                                                    <div class="col-xs-12 col-md-9"> {{$re->bedroom ? 'Phòng ngủ: ' . $re->bedroom : ''}}{{ ($re->bedroom && $re->living_room) ? ', ' : ''}}{{$re->living_room ? 'Phòng khách: ' . $re->living_room : ''}}{{ ($re->living_room && $re->wc) ? ', ' : '' }}{{$re->wc ? 'WC: ' . $re->wc : ''}}</div>
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
        <div id="postReModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" onclick="closemd()">&times;</button>
                        <h4 class="modal-title">Đăng tin mới</h4>
                    </div>
                    <div class="modal-body">
                        {{--@include(theme(TRUE).'.includes.create-re')--}}
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- Include footer --}}
    @include(theme(TRUE).'.includes.user-info-footer')
@endsection

@push('js')
    <script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
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
                $('#postReModal').modal('show');
                $(this).blur();
            });
            $('#btn-hold').on('click', function() {
                $('#postReModal').modal('show');
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

        $(document)
        .one('focus.autoExpand', 'textarea.autoExpand', function(){
            var savedValue = this.value;
            this.value = '';
            this.baseScrollHeight = this.scrollHeight;
            this.value = savedValue;
        })
        .on('input.autoExpand', 'textarea.autoExpand', function(){
            var minRows = this.getAttribute('data-min-rows')|0, rows;
            this.rows = minRows;
            rows = Math.ceil((this.scrollHeight - this.baseScrollHeight) / 16);
            this.rows = minRows + rows;
        });

        /*---------------- change avatar -----------------*/
        let curAvatar = $('.avatar').attr('src');
        let curCover = $('.cover').attr('src');
        let formDataAv = false;
        let formDataCover = false;
        console.log('current avatar');
        console.log(curAvatar);
        $('.btn-change-av').click( function () {
            $('#avatar-change').trigger('click');
        });
        $('#avatar-change').on('change', function () {
            console.log('new avatar');
            console.log($(this).val());
            readSingleURL(this, '.avatar');
            $('.cfr-change-av').css('display', 'block');
        });

        function readSingleURL(input, target) {
            console.log(input.files);
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(target).attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
            if ( target == '.avatar' ) {
                formDataAv = new FormData();
                formDataAv.append('avatar', input.files[0]);
            }
            if (target == '.cover') {
                formDataCover = new FormData();
                formDataCover.append('cover', input.files[0]);
            }
        }
        function acceptChangeAv() {
            if (formDataAv) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    }
                });
                $.ajax({
                    url: '{{route('post.update-avatar')}}',
                    type: 'POST',
                    data: formDataAv,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        console.log('success change av');
                        console.log(res);
                        toastr.success(res.message);
                        $('.avatar').attr('src', res.uploaded_image);
                        $('.cfr-change-av').css('display', 'none');
                    },
                    error: function(err) {
                        console.log('err change av');
                        console.log(err);
                        toastr.error(err.message);
                    }
                });
            }
        }
        function cancelChange() {
            $('.avatar').attr('src', curAvatar);
            $('.cfr-change-av').css('display', 'none');
        }
        /*---------------- end change avatar -----------------*/

        /*---------------- change cover -----------------*/
        $('.btn-change-cover').click( function () {
            $('#cover-change').trigger('click');
        });
        $('#cover-change').on('change', function () {
            console.log('new cover');
            console.log($(this).val());
            readSingleURL(this, '.cover');
            $('.cover').removeClass('hidden');
            $('.cfr-change-cv').css('display', 'block');
        });
        function acceptChangeCv() {
            if (formDataCover) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    }
                });
                $.ajax({
                    url: '{{route('post.update-cover')}}',
                    type: 'POST',
                    data: formDataCover,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        console.log('success change cover');
                        console.log(res);
                        if (res.success) {
                            toastr.success(res.message);
                            $('.cover').attr('src', res.uploaded_image);
                            $('.cfr-change-cv').css('display', 'none');
                        } else {
                            toastr.error(res.message);
                            // $('.cover').attr('src', res.uploaded_image);
                            // $('.cfr-change-cv').css('display', 'none');
                        }
                    },
                    error: function(err) {
                        console.log('err change cover');
                        console.log(err);
                        err.message.each(mes => {
                            toastr.error(mes);
                        });
                        // toastr.error(err.message);
                    }
                });
            }
        }
        function cancelChangeCv() {
            $('.cover').attr('src', curCover);
            if (!curCover) {
                if(!$('.cover').hasClass('hidden')) {
                    $('.cover').addClass('hidden');
                }
            }
            $('.cfr-change-cv').css('display', 'none');
        }
        /*---------------- end change cover -----------------*/
    </script>
@endpush
