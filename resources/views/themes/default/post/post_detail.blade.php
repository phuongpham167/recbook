@extends('themes.default.layouts.app')

@section('meta-description')
    <meta name="description" content="{{\App\PostCategory::find($data->post_category_id)->name}}" >
@endsection

@section('title')
    Dothigroup
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/news.css') }}"/>
@endpush

@section('content')
    @include(theme(TRUE).'.includes.header')

    <div class="container-vina">
        <div class="row subpage">

            <!--Begin left-->
            <div class="col-xs-12 col-md-9 left catland_page">

                <!--Begin land_box-->
                <div class="_box">


                    <p class="title_box"><strong>{{\App\PostCategory::find($data->post_category_id)->name}}</strong></p>
                    <div class="">

                        <div class="news_page">
                            <h1>{{$data->title}}</h1>
                            <p class="info_news">Cập nhật: {{$data->created_at}} | <a href="{{ route('postcategorylist', ['slugdanhmuc' => \App\PostCategory::find($data->post_category_id)->slugdanhmuc]) }}">{{\App\PostCategory::find($data->post_category_id)->name}}</a></p>

                            {{--<div style="float: left;"><script src="https://apis.google.com/js/plusone.js" gapi_processed="true"></script><div id="___plus_0" style="text-indent: 0px; margin: 0px; padding: 0px; background: transparent; border-style: none; float: none; line-height: normal; font-size: 1px; vertical-align: baseline; display: inline-block; width: 67px; height: 20px;"><iframe ng-non-bindable="" frameborder="0" hspace="0" marginheight="0" marginwidth="0" scrolling="no" style="position: static; top: 0px; width: 67px; margin: 0px; border-style: none; left: 0px; visibility: visible; height: 20px;" tabindex="0" vspace="0" width="100%" id="I0_1546153651187" name="I0_1546153651187" src="https://apis.google.com/u/0/se/0/_/+1/sharebutton?plusShare=true&amp;usegapi=1&amp;action=share&amp;annotation=bubble&amp;origin=http%3A%2F%2Fnhadathaiphong.vn&amp;url=http%3A%2F%2Fnhadathaiphong.vn%2Fdien-dan--hoi-dap%2Fbang-gia-dich-vu-quang-cao-n179.htm&amp;gsrc=3p&amp;ic=1&amp;jsh=m%3B%2F_%2Fscs%2Fapps-static%2F_%2Fjs%2Fk%3Doz.gapi.vi.fep4cAUkeLw.O%2Fam%3DQQ%2Frt%3Dj%2Fd%3D1%2Frs%3DAGLTcCNTOwY74SGopom2X2fJJKLromEMaA%2Fm%3D__features__#_methods=onPlusOne%2C_ready%2C_close%2C_open%2C_resizeMe%2C_renderstart%2Concircled%2Cdrefresh%2Cerefresh&amp;id=I0_1546153651187&amp;_gfid=I0_1546153651187&amp;parent=http%3A%2F%2Fnhadathaiphong.vn&amp;pfname=&amp;rpctoken=37775826" data-gapiattached="true" title="G+"></iframe></div></div>--}}
                            {{--<!-- Go to www.addthis.com/dashboard to customize your tools -->--}}
                            {{--<div style="float: left;" class="addthis_sharing_toolbox"></div>--}}
                            {{--<div style="float: left; width: 200px;" class="fb-like fb_iframe_widget" data-href="http://nhadathaiphong.vn/dien-dan--hoi-dap/bang-gia-dich-vu-quang-cao-n179.htm" data-layout="standard" data-action="like" data-show-faces="true" data-share="true" fb-xfbml-state="rendered" fb-iframe-plugin-query="action=like&amp;app_id=&amp;container_width=200&amp;href=http%3A%2F%2Fnhadathaiphong.vn%2Fdien-dan--hoi-dap%2Fbang-gia-dich-vu-quang-cao-n179.htm&amp;layout=standard&amp;locale=en_US&amp;sdk=joey&amp;share=true&amp;show_faces=true"><span style="vertical-align: bottom; width: 450px; height: 24px;"><iframe name="f13dac377d6ff98" width="1000px" height="1000px" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" title="fb:like Facebook Social Plugin" src="https://www.facebook.com/v2.4/plugins/like.php?action=like&amp;app_id=&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter%2Fr%2Fj-GHT1gpo6-.js%3Fversion%3D43%23cb%3Df2a1d87a60159e8%26domain%3Dnhadathaiphong.vn%26origin%3Dhttp%253A%252F%252Fnhadathaiphong.vn%252Ff3eb7d81ec63d0c%26relation%3Dparent.parent&amp;container_width=200&amp;href=http%3A%2F%2Fnhadathaiphong.vn%2Fdien-dan--hoi-dap%2Fbang-gia-dich-vu-quang-cao-n179.htm&amp;layout=standard&amp;locale=en_US&amp;sdk=joey&amp;share=true&amp;show_faces=true" style="border: none; visibility: visible; width: 450px; height: 24px;" class=""></iframe></span></div>--}}
                            <div class="clearfix"></div>
                            <br>
                            <div class="content_news_page"><p>&nbsp;</p>
                                {!! $data->content !!}
                            </div>

                            {{--<div class="tags_news_page"><strong>Tags:</strong>--}}
                                {{--<a href="/tim-kiem.htm?txtkeyword=B%E1%BA%A3ng+gi%C3%A1+qu%E1%BA%A3ng+c%C3%A1o+nh%C3%A0+%C4%91%E1%BA%A5t+ch%C3%ADnh+ch%E1%BB%A7">Bảng giá quảng cáo nhà đất chính chủ</a>, <a href="/tim-kiem.htm?txtkeyword=+qu%E1%BA%A3ng+c%C3%A1o+banner"> quảng cáo banner</a>, <a href="/tim-kiem.htm?txtkeyword=+nh%C3%A0+%C4%91%E1%BA%A5t+h%E1%BA%A3i+ph%C3%B2ng"> nhà đất hải phòng</a>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
                <!--End detail_land-->


            </div>
            <!--End left-->

            <!--Begin right-->
            <div class="col-xs-12 col-md-3">
                @include(theme(TRUE).'.includes.right-sidebar')
                @include(theme(TRUE).'.includes.vip-slide')
            </div>
            <!--End right-->

        </div>
    </div>

    @include(theme(TRUE).'.includes.footer')
@endsection

@section('js')

@endsection
