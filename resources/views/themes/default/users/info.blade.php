@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Thông tin thành viên" >
@endsection

@section('title')
    {{trans('users.info')}}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <link rel="stylesheet" href="{{asset('plugins/loopj-jquery-tokeninput/styles/token-input.css')}}" />
    <link rel="stylesheet" href="{{asset('plugins/loopj-jquery-tokeninput/styles/token-input-bootstrap3.css')}}" />
    <style type="text/css">
        #token-input-subcribes {
            border: none;
        }
    </style>
@endpush

@section('content')
    @php
        $guigannhat =   \App\Verify::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->first();
        $thoigiangui = \Carbon\Carbon::now()->diffInSeconds(\Carbon\Carbon::parse($guigannhat->created_at), true);
    @endphp

    @include(theme(TRUE).'.includes.user-info-header-1')

    <div class="container-vina">
        <div class="row subpage">

            <div class="col-xs-3 left">
                @include(theme(TRUE).'.includes.left-menu')
            </div>
        <!--End right-->

            <!--Begin left-->
            <div class="col-xs-9 right">
                @include(theme(TRUE).'.includes.message')
                <!--begin manage_page-->
                <div class="changeinfoA_page member_page">
                    <p class="title_boxM"><strong><i class="fa fa-file-pdf-o"></i> Cập nhật thông tin</strong></p>
                    <div>
                        <div class="_form">
                            <form id="dangnhap-form" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div id="dangnhap-form_es_" class="errorSummary" style="display:none"><p>Xin hãy sửa lại những lỗi nhập liệu sau:</p>
                                    <ul><li>dummy</li></ul></div>							<div class="row">

                                    <div class="col-xs-12">
                                        <dl>
                                            <dt class="txt_right">Họ và tên <span class="required">*</span></dt>
                                            <dd>
                                                <input class="_required" name="full_name" id="full_name" type="text" maxlength="200" value="{{auth()->user()->userinfo->full_name}}">
                                            </dd>
                                        </dl>
                                    </div>
                                    <div class="col-xs-12">
                                        <dl>
                                            <dt class="txt_right">Hạng thành viên <span class="required">*</span></dt>
                                            <dd>
                                                <input class="_required" name="group" id="group" type="text" value="{{auth()->user()->group->name}}" disabled>
                                                <a></a>
                                            </dd>
                                        </dl>
                                    </div>
                                    <div class="col-xs-12">
                                        <dl>
                                            <dt class="txt_right">Nơi làm việc <span class="required">*</span></dt>
                                            <dd>
                                                <input class="_required" name="company" id="company" type="text" maxlength="200" value="{{auth()->user()->userinfo->company}}">
                                            </dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-12">
                                        <dl>
                                            <dt class="txt_right">Số CMT/Mã số thuế <span class="required">*</span></dt>
                                            <dd>
                                                <input class="_required" name="identification" id="identification" type="text" maxlength="50" value="{{auth()->user()->userinfo->identification}}">
                                            </dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-6">
                                        <dl>
                                            <dt class="txt_right">Điện thoại <span class="required">*</span></dt>
                                            <dd>
                                                <input class="_required" name="phone" id="phone" type="text" maxlength="50" value="{{auth()->user()->userinfo->phone}}">
                                            </dd>
                                        </dl>
                                    </div>

                                    @if(empty(auth()->user()->phone_verify))
                                        <div class="col-xs-6">
                                            <dl>
                                                <dt class="txt_right" style="width: 100%"><span class="required"><i class="fa fa-times-circle-o" style="color: red"></i> <a href="#" class="verify_btn" id="{{auth()->user()->id}}">Click để xác minh</a></span></dt>
                                                <dd>

                                                </dd>
                                            </dl>
                                        </div>
                                    @else
                                        <div class="col-xs-6">
                                            <dl>
                                                <dt class="txt_right"><span class="required"><i class="fa fa-check"></i> Đã xác thực</span></span></dt>
                                            </dl>
                                        </div>
                                    @endif

                                    <div class="col-xs-12">
                                        <dl>
                                            <dt class="txt_right">Tỉnh/Thành <span class="required">*</span></dt>
                                            <dd>
                                                <select class="_required" name="province_id">
                                                    @foreach($provinces as $province)
                                                        <option value="{{$province->id}}" {{$province->id == auth()->user()->userinfo->province_id ? 'selected' : ''}}>{{$province->name}}</option>
                                                    @endforeach
                                                </select>
                                            </dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-12">
                                        <dl>
                                            <dt class="txt_right">Địa chỉ <span class="required">*</span></dt>
                                            <dd>
                                                <input class="_required" name="address" id="address" type="text" maxlength="200" value="{{auth()->user()->userinfo->address}}">
                                            </dd>
                                        </dl>
                                    </div>

                                    {{--<div class="col-xs-12">--}}
                                        {{--<dl>--}}
                                            {{--<dt class="txt_right">Email <span class="required">*</span></dt>--}}
                                            {{--<dd>--}}
                                                {{--<input class="_required" name="email" id="email" type="text" maxlength="200" value="{{auth()->user()->email}}">											<div class="errorMessage" id="Account_email_em_" style="display:none"></div>										</dd>--}}
                                        {{--</dl>--}}
                                    {{--</div>--}}

                                    <div class="col-xs-12">
                                        <dl>
                                            <dt class="txt_right">Website</dt>
                                            <dd>
                                                <input name="website" id="website" type="text" maxlength="200" value="{{ auth()->user()->userinfo->website }}">
                                            </dd>
                                        </dl>
                                    </div>
                                    <div class="col-xs-12">
                                        <dl>
                                            <dt class="txt_right">Giới thiệu <span class="required">*</span></dt>
                                            <dd>
                                                <textarea class="_required" name="description" >{{ auth()->user()->userinfo->description }}</textarea>
                                            </dd>
                                        </dl>
                                    </div>
                                    <div class="col-xs-12">
                                        <dl>
                                            <dt class="txt_right">Tỉnh, thành quan tâm:</dt>
                                            <dd>
                                                <input type="text" name="subcribes" id="subcribes" />
                                            </dd>
                                        </dl>
                                    </div>

                                    @if(empty(auth()->user()->userinfo->certificate))
                                        <div class="col-xs-12">
                                            <dl>
                                                <dt class="txt_right">Chứng chỉ </dt>
                                                <dd>
                                                    <input type="file" class="_required" name="certificate" id="certificate">
                                                </dd>
                                            </dl>
                                        </div>
                                        <div class="col-xs-12">
                                            <dl>
                                                <dt class="txt_right"></dt>
                                                <dd>
                                                    <em>Lưu ý: Chỉ cho phép tải các file có đuôi định dạng: jpeg, jpg, bmp, png</em>
                                                </dd>
                                            </dl>
                                        </div>
                                    @else
                                        <div class="col-xs-12">
                                            <dl>
                                                <dt class="txt_right"></dt>
                                                <dd>
                                                    <a href='{{asset(auth()->user()->userinfo->certificate)}}' target='_blank' class='btn btn-info btn-xs'><i
                                                                class='fa fa-eye'></i> Xem chứng chỉ</a>
                                                </dd>
                                            </dl>
                                        </div>
                                        <div class="col-xs-12">
                                            <dl>
                                                <dt class="txt_right">Cập nhật chứng chỉ </dt>
                                                <dd>
                                                    <input type="file" class="_required" name="certificate" id="certificate">
                                                </dd>
                                            </dl>
                                        </div>
                                        <div class="col-xs-12">
                                            <dl>
                                                <dt class="txt_right"></dt>
                                                <dd>
                                                    <em>Lưu ý: Chỉ cho phép tải các file có đuôi định dạng: jpeg, jpg, bmp, png</em>
                                                </dd>
                                            </dl>
                                        </div>
                                    @endif

                                    <div class="col-xs-12">
                                        <hr/>
                                    </div>
                                    <div class="col-xs-12">
                                        <dl>
                                            <dt class="txt_right">Tiêu đề </dt>
                                            <dd>
                                                <input type="text" class="" name="seo_title" id="seo_title" maxlength="191" value="{{auth()->user()->userinfo->seo_title}}">
                                            </dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-12">
                                        <dl>
                                            <dt class="txt_right">Từ khóa </dt>
                                            <dd>
                                                <textarea name="seo_keyword">{{  auth()->user()->userinfo->seo_keyword }}</textarea>
                                            </dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-12">
                                        <dl>
                                            <dt class="txt_right">Mô tả </dt>
                                            <dd>
                                                <textarea name="seo_description">{{ auth()->user()->userinfo->seo_description }}</textarea>
                                            </dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-12">
                                        <dl>
                                            <dt></dt>
                                            <dd>
                                                <button type="submit" class="_btn bg_red"><i class="fa fa-pencil-square-o fa-lg fa-fw"></i> THAY ĐỔI</button>
                                                <button type="reset" class="_btn bg_black"><i class="fa fa-refresh fa-lg fa-fw"></i> LÀM LẠI</button>
                                            </dd>
                                        </dl>
                                    </div>

                                </div>
                            </form>					</div>



                        <div class="clearfix"></div>
                    </div>
                </div>
                <!--end manage_page-->

            </div>
            <!--End left-->

        </div>
    </div>
    @if(empty(auth()->user()->phone_verify))
    <form method="post" action="{{route('post.verify')}}">
        {{csrf_field()}}
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content modal-lg">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Xác thực số điện thoại</h4>
                    </div>
                    <div class="modal-body">
                        @if(!empty(session('codeSend')) && session('codeSend') == 'send')
                            Mã xác thực vừa được gửi về số điện thoại của bạn. Vui lòng nhập mã vào ô bên dưới để xác thực.
                            <br/>
                        @endif
                        <label class="control-label">Mã xác thực</label>
                        <div>
                            <input class="form-control" name="verify_code">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a id="countdown" href="{{route('resend.verify')}}"
                           class="btn pull-right @if($thoigiangui<60) disabled @endif"><i
                                    class="fa fa-refresh"></i> Gửi lại mã
                        </a>
                        <button type="submit"
                                class="_btn bg_red pull-right"><i
                                    class="fa fa-plus"></i> XÁC THỰC
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @endif
    @include(theme(TRUE).'.includes.footer')
