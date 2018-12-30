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
                                @php
                                    $avatar = $data->userinfo->avatar ? $data->userinfo->avatar : '/images/default-avatar.png';
                                @endphp
                                <img class="img-responsive avatar" src="{{$avatar}}"/>
                                <h1 class="name text-center">{{ $data->userinfo->full_name }} </h1>
                                <p class=" text-center">Làm việc tại: {{ $data->userinfo->company }}</p>
                                <p class=" text-center">Đánh giá: 87/100 điểm</p>
                                <p class="title-short-section">Giới thiệu</p>
                                <p class="user-desc">{{ $data->userinfo->description }}</p>
                                <p class="title-short-section">Tin đã đăng</p>
                                <div class="posted-re border-block">
                                    <a href="#">Bán nhà số 44/54 Bạch Đằng</a>
                                </div>
                                @if (\Auth::user())
                                    @include(theme(TRUE).'.includes.left-menu')
                                @endif
                                <p class="title-short-section">Dự án giao dịch thành công</p>
                                <div class="success-project border-block">
                                    <a href="#">Bán nhà số 44/54 Bạch Đằng</a>
                                </div>
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

                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">Đăng tin mới </h4>
                                                        <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                                                    </div>
                                                    <div class="panel-body">
                                                        @include(theme(TRUE).'.includes.create-re')
                                                    </div>
                                                </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row list-re">
                                    <div class="col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading clearfix">
                                                <div class="col-xs-12 col-md-8 left no-padding-left"> Nhà số 3 Bạch Đằng</div>
                                                <div class="col-xs-12 col-md-2 pull-right no-padding-right">
                                                    <a href="#">Xem bản đồ</a>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-3">Khu vực: Bình Thạnh</div>
                                                    <div class="col-xs-12 col-md-4">Số tầng: 4</div>
                                                    <div class="col-xs-12 col-md-5">Gần: chợ 200m</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-3">Nhà mặt phố</div>
                                                    <div class="col-xs-12 col-md-4">Số phòng</div>
                                                </div>
                                                <div class="row">
                                                    <div class="popup-gallery">
                                                        <a href="http://farm9.staticflickr.com/8242/8558295633_f34a55c1c6_b.jpg" title="The Cleaner"><img src="http://farm9.staticflickr.com/8242/8558295633_f34a55c1c6_s.jpg" width="75" height="75"></a>
                                                        <a href="http://farm9.staticflickr.com/8382/8558295631_0f56c1284f_b.jpg" title="Winter Dance"><img src="http://farm9.staticflickr.com/8382/8558295631_0f56c1284f_s.jpg" width="75" height="75"></a>
                                                        <a href="http://farm9.staticflickr.com/8225/8558295635_b1c5ce2794_b.jpg" title="The Uninvited Guest"><img src="http://farm9.staticflickr.com/8225/8558295635_b1c5ce2794_s.jpg" width="75" height="75"></a>
                                                        <a href="http://farm9.staticflickr.com/8383/8563475581_df05e9906d_b.jpg" title="Oh no, not again!"><img src="http://farm9.staticflickr.com/8383/8563475581_df05e9906d_s.jpg" width="75" height="75"></a>
                                                        <a href="http://farm9.staticflickr.com/8235/8559402846_8b7f82e05d_b.jpg" title="Swan Lake"><img src="http://farm9.staticflickr.com/8235/8559402846_8b7f82e05d_s.jpg" width="75" height="75"></a>
                                                        <a href="http://farm9.staticflickr.com/8235/8558295467_e89e95e05a_b.jpg" title="The Shake"><img src="http://farm9.staticflickr.com/8235/8558295467_e89e95e05a_s.jpg" width="75" height="75"></a>
                                                        <a href="http://farm9.staticflickr.com/8378/8559402848_9fcd90d20b_b.jpg" title="Who's that, mommy?"><img src="http://farm9.staticflickr.com/8378/8559402848_9fcd90d20b_s.jpg" width="75" height="75"></a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="pull-right">
                                                            <a href="#" class="btn btn-success">Gọi điện</a>
                                                            <a href="#" class="btn btn-info">Gửi SMS</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading clearfix">
                                                <div class="col-xs-12 col-md-8 left no-padding-left"> Nhà số 3 Bạch Đằng</div>
                                                <div class="col-xs-12 col-md-2 pull-right no-padding-right">
                                                    <a href="#">Xem bản đồ</a>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-3">Khu vực: Bình Thạnh</div>
                                                    <div class="col-xs-12 col-md-4">Số tầng: 4</div>
                                                    <div class="col-xs-12 col-md-5">Gần: chợ 200m</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-3">Nhà mặt phố</div>
                                                    <div class="col-xs-12 col-md-4">Số phòng</div>
                                                </div>
                                                <div class="row">
                                                    <div class="popup-gallery">
                                                        <a href="http://farm9.staticflickr.com/8242/8558295633_f34a55c1c6_b.jpg" title="The Cleaner"><img src="http://farm9.staticflickr.com/8242/8558295633_f34a55c1c6_s.jpg" width="75" height="75"></a>
                                                        <a href="http://farm9.staticflickr.com/8382/8558295631_0f56c1284f_b.jpg" title="Winter Dance"><img src="http://farm9.staticflickr.com/8382/8558295631_0f56c1284f_s.jpg" width="75" height="75"></a>
                                                        <a href="http://farm9.staticflickr.com/8225/8558295635_b1c5ce2794_b.jpg" title="The Uninvited Guest"><img src="http://farm9.staticflickr.com/8225/8558295635_b1c5ce2794_s.jpg" width="75" height="75"></a>
                                                        <a href="http://farm9.staticflickr.com/8383/8563475581_df05e9906d_b.jpg" title="Oh no, not again!"><img src="http://farm9.staticflickr.com/8383/8563475581_df05e9906d_s.jpg" width="75" height="75"></a>
                                                        <a href="http://farm9.staticflickr.com/8235/8558295467_e89e95e05a_b.jpg" title="The Shake"><img src="http://farm9.staticflickr.com/8235/8558295467_e89e95e05a_s.jpg" width="75" height="75"></a>
                                                        <a href="http://farm9.staticflickr.com/8378/8559402848_9fcd90d20b_b.jpg" title="Who's that, mommy?"><img src="http://farm9.staticflickr.com/8378/8559402848_9fcd90d20b_s.jpg" width="75" height="75"></a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="pull-right">
                                                            <a href="#" class="btn btn-success">Gọi điện</a>
                                                            <a href="#" class="btn btn-info">Gửi SMS</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <p class="title-short-section">Bạn bè</p>
                                <div class="list-friend border-block">
                                    <a href="#">Thang Pham</a>
                                </div>
                                <p class="title-short-section">Dự án tham gia</p>
                                <div class="joined-project border-block">
                                    <a href="#">Bán nhà số 34/65 Bạch Đằng</a>
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
            $('.popup-gallery').magnificPopup({
                delegate: 'a',
                type: 'image',
                tLoading: 'Loading image #%curr%...',
                mainClass: 'mfp-img-mobile',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                },
                image: {
                    tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                    titleSrc: function(item) {
                        return item.el.attr('title') + '<small></small>';
                    }
                }
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
        })
    </script>
@endpush
