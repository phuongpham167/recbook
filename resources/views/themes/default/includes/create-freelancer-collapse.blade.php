<div class="form-group collapse collapse1" id="catSelect">
    <div class="row">
        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.reCategory')}}</label>
        <div class="col-sm-4">
            <select class="form-control" id="re-category" name="category_id" onchange="changeReCategory(this)"
                    value="{{ old('re_category_id') }}">
                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                @foreach(\App\FLCategory::all() as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
            <p class="text-red error"></p>
        </div>
        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.reType')}}</label>
        <div class="col-sm-4">
            <select class="form-control" id="re-type" name="re_type_id" value="{{ old('re_type_id') }}">
                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                @foreach(\App\ReType::all() as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
            <p class="text-red error"></p>
        </div>
    </div>
</div>
<div class="form-group collapse collapse1" id="addressSelect">
    <div class="row">
        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.province')}} </label>
        <div class="col-sm-4">
            <select class="form-control" id="province" name="province_id" value="{{ old('province_id') }}"
                    onchange="changeProvince(this)">
                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                @foreach(\App\Province::all() as $d)
                    <option value="{{$d->id}}">{{$d->name}}</option>
                @endforeach
            </select>
            <p class="text-red error"></p>
        </div>
        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.district')}} </label>
        <div class="col-sm-4">
            <select class="form-control" id="district" name="district_id" onchange="changeDistrict(this)"
                    value="{{ old('district_id') }}">
                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                @foreach(\App\Province::all() as $d)
                    <option value="{{$d->id}}">{{$d->name}}</option>
                @endforeach
            </select>
            <p class="text-red error"></p>
        </div>
    </div>
    <div class="row">
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
</div>
<div class="form-group collapse collapse1" id="time">
    <div class="row">
        <label class="col-sm-2 control-label">{{trans('freelancer.finish_at')}}</label>
        <div class="col-sm-4">
            <input type="text" class="form-control datepicker" name="finish_at" id="finish_at"
                   value="{{request('finish_at', \Carbon\Carbon::now()->format('d/m/Y'))}}"
                   placeholder="Ngày cần hoàn thành">
        </div>
        <label class="col-sm-2 control-label">{{trans('freelancer.end_at')}}</label>
        <div class="col-sm-4">
            <input type="text" class="form-control datepicker" name="end_at" id="end_at"
                   value="{{request('end_at', \Carbon\Carbon::now()->format('d/m/Y'))}}"
                   placeholder="Ngày kết thúc">
        </div>
    </div>
</div>
<div class="form-group collapse collapse1" id="construction_type">
    <div class="row">
    <label class="col-sm-2 control-label">{{trans('freelancer.construction_type')}} </label>
    <div class="col-sm-4">
        <select class="form-control" id="construction_type" name="construction_type" value="{{ old('construction_type') }}">
            <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
            @foreach(\App\ConstructionType::all() as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>
        <p class="text-red error"></p>
    </div>
    </div>
</div>
<div class="form-group collapse collapse1" id="directionSelect">
    <div class="row">
        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.direction')}} </label>
        <div class="col-sm-4">
            <select class="form-control" id="direction" name="direction_id" value="{{ old('direction_id') }}">
                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                @foreach(\App\Direction::all() as $direction)
                    <option value="{{$direction->id}}">{{$direction->name}}</option>
                @endforeach
            </select>
            <p class="text-red error"></p>
        </div>
    </div>
</div>
<div class="form-group collapse collapse1" id="budget">
    <div class="row">
        <label class="col-sm-2 control-label">{{trans('freelancer.budget')}}</label>

        <div class="col-sm-4">
            <input type="number" class="form-control" name="budget" value="{{ old('budget') }}"/>
        </div>
    </div>
</div>
<div class="form-group collapse collapse1" id="note">
    <div class="row">
        <label class="col-sm-2 control-label">{{trans('freelancer.note')}}</label>

        <div class="col-sm-4">
            <textarea class="form-control" name="note" rows="3"></textarea>
        </div>
    </div>
</div>
<div class="form-group collapse collapse1" id="room">
    <div class="row">
        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.bedroom')}}</label>

        <div class="col-sm-4">
            <input type="number" class="form-control" name="bedroom" value="{{ old('bedroom') }}"/>
        </div>
    </div>
</div>
<div class="form-group collapse collapse1" id="area">
    <div class="row">
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
</div>
<div class="form-group collapse collapse1" id="floorSelect">
    <div class="row">
    <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.floor')}}</label>

    <div class="col-sm-4">
        <input type="number" class="form-control" name="floor" value="{{ old('floor') }}"/>
    </div>
    </div>
</div>
<div class="form-group collapse collapse1" id="address">
    <div class="row">
        <label class="col-sm-2 control-label">{{trans('freelancer.address')}}</label>

        <div class="col-sm-10">
            <input type="address" class="form-control" name="address" value="{{ old('address') }}"/>
        </div>
    </div>
</div>
<div class="form-group collapse collapse1" id="measurements">
    <div class="row">
        <label class="col-sm-2 control-label">{{trans('freelancer.width')}}</label>

        <div class="col-sm-4">
            <input type="number" class="form-control" name="width" value="{{ old('width') }}"/>
        </div>

        <label class="col-sm-2 control-label">{{trans('freelancer.length')}}</label>

        <div class="col-sm-4">
            <input type="number" class="form-control" name="length" value="{{ old('length') }}"/>
        </div>
    </div>
</div>
<div class="form-group collapse collapse1" id="short_description">
    <div class="row">
        <label class="col-sm-2 control-label">{{trans('freelancer.short_description')}}</label>

        <div class="col-sm-4">
            <textarea class="form-control" name="short_description" rows="3"></textarea>
        </div>
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

    </script>
@endpush
