<section class="addition_info">
    <div class="container">
        <div class="row  three_cols">
            <div class="col-xs-12 col-sm-4 three_i brokers">

                <p class="title_col">
                    <a href="#"><i class="fa fa-users"></i> NHÀ MÔI GIỚI</a>
                </p>
                <div class="content col-xs-12 no-padding-left no-padding-right broker_slider">
                    @for($i=0; $i<2; $i++)
                        <div class="col-xs-12 broker-item">
                            <div class="ct_left">
                                <a href="#">
                                    <img class="img-responsive b_img" src="http://nhadathaiphong.vn/images/lander/49521-Ki%C3%AAn.jpg" alt="">
                                </a>
                            </div>
                            <div class="ct_right">
                                <h3 class="name"><a href="#">Nguyen Van A</a></h3>
                                <p class="phone">0999.0880.32</p>
                                <p class="des">GĐ Kinh Doanh - Chuyên Viên tư vấn mua bán, cho thuê, định giá BĐS Lê Hồng Phong, Mặt Phố Chính (Xem hồ sơ và sản phẩm phụ trách)</p>
                            </div>
                        </div>
                    @endfor
                </div>
                <div class="col-xs-12 broker_see_all">
                    <a href="#">Xem tất cả</a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 three_i statistic">
                <p class="title_col">
                    <a href="#">{{ trans('home.statistic_col') }}</a>
                </p>
                <div class="col-xs-12 content">
                    @php
                    $web_id = get_web_id();
                    @endphp
                    <p>{{ trans('home.num_of_user') }}: {{ \App\User::where('web_id', $web_id)->count() }}</p>
                    <p>{{ trans('home.num_of_real_estate') }}: {{\App\RealEstate::where('web_id', $web_id)->count()}}</p>
                    <p>{{ trans('home.num_of_success_transaction') }}: 0</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 three_i design">
                <p class="title_col">
                    <a href="#"><i class="fa fa-desktop" aria-hidden="true"></i> {{ trans('home.design_col') }}</a>
                </p>
                <div class="col-xs-12 content design_content">
                    <p>Cách xác định hướng nhà theo phong thủy tốt nhất</p>
                    <a href="#">
                        <img class="img-responsive" src="http://nhadathaiphong.vn/images/partner/9998cach-xac-dinh-huong-nha-theo-phong-thuy-tot-nhat-2.jpg" alt="Cách xác định hướng nhà theo phong thủy tốt nhất">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="menu-footer">
    <div class="container">
        <ul>
            <li>
                <a href="#">QUY CHẾ HOẠT ĐỘNG</a>
            </li>
            <li>
                <a href="#">Cơ chế giải quyết khiếu nại</a>
            </li>
            <li>
                <a href="#">Chính sách bảo mật thông tin</a>
            </li>
            <li>
                <a href="#">Liên hệ - Gửi yêu cầu</a>
            </li>
        </ul>
    </div>
</div>
<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8">
                <div class="col-xs-6">
                    <a href="#">
                        <img src="{{ asset('images/logo.png') }}" class="img-responsive"/>
                    </a>
                </div>
                <div class="col-xs-6">
                    <a href="#">
                        <img src="{{ asset('images/logo.png') }}" class="img-responsive"/>
                    </a>
                </div>
                <div class="col-xs-6">
                    <a href="#">
                        <img src="{{ asset('images/logo.png') }}" class="img-responsive"/>
                    </a>
                </div>
                <div class="col-xs-6">
                    <a href="#">
                        <img src="{{ asset('images/logo.png') }}" class="img-responsive"/>
                    </a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 footer-info">
                <p style="text-align:justify;"><span style="font-size:16px"><span style="color:#0000FF"><strong>CÔNG TY CỔ PHẦN&nbsp;NHÀ ĐẤT HẢI PHÒNG</strong></span></span></p>

                <p><span style="font-size:14px"><strong><span style="color:#FF0000">Hotline: 0986.186.179&nbsp;</span></strong></span></p>

                <p><span style="font-size:14px"><strong>Tel: </strong>0225.3.68.67.68​ - 0225.3.68.67.69</span></p>

                <p><span style="font-size:14px"><strong>Email:</strong>&nbsp;<span style="color:#0000CD">dothigroup.vn@gmail.com</span></span></p>

                <p><span style="font-size:14px"><strong>Mã số thuế (Mã số Doanh nghiệp): </strong><span style="color:#0000CD"><strong><span style="background-color:rgb(245, 245, 245)">0201868420</span></strong></span></span></p>

                <p><span style="font-size:14px"><span style="color:#000000"><strong>Trụ sở:</strong>&nbsp;<strong>Số 177 Bạch Đằng, P.Thượng Lý, Q.Hồng Bàng, Hải Phòng</strong></span></span></p>

                <p><span style="color:#000000"><span style="font-size:14px"><strong>VPGD 1: </strong>Số 50 Lô 16MR Lê Hồng Phong, P.Đằng Lâm, Q.Hải An, Hải Phòng</span></span></p>

                <p><span style="color:#000000"><span style="font-size:14px"><strong>VPGD 2 : </strong>Số 1 lô 34 khu TĐC Vinhomes Riverside, Sở Dầu, Hồng Bàng, Hải Phòng</span></span></p>
            </div>
        </div>
    </div>
</footer>

@push('js')
    <script>
        $('.broker_slider').bxSlider({
            mode: 'vertical',
            auto: false,
            minSlides: 30,
            maxSlides: 30,
            moveSlides: 1,
            pager: false
        });
    </script>
@endpush
