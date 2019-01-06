@push('style')
    <link rel="stylesheet" href="{{ asset('css/manage-real-estate.css') }}"/>
    <link rel="stylesheet"
          href="{{asset('plugins/bootstrap-datetimepicker-master/build/css/bootstrap-datetimepicker.min.css')}}">
@endpush

@if (!empty($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form class="form-horizontal" method="post" action="{{route('post.create-real-estate')}}">
    {{csrf_field()}}
    <div class="form-group">
        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.title')}} <span
                class="text-red">*</span></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}"/>
            <p class="text-red error"></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.detail')}} <span
                class="text-red">*</span>
        </label>
        <div class="col-sm-10">
            <textarea name="detail" class="form-control" id="detail"></textarea>
            <p class="text-red error"></p>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-6">
            <button type="button" class="btn btn-default btn-collapse" data-toggle="collapse" data-target="#catSelect">Danh mục</button>
        </div>
        <div class="col-sm-6">
            <button type="button" class="btn btn-default btn-collapse" data-toggle="collapse" data-target="#addressSelect"><i class="fa fa-road" aria-hidden="true"></i> Khu vực</button>
        </div>
    </div>
    <div class="form-group collapse" id="catSelect">
        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.reCategory')}}</label>
        <div class="col-sm-4">
            <select class="form-control" id="re-category" name="re_category_id" onchange="changeReCategory(this)"
                    value="{{ old('re_category_id') }}">
                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                @foreach($reCategories as $reCategory)
                    <option value="{{$reCategory->id}}">{{$reCategory->name}}</option>
                @endforeach
            </select>
            <p class="text-red error"></p>
        </div>
        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.reType')}}</label>
        <div class="col-sm-4">
            <select class="form-control" id="re-type" name="re_type_id" value="{{ old('re_type_id') }}">
                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
            </select>
            <p class="text-red error"></p>
        </div>
    </div>
    {{--<div class="form-group">--}}
        {{--<div class="col-sm-10 col-sm-offset-2">--}}
            {{--<button type="button" class="btn btn-default" data-toggle="collapse" data-target="#addressSelect"><i class="fa fa-road" aria-hidden="true"></i> Khu vực</button>--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="form-group collapse" id="addressSelect">
        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.district')}} </label>
        <div class="col-sm-4">
            <select class="form-control" id="district" name="district_id" onchange="changeDistrict(this)"
                    value="{{ old('district_id') }}">
                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                @foreach($districtByUProvince as $d)
                    <option value="{{$d->id}}">{{$d->name}}</option>
                @endforeach
            </select>
            <p class="text-red error"></p>
        </div>
        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.ward')}} </label>
        <div class="col-sm-4">
            <select class="form-control" id="ward" name="ward_id" value="{{ old('ward_id') }}"
                    onchange="changeWard(this)">
                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
            </select>
            <p class="text-red error"></p>
        </div>
        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.street')}} </label>
        <div class="col-sm-4">
            <select class="form-control" id="street" name="street_id" value="{{ old('street_id') }}">
                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
            </select>
            <p class="text-red error"></p>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-6">
            <button type="button" class="btn btn-default btn-collapse" data-toggle="collapse" data-target="#nearBy">Gần</button>
        </div>
        <div class="col-sm-6">
            <button type="button" class="btn btn-default btn-collapse" data-toggle="collapse" data-target="#directionSelect">Hướng</button>
        </div>
    </div>
    <div class="form-group collapse" id="nearBy">
        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.position')}}</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="position" value="{{ old('position') }}" placeholder="VD: gần chợ 200m,"/>
        </div>
    </div>
    <div class="form-group collapse" id="directionSelect">

        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.direction')}} </label>
        <div class="col-sm-4">
            <select class="form-control" id="direction" name="direction_id" value="{{ old('direction_id') }}">
                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                @foreach($directions as $direction)
                    <option value="{{$direction->id}}">{{$direction->name}}</option>
                @endforeach
            </select>
            <p class="text-red error"></p>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-6">
            <button type="button" class="btn btn-default btn-collapse" data-toggle="collapse" data-target="#exhibitSelect">Giấy tờ</button>
        </div>
        <div class="col-sm-6">
            <button type="button" class="btn btn-default btn-collapse" data-toggle="collapse" data-target="#projectSelect">Dự án</button>
        </div>
    </div>
    <div class="form-group collapse" id="exhibitSelect">
        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.exhibit')}} </label>
        <div class="col-sm-4">
            <select class="form-control" id="exhibit" name="exhibit_id" value="{{ old('exhibit_id') }}">
                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                @foreach($exhibits as $exhibit)
                    <option value="{{$exhibit->id}}">{{$exhibit->name}}</option>
                @endforeach
            </select>
            <p class="text-red error"></p>
        </div>
    </div>
    <div class="form-group collapse" id="projectSelect">

        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.project')}} </label>
        <div class="col-sm-4">
            <select class="form-control" id="project" name="project_id" value="{{ old('project_id') }}">
                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                @foreach($projectByUProvince as $p)
                    <option value="{{$p->id}}">{{$p->name}}</option>
                @endforeach
            </select>
            <p class="text-red error"></p>
        </div>

        {{--<label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.block')}}</label>--}}
        {{--<div class="col-sm-4">--}}
            {{--<select class="form-control" id="block" name="block_id" value="{{ old('block_id') }}">--}}
                {{--<option value="">{{trans('real-estate.selectFirstOpt')}}</option>--}}
                {{--@foreach($blocks as $block)--}}
                    {{--<option value="{{$block->id}}">{{$block->name}}</option>--}}
                {{--@endforeach--}}
            {{--</select>--}}
        {{--</div>--}}
    </div>
    {{--<div class="form-group">--}}

        {{--<label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.constructionType')}}</label>--}}
        {{--<div class="col-sm-4">--}}
            {{--<select class="form-control" id="construction-type" name="construction_type_id"--}}
                    {{--value="{{ old('construction_type_id') }}">--}}
                {{--<option value="">{{trans('real-estate.selectFirstOpt')}}</option>--}}
                {{--@foreach($constructionTypes as $constructionType)--}}
                    {{--<option value="{{$constructionType->id}}">{{$constructionType->name}}</option>--}}
                {{--@endforeach--}}
            {{--</select>--}}
        {{--</div>--}}

    {{--</div>--}}
    {{--<div class="form-group">--}}
        {{--<label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.width')}}</label>--}}

        {{--<div class="col-sm-4">--}}
            {{--<input type="number" class="form-control" name="width" value="{{ old('width') }}"/>--}}
        {{--</div>--}}
        {{--<label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.length')}}</label>--}}

        {{--<div class="col-sm-4">--}}
            {{--<input type="number" class="form-control" name="length" value="{{ old('length') }}"/>--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="form-group">
        <div class="col-sm-6">
            <button type="button" class="btn btn-default btn-collapse" data-toggle="collapse" data-target="#room"><i class="fa fa-bed" aria-hidden="true"></i> Phòng</button>
        </div>
        <div class="col-sm-6">
            <button type="button" class="btn btn-default btn-collapse" data-toggle="collapse" data-target="#area"><i class="fa fa-area-chart" aria-hidden="true"></i> Diện tích</button>
        </div>
    </div>
    <div class="form-group collapse" id="room">
        <div class="row">
            <div class="col-xs-12">
                <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.bedroom')}}</label>

                <div class="col-sm-4">
                    <input type="number" class="form-control" name="bedroom" value="{{ old('bedroom') }}"/>
                </div>
                <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.living_room')}}</label>

                <div class="col-sm-4">
                    <input type="number" class="form-control" name="living_room" value="{{ old('living_room') }}"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.wc')}}</label>

                <div class="col-sm-4">
                    <input type="number" class="form-control" name="wc" value="{{ old('wc') }}"/>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group collapse" id="area">

        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.areaOfPremises')}} </label>

        <div class="col-sm-4">
            <input type="number" class="form-control" id="area-of-premises" name="area_of_premises" value="{{ old('area_of_premises') }}" step="0.01"/>
            <p class="text-red error"></p>
        </div>
        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.areaOfUse')}}</label>

        <div class="col-sm-4">
            <input type="number" class="form-control" name="area_of_use" value="{{ old('area_of_use') }}" step="0.01"/>
        </div>

    </div>
    <div class="form-group">
        <div class="col-sm-6">
            <button type="button" class="btn btn-default btn-collapse" data-toggle="collapse" data-target="#floorSelect">Số tầng</button>
        </div>
        <div class="col-sm-6">
            <button type="button" class="btn btn-default btn-collapse" data-toggle="collapse" data-target="#priceSelect">Giá</button>
        </div>
    </div>
    <div class="form-group collapse" id="floorSelect">
        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.floor')}}</label>

        <div class="col-sm-4">
            <input type="number" class="form-control" name="floor" value="{{ old('floor') }}"/>
        </div>
    </div>
    <div class="form-group collapse" id="priceSelect">
        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.price')}}</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="price" value="{{ old('price') }}" step="0.01"/>
        </div>
        <div class="col-sm-10 col-sm-offset-2">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="is_deal" {{ old('is_deal') == 'on' ? 'checked' : '' }}>
                    {{trans('real-estate.formCreateLabel.isDeal')}}
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-6">
            <button type="button" class="btn btn-default btn-collapse" data-toggle="collapse" data-target="#time"><i class="fa fa-calendar-minus-o"></i> Lịch</button>
        </div>
        <div class="col-sm-6">
            <button type="button" class="btn btn-default btn-collapse" data-toggle="collapse" data-target="#mapSelect"><i class="fa fa-map-marker"></i> Vị ví</button>
        </div>
    </div>
    <div class="form-group collapse" id="time">
        <div class="row">
            <div class="col-xs-12">
                <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.postDate')}} </label>
                <div class="col-sm-6">
                    <div class='input-group date' id='post-date'>
                        <input type='text' class="form-control" id="post-date-val" name="post_date" value="{{ old('post_date') }}"/>
                        <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                    </div>
                    <p class="text-red error"></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.expireDate')}} </label>
                <div class="col-sm-6">
                    <div class='input-group date' id='expire-date'>
                        <input type='text' class="form-control" id="expire-date-val" name="expire_date" value="{{ old('expire_date') }}"/>
                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                    </div>
                    <p class="text-red error"></p>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group collapse" id="mapSelect">
        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.map')}}</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="map" id="map" value="{{ old('map') }}"/>
            <span class="help-block"><i>{{trans('real-estate.formCreateLabel.mapHelpBlock')}}</i></span>
        </div>
        <div class="col-sm-12">
            <div id="map-view" style="width: 100%; height: 250px;"></div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-6">
            <button type="button" class="btn btn-default btn-collapse" data-toggle="collapse" data-target="#imageSelect"><i class="fa fa-picture-o"></i> Hình ảnh</button>
        </div>
    </div>
    <div class="form-group collapse" id="imageSelect">
        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.image')}}</label>
        <div class="col-sm-10">
            <div class="input-group">
                    <span class="input-group-btn">
                        <a data-toggle="modal" href="javascript:;" data-target="#myModal"
                           class="btn btn-primary" type="button" id="choose-image">
                            <i class="fa fa-picture-o"></i> Choose
                        </a>
                    </span>
                <input id="images" class="form-control" name="imagesList" type="hidden" value="" readonly>
            </div>
        </div>
        <div class="col-sm-12 img-preview">

        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Đăng lên</label>

        <div class="col-sm-4">
            <select class="form-control" id="is-private" name="is_private" value="{{ old('is_private') }}">
                <option value="1">Đăng trên trang cá nhân</option>
                <option value="2">Đăng trên web cá nhân</option>
                <option value="3">Đăng trên web công ty</option>
                <option value="4">Đăng trên web đã đăng ký</option>
            </select>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            <button type="button" name="add_new" id="add-new-re" class="_btn bg_red"><i class="fa fa-plus"></i> &nbsp;&nbsp;ĐĂNG TIN
            </button>
        </div>
    </div>
    <!-- /.box-footer -->
</form>
{{-- modal select image --}}
<div class="modal fade" id="myModal" style="opacity: 1; overflow: visible; display: none;" aria-hidden="true">
    <div class="modal-dialog" style="width: 860px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Chọn ảnh</h4>
            </div>
            <div class="modal-body" style="padding:0px; margin:0px; width: 100%;">
                <iframe width="100%" height="400"
                        src="/plugins/filemanager/dialog.php?type=2&amp;field_id=images&amp;fldr=" frameborder="0"
                        style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

@push('js')
    <script
        src="{{asset('plugins/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('plugins/ckeditor-4/ckeditor.js')}}"></script>
    <script>
        $(function () {
            // $('#contact_phone_number').keyup(function () {
            //     emptyContactInfo();
            //
            //     let phone = $(this).val();
            //     if (phone.length > 9) {
            //         $.ajax({
            //             url: "/customer-by-phone/" + phone,
            //             method: 'GET',
            //             success: function (result) {
            //                 console.log('success');
            //                 console.log(result);
            //                 if (!jQuery.isEmptyObject(result)) {
            //                     $('#contact_person').val(result.name).prop('readonly', true);
            //                     $('#contact_address').val(result.address).prop('readonly', true);
            //                 } else {
            //                     emptyContactInfo();
            //                 }
            //             }
            //         });
            //     }
            // });

            // init datetime picker
            $('#post-date').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss',
                defaultDate: moment.now()
            });
            $('#expire-date').datetimepicker({
                format: 'YYYY-MM-DD',
                useCurrent: false
            });
            $("#post-date").on("dp.change", function (e) {
                $('#expire-date').data("DateTimePicker").minDate(e.date);
            });
            $("#expire-date").on("dp.change", function (e) {
                $('#post-date').data("DateTimePicker").maxDate(e.date);
            });

            // var domain = "";
            // $('#lfm').filemanager('image', {prefix: domain});

            $('#map-view').locationpicker({
                location: {
                    latitude: 10.774839,
                    longitude: 106.700766
                },
                radius: 0,
                onchanged: function (currentLocation, radius, isMarkerDropped) {
                    console.log("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
                    $('#map').val(currentLocation.latitude + ", " + currentLocation.longitude);
                }
            });

            // var options = {
            //     filebrowserBrowseUrl: '/plugins/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
            //     filebrowserUploadUrl: '/plugins/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
            //     filebrowserImageBrowseUrl: '/plugins/filemanager/dialog.php?type=1&editor=ckeditor&fldr='
            // };
            // CKEDITOR.replace('editor', options);

            let totalShortDesLetter = 150;

            // $('#short-description').keyup(function () {
            //     let txtLength = $(this).val().length;
            //     $('#count-short-des').text(totalShortDesLetter - txtLength);
            // });
        });

        function changeReCategory(e) {
            console.log($(e).val());
            let catId = $(e).val();

            $.ajax({
                url: "/re-type/list-dropdown/" + catId,
                method: 'GET',
                success: function (result) {
                    console.log('success');
                    console.log(result);
                    let html = '';
                    if (result) {
                        for (let r of result) {
                            html += '<option value="' + r.id + '">' + r.name + '</option>';
                        }
                    }
                    if (html) {
                        $('#re-type').html(html);
                    }
                }
            });

            $.ajax({
                url: '/range-price/list-dropdown/' + catId,
                method: 'GET',
                success: function (result) {
                    console.log('success');
                    console.log(result);
                    let html = '';
                    if (result) {
                        for (let r of result) {
                            html += '<option value="' + r.id + '">' + r.name + '</option>';
                        }
                    }
                    $('#range-price').html(html);
                }
            });
        }

        function changeProvince(e) {
            console.log($(e).val());
            let provinceId = $(e).val();

            $.ajax({
                url: '/district-by-province/' + provinceId,
                method: 'GET',
                success: function (result) {
                    console.log('success');
                    console.log(result);
                    let html = '<option value="">{{trans('real-estate.selectFirstOpt')}}</option>';
                    if (result) {
                        for (let r of result) {
                            html += '<option value="' + r.id + '">' + r.name + '</option>';
                        }
                    }
                    if (html) {
                        $('#district').html(html);
                    }
                }
            });

            $.ajax({
                url: '/project-by-province/' + provinceId,
                method: 'GET',
                success: function (result) {
                    console.log('success');
                    console.log(result);
                    let html = '<option value="">{{trans('real-estate.selectFirstOpt')}}</option>';
                    if (result) {
                        for (let r of result) {
                            html += '<option value="' + r.id + '">' + r.name + '</option>';
                        }
                    }
                    if (html) {
                        $('#project').html(html);
                    }
                }
            });
        }

        function changeDistrict(e) {
            console.log($(e).val());
            let districtId = $(e).val();

            $.ajax({
                url: '/ward-by-district/' + districtId,
                method: 'GET',
                success: function (result) {
                    console.log('success');
                    console.log(result);
                    let html = '<option value="">{{trans('real-estate.selectFirstOpt')}}</option>';
                    if (result) {
                        for (let r of result) {
                            html += '<option value="' + r.id + '">' + r.name + '</option>';
                        }
                    }
                    if (html) {
                        $('#ward').html(html);
                    }
                }
            });
        }

        function changeWard(e) {
            console.log($(e).val());
            let wardId = $(e).val();

            $.ajax({
                url: '/street-by-ward/' + wardId,
                method: 'GET',
                success: function (result) {
                    console.log('success');
                    console.log(result);
                    let html = '';
                    if (result) {
                        for (let r of result) {
                            html += '<option value="' + r.id + '">' + r.name + '</option>';
                        }
                    }
                    if (html) {
                        $('#street').html(html);
                    }
                }
            });
        }

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
            var root = location.protocol + '//' + location.host;
            /*
            * 12-07-2018
            * change here - save image with absolute path
            * */
            console.log('arr img');
            console.log(arrImgLinks);
            /*
            * 05/01/2019
            * save if id = avatar
            * */
            if(field_id == 'avatar') {
                const avatar = root + arrImgLinks[0];
                updateAvatar(avatar);
                return;
            }
            // empty html before append new image
            $('.img-preview').html('');
            for (let imgLink of arrImgLinks) {
                let htmlMarkup = '<div class="col-xs-4 item-img-preview"><img src="' + root + imgLink + '" class="img-responsive"/>'
                    + '<div class=""><input type="hidden" name="images[]" value="' + root + imgLink + '" class="form-control" />'
                    + '<label>{{ trans("real-estate.formCreateLabel.alt-text") }}</label>'
                    + '<input type="text" name="alt[]" class="form-control" /></div>'
                    + '<a class="img-preview-btn-remove" onclick="removeImgPreview(this)"><i class="fa fa-trash" aria-hidden="true"></i></a>'
                    + '</div>';

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

        function emptyContactInfo() {
            if ($('#contact_person').prop('readonly')) {
                $('#contact_person').val('').prop('readonly', false);
            }
            if ($('#contact_address').prop('readonly')) {
                $('#contact_address').val('').prop('readonly', false);
            }
        }
        function updateAvatar(avatar) {
            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': '{{csrf_token()}}'

                }

            });
            $.ajax({
                url: '{{route('post.update-avatar')}}',
                method: 'POST',
                data: {avatar: avatar},
                success: function (result) {
                    console.log('success');
                    console.log(result);
                    if (result.code == 200) {
                        console.log('ok');
                        $('.avatar').attr('src', avatar);
                    }
                }
            });
        }

    </script>
@endpush
