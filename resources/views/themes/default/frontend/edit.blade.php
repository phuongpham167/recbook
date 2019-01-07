@extends(theme(TRUE).'.layout')

@section('title')
    {{trans('web.edit')}}
@endsection

@section('content')
    @include(theme(TRUE).'.includes.header')
    <div class="row">
        <div class="col-md-12">
            @include('themes.default.includes.message')
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">{{trans('web.edit')}}</h3>

                    <div class="box-tools pull-right">
                        {!! a('web', '', '<i class="fa fa-arrow-left"></i> '.trans('system.back'), ['class'=>'btn btn-sm btn-success'],'')  !!}
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
            </div>
        </div>
    </div>
    @include(theme(TRUE).'.includes.footer')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" href="{{asset('themes/default/css/real-estate.css')}}" />
@endsection

@section('js')
    <script src="{{asset('plugins/moment-develop/moment.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script>
        function responsive_filemanager_callback(field_id){
            console.log(field_id);
            var url=jQuery('#'+field_id).val();
            console.log(url);
            var splitImages = url.split(',');
            var isMultiImages = splitImages.length > 1 ? true : false;
            var resultImages = null;
            if (isMultiImages) {
                for (var i= 0, len = splitImages.length; i < len; i++) {
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
            jQuery('#'+field_id).val(resultImages);

            // handle show preview img and input alt text
            let arrImgLinks = resultImages.split(',');
            console.log(arrImgLinks);
            // empty html before append new image
            $('.img-preview').html('');
            for (let imgLink of arrImgLinks) {
                let htmlMarkup = '<div class="col-xs-3 item-img-preview"><img src="' + imgLink + '" class="img-responsive"/>'
                    + '<div class=""><input type="hidden" name="images[]" value="' + imgLink +'" class="form-control" />'
                    +'<label>{{ trans("real-estate.formCreateLabel.alt-text") }}</label>'
                    +'<input type="text" name="alt[]" class="form-control" /></div>'
                    +'<a class="img-preview-btn-remove" onclick="removeImgPreview(this)"><i class="fa fa-trash" aria-hidden="true"></i></a>'
                    +'</div>';

                $('.img-preview').append(htmlMarkup);
            }
        }
        function removeRootUrl(str) {
            let indexC = str.indexOf('/', 8);
            str = str.substr(indexC);
            return str;
        }
        // remove img preview
        function removeImgPreview(e){
            console.log(e);
            $(e).closest('.item-img-preview').remove();
        }
        $(function() {
            $('.datepicker').datetimepicker({format: "DD/MM/YYYY"});

        });
    </script>
@endsection
