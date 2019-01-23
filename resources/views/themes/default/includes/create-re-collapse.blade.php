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
    <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.province')}} </label>
    <div class="col-sm-4">
        <select class="form-control" id="province" name="province_id" onchange="changeProvince(this)"
                value="{{ old('province_id') }}">
            <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
            @foreach($provinces as $province)
                <option value="{{$province->id}}" {{auth()->user() && auth()->user()->userinfo->province_id == $province->id ? 'selected' : ''}}>{{$province->name}}</option>
            @endforeach
        </select>
        <p class="text-red error"></p>
    </div>
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
        <input type="text" class="form-control" id="street" name="street_id">
        <p class="text-red error"></p>
    </div>
</div>
<div class="form-group collapse collapse1" id="contactInfo">
    <div class="row form-group">
        <div class="col-xs-12">
            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.contactPhone')}}</label>
            <div class="col-sm-4">
                <input type="tel" class="form-control" id="contact_phone_number" name="contact_phone_number" value="{{ old('contact_phone_number') ? old('contact_phone_number') : auth()->user()->userinfo->phone }}">
            </div>
            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.contactPerson')}}</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="contact_person" name="contact_person" value="{{ old('contact_person') ? old('contact_person') : auth()->user()->userinfo->full_name }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.contactAddress')}}</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="contact_address" name="contact_address" value="{{ old('contact_address') ? old('contact_address') : auth()->user()->userinfo->address }}">
            </div>
        </div>
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
            $('#contact_phone_number').keyup(function() {
                emptyContactInfo();

                let phone = $(this).val();
                if (phone.length > 9) {
                    $.ajax({
                        url: "/customer-by-phone/" + phone,
                        method: 'GET',
                        success: function (result) {
                            console.log('success');
                            console.log(result);
                            if (!jQuery.isEmptyObject(result)) {
                                $('#contact_person').val(result.name);
                                $('#contact_address').val(result.address);
                            } else {
                                emptyContactInfo();
                            }
                        }
                    });
                }
            });
            function emptyContactInfo() {
                $('#contact_person').val('');
                $('#contact_address').val('');
            }
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
        });

        function changeReCategory(e) {
            console.log($(e).val());
            let catId = $(e).val();

            showLoader();
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
                    hideLoader();
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
            showLoader();
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
                    hideLoader();
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
            showLoader();
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
                    hideLoader();
                }
            });
        }

        function changeWard(e) {
            console.log($(e).val());
            let wardId = $(e).val();
            showLoader();
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
                    hideLoader();
                }
            });
        }

    </script>
@endpush
