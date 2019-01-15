<div class="form-group collapse collapse1" id="catSelect">
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
<div class="form-group collapse collapse1" id="addressSelect">
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
<div class="form-group collapse collapse1" id="nearBy">
    <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.position')}}</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" name="position" value="{{ old('position') }}" placeholder="VD: gần chợ 200m,"/>
    </div>
</div>
<div class="form-group collapse collapse1" id="directionSelect">

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
<div class="form-group collapse collapse1" id="exhibitSelect">
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
<div class="form-group collapse collapse1" id="projectSelect">

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
</div>
<div class="form-group collapse collapse1" id="room">
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
<div class="form-group collapse collapse1" id="area">

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
<div class="form-group collapse collapse1" id="floorSelect">
    <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.floor')}}</label>

    <div class="col-sm-4">
        <input type="number" class="form-control" name="floor" value="{{ old('floor') }}"/>
    </div>
</div>
<div class="form-group collapse collapse1" id="priceSelect">
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
<div class="form-group collapse collapse1" id="mapSelect">
    <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.map')}}</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" name="map" id="map" value="{{ old('map') }}"/>
        <span class="help-block"><i>{{trans('real-estate.formCreateLabel.mapHelpBlock')}}</i></span>
    </div>
    <div class="col-sm-12">
        <div id="map-view" style="width: 100%; height: 250px;"></div>
    </div>
</div>
<div class="form-group collapse collapse1" id="imageSelect">
    <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.image')}}</label>
    <div class="col-sm-10">
            <button class="btn btn-primary" type="button" id="choose-image">
                <i class="fa fa-picture-o"></i> Choose
            </button>
            <input id="images" class="form-control hidden" name="imagesList[]" type="file" multiple="multiple">
    </div>
    <div class="col-sm-12 img-preview">

    </div>
</div>

@push('js')
    {{--<script src="{{asset('plugins/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js')}}"></script>--}}
    <script src="{{asset('plugins/ckeditor-4/ckeditor.js')}}"></script>
    <script>
        $(function () {
            //------------------------------------------------------------
            // COLLAPSE CONTENT
            //------------------------------------------------------------
            $('.btn-collapse').on('click', function () {
                let targetId = $(this).data('target');
                console.log(targetId);
                let has = $(targetId).hasClass('in') ? 'yes' : 'no';
                console.log(has);
                if($(targetId).hasClass('in')) {
                    console.log('opening');
                    $('.form-create-re .collapse.collapse1').collapse('hide');
                } else {
                    console.log('close');
                    $('.form-create-re .collapse.collapse1').collapse('hide');
                    $(targetId).collapse('show');
                }
            });
            //------------------------------------------------------------
            // END COLLAPSE CONTENT
            //------------------------------------------------------------

            // init datetime picker
            // $('#post-date').datetimepicker({
            //     format: 'YYYY-MM-DD HH:mm:ss',
            //     defaultDate: moment.now()
            // });
            // $('#expire-date').datetimepicker({
            //     format: 'YYYY-MM-DD',
            //     useCurrent: false
            // });
            // $("#post-date").on("dp.change", function (e) {
            //     $('#expire-date').data("DateTimePicker").minDate(e.date);
            // });
            // $("#expire-date").on("dp.change", function (e) {
            //     $('#post-date').data("DateTimePicker").maxDate(e.date);
            // });

            // var domain = "";
            // $('#lfm').filemanager('image', {prefix: domain});

            // $('#map-view').locationpicker({
            //     location: {
            //         latitude: 10.774839,
            //         longitude: 106.700766
            //     },
            //     radius: 0,
            //     onchanged: function (currentLocation, radius, isMarkerDropped) {
            //         console.log("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
            //         $('#map').val(currentLocation.latitude + ", " + currentLocation.longitude);
            //     }
            // });

            // var options = {
            //     filebrowserBrowseUrl: '/plugins/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
            //     filebrowserUploadUrl: '/plugins/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
            //     filebrowserImageBrowseUrl: '/plugins/filemanager/dialog.php?type=1&editor=ckeditor&fldr='
            // };
            // CKEDITOR.replace('editor', options);

            // let totalShortDesLetter = 150;

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

        //---------------------------------
        // HANDLE WHEN CLICK BUTTON CHOOSE IMAGE
        //---------------------------------
        // $("#choose-image").unbind("click").bind("click", function () {
        //     $("#images").click();
        // });
        // function readURL(input) {
        //     console.log('list select images');
        //     console.log(input.files);
        //     // if (input.files && input.files[0]) {
        //     //     var reader = new FileReader();
        //     //
        //     //     reader.onload = function(e) {
        //     //         $('#blah').attr('src', e.target.result);
        //     //     }
        //     //
        //     //     reader.readAsDataURL(input.files[0]);
        //     // }
        // }
        //
        // $("#images").change(function() {
        //     readURL(this);
        // });
        //---------------------------------
        // END HANDLE WHEN CLICK BUTTON CHOOSE IMAGE
        //---------------------------------

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
