@extends('layouts.app')

@section('meta-description')
    <meta name="description" content="Thông tin thành viên" >
@endsection

@section('title')
    {{trans('users.info')}}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}"/>

@endsection

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
                        <div id="map" style="width:500px;height:500px;">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3728.2557187545517!2d106.6647693154282!3d20.861740686089085!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314a7a5cfc79bf97%3A0x1f13e7ca9820fcbc!2zMTc3IELhuqFjaCDEkOG6sW5nLCBUaMaw4bujbmcgTMO9LCBI4buTbmcgQsOgbmcsIEjhuqNpIFBow7JuZywgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1542071768551" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>

                        <!--begin contact_page-->
                        <div class="contact_page">
                            <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBFmVtGqvNTqOk6vRBbD2mSG5Xi9qQ7kmk&amp;language=vi"></script>
                            <script type="text/javascript">

                                var infoWindow;

                                window.onload = function(){
                                    var toa_do = new google.maps.LatLng(20.835936, 106.712872);
                                    var conf = {
                                        center: toa_do,
                                        zoom: 15,
                                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                                        disableDefaultUI: true,
                                        mapTypeControl: true,
                                        navigationControl: true,
                                        navigationControlOptions: {
                                            style: google.maps.NavigationControlStyle.SMALL
                                        }
                                    }
                                    map = new google.maps.Map(document.getElementById('mapcont'),conf);

                                    var marker = new google.maps.Marker({
                                        position: toa_do,
                                        map: map,
                                        title: 'CÔNG TY CỔ PHẦN NHÀ ĐẤT HẢI PHÒNG',
                                    });

                                    google.maps.event.addListener(marker, 'click', function() {
                                        if(!infoWindow)
                                        {
                                            infoWindow = new google.maps.InfoWindow();
                                        }
                                        var content = '<div id="info">' +
                                            '<div><h2>CÔNG TY CỔ PHẦN NHÀ ĐẤT HẢI PHÒNG</h2>' +
                                            '<p><strong>Địa chỉ: Số 177 Bạch Đằng, Thượng Lý, Hồng Bàng, Hải Phòng</strong></p>' +
                                            '<p><strong>Điện thoại:</strong> 0986.186.179 - 0225.3.68.67.68</p>' +
                                            '<p style="color: #e00;"><strong>Hotline:</strong> 0989.186.179</p>' +
                                            '<p><strong>Email:</strong> <a href="mailto:dothigroup.vn@gmail.com">dothigroup.vn@gmail.com</a></p></div>';
                                        infoWindow.setContent(content);
                                        infoWindow.open(map, marker);
                                    });
                                };
                            </script>
                            <div id="mapcont" style="position: relative; overflow: hidden;"><div style="height: 100%; width: 100%; position: absolute; top: 0px; left: 0px; background-color: rgb(229, 227, 223);"><div class="gm-style" style="position: absolute; z-index: 0; left: 0px; top: 0px; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px;"><div tabindex="0" style="position: absolute; z-index: 0; left: 0px; top: 0px; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; cursor: url(&quot;http://maps.gstatic.com/mapfiles/openhand_8_8.cur&quot;), default; touch-action: pan-x pan-y;"><div style="z-index: 1; position: absolute; left: 50%; top: 50%; width: 100%; transform: translate(0px, 0px);"><div style="position: absolute; left: 0px; top: 0px; z-index: 100; width: 100%;"><div style="position: absolute; left: 0px; top: 0px; z-index: 0;"><div style="position: absolute; z-index: 985; transform: matrix(1, 0, 0, 1, -62, -58);"><div style="position: absolute; left: 0px; top: 0px; width: 256px; height: 256px;"><div style="width: 256px; height: 256px;"></div></div><div style="position: absolute; left: -256px; top: 0px; width: 256px; height: 256px;"><div style="width: 256px; height: 256px;"></div></div><div style="position: absolute; left: -256px; top: -256px; width: 256px; height: 256px;"><div style="width: 256px; height: 256px;"></div></div><div style="position: absolute; left: 0px; top: -256px; width: 256px; height: 256px;"><div style="width: 256px; height: 256px;"></div></div><div style="position: absolute; left: 256px; top: -256px; width: 256px; height: 256px;"><div style="width: 256px; height: 256px;"></div></div><div style="position: absolute; left: 256px; top: 0px; width: 256px; height: 256px;"><div style="width: 256px; height: 256px;"></div></div><div style="position: absolute; left: -512px; top: 0px; width: 256px; height: 256px;"><div style="width: 256px; height: 256px;"></div></div><div style="position: absolute; left: -512px; top: -256px; width: 256px; height: 256px;"><div style="width: 256px; height: 256px;"></div></div></div></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 101; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 102; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 103; width: 100%;"><div style="width: 27px; height: 43px; overflow: hidden; position: absolute; left: -14px; top: -43px; z-index: 0;"><img alt="" src="http://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi2.png" draggable="false" style="position: absolute; left: 0px; top: 0px; width: 27px; height: 43px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: -1;"><div style="position: absolute; z-index: 985; transform: matrix(1, 0, 0, 1, -62, -58);"><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 0px; top: 0px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: -256px; top: 0px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: -256px; top: -256px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 0px; top: -256px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 256px; top: -256px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 256px; top: 0px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: -512px; top: 0px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: -512px; top: -256px;"></div></div></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 0;"><div style="position: absolute; z-index: 985; transform: matrix(1, 0, 0, 1, -62, -58);"><div style="position: absolute; left: 0px; top: 0px; width: 256px; height: 256px; transition: opacity 200ms linear 0s;"><img draggable="false" alt="" role="presentation" src="http://maps.google.com/maps/vt?pb=!1m5!1m4!1i15!2i26097!3i14444!4i256!2m3!1e0!2sm!3i443148598!2m3!1e2!6m1!3e5!3m14!2svi!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcC5zOi02MHxwLmw6LTYw!4e0!23i1301875&amp;key=AIzaSyBFmVtGqvNTqOk6vRBbD2mSG5Xi9qQ7kmk&amp;token=77754" style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div><div style="position: absolute; left: -256px; top: 0px; width: 256px; height: 256px; transition: opacity 200ms linear 0s;"><img draggable="false" alt="" role="presentation" src="http://maps.google.com/maps/vt?pb=!1m5!1m4!1i15!2i26096!3i14444!4i256!2m3!1e0!2sm!3i443148514!2m3!1e2!6m1!3e5!3m14!2svi!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcC5zOi02MHxwLmw6LTYw!4e0!23i1301875&amp;key=AIzaSyBFmVtGqvNTqOk6vRBbD2mSG5Xi9qQ7kmk&amp;token=91771" style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div><div style="position: absolute; left: -256px; top: -256px; width: 256px; height: 256px; transition: opacity 200ms linear 0s;"><img draggable="false" alt="" role="presentation" src="http://maps.google.com/maps/vt?pb=!1m5!1m4!1i15!2i26096!3i14443!4i256!2m3!1e0!2sm!3i443148514!2m3!1e2!6m1!3e5!3m14!2svi!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcC5zOi02MHxwLmw6LTYw!4e0!23i1301875&amp;key=AIzaSyBFmVtGqvNTqOk6vRBbD2mSG5Xi9qQ7kmk&amp;token=53985" style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div><div style="position: absolute; left: 0px; top: -256px; width: 256px; height: 256px; transition: opacity 200ms linear 0s;"><img draggable="false" alt="" role="presentation" src="http://maps.google.com/maps/vt?pb=!1m5!1m4!1i15!2i26097!3i14443!4i256!2m3!1e0!2sm!3i443148598!2m3!1e2!6m1!3e5!3m14!2svi!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcC5zOi02MHxwLmw6LTYw!4e0!23i1301875&amp;key=AIzaSyBFmVtGqvNTqOk6vRBbD2mSG5Xi9qQ7kmk&amp;token=39968" style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div><div style="position: absolute; left: 256px; top: -256px; width: 256px; height: 256px; transition: opacity 200ms linear 0s;"><img draggable="false" alt="" role="presentation" src="http://maps.google.com/maps/vt?pb=!1m5!1m4!1i15!2i26098!3i14443!4i256!2m3!1e0!2sm!3i443148598!2m3!1e2!6m1!3e5!3m14!2svi!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcC5zOi02MHxwLmw6LTYw!4e0!23i1301875&amp;key=AIzaSyBFmVtGqvNTqOk6vRBbD2mSG5Xi9qQ7kmk&amp;token=61018" style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div><div style="position: absolute; left: 256px; top: 0px; width: 256px; height: 256px; transition: opacity 200ms linear 0s;"><img draggable="false" alt="" role="presentation" src="http://maps.google.com/maps/vt?pb=!1m5!1m4!1i15!2i26098!3i14444!4i256!2m3!1e0!2sm!3i443148598!2m3!1e2!6m1!3e5!3m14!2svi!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcC5zOi02MHxwLmw6LTYw!4e0!23i1301875&amp;key=AIzaSyBFmVtGqvNTqOk6vRBbD2mSG5Xi9qQ7kmk&amp;token=98804" style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div><div style="position: absolute; left: -512px; top: 0px; width: 256px; height: 256px; transition: opacity 200ms linear 0s;"><img draggable="false" alt="" role="presentation" src="http://maps.google.com/maps/vt?pb=!1m5!1m4!1i15!2i26095!3i14444!4i256!2m3!1e0!2sm!3i443148586!2m3!1e2!6m1!3e5!3m14!2svi!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcC5zOi02MHxwLmw6LTYw!4e0!23i1301875&amp;key=AIzaSyBFmVtGqvNTqOk6vRBbD2mSG5Xi9qQ7kmk&amp;token=42400" style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div><div style="position: absolute; left: -512px; top: -256px; width: 256px; height: 256px; transition: opacity 200ms linear 0s;"><img draggable="false" alt="" role="presentation" src="http://maps.google.com/maps/vt?pb=!1m5!1m4!1i15!2i26095!3i14443!4i256!2m3!1e0!2sm!3i443148646!2m3!1e2!6m1!3e5!3m14!2svi!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcC5zOi02MHxwLmw6LTYw!4e0!23i1301875&amp;key=AIzaSyBFmVtGqvNTqOk6vRBbD2mSG5Xi9qQ7kmk&amp;token=27674" style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div></div></div></div><div class="gm-style-pbc" style="z-index: 2; position: absolute; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; left: 0px; top: 0px; opacity: 0;"><p class="gm-style-pbt"></p></div><div style="z-index: 3; position: absolute; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; left: 0px; top: 0px; touch-action: pan-x pan-y;"><div style="z-index: 4; position: absolute; left: 50%; top: 50%; width: 100%; transform: translate(0px, 0px);"><div style="position: absolute; left: 0px; top: 0px; z-index: 104; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 105; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 106; width: 100%;"><div style="width: 27px; height: 43px; overflow: hidden; position: absolute; opacity: 0; left: -14px; top: -43px; z-index: 0;"><img alt="" src="http://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi2.png" draggable="false" usemap="#gmimap0" style="position: absolute; left: 0px; top: 0px; width: 27px; height: 43px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"><map name="gmimap0" id="gmimap0"><area log="miw" coords="13.5,0,4,3.75,0,13.5,13.5,43,27,13.5,23,3.75" shape="poly" title="CÔNG TY CỔ PHẦN NHÀ ĐẤT HẢI PHÒNG" style="cursor: pointer; touch-action: none;"></map></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 107; width: 100%;"></div></div></div></div><iframe aria-hidden="true" frameborder="0" style="z-index: -1; position: absolute; width: 100%; height: 100%; top: 0px; left: 0px; border: none;" src="about:blank"></iframe><div style="margin-left: 5px; margin-right: 5px; z-index: 1000000; position: absolute; left: 0px; bottom: 0px;"><a target="_blank" rel="noopener" href="https://maps.google.com/maps?ll=20.835936,106.712872&amp;z=15&amp;t=m&amp;hl=vi&amp;gl=US&amp;mapclient=apiv3" title="Nhấp để xem khu vực này trên Google Maps" style="position: static; overflow: visible; float: none; display: inline;"><div style="width: 66px; height: 26px; cursor: pointer;"><img alt="" src="http://maps.gstatic.com/mapfiles/api-3/images/google4.png" draggable="false" style="position: absolute; left: 0px; top: 0px; width: 66px; height: 26px; user-select: none; border: 0px; padding: 0px; margin: 0px;"></div></a></div><div style="background-color: white; padding: 15px 21px; border: 1px solid rgb(171, 171, 171); font-family: Roboto, Arial, sans-serif; color: rgb(34, 34, 34); box-sizing: border-box; box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 16px; z-index: 10000002; display: none; width: 300px; height: 170px; position: absolute; left: 293px; top: 5px;"><div style="padding: 0px 0px 10px; font-size: 16px;">Dữ liệu Bản đồ</div><div style="font-size: 13px;">Dữ liệu bản đồ ©2018 Google</div><button draggable="false" title="Close" aria-label="Close" type="button" class="gm-ui-hover-effect" style="background: none; display: block; border: 0px; margin: 0px; padding: 0px; position: absolute; cursor: pointer; user-select: none; top: 0px; right: 0px; width: 37px; height: 37px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224px%22%20height%3D%2224px%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22%23000000%22%3E%0A%20%20%20%20%3Cpath%20d%3D%22M19%206.41L17.59%205%2012%2010.59%206.41%205%205%206.41%2010.59%2012%205%2017.59%206.41%2019%2012%2013.41%2017.59%2019%2019%2017.59%2013.41%2012z%22%2F%3E%0A%20%20%20%20%3Cpath%20d%3D%22M0%200h24v24H0z%22%20fill%3D%22none%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="pointer-events: none; display: block; width: 13px; height: 13px; margin: 12px;"></button></div><div class="gmnoprint" style="z-index: 1000001; position: absolute; right: 215px; bottom: 0px; width: 143px;"><div draggable="false" class="gm-style-cc" style="user-select: none; height: 14px; line-height: 14px;"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right; vertical-align: middle; display: inline-block;"><a style="text-decoration: none; cursor: pointer; display: none;">Dữ liệu Bản đồ</a><span>Dữ liệu bản đồ ©2018 Google</span></div></div></div><div class="gmnoscreen" style="position: absolute; right: 0px; bottom: 0px;"><div style="font-family: Roboto, Arial, sans-serif; font-size: 11px; color: rgb(68, 68, 68); direction: ltr; text-align: right; background-color: rgb(245, 245, 245);">Dữ liệu bản đồ ©2018 Google</div></div><div class="gmnoprint gm-style-cc" draggable="false" style="z-index: 1000001; user-select: none; height: 14px; line-height: 14px; position: absolute; right: 115px; bottom: 0px;"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right; vertical-align: middle; display: inline-block;"><a href="https://www.google.com/intl/vi_US/help/terms_maps.html" target="_blank" rel="noopener" style="text-decoration: none; cursor: pointer; color: rgb(68, 68, 68);">Điều khoản sử dụng</a></div></div><button draggable="false" title="Chuyển đổi chế độ xem toàn màn hình" aria-label="Chuyển đổi chế độ xem toàn màn hình" type="button" class="gm-control-active gm-fullscreen-control" style="background: none rgb(255, 255, 255); border: 0px; margin: 10px; padding: 0px; position: absolute; cursor: pointer; user-select: none; border-radius: 2px; height: 40px; width: 40px; box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; overflow: hidden; display: none; top: 0px; right: 0px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218%22%20height%3D%2218%22%20viewBox%3D%220%20018%2018%22%3E%0A%20%20%3Cpath%20fill%3D%22%23666%22%20d%3D%22M0%2C0v2v4h2V2h4V0H2H0z%20M16%2C0h-4v2h4v4h2V2V0H16z%20M16%2C16h-4v2h4h2v-2v-4h-2V16z%20M2%2C12H0v4v2h2h4v-2H2V12z%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px; margin: 11px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218%22%20height%3D%2218%22%20viewBox%3D%220%200%2018%2018%22%3E%0A%20%20%3Cpath%20fill%3D%22%23333%22%20d%3D%22M0%2C0v2v4h2V2h4V0H2H0z%20M16%2C0h-4v2h4v4h2V2V0H16z%20M16%2C16h-4v2h4h2v-2v-4h-2V16z%20M2%2C12H0v4v2h2h4v-2H2V12z%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px; margin: 11px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218%22%20height%3D%2218%22%20viewBox%3D%220%200%2018%2018%22%3E%0A%20%20%3Cpath%20fill%3D%22%23111%22%20d%3D%22M0%2C0v2v4h2V2h4V0H2H0z%20M16%2C0h-4v2h4v4h2V2V0H16z%20M16%2C16h-4v2h4h2v-2v-4h-2V16z%20M2%2C12H0v4v2h2h4v-2H2V12z%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px; margin: 11px;"></button><div draggable="false" class="gm-style-cc" style="user-select: none; height: 14px; line-height: 14px; position: absolute; right: 0px; bottom: 0px;"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right; vertical-align: middle; display: inline-block;"><a target="_blank" rel="noopener" title="Báo cáo lỗi trong bản đồ đường hoặc hình ảnh đến Google" href="https://www.google.com/maps/@20.835936,106.712872,15z/data=!10m1!1e1!12b1?source=apiv3&amp;rapsrc=apiv3" style="font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); text-decoration: none; position: relative;">Báo cáo một lỗi bản đồ</a></div></div></div></div><div style="background-color: white; font-weight: 500; font-family: Roboto, sans-serif; padding: 15px 25px; box-sizing: border-box; top: 5px; border: 1px solid rgba(0, 0, 0, 0.12); border-radius: 5px; left: 50%; max-width: 375px; position: absolute; transform: translateX(-50%); width: calc(100% - 10px); z-index: 1;"><div><img alt="" src="http://maps.gstatic.com/mapfiles/api-3/images/google_gray.svg" draggable="false" style="padding: 0px; margin: 0px; border: 0px; height: 17px; vertical-align: middle; width: 52px; user-select: none;"></div><div style="line-height: 20px; margin: 15px 0px;"><span style="color: rgba(0, 0, 0, 0.87); font-size: 14px;">Trang này không thể tải Google Maps đúng cách.</span></div><table style="width: 100%;"><tr><td style="line-height: 16px; vertical-align: middle;"><a href="https://developers.google.com/maps/documentation/javascript/error-messages?utm_source=maps_js&amp;utm_medium=degraded&amp;utm_campaign=billing#api-key-and-billing-errors" target="_blank" rel="noopener" style="color: rgba(0, 0, 0, 0.54); font-size: 12px;">Do you own this website?</a></td><td style="text-align: right;"><button class="dismissButton">OK</button></td></tr></table></div></div>

                            <div class="detail_contact">
                                <h1>CÔNG TY CỔ PHẦN NHÀ ĐẤT HẢI PHÒNG</h1>
                                <p class="address-1"><strong>Địa chỉ:</strong> Số 177 Bạch Đằng, Thượng Lý, Hồng Bàng, Hải Phòng</p>
                                <p class="mobile-1"><strong>Điện thoại:</strong> 0986.186.179 - 0225.3.68.67.68 - <span style="color: #e00;"><strong>Hotline:</strong> 0989.186.179</span></p>
                                <p class="fax-1"><strong>Fax:</strong> 0986.186.179 - 0225.3.68.67.68</p>
                                <p class="email-1"><strong>Email:</strong> <a href="mailto:dothigroup.vn@gmail.com">dothigroup.vn@gmail.com</a></p>
                            </div>

                            <form id="contact-form" action="/lien-he.htm" method="post">						<ul>
                                    <li>
                                        <input placeholder="Họ tên" name="ContactForm[name]" id="ContactForm_name" type="text">							<div class="errorMessage" id="ContactForm_name_em_" style="display:none"></div>                        	</li>

                                    <li>
                                        <input placeholder="Email" name="ContactForm[email]" id="ContactForm_email" type="text">							<div class="errorMessage" id="ContactForm_email_em_" style="display:none"></div>                        	</li>

                                    <li>
                                        <input placeholder="Điện thoại" name="ContactForm[mobile]" id="ContactForm_mobile" type="text">							<div class="errorMessage" id="ContactForm_mobile_em_" style="display:none"></div>                        	</li>

                                    <li>
                                        <input placeholder="Địa chỉ" name="ContactForm[address]" id="ContactForm_address" type="text">							<div class="errorMessage" id="ContactForm_address_em_" style="display:none"></div>                        	</li>

                                    <li>
                                        <textarea placeholder="Nội dung yêu cầu" name="ContactForm[body]" id="ContactForm_body"></textarea>							<div class="errorMessage" id="ContactForm_body_em_" style="display:none"></div>                        	</li>

                                    <li>
                                        <button type="submit" class="btn btn-green"><i class="fa fa-arrow-right fa-fw"></i> Gửi</button>
                                        <button type="submit" class="btn btn-gray"><i class="fa fa-refresh fa-fw"></i> Làm lại</button>
                                    </li>

                                </ul>

                            </form>	        </div>
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