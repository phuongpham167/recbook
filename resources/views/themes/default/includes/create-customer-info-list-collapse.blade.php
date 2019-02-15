@push('style')
    <link rel="stylesheet" href="{{ asset('css/manage-real-estate.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/user-info.css') }}"/>
    <link rel="stylesheet" href="{{asset('plugins/loopj-jquery-tokeninput/styles/token-input.css')}}" />
    <link rel="stylesheet" href="{{asset('plugins/loopj-jquery-tokeninput/styles/token-input-bootstrap3.css')}}" />
    <style type="text/css">
        .token-input-dropdown-bootstrap3 {
            z-index: 11001 !important;
        }
        .token-input-dropdown-bootstrap {
            z-index: 11001 !important;
        }
    </style>
@endpush
<div id="modalAddCustomerInfoList" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Sửa tin</h4>
            </div>
            <div class="modal-body clearfix">
                <div class="form-add-cil">
                    <div class="form-group clearfix">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.title')}} <span
                                class="text-red">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title-edit" id="title"/>
                            <p class="text-red error"></p>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.detail')}} <span
                                class="text-red">*</span>
                        </label>
                        <div class="col-sm-10">
                                <textarea name="detail-edit" class="form-control autoExpand" rows="3"
                                          id="detail"></textarea>
                            <p class="text-red error"></p>
                        </div>
                    </div>
                    <div class="form-group collapse clearfix" id="catSelect">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.reCategory')}}</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="re-category" name="re_category_id"
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
                            <select class="form-control" id="loai-bds" name="loai_bds" value="{{ old('loai_bds') }}" onChange="changeLoaiBDS(this)">
                                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                <option value="1">Thổ cư</option>
                                <option value="2">Dự án</option>
                            </select>
                            <p class="text-red error"></p>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 hidden" id="thocu-select-wrap">
                                <label class="col-sm-2 control-label">Thổ cư</label>
                                <div class="col-sm-4" id="thocu-select">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 hidden" id="duan-select-wrap">
                                <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.project')}}</label>
                                <div class="col-sm-4" id="duan-select">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group collapse collapse1 clearfix" id="addressSelect">
                        <div class="form-group row">
                            <div class="col-xs-12">
                                <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.province')}} </label>
                                <div class="col-sm-4">
                                    <select class="form-control" id="province" name="province_id" onchange="changeProvince(this)"
                                            value="{{ old('province_id') }}">
                                        <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                        @foreach($provinces as $province)
                                            <option value="{{$province->id}}">{{$province->name}}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-red error"></p>
                                </div>
                                <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.district')}} </label>
                                <div class="col-sm-4">
                                    <select class="form-control" id="district" name="district_id" onchange="changeDistrict(this)"
                                            value="{{ old('district_id') }}">
                                        <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                    </select>
                                    <p class="text-red error"></p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-12">
                                <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.ward')}} </label>
                                <div class="col-sm-4">
                                    <select class="form-control" id="ward" name="ward_id" value="{{ old('ward_id') }}">
                                        <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                    </select>
                                    <p class="text-red error"></p>
                                </div>
                                <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.street')}} </label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="street" name="street_id" autocomplete="off">
                                    <p class="text-red error"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group collapse collapse1 clearfix" id="contactInfo">
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.contactPhone')}}</label>
                                <div class="col-sm-4">
                                    <input type="tel" class="form-control" id="contact_phone_number" name="contact_phone_number" value="{{$customer->phone}}">
                                </div>
                                <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.contactPerson')}}</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="contact_person" name="contact_person" value="{{$customer->name}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.contactAddress')}}</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="contact_address" name="contact_address" value="{{$customer->address}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group collapse collapse1 clearfix" id="nearBy">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.position')}}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="position" name="position" value="{{ old('position') }}" placeholder="VD: gần chợ 200m,"/>
                        </div>
                    </div>
                    <div class="form-group collapse collapse1 clearfix" id="directionSelect">

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
                    <div class="form-group collapse collapse1 clearfix" id="exhibitSelect">
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
                    <div class="form-group collapse collapse1 clearfix" id="room">
                        <div class="row">
                            <div class="col-xs-12">
                                <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.bedroom')}}</label>

                                <div class="col-sm-4">
                                    <input type="number" class="form-control" id="bedroom" name="bedroom" value="{{ old('bedroom') }}"/>
                                </div>
                                <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.living_room')}}</label>

                                <div class="col-sm-4">
                                    <input type="number" class="form-control" id="living-room" name="living_room" value="{{ old('living_room') }}"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.wc')}}</label>

                                <div class="col-sm-4">
                                    <input type="number" class="form-control" id="wc" name="wc" value="{{ old('wc') }}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group collapse collapse1 clearfix" id="area">

                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.areaOfPremises')}} </label>

                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="area-of-premises" name="area_of_premises" value="{{ old('area_of_premises') }}" step="0.01"/>
                            <p class="text-red error"></p>
                        </div>
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.areaOfUse')}}</label>

                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="area-of-use" name="area_of_use" value="{{ old('area_of_use') }}" step="0.01"/>
                        </div>

                    </div>
                    <div class="form-group collapse collapse1 clearfix" id="mattien">

                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.width')}} </label>

                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="width" name="width" value="{{ old('width') }}"/>
                            <p class="text-red error"></p>
                        </div>
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.length')}}</label>

                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="length" name="length" value="{{ old('length') }}"/>
                        </div>

                    </div>
                    <div class="form-group collapse collapse1 clearfix" id="floorSelect">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.floor')}}</label>

                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="floor" name="floor" value="{{ old('floor') }}"/>
                        </div>
                    </div>
                    <div class="form-group collapse collapse1 clearfix" id="priceSelect">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.price')}}</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}"/>
                            <span id="price_format"></span>
                        </div>
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.don_vi')}}</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="don-vi" name="don_vi" value="{{ old('don_vi') }}"/>
                        </div>
                        <div class="col-sm-10 col-sm-offset-2">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="is-deal" name="is_deal" {{ old('is_deal') == 'on' ? 'checked' : '' }}>
                                    {{trans('real-estate.formCreateLabel.isDeal')}}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group collapse collapse1 clearfix" id="mapSelect">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.map')}}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="map" id="map" value="{{ old('map') }}" readonly/>
                            <span class="help-block"><i>{{trans('real-estate.formCreateLabel.mapHelpBlock')}}</i></span>
                        </div>
                        <div class="col-sm-12">
                            <div id="map-view" style="width: 100%; height: 250px;"></div>
                        </div>
                    </div>
                    <div class="form-group collapse collapse1 clearfix" id="imageSelect">
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
                    <div class="form-group clearfix">
                        <div class="col-xs-12">
                            <button type="button" class="btn btn-default btn-collapse" data-target="#addressSelect">
                                <i class="fa fa-road" aria-hidden="true"></i> Khu vực
                            </button>
                            <button type="button" class="btn btn-default btn-collapse" data-target="#catSelect">Danh
                                mục
                            </button>

                            <button type="button" class="btn btn-default btn-collapse" data-target="#priceSelect">
                                Giá
                            </button>
                            <button type="button" class="btn btn-default btn-collapse hidden" data-target="#contactInfo">Liên hệ
                            </button>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-xs-12">
                            <button type="button" class="btn btn-default btn-collapse" data-target="#nearBy">Gần
                            </button>
                            <button type="button" class="btn btn-default btn-collapse"
                                    data-target="#directionSelect">Hướng
                            </button>
                            <button type="button" class="btn btn-default btn-collapse" data-target="#exhibitSelect">
                                Giấy tờ
                            </button>
                            {{--<button type="button" class="btn btn-default btn-collapse" data-target="#projectSelectEdit">--}}
                            {{--Dự án--}}
                            {{--</button>--}}
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-xs-12">
                            <button type="button" class="btn btn-default btn-collapse" data-target="#room"><i
                                    class="fa fa-bed" aria-hidden="true"></i> Phòng
                            </button>
                            <button type="button" class="btn btn-default btn-collapse" data-target="#area"><i
                                    class="fa fa-area-chart" aria-hidden="true"></i> Diện tích
                            </button>
                            <button type="button" class="btn btn-default btn-collapse" data-target="#mattien"> Mặt tiền
                            </button>
                            <button type="button" class="btn btn-default btn-collapse" data-target="#floorSelect">Số
                                tầng
                            </button>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-xs-12">
                            <button type="button" class="btn btn-default btn-collapse" data-target="#mapSelect"><i
                                    class="fa fa-map-marker"></i> Vị ví
                            </button>
                            <button type="button" class="btn btn-default btn-collapse" data-target="#imageSelect"><i
                                    class="fa fa-picture-o"></i> Hình ảnh
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer clearfix">
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                <button type="button" name="add_cil" id="add-cil" onclick="addCustomerInfoList(this)" class="_btn bg_red"><i
                        class="fa fa-save"></i> &nbsp;&nbsp;Lưu
                </button>
            </div>
        </div>
    </div>
