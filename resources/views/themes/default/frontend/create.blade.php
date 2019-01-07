@extends(theme(TRUE).'.layouts.app')

@section('title')
    {{trans('frontend.create')}}
@endsection

@section('style')
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
    <link rel="stylesheet" href="{{asset('themes/default/css/real-estate.css')}}"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" href="{{asset('plugins/jquery.tokenInput/token-input.css')}}"/>

    <style type="text/css">
        li.token-input-token {
            max-width: 100% !important;
        }

        ul.token-input-list {
            width: 100% !important;
        }
    </style>
    <style type="text/css">
        .form-inline .form-group {
            margin-bottom: 10px !important;
            margin-top: 10px;
        }
        .help-block {display: none; font-size: 11px; font-style: italic}
        .has-error .help-block {display: block}
    </style>
@endsection

@section('content')
    @include(theme(TRUE).'.includes.header')
    <div class="row">
        <div class="col-md-12">
            @include('themes.default.includes.message')
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">{{trans('frontend.create')}}</h3>

                    <div class="box-tools pull-right">
                        {!! a('frontend', '', '<i class="fa fa-arrow-left"></i> '.trans('system.back'), ['class'=>'btn btn-sm btn-success'],'')  !!}
                    </div>
                </div>
                <div class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{trans('frontend.title')}}</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="title" id="title"
                                       placeholder="{{trans('frontend.title')}}" value="{{old('title')}}"/>
                                <span class="help-block">Vui lòng điền thông tin</span>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{trans('frontend.domain')}}</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="domain" id="domain"
                                       placeholder="{{trans('frontend.domain')}}" value="{{old('domain')}}"/>
                                <span class="help-block check-domain">Vui lòng điền thông tin</span>
                            </div>
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Chọn theme:</label>
                        </div>
                    </div>
                    <section class="new-deal">

                        <input type="text" name="theme" id="input-theme" hidden>
                        <div class="container">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 deal deal-block">
                                <div class="item-slide">
                                    <div class="box-img">
                                        <img src="{{asset('images/themes/index-agency-01.jpg')}}"
                                             alt="dasdas"/>
                                        <div class="text-wrap">
                                            <h4>Bất động sản 01
                                            </h4>
                                            <div class="desc">
                                                <span>Giá</span>
                                                <h3>Free</h3>
                                            </div>
                                            <div class="book-now-c">
                                                <a class="btn-theme" data-theme="index-agency-01" href="#a">Chọn</a>
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
                                                <a class="btn-theme" data-theme="index-agency-01" href="#a">Chọn</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 deal deal-block">
                                <div class="item-slide">
                                    <div class="box-img">
                                        <img src="{{asset('images/themes/index-agency-02.jpg')}}"
                                             alt="dasdas"/>
                                        <div class="text-wrap">
                                            <h4>Bất động sản 02
                                            </h4>
                                            <div class="desc">
                                                <span>Giá</span>
                                                <h3>Free</h3>
                                            </div>
                                            <div class="book-now-c">
                                                <a class="btn-theme" data-theme="index-agency-02" href="#a">Chọn</a>
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
                                                <a class="btn-theme" data-theme="index-agency-02" href="#a">Chọn</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 deal deal-block">
                                <div class="item-slide">
                                    <div class="box-img">
                                        <img src="{{asset('images/themes/index-agency-03.jpg')}}"
                                             alt="dasdas"/>
                                        <div class="text-wrap">
                                            <h4>Bất động sản 03
                                            </h4>
                                            <div class="desc">
                                                <span>Giá</span>
                                                <h3>Free</h3>
                                            </div>
                                            <div class="book-now-c">
                                                <a class="btn-theme" data-theme="index-agency-03" href="#a">Chọn</a>
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
                                                <a class="btn-theme" data-theme="index-agency-03" href="#a">Chọn</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="reset" class="btn btn-default">{{trans('system.cancel')}}</button>
                        <a class="btn btn-info pull-right btn-submit">{{trans('system.submit')}}</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
                {{-- modal select image --}}
                <div class="modal fade" id="myModal" style="opacity: 1; overflow: visible; display: none;"
                     aria-hidden="true">
                    <div class="modal-dialog" style="width: 860px">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Chọn ảnh</h4>
                            </div>
                            <div class="modal-body" style="padding:0px; margin:0px; width: 100%;">
                                <iframe width="100%" height="400"
                                        src="/plugins/filemanager/dialog.php?type=2&amp;field_id=images'&amp;fldr="
                                        frameborder="0"
                                        style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
            </div>
        </div>
    </div>
    @include(theme(TRUE).'.includes.footer')

@endsection

@section('js')
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

        function responsive_filemanager_callback(field_id) {
            console.log(field_id);
            var url = jQuery('#' + field_id).val();
            console.log(url);
            var splitImages = url.split(',');
            var isMultiImages = splitImages.length > 1 ? true : false;
            var resultImages = null;
            if (isMultiImages) {
                for (var i = 0, len = splitImages.length; i < len; i++) {
                    let tmp = '';
                    if (i === 0) {
                        tmp = splitImages[i].substr(2, splitImages[i].length - 3);
                    }
                    else if (i === len - 1) {
                        tmp = splitImages[i].substr(1, splitImages[i].length - 3);
                    }
                    else {
                        tmp = splitImages[i].substr(1, splitImages[i].length - 2);
                    }
                    tmp = removeRootUrl(tmp);
                    if (i !== len - 1) {
                        if (resultImages) {
                            resultImages = resultImages + tmp + ',';
                        } else {
                            resultImages = tmp + ',';
                        }
                    } else {
                        resultImages += tmp;
                    }
                }
            } else {
                let tmp = url;
                resultImages = removeRootUrl(tmp);
            }
            console.log('result images');
            console.log(resultImages);
            jQuery('#' + field_id).val(resultImages);

            // handle show preview img and input alt text
            let arrImgLinks = resultImages.split(',');
            console.log(arrImgLinks);
            // empty html before append new image
            $('.img-preview').html('');
            for (let imgLink of arrImgLinks) {
                let htmlMarkup = '<div class="col-xs-3 item-img-preview"><img src="' + imgLink + '" class="img-responsive"/>'
                    + '<div class=""><input type="hidden" name="images[]" value="' + imgLink + '" class="form-control" />'
                    + '<label>{{ trans("real-estate.formCreateLabel.alt-text") }}</label>'
                    + '<input type="text" name="alt[]" class="form-control" /></div>'
                    + '<a class="img-preview-btn-remove" onclick="removeImgPreview(this)"><i class="fa fa-trash" aria-hidden="true"></i></a>'
                    + '</div>';

                console.log('a');
                $('.img-preview').append(htmlMarkup);
            }
        }

        function removeRootUrl(str) {
            let indexC = str.indexOf('/', 8);
            str = str.substr(indexC);
            return str;
        }

        // remove img preview
        function removeImgPreview(e) {
            console.log(e);
            $(e).closest('.item-img-preview').remove();
        }

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
            var theme = $('.btn-theme').data('theme');
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
@endsection