@endsection

@push('js')
    <script src="{{asset('plugins/loopj-jquery-tokeninput/src/jquery.tokeninput.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('#subcribes').tokenInput('{{route('ajaxProvince')}}', {
                theme: "bootstrap",
                queryParam: "term",
                zindex  :   1005,
                preventDuplicates : true,
                prePopulate : [
                    @foreach(auth()->user()->subcribes()->get() as $item)
                    {id: '{{$item->id}}', 'name': '{{$item->name}}'},
                    @endforeach
                ]
            });
        });
        @if(empty(auth()->user()->phone_verify))
        $('.verify_btn').on('click', function () {
            // console.log(check);
            // var id      =   $(this).attr('id');

            // $('.modal #id').val(id);
            $('#myModal').modal('show');
        });
        @if(!empty(session('codeSend')) && session('codeSend') == 'send')
        $('#myModal').modal('show');
        @php
        session()->forget('codeSend');
        @endphp
        @endif
        @endif
    </script>
    <script>
        // Set the date we're counting down to
        @if($thoigiangui<60)
        var countDownDate = new Date("{{\Carbon\Carbon::now()->addSecond(60-$thoigiangui)->format("M d, Y H:i:s")}}").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get todays date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("countdown").innerHTML = '<i class="fa fa-refresh"></i> Gửi lại sau '+seconds + " giây ";

            // If the count down is over, write some text
            if (distance < 0) {
                clearInterval(x);
                $('#countdown').removeClass('disabled');
                $('#countdown').html('<i class="fa fa-refresh"></i> Gửi lại mã');
            }
        }, 1000);
        @endif
    </script>
@endpush
