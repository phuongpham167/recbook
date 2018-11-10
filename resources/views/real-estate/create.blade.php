@extends(theme(TRUE).'.layout')

@section('title')
    {{trans('real-estate.pageCreateTitle')}}
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('themes/default/css/real-estate.css')}}" />
@endsection

<?php
    $user = \Auth::user();
//    dd($user);
    $adminGroup = config('res-filemanager.admin_group');
    if ($user->group_id != $adminGroup) {
        if (! File::exists(public_path()."/storage/uploads/user".$user->id)) {
            File::makeDirectory(public_path()."/storage/uploads/user".$user->id, $mode=0766, true, true);
        }
        session_start();
        $_SESSION["RF"]["subfolder"] = "user".$user->id;
    }

?>

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">{{trans('real-estate.pageCreateTitle')}}</h3>

                    <div class="box-tools pull-right">
                        {!! a('real-estate', '', '<i class="fa fa-arrow-left"></i> '.trans('system.back'), ['class'=>'btn btn-sm btn-success'],'')  !!}
                    </div>
                </div>
                <div class="box-body">
                    <form class="form-horizontal" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.title')}} <span class="text-red">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.shortDescription')}} <span class="text-red">*</span></label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="short-description" name="short_description" maxlength="150" value="{{ old('short_description') }}"/>
                                <span class="help-block"><span id="count-short-des">150</span>{{trans('real-estate.formCreateLabel.shortDescriptionHelpBlock')}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.contactPerson')}} <span class="text-red">*</span></label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="contact_person" value="{{ old('contact_person') }}"/>
                            </div>
                            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.contactPhone')}} <span class="text-red">*</span></label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="contact_phone_number" value="{{ old('contact_phone_number') }}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.contactAddress')}} <span class="text-red">*</span></label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="contact_address" value="{{ old('contact_address') }}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.reCategory')}} <span class="text-red">*</span></label>
                            <div class="col-sm-2">
                                <select class="form-control" id="re-category" name="re_category_id" onchange="changeReCategory(this)" value="{{ old('re_category_id') }}">
                                    <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                    @foreach($reCategories as $reCategory)
                                        <option value="{{$reCategory->id}}">{{$reCategory->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.reType')}} <span class="text-red">*</span></label>
                            <div class="col-sm-2">
                                <select class="form-control" id="re-type" name="re_type_id" value="{{ old('re_type_id') }}">
                                    <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                </select>
                            </div>
                            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.province')}} <span class="text-red">*</span></label>
                            <div class="col-sm-2">
                                <select class="form-control" id="province" name="province_id" onchange="changeProvince(this)" value="{{ old('province_id') }}">
                                    <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                    @foreach($provinces as $province)
                                        <option value="{{$province->id}}">{{$province->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.district')}} <span class="text-red">*</span></label>
                            <div class="col-sm-2">
                                <select class="form-control" id="district" name="district_id" onchange="changeDistrict(this)" value="{{ old('district_id') }}">
                                    <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                </select>
                            </div>
                            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.ward')}} <span class="text-red">*</span></label>
                            <div class="col-sm-2">
                                <select class="form-control" id="ward" name="ward_id" value="{{ old('ward_id') }}" onchange="changeWard(this)">
                                    <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.address')}} <span class="text-red">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="address" value="{{ old('address') }}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.street')}} <span class="text-red">*</span></label>
                            <div class="col-sm-2">
                                <select class="form-control" id="street" name="street_id" value="{{ old('street_id') }}">
                                    <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                    {{--@foreach($streets as $street)--}}
                                        {{--<option value="{{$street->id}}">{{$street->name}}</option>--}}
                                    {{--@endforeach--}}
                                </select>
                            </div>
                            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.direction')}} <span class="text-red">*</span></label>
                            <div class="col-sm-2">
                                <select class="form-control" id="direction" name="direction_id" value="{{ old('direction_id') }}">
                                    <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                    @foreach($directions as $direction)
                                        <option value="{{$direction->id}}">{{$direction->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.exhibit')}} <span class="text-red">*</span></label>
                            <div class="col-sm-2">
                                <select class="form-control" id="exhibit" name="exhibit_id" value="{{ old('exhibit_id') }}">
                                    <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                    @foreach($exhibits as $exhibit)
                                        <option value="{{$exhibit->id}}">{{$exhibit->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.project')}} <span class="text-red">*</span></label>
                            <div class="col-sm-2">
                                <select class="form-control" id="project" name="project_id" value="{{ old('project_id') }}">
                                    <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                </select>
                            </div>
                            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.block')}}</label>
                            <div class="col-sm-2">
                                <select class="form-control" id="block" name="block_id" value="{{ old('block_id') }}">
                                    <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                    @foreach($blocks as $block)
                                        <option value="{{$block->id}}">{{$block->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.constructionType')}}</label>
                            <div class="col-sm-2">
                                <select class="form-control" id="construction-type" name="construction_type_id" value="{{ old('construction_type_id') }}">
                                    <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                    @foreach($constructionTypes as $constructionType)
                                        <option value="{{$constructionType->id}}">{{$constructionType->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.width')}}</label>

                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="width" value="{{ old('width') }}"/>
                            </div>
                            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.length')}}</label>

                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="length" value="{{ old('length') }}"/>
                            </div>
                            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.bedroom')}}</label>

                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="bedroom" value="{{ old('bedroom') }}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.areaOfPremises')}} <span class="text-red">*</span></label>

                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="area_of_premises" value="{{ old('area_of_premises') }}"/>
                            </div>
                            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.areaOfUse')}}</label>

                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="area_of_use" value="{{ old('area_of_use') }}"/>
                            </div>
                            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.floor')}}</label>

                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="floor" value="{{ old('floor') }}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.price')}}</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="price" value="{{ old('price') }}"/>
                            </div>

                            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.unit')}}</label>
                            <div class="col-sm-2">
                                <select class="form-control" id="unit" name="unit_id" value="{{ old('unit_id') }}">
                                    <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                    @foreach($units as $unit)
                                        <option value="{{$unit->id}}">{{$unit->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.rangePrice')}}</label>
                            <div class="col-sm-2">
                                <select class="form-control" id="range-price" name="range_price_id" value="{{ old('range_price_id') }}">
                                    <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
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
                            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.postDate')}} <span class="text-red">*</span></label>
                            <div class="col-sm-4">
                                <div class='input-group date' id='post-date'>
                                    <input type='text' class="form-control" name="post_date" value="{{ old('post_date') }}"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.expireDate')}}</label>
                            <div class="col-sm-4">
                                <div class='input-group date' id='expire-date'>
                                    <input type='text' class="form-control" name="expire_date" value="{{ old('expire_date') }}"/>
                                    <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.image')}}</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <a data-toggle="modal" href="javascript:;" data-target="#myModal" class="btn btn-primary" type="button" id="choose-image">
                                            <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                    </span>
                                    <input id="images" class="form-control" name="imagesList" type="hidden" value="" readonly>
                                </div>
                            </div>
                            <div class="col-sm-10 col-sm-offset-2 img-preview">

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.map')}}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="map" id="map" value="{{ old('map') }}"/>
                                <span class="help-block"><i>{{trans('real-estate.formCreateLabel.mapHelpBlock')}}</i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <div id="map-view" style="width: 100%; height: 250px;"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.detail')}} <span class="text-red">*</span> </label>
                            <div class="col-sm-10">
                                <textarea name="detail" class="form-control" id="editor">{!! old('detail') !!}
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.source')}}</label>

                            <div class="col-sm-2">
                                <select class="form-control" id="range-price" name="source" value="{{ old('source') }}">
                                    <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                    @foreach($reSources as $reSource)
                                        <option value="{{$reSource->id}}">{{$reSource->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.isPrivate')}}</label>

                            <div class="col-sm-2">
                                <select class="form-control" id="is-private" name="is_private" value="{{ old('is_private') }}">
                                    <option value="1">{{ trans('real-estate.isPrivateSelectText.public') }}</option>
                                    <option value="2">{{ trans('real-estate.isPrivateSelectText.private') }}</option>
                                    <option value="3">{{ trans('real-estate.isPrivateSelectText.privateInOwnWebsite') }}</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="reset" class="btn btn-default">{{trans('system.cancel')}}</button>
                            <button type="submit" class="btn btn-info pull-right">{{trans('system.submit')}}</button>
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
                                    <iframe width="100%" height="400" src="/plugins/filemanager/dialog.php?type=2&amp;field_id=images'&amp;fldr=" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')
    {{--<script src="/vendor/laravel-filemanager/js/lfm.js"></script>--}}
    <script src="{{asset('plugins/ckeditor-4/ckeditor.js')}}"></script>
    <script>
        $(function() {
            // init datetime picker
            $('#post-date').datetimepicker({
                defaultDate: moment.now()
            });
            $('#expire-date').datetimepicker({
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

            var options = {
                filebrowserBrowseUrl : '/plugins/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
                filebrowserUploadUrl : '/plugins/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
                filebrowserImageBrowseUrl : '/plugins/filemanager/dialog.php?type=1&editor=ckeditor&fldr='
            };
            CKEDITOR.replace('editor', options);

            let totalShortDesLetter = 150;
            
            $('#short-description').keyup(function() {
                let txtLength = $(this).val().length;
                $('#count-short-des').text(totalShortDesLetter - txtLength);
            });
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
                            html += '<option value="'+ r.id +'">' + r.name + '</option>';
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
                            html += '<option value="'+ r.id +'">' + r.name + '</option>';
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
                            html += '<option value="'+ r.id +'">' + r.name + '</option>';
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
                            html += '<option value="'+ r.id +'">' + r.name + '</option>';
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
                            html += '<option value="'+ r.id +'">' + r.name + '</option>';
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
                            html += '<option value="'+ r.id +'">' + r.name + '</option>';
                        }
                    }
                    if (html) {
                        $('#street').html(html);
                    }
                }
            });
        }
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
    </script>
@endsection