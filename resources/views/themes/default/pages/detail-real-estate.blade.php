@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Description page" >
@endsection

@section('title')
    Title Page
@endsection

@push('style')
    {{-- Link css for page here --}}
    <link rel="stylesheet" href="{{ asset('css/detail-real-estate.css') }}"/>
@endpush

@section('content')
    {{-- Include Header --}}
    @include(theme(TRUE).'.includes.header')
    {{--Page html content --}}
    <div class="content-body">
       <div class="container padding-top-30 padding-bottom-30">
           <div class="row">
               <div class="col-xs-12 col-md-9 detail-content-wrap">
                   <p class="title_box"><strong>Cần bán <i class="fa fa-angle-right"></i> Nhà trong ngõ (1416)</strong></p>
                   <div class="detail-content">
                       <h1 class="title">Bán nhà số 28 ngõ 389 đường Đằng Hải, Hải An, Hải Phòng</h1>
                       <h2 class="title-second">Bán nhà số 28 ngõ 389 đường Đằng Hải, Hải An, Hải Phòng</h2>
                       <div class="brief_detail row">
                           <div class="col-xs-12 col-sm-8 brief_detail__left">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <p><strong>- Mã số tin:</strong> HP-9047</p>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <p><strong>- Ngày cập nhật:</strong> 20/11/2018</p>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <p><strong>- Lượt xem:</strong> 7909</p>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <p><strong>- Ngày hết hạn:</strong> 20/12/2018</p>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <p><strong>- DTMB:</strong> 44m2</p>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <p><strong>- DTSD:</strong> 135m2</p>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <p><strong>- Danh mục:</strong> Cần bán</p>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <p><strong>- Loại BĐS:</strong> Nhà trong ngõ</p>
                                    </div>
                                    <div class="col-xs-12">
                                        <p><strong>- Địa chỉ:</strong> Số 28 ngõ 389 đường Đằng Hải, Hải An, Hải Phòng</p>
                                    </div>
                                </div>
                           </div>
                           <div class="col-xs-12 col-sm-4 brief_detail__right">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <p class="price"><strong>{{ trans('detail-real-estate.briefDetail.price') }}:</strong> 940 triệu VND</p>
                                        <p class="is_deal">(Có thỏa thuận)</p>
                                    </div>
                                </div>
                           </div>
                       </div>
                       <div class="title-short-section">Mô tả chi tiết:</div>
                       <div class="description short-section">
                           <div class="row margin-0">
                               <div class="col-xs-12 col-sm-4 description__item"><strong>Chiều rộng:</strong> 4m</div>
                               <div class="col-xs-12 col-sm-4 description__item"><strong>Chiều dài:</strong> 11m</div>
                               <div class="col-xs-12 col-sm-4 description__item"><strong>Giấy tờ:</strong> Sổ đỏ Chính Chủ</div>
                           </div>
                           <div class="row margin-0">
                               <div class="col-xs-12 col-sm-4 description__item"><strong>Diện tích MB:</strong> 44m</div>
                               <div class="col-xs-12 col-sm-4 description__item"><strong>Diện tích SD:</strong> 135m</div>
                               <div class="col-xs-12 col-sm-4 description__item"><strong>Hướng:</strong> Liên hệ</div>
                           </div>
                           <div class="row margin-0">
                               <div class="col-xs-12 description__item">
                                   <strong>Tên dự án:</strong> Nhà đất thổ cư trong ngõ
                               </div>
                           </div>
                           <div class="row margin-0">
                               <div class="col-xs-12 description__item">
                                   <h3 class="description__title">Thông tin chi tiết:</h3>
                                   <div class="description__body">
                                        <p>
                                            - Nhà 3 tầng xây kiên cố, chắc chắn, thiết kế hợp lý, hài hòa, nội thất đẹp, ngõ rộng 5m, ô tô đỗ cửa, khu dân cư đông đúc, hàng xóm thân thiện. Nhà gần đường Lê Hồng Phong, không gian thoáng mát, giao thông thuận tiện đi lại, an ninh tốt, sổ đỏ chính chủ.

                                            - Cấu trúc nhà gồm: phòng khách, phòng ăn, 4 phòng ngủ, phòng thờ , sân chơi, sân phơi, 2 toilet.

                                            - Tiện nghi đầy đủ.

                                            - Giá bán 940 triệu. Để biết thêm thông tin chi tiết vui lòng liên hệ với chính chủ. Xin cảm ơn đã đọc tin.
                                        </p>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="title-short-section">Thông tin liên hệ:</div>
                       <div class="contact short-section">
                           <div class="row margin-0">
                               <div class="col-xs-12 description__item">
                                   <strong>Người liên hệ :</strong> Anh Toàn
                               </div>
                           </div>
                           <div class="row margin-0">
                               <div class="col-xs-12 description__item">
                                   <strong>Địa chỉ :</strong> Số 28 ngõ 389 đường Đằng Hải, Hải An, Hải Phòng
                               </div>
                           </div>
                           <div class="row margin-0">
                               <div class="col-xs-12 description__item">
                                   <strong>Điện thoại :</strong> 0912.479.275
                               </div>
                           </div>
                       </div>
                       <div class="title-short-section">Bản đồ vị trí:</div>
                       <div class="strike-title">
                           <strong>Dành cho quảng cáo</strong>
                       </div>
                       <div class="adv-content">
                           <div class="row">
                               <div class="col-xs-12">
                                   <a href="http://nhadathaiphong.vn/tin-tuc-l2.htm" target="_blank">
                                       <img class="img-responsive" src="http://nhadathaiphong.vn/images/partner/448tin-chi-tiet-phai-425x150.jpg" alt="TRANG CHI TIẾT - TRÁI">
                                   </a>
                                    <a href="http://nhadathaiphong.vn/tin-tuc-l2.htm" target="_blank">
                                        <img class="img-responsive" src="http://nhadathaiphong.vn/images/partner/6586tin-chi-tiet-phai-425x150.jpg" alt="TRANG CHI TIẾT - PHẢI">
                                    </a>
                                   <a href="http://nhadathaiphong.vn/tim-kiem.htm?txtkeyword=cho+thu%C3%AA" target="_blank">
                                       <img class="img-responsive" src="http://nhadathaiphong.vn/images/partner/3638cho-thue-nha-mat-pho-tin-chi-tiet-900x150.jpg" alt="CHO THUÊ NHÀ MẶT PHỐ - TIN CHI TIẾT">
                                   </a>
                               </div>
                           </div>
                       </div>
                       <div class="strike-title">
                           <strong>Thông tin người đăng</strong>
                       </div>
                       <div class="post-by-info">
                           <div class="row margin-0">
                               <div class="col-xs-12 padding-0">
                                   <div class="col-xs-12 col-sm-3 no-padding-left post-by-info__left">
                                        <img src="http://nhadathaiphong.vn/css/images/noimage.jpg" class="img-responsive post-by-info__avatar"/>
                                   </div>
                                   <div class="col-xs-12 col-sm-9 post-by-info__right">
                                       <p><strong>Công ty/cá nhân</strong>: Nhà Đất Hải Phòng</p>
                                       <p><strong>Địa chỉ email</strong>: dothigroup.vn@gmail.com</p>
                                       <p><strong>Số điện thoại</strong>: 02253.68.67.68 - 02253.68.67.69 - 0986.186.179</p>
                                       <p><strong>Địa chỉ liên lạc</strong>: Trụ sở: Số 50 lô 16 MR, Lê Hồng Phong, Hải An, Hải Phòng</p>
                                       <p><strong>Website</strong>: <a href="www.nhadathaiphong.vn" target="_blank">www.nhadathaiphong.vn</a></p>
                                   </div>
                               </div>
                           </div>
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
