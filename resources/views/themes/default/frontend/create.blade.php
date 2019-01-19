@extends(theme(TRUE).'.layouts.app')

@section('title')
    {{trans('frontend.create')}}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <style>
        .picked {
            border: 3px solid rgba(0, 128, 0, 0.35);
            border-radius: 9px;
        }
        .new-deal{width:100%;float:left;padding:15px 0;}
        .new-deal .item-slide{position: relative;overflow: hidden;transition:all .5s ease;-moz-transition:all .5s ease;-webkit-transition:all .5s ease;margin:15px 0;}
        .new-deal .slide-hover{ position: absolute;height: 100%;width: 100%;left: -100%; background:rgba(0,0,0,.5);top: 0;transition:all .5s ease;-moz-transition:all .5s ease;-webkit-transition:all .5s ease;-moz-border-radius: 5px; border-radius: 5px;-webkit-border-radius: 5px;  }
        .new-deal .item-slide:hover .slide-hover{left:0px;}
        .new-deal img{max-width:100%;}
        .text-wrap {position: absolute;bottom: 0;left: 0;width: 100%;color: #fff;background: rgba(0, 0, 0, .5);z-index:999;transition:all .5s ease;-moz-transition:all .5s ease;-webkit-transition:all .5s ease;}
        .text-wrap h4{padding:0 5px;}
        .box-img{width: 100%;   float: left;    -moz-border-radius: 5px; border-radius: 5px;-webkit-border-radius: 5px;    overflow: hidden;    border: 1px solid #ccc;}
        .text-wrap .desc{width:50%;float:left;padding:0 5px;}
        .text-wrap p{padding: 15px;font-size: 15px;text-align: center;font-weight: normal;text-shadow: 2px 2px 3px #000;}
        .text-wrap .desc h4{margin:0px;font: 400 17px/21px "Roboto";}
        .text-wrap .desc h3{margin:0px;font: 400 32px/36px "Roboto";}
        .new-deal .item-slide:hover .text-wrap{background:none}
        .book-now-c {float:right;padding:10px;}
        .book-now-c a {background: #029a8b;color: #fff;padding: 5px;border-radius: 5px;margin-top:0px;float: left;min-width: 101px;text-align: center;font-size: 16px;}
        .new-deal .item-slide:hover .box-img .text-wrap{bottom:-100%;}
    </style>
    <style type="text/css">
        /*.form-inline .form-group {*/
            /*margin-bottom: 10px !important;*/
            /*margin-top: 10px;*/
        /*}*/
        .help-block {display: none; font-size: 11px; font-style: italic}
        .has-error .help-block {display: block}
    </style>
@endpush

@section('content')
    @include(theme(TRUE).'.includes.header')
    <div class="container-vina">
        <div class="row subpage">
            <div class="col-md-12">
                @include('themes.default.includes.message')
                <div class="_form dangnhap_page bg_fdfdfd">
                    <div class="form-horizontal">
                        <h3 class="title_form"><i class="fa fa-at"></i> TẠO WEBSITE CON MỚI</h3>

                        <dl>
                            <dt>{{trans('frontend.title')}} <span class="required">*</span></dt>
                            <dd>
                                <input type="text" name="title" id="title" required placeholder="{{trans('frontend.title')}}" />
                                <span class="help-block">Vui lòng điền thông tin</span>
                            </dd>
                        </dl>

                        <dl>
                            <dt>{{trans('frontend.domain')}} <span class="required">*</span></dt>
                            <dd>
                                <input type="text" name="domain" id="domain" placeholder="{{trans('frontend.domain')}}">
                                <span class="help-block check-domain">Vui lòng điền thông tin</span>
                            </dd>
                        </dl>

                        <dl>
                            <dt>Chọn theme: <span class="required">*</span></dt>
                        </dl>
                        <dl>
                            <section class="new-deal">

                                <input type="text" name="theme" id="input-theme" hidden>
                                <div class="container">
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 deal deal-block">
                                        <div class="item-slide">
                                            <div class="box-img">
                                                <img src="{{asset('images/themes/BDS-01.jpg')}}"
                                                     alt="dasdas"/>
                                                <div class="text-wrap">
                                                    <h4>Bất động sản 01
                                                    </h4>
                                                    <div class="desc">
                                                        <span>Giá</span>
                                                        <h3>Free</h3>
                                                    </div>
                                                    <div class="book-now-c">
                                                        <a class="btn-theme" data-theme="BDS-01" href="#a">Chọn</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="slide-hover">
                                                <div class="text-wrap">
                                                    <p>Chủ đề Bất động sản 01</p>
                                                    <h4>Bất động sản 01
                                                    </h4>
                                                    <div class="desc">
                                                        <span>Giá</span>
                                                        <h3>Free</h3>
                                                    </div>
                                                    <div class="book-now-c">
                                                        <a class="btn-theme" data-theme="BDS-01" href="#a">Chọn</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 deal deal-block">
                                        <div class="item-slide">
                                            <div class="box-img">
                                                <img src="{{asset('images/themes/BDS-02.jpg')}}"
                                                     alt="dasdas"/>
                                                <div class="text-wrap">
                                                    <h4>Bất động sản 02
                                                    </h4>
                                                    <div class="desc">
                                                        <span>Giá</span>
                                                        <h3>Free</h3>
                                                    </div>
                                                    <div class="book-now-c">
                                                        <a class="btn-theme" data-theme="BDS-02" href="#a">Chọn</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="slide-hover">
                                                <div class="text-wrap">
                                                    <p>Chủ đề Bất động sản 02</p>
                                                    <h4>Bất động sản 02
                                                    </h4>
                                                    <div class="desc">
                                                        <span>Giá</span>
                                                        <h3>Free</h3>
                                                    </div>
                                                    <div class="book-now-c">
                                                        <a class="btn-theme" data-theme="BDS-02" href="#a">Chọn</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 deal deal-block">
                                        <div class="item-slide">
                                            <div class="box-img">
                                                <img src="{{asset('images/themes/BDS-03.jpg')}}"
                                                     alt="dasdas"/>
                                                <div class="text-wrap">
                                                    <h4>Bất động sản 03
                                                    </h4>
                                                    <div class="desc">
                                                        <span>Giá</span>
                                                        <h3>Free</h3>
                                                    </div>
                                                    <div class="book-now-c">
                                                        <a class="btn-theme" data-theme="BDS-03" href="#a">Chọn</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="slide-hover">
                                                <div class="text-wrap">
                                                    <p>Chủ đề Bất động sản 03</p>
                                                    <h4>Bất động sản 03
                                                    </h4>
                                                    <div class="desc">
                                                        <span>Giá</span>
                                                        <h3>Free</h3>
                                                    </div>
                                                    <div class="book-now-c">
                                                        <a class="btn-theme" data-theme="BDS-03" href="#a">Chọn</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </dl>

                        <dl>
                            <dd class="text-center" style="margin-left: 0 !important;">
                                <a class="_btn bg_red btn-submit" href="#a"> Lưu lại</a>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include(theme(TRUE).'.includes.footer')

@endsection

@push('js')
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#list').click(function (event) {
                event.preventDefault();
                $('#products .item').addClass('list-group-item');
            });
            $('#grid').click(function (event) {
                event.preventDefault();
                $('#products .item').removeClass('list-group-item');
                $('#products .item').addClass('grid-group-item');
            });
        });

        $('.item-slide').on('click', '.btn-theme', function(){
            var theme    =   $(this).data('theme');
            console.log(theme);
            $('.item-slide').removeClass('picked');
            $(this).closest('.item-slide').addClass('picked');
            $('#input-theme').val(theme);
        });
        $(document).on('click', '.btn-submit', function(e){
            $('.form-horizontal input').parent().removeClass('has-error');
            var theme = $('#input-theme').val();
            var title = $('#title').val();
            var domain = $('#domain').val();
            $('.form-horizontal input').each(function(){
                if($(this).val() == '')
                    $(this).parent().addClass('has-error')
            });
            if(theme != '' && title != '' && domain !='')
            {
                $(this).html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i> Đang tải');
                $(this).attr('disabled','disabled');
                $.post('<?php echo asset('frontend/create'); ?>', {theme, title, domain, _token: '{{csrf_token()}}'}, function(r){

                }).done(function(r) {
                    window.location.replace(r.url);
                }).fail(function(data) {
                    if( data.status === 422 ) {
                        var errors = $.parseJSON(data.responseText);
                        $.each(errors, function (key, value) {
                            // console.log(key+ " " +value);
                            $('#response').addClass("alert alert-danger");

                            if($.isPlainObject(value)) {
                                $.each(value, function (key, value) {
                                    console.log(key+ " " +value);
                                    $('#response').show().append(value+"<br/>");
                                    $('input[name=domain]').parent().find('.help-block').html(value);
                                    $('input[name=domain]').parent().addClass('has-error');
                                    $('.btn-submit').html('Lưu lại');
                                    $('.btn-submit').removeAttr('disabled');
                                });
                            }else{
                                $('#response').show().append(value+"<br/>");
                            }
                        });
                    }
                });
            }
        });

    </script>
@endpush
