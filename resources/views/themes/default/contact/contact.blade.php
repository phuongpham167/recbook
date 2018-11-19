@extends('themes.default.layouts.app')

@section('meta-description')
    <meta name="description" content="Thông tin thành viên" >
@endsection

@section('title')
    {{trans('users.info')}}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}"/>
@endpush

@section('content')
    @include(theme(TRUE).'.includes.header')

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
                            @include(theme(TRUE).'.includes.message')
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
            @include(theme(TRUE).'.includes.right-menu')
            <!--End right-->

        </div>
    </div>

    @include(theme(TRUE).'.includes.footer')
@endsection

@section('js')

@endsection