</div>

@push('js')
    {{--<script src="{{asset('plugins/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js')}}"></script>--}}
    <script src="{{asset('plugins/ckeditor-4/ckeditor.js')}}"></script>
    <script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{asset('plugins/loopj-jquery-tokeninput/src/jquery.tokeninput.js')}}"></script>
    <script>
        function initMap() {
            let uLat = '{{auth()->user()->userinfo->province->lat}}';
            let uLong = '{{auth()->user()->userinfo->province->long}}';
            var myLatLng = {lat: parseFloat(uLat), lng: parseFloat(uLong)};

            var map = new google.maps.Map(document.getElementById('map-view'), {
                zoom: 10,
                center: myLatLng
            });

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                draggable:true,
                title: 'Hello World!'
            });
            // marker.addListener('drag', handleEvent);
            marker.addListener('dragend', handleEvent);
        }
        function handleEvent(event) {
            // console.log(event.latLng.lat());
            // console.log(event.latLng.lng());
            $('#map').val(event.latLng.lat() + ',' + event.latLng.lng());
        }
        $('#street').tokenInput(function(){
            return "{{asset('/ajax/street')}}?province_id="+$("#province").val()+"&district_id="+$("#district").val()+"&ward_id="+$("#ward").val();
        }, {
            theme: "bootstrap",
            queryParam: "term",
            zindex  :   1005,
            tokenLimit  :   1,
            onAdd   :   function(r){
                $('#method').val(r.method);
            }
        });

        $(document)
            .one('focus.autoExpand', 'textarea.autoExpand', function () {
                var savedValue = this.value;
                this.value = '';
                this.baseScrollHeight = this.scrollHeight;
                this.value = savedValue;
            })
            .on('input.autoExpand', 'textarea.autoExpand', function () {
                var minRows = this.getAttribute('data-min-rows') | 0, rows;
                this.rows = minRows;
                rows = Math.ceil((this.scrollHeight - this.baseScrollHeight) / 16);
                this.rows = minRows + rows;
            });
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
                // console.log(targetId);
                let has = $(targetId).hasClass('in') ? 'yes' : 'no';
                // console.log(has);
                if ($(targetId).hasClass('in')) {
                    // console.log('opening');
                    $('.form-add-cil .collapse').collapse('hide');
                } else {
                    // console.log('close');
                    $('.form-add-cil .collapse').collapse('hide');
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
                        $('.form-add-cil #re-type').html(html);
                    }
                    hideLoader();
                }
            });
        }

        function changeLoaiBDS(e) {
            if ( !$('#thocu-select-wrap').hasClass('hidden') ) {
                $('#thocu-select-wrap').addClass('hidden');
            }
            $('#thocu-select').html('');

            if ( !$('#duan-select-wrap').hasClass('hidden') ) {
                $('#duan-select-wrap').addClass('hidden');
            }
            $('#duan-select').html('');

            console.log($(e).val());
            let loaiBDS = $(e).val();



            if (loaiBDS == 1) {
                showLoader();
                $.ajax({
                    url: "/re-type/list-dropdown",
                    method: 'GET',
                    success: function (result) {
                        console.log('success');
                        console.log(result);
                        let html = '<select class="form-control" name="re_type_id" id="re-type">';
                        if (result) {
                            for (let r of result) {
                                html += '<option value="' + r.id + '">' + r.name + '</option>';
                            }
                        }
                        html += '</select>';
                        if (html) {
                            $('#thocu-select-wrap').removeClass('hidden');
                            $('#thocu-select').html(html);
                        }
                    }
                });
            } else if (loaiBDS == 2) {
                let provinceId = $('.form-add-cil #province').val();
                if (!provinceId) {
                    provinceId = '{{auth()->user()->userinfo->province_id}}';
                }
                provinceId = parseInt(provinceId);
                showLoader();
                $.ajax({
                    url: '/project-by-province/' + provinceId,
                    method: 'GET',
                    success: function (result) {
                        console.log('success');
                        console.log(result);
                        let html = '' +
                            '<select class="form-control" name="project_id" id="project">';
                        if (result) {
                            for (let r of result) {
                                html += '<option value="' + r.id + '">' + r.name + '</option>';
                            }
                        }
                        html += '</select>';
                        if (html) {
                            $('#duan-select-wrap').removeClass('hidden');
                            $('#duan-select').html(html);
                        }
                    }
                });
            }
            hideLoader();
        }

        function changeProvince(e) {
            console.log($(e).val());
            let provinceId = $(e).val();
            if (!provinceId) {
                $('.form-add-cil #district').html('<option value="">{{trans('real-estate.selectFirstOpt')}}</option>');
                $('.form-add-cil #ward').html('<option value="">{{trans('real-estate.selectFirstOpt')}}</option>');
                return;
            }
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
                        $('.form-add-cil #district').html(html);
                    }
                    hideLoader();
                }
            });


        }

        function changeDistrict(e) {
            console.log($(e).val());
            let districtId = $(e).val();
            if (!districtId) {
                $('.form-add-cil #ward').html('<option value="">{{trans('real-estate.selectFirstOpt')}}</option>');
                return;
            }
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
                        $('.form-add-cil #ward').html(html);
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
                        $('.form-add-cil #street').html(html);
                    }
                    hideLoader();
                }
            });
        }

        /*---------------- handle upload images  re -----------------*/
        const root = location.protocol + '//' + location.host;
        $('#choose-image').click(function (event) {
            $('#images').click();
        });
        $('#images').on('change', function () {
            var i = 0, len = this.files.length, reader, file;
            for (; i < len; i++) {
                file = this.files[i];
                if (!!file.type.match(/image.*/)) {
                    reader = new FileReader();
                    reader.onloadend = function (e) {
                        showSelectedImg(e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        function showSelectedImg(src) {
            const htmlMarkup = '<div class="col-xs-4 item-img-preview"><img src="' + src + '" class="img-responsive"/>'
                + '<div class=""><input type="hidden" name="images[]" value="' + src + '" class="form-control" />'
                + '<label>{{ trans("real-estate.formCreateLabel.alt-text") }}</label>'
                + '<input type="text" name="alt[]" class="form-control" /></div>'
                + '<a class="img-preview-btn-remove" onclick="removeImgPreview(this)"><i class="fa fa-trash" aria-hidden="true"></i></a>'
                + '</div>';
            $('.img-preview').append(htmlMarkup);
        }
        function removeImgPreview(e) {
            $(e).closest('.item-img-preview').remove();
        }


        /*---------------- end handle upload images  re -----------------*/

        function addCustomerInfoList(e) {
            console.log('here');
            let formDataAdd = new FormData();
            let title = $('.form-add-cil #title').val();
            let detail = $('.form-add-cil #detail').val();

            if (!title || !detail) {
                if (!title) {
                    console.log('title empty');
                    $('.form-add-cil #title').parent().find('.error').html('Nhập tiêu đề tin');
                } else {
                    $('.form-add-cil #title').parent().find('.error').html('');
                }

                if (!detail) {
                    console.log('detail empty');
                    $('.form-add-cil textarea#detail').parent().find('.error').html('Nhập nội dung chi tiết');
                } else {
                    $('.form-add-cil textarea#detail').parent().find('.error').html('');
                }

                return;
            }
            console.log('here1');

            let reCatId = $('.form-add-cil #re-category').val();

            let loaiBDS = $('.form-add-cil #loai-bds').val();

            let reTypeId = $('.form-add-cil #re-type').length ? $('.form-add-cil #re-type').val() : '';

            let provinceId = $('.form-add-cil #province').val();

            let districtId = $('.form-add-cil #district').val();

            let wardId = $('.form-add-cil #ward').val();

            let streetId = $('.form-add-cil #street').val();

            let contactPhone = $('.form-add-cil #contact_phone_number').val();
            let contactPerson = $('.form-add-cil #contact_person').val();
            let contactAddress = $('.form-add-cil #contact_address').val();

            let position = $('.form-add-cil #position').val();

            let directionId = $('.form-add-cil #direction').val();

            let exhibitId = $('.form-add-cil #exhibit').val();

            let projectId = $('.form-add-cil #project').length ? $('.form-add-cil #project').val() : '';

            let bedroom = $('.form-add-cil #bedroom').val();

            let livingroom = $('.form-add-cil #living-room').val();

            let wc = $('.form-add-cil #wc').val();

            let aop = $('.form-add-cil #area-of-premises').val();

            let aou = $('.form-add-cil #area-of-use').val();

            let width = $('.form-add-cil #width').val();

            let length = $('.form-add-cil #length').val();

            let floor = $('.form-add-cil #floor').val();

            let price = $('.form-add-cil #price').val();

            let donvi = $('.form-add-cil #don-vi').val();

            let isDeal = $('.form-add-cil #is-deal').is(":checked") ? 1 : 0;

            let map = $('.form-add-cil #map').val();

            let isPrivate = $('.form-add-cil #is-private').val();

            $("input[name='images[]']")
                .each(function(){
                    formDataAdd.append('images[]', $(this).val());
                });
            $("input[name='alt[]']")
                .each(function(){
                    formDataAdd.append('alt[]', $(this).val());
                });
            formDataAdd.append('title', title);
            formDataAdd.append('detail', detail);
            formDataAdd.append('re_category_id', reCatId);
            formDataAdd.append('loai_bds', loaiBDS);
            if (reTypeId) {
                formDataAdd.append('re_type_id', reTypeId);
            }
            formDataAdd.append('province_id', provinceId);
            formDataAdd.append('district_id', districtId);
            formDataAdd.append('ward_id', wardId);
            formDataAdd.append('street_id', streetId);
            formDataAdd.append('contact_person', contactPerson);
            formDataAdd.append('contact_phone_number', contactPhone);
            formDataAdd.append('contact_address', contactAddress);
            formDataAdd.append('position', position);
            formDataAdd.append('direction_id', directionId);
            formDataAdd.append('exhibit_id', exhibitId);
            if (projectId) {
                formDataAdd.append('project_id', projectId);
            }
            formDataAdd.append('bedroom', bedroom);
            formDataAdd.append('living_room', livingroom);
            formDataAdd.append('wc', wc);
            formDataAdd.append('area_of_premises', aop);
            formDataAdd.append('area_of_use', aou);
            formDataAdd.append('width', width);
            formDataAdd.append('length', length);
            formDataAdd.append('floor', floor);
            formDataAdd.append('price', price);
            formDataAdd.append('don_vi', donvi);
            formDataAdd.append('is_deal', isDeal);
            formDataAdd.append('map', map);
            formDataAdd.append('is_private', 1);

            console.log(formDataAdd);
            // return;

            showLoader();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            });
            $.ajax({
                url: '/ajax/add-cil',
                type: 'POST',
                data: formDataAdd,
                processData: false,
                contentType: false,
                success: function (res) {
                    // console.log('success change cover');
                    // console.log(res);
                    if (res.success) {
                        toastr.success(res.message);
                        $('#modalAddCustomerInfoList').modal('hide');
                        resetValueModal();
                        setTimeout(function(){
                            window.location.reload();
                        }, 300);
                    } else {
                        toastr.error(res.message);
                    }
                    hideLoader();
                },
                error: function (err) {
                    // console.log('err change cover');
                    // console.log(err);
                    err.message.each(mes => {
                        toastr.error(mes);
                    });
                    // toastr.error(err.message);
                }
            });
        }
        function resetValueModal() {
            $('.form-add-cil #title').val('');
            $('.form-add-cil #detail').val('');

            $('.form-add-cil #re-category').val('');

            $('.form-add-cil #loai-bds').val('');

            $('.form-add-cil #province').val('');

            $('.form-add-cil #district').val('');

            $('.form-add-cil #ward').val('');

            $('.form-add-cil #street').val('');

            $('.form-add-cil #street-id-hidden').val('');

            $('.form-add-cil #street-name-hidden').val('');

            $('.form-add-cil #contact_person').val('');
            $('.form-add-cil #contact_phone_number').val('');
            $('.form-add-cil #contact_address').val('');

            $('.form-add-cil #position').val('');

            $('.form-add-cil #direction').val('');

            $('.form-add-cil #exhibit').val('');

            $('.form-add-cil #bedroom').val('');

            $('.form-add-cil #living-room').val('');

            $('.form-add-cil #wc').val('');

            $('.form-add-cil #area-of-premises').val('');

            $('.form-add-cil #area-of-use').val('');

            $('.form-add-cil #width').val('');

            $('.form-add-cil #length').val('');

            $('.form-add-cil #floor').val('');

            $('.form-add-cil #price').val('');

            $('.form-add-cil #don-vi').val('');

            $('.form-add-cil #is-deal').prop('checked', false);

            $('.form-add-cil #map').val('');
        }

    </script>
    <script type="text/javascript" src='https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyAxgnRkMsWPSqlxOz_kLga0hJ4eG2l0Vmo&callback=initMap'></script>
@endpush
