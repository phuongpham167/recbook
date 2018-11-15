@extends('layouts.app')

@section('meta-description')
    <meta name="description" content="Thông tin thành viên" >
@endsection

@section('title')
    {{trans('users.info')}}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}"/>
@endpush

@section('content')
    @include('includes.header')

    <div class="container-vina">
        <div class="row subpage">

            <!--Begin left-->
            <div class="col-xs-9 left catland_page">

                <!--Begin land_box-->
                <div class="_box">


                    <p class="title_box"><strong>Thông tin liên hệ</strong></p>
                    <div class="">
                        <div id="map" style="width:100%;height:200px;">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3728.2557187545517!2d106.6647693154282!3d20.861740686089085!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314a7a5cfc79bf97%3A0x1f13e7ca9820fcbc!2zMTc3IELhuqFjaCDEkOG6sW5nLCBUaMaw4bujbmcgTMO9LCBI4buTbmcgQsOgbmcsIEjhuqNpIFBow7JuZywgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1542071768551" width="100%" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>

                        <!--begin contact_page-->
                        <div class="contact_page">
                            <div class="detail_contact">
                                <h1>{{\Efriandika\LaravelSettings\Facades\Settings::get('company_name')}}</h1>
                                <p class="address-1"><strong>{{trans('contact.address')}}:</strong> {{\Efriandika\LaravelSettings\Facades\Settings::get('address')}}</p>
                                <p class="mobile-1"><strong>{{trans('contact.phone')}}:</strong> {{\Efriandika\LaravelSettings\Facades\Settings::get('phone')}} - <span style="color: #e00;"><strong>Hotline:</strong> {{\Efriandika\LaravelSettings\Facades\Settings::get('hotline')}}</span></p>
                                <p class="fax-1"><strong>{{trans('contact.fax')}}:</strong> {{\Efriandika\LaravelSettings\Facades\Settings::get('fax')}}</p>
                                <p class="email-1"><strong>{{trans('contact.email')}}:</strong> <a href="{{\Efriandika\LaravelSettings\Facades\Settings::get('email')}}">{{\Efriandika\LaravelSettings\Facades\Settings::get('email')}}</a></p>
                            </div>
                            @include('includes.message')
                            <form id="contact-form" method="post">
                                {{csrf_field()}}
                                <ul>
                                    <li>
                                        <input placeholder="Họ tên" name="name" id="name" type="text">
                                    </li>

                                    <li>
                                        <input placeholder="Email" name="email" id="email" type="text">
                                    </li>

                                    <li>
                                        <input placeholder="Điện thoại" name="mobile" id="mobile" type="text">
                                    </li>

                                    <li>
                                        <input placeholder="Địa chỉ" name="address" id="address" type="text">
                                    </li>

                                    <li>
                                        <textarea placeholder="Nội dung yêu cầu" name="note" id="note"></textarea>
                                    </li>

                                    <li>
                                        <button type="submit" class="btn btn-green"><i class="fa fa-arrow-right fa-fw"></i> Gửi</button>
                                        <button type="submit" class="btn btn-gray"><i class="fa fa-refresh fa-fw"></i> Làm lại</button>
                                    </li>
                                </ul>
                            </form>
                        </div>
                        <!--end contact_page-->


                    </div>
                </div>
                <!--End detail_land-->


            </div>
            <!--End left-->

            <!--Begin right-->
            @include('includes.right-menu')
            <!--End right-->

        </div>


        <!--Begin three_cols-->
        <div class="row three_cols">

            <div class="col-xs-4 three_i lander_home">
                <p><i class="fa fa-users"></i> NHÀ MÔI GIỚI</p>
                <div>
                    <div class="nbs-flexisel-container"><div class="nbs-flexisel-inner"><ul class="lander_slide nbs-flexisel-ul" style="left: -332px;">
                                <li class="nbs-flexisel-item" style="width: 332px;">							            <dl>
                                        <dt><a href="/nha-moi-gioi/pham-van-kien-m18.htm"><img src="images/lander/49521-Kiên.jpg" alt="Phạm Văn Kiên"></a></dt>
                                        <dd>
                                            <h3><a href="/nha-moi-gioi/pham-van-kien-m18.htm">Phạm Văn Kiên</a></h3>
                                            <span>09.1111.5222</span>
                                            <p>GĐ Kinh Doanh - Chuyên Viên tư vấn mua bán, cho thuê, định giá BĐS Lê Hồng Phong, Mặt Phố Chính (Xem hồ sơ và sản phẩm phụ trách)
                                            </p>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt><a href="/nha-moi-gioi/nguyen-tri-chung-m26.htm"><img src="images/lander/395810-chung.jpg" alt="Nguyễn Trí Chung"></a></dt>
                                        <dd>
                                            <h3><a href="/nha-moi-gioi/nguyen-tri-chung-m26.htm">Nguyễn Trí Chung</a></h3>
                                            <span>0969.186.179</span>
                                            <p>GĐ Kinh Doanh - Chuyên viên tư vấn mua/bán, thuê/cho thuê&nbsp;BĐS&nbsp;quận&nbsp;Hồng Bàng, Thủy Nguyên&nbsp;(Xem hồ sơ và sản phẩm phụ trách)
                                            </p>
                                        </dd>
                                    </dl>
                                </li><li class="nbs-flexisel-item" style="width: 332px;">							            <dl>
                                        <dt><a href="/nha-moi-gioi/pham-van-kien-m18.htm"><img src="images/lander/49521-Kiên.jpg" alt="Phạm Văn Kiên"></a></dt>
                                        <dd>
                                            <h3><a href="/nha-moi-gioi/pham-van-kien-m18.htm">Phạm Văn Kiên</a></h3>
                                            <span>09.1111.5222</span>
                                            <p>GĐ Kinh Doanh - Chuyên Viên tư vấn mua bán, cho thuê, định giá BĐS Lê Hồng Phong, Mặt Phố Chính (Xem hồ sơ và sản phẩm phụ trách)
                                            </p>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt><a href="/nha-moi-gioi/nguyen-tri-chung-m26.htm"><img src="images/lander/395810-chung.jpg" alt="Nguyễn Trí Chung"></a></dt>
                                        <dd>
                                            <h3><a href="/nha-moi-gioi/nguyen-tri-chung-m26.htm">Nguyễn Trí Chung</a></h3>
                                            <span>0969.186.179</span>
                                            <p>GĐ Kinh Doanh - Chuyên viên tư vấn mua/bán, thuê/cho thuê&nbsp;BĐS&nbsp;quận&nbsp;Hồng Bàng, Thủy Nguyên&nbsp;(Xem hồ sơ và sản phẩm phụ trách)
                                            </p>
                                        </dd>
                                    </dl>
                                </li>							</ul></div><div class="nbs-flexisel-nav-left" style="visibility: visible; top: 147px;"></div><div class="nbs-flexisel-nav-right" style="visibility: visible; top: 147px;"></div></div>
                    <div class="clearfix"></div>
                    <p><a href="/nha-moi-gioi.htm">Xem tất cả</a></p>
                </div>
            </div>

            <div class="col-xs-4 three_i">
                <p><i class="fa fa-facebook-square"></i> FANPAGE FACEBOOK</p>
                <div>
                    <div class="fb-page fb_iframe_widget" data-href="https://www.facebook.com/nhadathaiphong.com.vn/" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false" fb-xfbml-state="rendered" fb-iframe-plugin-query="adapt_container_width=true&amp;app_id=&amp;container_width=332&amp;hide_cover=false&amp;href=https%3A%2F%2Fwww.facebook.com%2Fnhadathaiphong.com.vn%2F&amp;locale=en_US&amp;sdk=joey&amp;show_facepile=true&amp;show_posts=false&amp;small_header=false"><span style="vertical-align: bottom; width: 332px; height: 180px;"><iframe name="f22f1a644417518" width="1000px" height="1000px" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" title="fb:page Facebook Social Plugin" src="https://www.facebook.com/v2.4/plugins/page.php?adapt_container_width=true&amp;app_id=&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter%2Fr%2F__Bz3h5RzMx.js%3Fversion%3D42%23cb%3Df302440201a3f68%26domain%3Dnhadathaiphong.vn%26origin%3Dhttp%253A%252F%252Fnhadathaiphong.vn%252Ff1f1730b655a94c%26relation%3Dparent.parent&amp;container_width=332&amp;hide_cover=false&amp;href=https%3A%2F%2Fwww.facebook.com%2Fnhadathaiphong.com.vn%2F&amp;locale=en_US&amp;sdk=joey&amp;show_facepile=true&amp;show_posts=false&amp;small_header=false" style="border: none; visibility: visible; width: 332px; height: 180px;" class=""></iframe></span></div>
                </div>
            </div>

            <div class="col-xs-4 three_i view_direction">
                <p><i class="fa fa-compass"></i> XEM HƯỚNG NHÀ</p>
                <div>
                    <p>Cách xác định hướng nhà theo phong thủy tốt nhất</p>
                    <a href="http://nhadathaiphong.vn/kinh-nghiem-mua-ban-nha-dat/cach-xac-dinh-huong-nha-theo-phong-thuy-tot-nhat-n168.htm"><img src="images/partner/9998cach-xac-dinh-huong-nha-theo-phong-thuy-tot-nhat-2.jpg" alt="Cách xác định hướng nhà theo phong thủy tốt nhất"></a>
                </div>
            </div>

        </div>
        <!--End three_cols-->


    </div>

    @include('includes.footer')
@endsection

@section('js')

@endsection