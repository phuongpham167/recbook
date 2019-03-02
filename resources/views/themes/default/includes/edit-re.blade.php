{{--modal edit re--}}
<div id="modalEditRe" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Sửa tin</h4>
            </div>
            <div class="modal-body clearfix">
                <div class="form-edit-re">
                    <input type="hidden" name="id_edit" id="id-edit"/>
                    <div class="form-group clearfix">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.title')}} <span
                                class="text-red">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title-edit" id="title-edit"/>
                            <p class="text-red error"></p>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.detail')}} <span
                                class="text-red">*</span>
                        </label>
                        <div class="col-sm-10">
                            <textarea name="detail-edit" class="form-control autoExpand" rows="3"
                                      id="detail-edit"></textarea>
                            <p class="text-red error"></p>
                        </div>
                        <div class="row">
                            <div class="col-sm-7" style="padding-top: 4px"><strong> Bạn còn <span id="edit_public_left">{{post_left(auth()->user())}}</span> lượt tin đăng trên trang cộng đồng.  </strong></div>
                            <div class="col-sm-5">
                                <input type="checkbox" name="edit_public_site" value="1"> Đăng lên trang cộng đồng
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="form-group clearfix collapse" id="contactInfoEdit">
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.contactPerson')}}</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="contact_person" id="contact-person-edit">
                                </div>

                                <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.contactPhone')}}</label>
                                <div class="col-sm-4">
                                    <input type="tel" class="form-control" name="contact_phone_number" id="contact-phone-edit">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.contactAddress')}}</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="contact_address" id="contact-address-edit">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group clearfix collapse" id="addressSelectEdit">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.province')}} </label>
                        <div class="col-sm-4">
                            <select class="form-control" id="province-edit" name="province_id_edit" onchange="changeProvinceEdit(this)">
                                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                @foreach($provinces as $province)
                                    <option value="{{$province->id}}" {{auth()->user() && auth()->user()->userinfo->province_id == $province->id ? 'selected' : ''}}>{{$province->name}}</option>
                                @endforeach
                            </select>
                            <p class="text-red error"></p>
                        </div>

                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.district')}} </label>
                        <div class="col-sm-4">
                            <select class="form-control" id="district-edit" name="district_id_edit"
                                    onchange="changeDistrictEdit(this)"
                            >
                                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                            </select>
                            <p class="text-red error"></p>
                        </div>

                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.ward')}} </label>
                        <div class="col-sm-4">
                            <select class="form-control" id="ward-edit" name="ward_id_edit">
                                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                            </select>
                            <p class="text-red error"></p>
                        </div>

                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.street')}} </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="street-edit" name="street_id_edit" autocomplete="off">

                            <p class="text-red error"></p>
                        </div>
                    </div>
                    <input type="text" class="hidden" id="street-id-hidden" value=""/>
                    <input type="text" class="hidden" id="street-name-hidden" value=""/>

                    <div class="form-group clearfix collapse" id="catSelectEdit">
                        <label
                            class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.reCategory')}}</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="re-category-edit" name="re_category_id_edit"
                            >
                                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                @foreach($reCategories as $reCategory)
                                    <option value="{{$reCategory->id}}">{{$reCategory->name}}</option>
                                @endforeach
                            </select>
                            <p class="text-red error"></p>
                        </div>

                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.reType')}}</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="loai-bds-edit" name="loai_bds" onChange="changeLoaiBDSEdit(this)">
                                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                <option value="1">Thổ cư</option>
                                <option value="2">Dự án</option>
                            </select>
                            <p class="text-red error"></p>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 hidden" id="thocu-select-wrap-edit">
                                <label class="col-sm-2 control-label">Thổ cư</label>
                                <div class="col-sm-4" id="thocu-select-edit">

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 hidden" id="duan-select-wrap-edit">
                                <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.project')}}</label>
                                {{--<div class="col-sm-4" id="duan-select-edit">--}}

                                {{--</div>--}}
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="project-id-edit" name="project_id_edit" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="text" class="hidden" id="project-id-hidden" value=""/>
                    <input type="text" class="hidden" id="project-name-hidden" value=""/>

                    <div class="form-group clearfix collapse" id="areaEdit">
                        <div class="row">
                            <div class="col-xs-12">
                                <label
                                    class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.width')}} </label>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" id="width-edit"
                                           name="width_edit"/>
                                    <p class="text-red error"></p>
                                </div>

                                <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.length')}}</label>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" name="length_edit" id="length-edit"
                                    />
                                    <p class="text-red error"></p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <label
                                    class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.areaOfPremises')}} </label>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" id="area-of-premises-edit"
                                           name="area_of_premises_edit" step="0.01"/>
                                    <p class="text-red error"></p>
                                </div>

                                <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.areaOfUse')}}</label>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" name="area_of_use_edit" id="area-of-use-edit"
                                           step="0.01"/>
                                    <p class="text-red error"></p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.floor')}}</label>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" name="floor_edit" id="floor-edit"/>
                                    <p class="text-red error"></p>
                                </div>

                                <label
                                    class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.bedroom')}}</label>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" name="bedroom_edit" id="bedroom-edit"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <label
                                    class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.living_room')}}</label>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" name="living_room_edit"
                                           id="living-room-edit"/>
                                </div>

                                <label
                                    class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.wc')}}</label>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" name="wc_edit" id="wc-edit"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.block')}}</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="block-edit" name="block_id" autocomplete="off">
                                    {{--<select class="form-control" id="block-edit" name="block_id_edit">--}}
                                        {{--<option value="">{{trans('real-estate.selectFirstOpt')}}</option>--}}
                                        {{--@foreach($blocks as $block)--}}
                                            {{--<option value="{{$block->id}}">{{$block->name}}</option>--}}
                                        {{--@endforeach--}}
                                    {{--</select>--}}
                                    <p class="text-red error"></p>
                                </div>
                                <input type="text" class="hidden" id="block-id-hidden" value=""/>
                                <input type="text" class="hidden" id="block-name-hidden" value=""/>

                                <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.constructionType')}}</label>
                                <div class="col-sm-4">
                                    <select class="form-control" id="construction-type-edit" name="construction_type_id_edit"
                                            >
                                        <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                        @foreach($constructionTypes as $constructionType)
                                            <option value="{{$constructionType->id}}">{{$constructionType->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="is-deal-edit"
                                                   name="gara_edit" {{ old('gara') == 'on' ? 'checked' : '' }}>
                                            {{trans('real-estate.formCreateLabel.gara')}}
                                        </label>
                                    </div>
                                </div>

                                <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.lane_width')}}</label>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" name="width_lane_edit" id="width-lane-edit"/>
                                    <p class="text-red error"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group clearfix collapse" id="directionSelectEdit">

                        <label
                            class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.direction')}} </label>
                        <div class="col-sm-4">
                            <select class="form-control" id="direction-edit" name="direction_id_edit">
                                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                @foreach($directions as $direction)
                                    <option value="{{$direction->id}}">{{$direction->name}}</option>
                                @endforeach
                            </select>
                            <p class="text-red error"></p>
                        </div>
                    </div>

                    <div class="form-group clearfix collapse" id="exhibitSelectEdit">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.exhibit')}} </label>
                        <div class="col-sm-4">
                            <select class="form-control" id="exhibit-edit" name="exhibit_id_edit">
                                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                @foreach($exhibits as $exhibit)
                                    <option value="{{$exhibit->id}}">{{$exhibit->name}}</option>
                                @endforeach
                            </select>
                            <p class="text-red error"></p>
                        </div>
                    </div>

                    <div class="form-group clearfix collapse" id="priceSelectEdit">
                        <div class="row">
                            <div class="col-xs-12">
                                <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.price')}}</label>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" name="price_edit" id="price-edit" step="1"/>
                                    <span id="price_format_edit"></span>
                                </div>

                                <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.don_vi')}}</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="unit_id" id="don_vi_edit">
                                        <option value="1">VNĐ</option>
                                        <option value="2">USD</option>
                                        <option value="4">VNĐ/m2</option>
                                        <option value="6">USD/m2</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="is-deal-edit"
                                                   name="is_deal_edit" {{ old('is_deal') == 'on' ? 'checked' : '' }}>
                                            {{trans('real-estate.formCreateLabel.isDeal')}}
                                        </label>
                                    </div>
                                </div>

                                <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.rangePrice')}}</label>
                                <div class="col-sm-4">
                                    <select class="form-control" id="range-price-edit" name="range_price_id_edit">
                                        <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                        @foreach($rangePrices as $r)
                                            <option value="{{$r->id}}">{{$r->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group clearfix collapse" id="imageSelectEdit">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.image')}}</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                        <span class="input-group-btn">
                                            <a class="btn btn-primary" type="button" id="choose-image-edit">
                                                <i class="fa fa-picture-o"></i> Choose
                                            </a>
                                        </span>
                                <input id="images-edit" class="form-control hidden" name="imagesListEdit[]" type="file"
                                       multiple="multiple">
                            </div>
                        </div>
                        <div class="col-sm-12 img-preview-edit">

                        </div>
                    </div>

                    <div class="form-group clearfix collapse" id="linkYoutubeEdit">

                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.linkYoutube')}} </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="link-video-edit" name="link_video" placeholder=""/>
                        </div>
                    </div>

                    <div class="form-group clearfix collapse" id="mapSelectEdit">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.map')}}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="map_edit" id="map-edit" readonly/>
                            <span class="help-block"><i>{{trans('real-estate.formCreateLabel.mapHelpBlock')}}</i></span>
                        </div>
                        <div class="col-sm-12">
                            <div id="map-view-edit" style="width: 100%; height: 250px;"></div>
                        </div>
                    </div>
                    {{--<div class="form-group clearfix collapse" id="roomEdit">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-xs-12">--}}

                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-xs-12">--}}

                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="form-group clearfix collapse" id="floorSelectEdit">--}}
                        {{----}}
                    {{--</div>--}}

                    {{--<div class="form-group clearfix collapse" id="mattienEdit">--}}
                        {{----}}
                    {{--</div>--}}

                    {{--<div class="form-group clearfix collapse" id="nearByEdit">--}}
                        {{--<label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.position')}}</label>--}}
                        {{--<div class="col-sm-10">--}}
                            {{--<input type="text" class="form-control" name="position_edit" id="position-edit"--}}
                                   {{--placeholder="VD: gần chợ 200m,"/>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <div class="form-group clearfix">
                        <div class="col-xs-12">
                            <button type="button" class="btn btn-default btn-collapse" data-target="#contactInfoEdit">Liên hệ
                            </button>
                            <button type="button" class="btn btn-default btn-collapse" data-target="#addressSelectEdit">
                                Khu vực
                            </button>
                            <button type="button" class="btn btn-default btn-collapse" data-target="#catSelectEdit">Danh
                                mục
                            </button>
                            <button type="button" class="btn btn-default btn-collapse" data-target="#areaEdit">Thông số
                            </button>

                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-xs-12">
                            <button type="button" class="btn btn-default btn-collapse"
                                    data-target="#directionSelectEdit">Hướng
                            </button>
                            <button type="button" class="btn btn-default btn-collapse" data-target="#exhibitSelectEdit">
                                Giấy tờ
                            </button>
                            <button type="button" class="btn btn-default btn-collapse" data-target="#priceSelectEdit">
                                Giá
                            </button>
                            <button type="button" class="btn btn-default btn-collapse" data-target="#imageSelectEdit">Hình ảnh
                            </button>

                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-xs-12">
                            <button type="button" class="btn btn-default btn-collapse" data-target="#linkYoutubeEdit">
                                Video
                            </button>
                            <button type="button" class="btn btn-default btn-collapse" data-target="#mapSelectEdit">Bản đồ
                            </button>

                        </div>
                    </div>
                    {{--<div class="form-group clearfix">--}}
                        {{--<div class="col-xs-12">--}}
                            {{--<button type="button" class="btn btn-default btn-collapse" data-target="#nearByEdit">Gần--}}
                            {{--</button>--}}
                            {{--<button type="button" class="btn btn-default btn-collapse" data-target="#roomEdit"><i--}}
                                    {{--class="fa fa-bed" aria-hidden="true"></i> Phòng--}}
                            {{--</button>--}}

                            {{--<button type="button" class="btn btn-default btn-collapse" data-target="#mattienEdit"> Mặt tiền--}}
                            {{--</button>--}}
                            {{--<button type="button" class="btn btn-default btn-collapse" data-target="#floorSelectEdit">Số--}}
                                {{--tầng--}}
                            {{--</button>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <div class="form-group clearfix hidden">
                        <label class="col-sm-2 control-label">Đăng lên</label>

                        <div class="col-sm-4">
                            <select class="form-control" id="is-private-edit" name="is_private"
                                    value="{{ old('is_private') }}">
                                <option value="1">Đăng trên trang cá nhân</option>
                                <option value="2">Đăng trên web cá nhân</option>
                                <option value="3">Đăng trên web công ty</option>
                                <option value="4">Đăng trên web đã đăng ký</option>
                            </select>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="form-group clearfix">
                        <div class="col-sm-10 col-sm-offset-2">

                        </div>
                    </div>
                    <!-- /.box-footer -->
                </div>
            </div>
            <div class="modal-footer clearfix">
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                <button type="button" name="update_re" id="update-re" onclick="updateRe(this)" class="_btn bg_red"><i
                        class="fa fa-save"></i> &nbsp;&nbsp;Cập nhật
                </button>
            </div>
        </div>

    </div>
</div>
{{--end modal--}}

@push('js')
    <script>
        function changeEditUnit(){
            var type    =   $('#re-category-edit').val();
            console.log(type);
            if(type == 2 || type ==4)
                $('#don_vi_edit').html('<option value="3">VNĐ/m2</option>\n' +
                    '            <option value="4">VNĐ/tháng</option>\n' +
                    '            <option value="5">USD/m2</option>\n' +
                    '            <option value="6">USD/tháng</option>');
            else {
                $('#don_vi_edit').html('<option value="1">VNĐ</option>\n' +
                    '            <option value="2">USD</option>' +
                    '<option value="4">VNĐ/m2</option>' +
                    '<option value="6">USD/m2</option>');
            }
        }
        function format_edit_price(){
            $('#price_format_edit').html(new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format($('input[name=price_edit]').val()));
        }
        $(function () {
            $('#modalEditRe').on('shown.bs.modal', function(){
                console.log($('input[name=price_edit]').val());
                format_edit_price();
            });
            $(document).on('keyup','input[name=price_edit]',function(){
                format_edit_price();
            });
            $('#modalEditRe').on('change','#re-category-edit',function(){
                changeEditUnit();
            });
            $('#contact-phone-edit').keyup(function() {
                emptyContactInfoEdit();

                let phone = $(this).val();
                if (phone.length > 9) {
                    $.ajax({
                        url: "/customer-by-phone/" + phone,
                        method: 'GET',
                        success: function (result) {
                            console.log('success');
                            console.log(result);
                            if (!jQuery.isEmptyObject(result)) {
                                $('#contact-person-edit').val(result.name);
                                $('#contact-address-edit').val(result.address);
                            } else {
                                emptyContactInfoEdit();
                            }
                        }
                    });
                }
            });
            function emptyContactInfoEdit() {
                $('#contact-person-edit').val('');
                $('#contact-address-edit').val('');
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
                    $('.form-edit-re .collapse').collapse('hide');
                } else {
                    // console.log('close');
                    $('.form-edit-re .collapse').collapse('hide');
                    $(targetId).collapse('show');
                }
            });
            //------------------------------------------------------------
            // END COLLAPSE CONTENT
            //------------------------------------------------------------
        });

        function changeReCategoryEdit(e) {
            let catId = $(e).val();

            $.ajax({
                url: "/re-type/list-dropdown/" + catId,
                method: 'GET',
                success: function (result) {
                    // console.log('success');
                    // console.log(result);
                    let html = '';
                    if (result) {
                        for (let r of result) {
                            html += '<option value="' + r.id + '">' + r.name + '</option>';
                        }
                    }
                    if (html) {
                        $('#re-type-edit').html(html);
                    }
                }
            });
        }

        function changeLoaiBDSEdit(e) {
            if ( !$('#thocu-select-wrap-edit').hasClass('hidden') ) {
                $('#thocu-select-wrap-edit').addClass('hidden');
            }
            $('#thocu-select-edit').html('');

            if ( !$('#duan-select-wrap-edit').hasClass('hidden') ) {
                $('#duan-select-wrap-edit').addClass('hidden');
            }
            $('#duan-select-edit').html('');

            console.log($(e).val());
            let loaiBDS = $(e).val();

            showLoader();

            if (loaiBDS == 1) {
                $.ajax({
                    url: "/re-type/list-dropdown",
                    method: 'GET',
                    success: function (result) {
                        console.log('success');
                        console.log(result);
                        let html = '<select class="form-control" name="re_type_id" id="re-type-edit">';
                        if (result) {
                            for (let r of result) {
                                html += '<option value="' + r.id + '">' + r.name + '</option>';
                            }
                        }
                        html += '</select>';
                        if (html) {
                            $('#thocu-select-wrap-edit').removeClass('hidden');
                            $('#thocu-select-edit').html(html);
                        }
                    }
                });
            } else if (loaiBDS == 2) {
                {{--let provinceId = $('#province-edit').val();--}}
                {{--if (!provinceId) {--}}
                    {{--provinceId = '{{auth()->user()->userinfo->province_id}}';--}}
                {{--}--}}
                {{--provinceId = parseInt(provinceId);--}}
                {{--$.ajax({--}}
                    {{--url: '/project-by-province/' + provinceId,--}}
                    {{--method: 'GET',--}}
                    {{--success: function (result) {--}}
                        {{--console.log('success');--}}
                        {{--console.log(result);--}}
                        {{--let html = '<select class="form-control" name="project_id">';--}}
                        {{--if (result) {--}}
                            {{--for (let r of result) {--}}
                                {{--html += '<option value="' + r.id + '">' + r.name + '</option>';--}}
                            {{--}--}}
                        {{--}--}}
                        {{--html += '</select>';--}}
                        {{--if (html) {--}}
                            {{--$('#duan-select-wrap-edit').removeClass('hidden');--}}
                            {{--$('#duan-select-edit').html(html);--}}
                        {{--}--}}
                    {{--}--}}
                {{--});--}}
                $('#duan-select-wrap-edit').removeClass('hidden');
            }
            hideLoader();
        }

        function changeProvinceEdit(e) {
            let provinceId = $(e).val();
            if (!provinceId) {
                $('#district-edit').html('<option value="">{{trans('real-estate.selectFirstOpt')}}</option>');
                $('#ward-edit').html('<option value="">{{trans('real-estate.selectFirstOpt')}}</option>');
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
                        $('#district-edit').html(html);
                    }
                    hideLoader();
                }
            });


        }

        function changeDistrictEdit(e) {
            // console.log($(e).val());
            let districtId = $(e).val();

            if (!districtId) {
                $('#ward-edit').html('<option value="">{{trans('real-estate.selectFirstOpt')}}</option>');
                return;
            }

            $.ajax({
                url: '/ward-by-district/' + districtId,
                method: 'GET',
                success: function (result) {
                    // console.log('success');
                    // console.log(result);
                    let html = '<option value="">{{trans('real-estate.selectFirstOpt')}}</option>';
                    if (result) {
                        for (let r of result) {
                            html += '<option value="' + r.id + '">' + r.name + '</option>';
                        }
                    }
                    if (html) {
                        $('#ward-edit').html(html);
                    }
                }
            });
        }

        function changeWardEdit(e) {
            // console.log($(e).val());
            let wardId = $(e).val();

            $.ajax({
                url: '/street-by-ward/' + wardId,
                method: 'GET',
                success: function (result) {
                    // console.log('success');
                    // console.log(result);
                    let html = '';
                    if (result) {
                        for (let r of result) {
                            html += '<option value="' + r.id + '">' + r.name + '</option>';
                        }
                    }
                    if (html) {
                        $('#street-edit').html(html);
                    }
                }
            });
        }

        //---------------------------------
        // HANDLE WHEN CLICK BUTTON CHOOSE IMAGE
        //---------------------------------
        $("#choose-image-edit").unbind("click").bind("click", function () {
            $("#images-edit").click();
        });
        $("#images-edit").change(function () {
            var i = 0, len = this.files.length, reader, file;
            for (; i < len; i++) {
                file = this.files[i];
                if (!!file.type.match(/image.*/)) {
                    reader = new FileReader();
                    reader.onloadend = function (e) {
                        showSelectedImgEdit(e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        function showSelectedImgEdit(src) {
            const htmlMarkup = '<div class="col-xs-4 item-img-preview"><img src="' + src + '" class="img-responsive"/>'
                + '<div class=""><input type="hidden" name="imagesNew[]" value="' + src + '" class="form-control" />'
                + '<label>{{ trans("real-estate.formCreateLabel.alt-text") }}</label>'
                + '<input type="text" name="altNew[]" class="form-control" /></div>'
                + '<a class="img-preview-btn-remove" onclick="removeImgPreview(this)"><i class="fa fa-trash" aria-hidden="true"></i></a>'
                + '</div>';
            $('.img-preview-edit').append(htmlMarkup);
        }
        //---------------------------------
        // END HANDLE WHEN CLICK BUTTON CHOOSE IMAGE
        //---------------------------------

        function cancelEditRe(e) {

        }
        function updateRe(e) {
            let formDataEdit = new FormData();
            let id = $('#id-edit').val();
            let title = $('#title-edit').val();
            let detail = $('#detail-edit').val();

            if (!title || !detail) {
                if (!title) {
                    // console.log('title empty');
                    $('#title-edit').parent().find('.error').html('Nhập tiêu đề tin');
                } else {
                    $('#title-edit').parent().find('.error').html('');
                }

                if (!detail) {
                    // console.log('detail empty');
                    $('textarea#detail-edit').parent().find('.error').html('Nhập nội dung chi tiết');
                } else {
                    $('textarea#detail-edit').parent().find('.error').html('');
                }

                return;
            }

            let reCatId = $('#re-category-edit').val();

            let reTypeId = $('#re-type-edit').length ? $('#re-type-edit').val() : '';

            let loaiBDS = $('#loai-bds-edit').val();

            let provinceId = $('#province-edit').val();

            let districtId = $('#district-edit').val();

            let wardId = $('#ward-edit').val();

            let streetId = $('#street-edit').val();

            let contactPhone = $('#contact-phone-edit').val();
            let contactPerson = $('#contact-person-edit').val();
            let contactAddress = $('#contact-address-edit').val();

            // let position = $('#position-edit').val();

            let directionId = $('#direction-edit').val();

            let linkVideo = $('#link-video-edit').val();

            let exhibitId = $('#exhibit-edit').val();

            let projectId = $('#project-id-edit').length ? $('#project-id-edit').val() : '';

            let bedroom = $('#bedroom-edit').val();

            let livingroom = $('#living-room-edit').val();

            let wc = $('#wc-edit').val();

            let blockId = $('#block-edit').val();

            let constructionType = $('#construction-type-edit').val();

            let aop = $('#area-of-premises-edit').val();

            let aou = $('#area-of-use-edit').val();

            let width = $('#width-edit').val();

            let length = $('#length-edit').val();

            let width_lane = $('#width-lane-edit').val();

            let floor = $('#floor-edit').val();

            let price = $('#price-edit').val();

            let donvi = $('#don-vi-edit').val();

            let isDeal = $('#is-deal-edit').is(":checked") ? 1 : 0;

            let gara = $('#gara-edit').is(":checked") ? 1 : 0;

            let rangePrice = $('#range-price-edit').val();

            let map = $('#map-edit').val();

            let isPrivate = $('#is-private-edit').val();

            $("input[name='imagesOld[]']")
                .each(function(){
                    formDataEdit.append('imagesOld[]', $(this).val());
                });
            $("input[name='altOld[]']")
                .each(function(){
                    formDataEdit.append('altOld[]', $(this).val());
                });
            $("input[name='imagesNew[]']")
                .each(function(){
                    formDataEdit.append('imagesNew[]', $(this).val());
                });
            $("input[name='altNew[]']")
                .each(function(){
                    formDataEdit.append('altNew[]', $(this).val());
                });

            formDataEdit.append('id', id);
            formDataEdit.append('title', title);
            formDataEdit.append('detail', detail);
            formDataEdit.append('re_category_id', reCatId);
            formDataEdit.append('loai_bds', loaiBDS);
            if (reTypeId) {
                formDataEdit.append('re_type_id', reTypeId);
            }
            formDataEdit.append('province_id', provinceId);
            formDataEdit.append('district_id', districtId);
            formDataEdit.append('ward_id', wardId);
            formDataEdit.append('street_id', streetId);
            formDataEdit.append('contact_person', contactPerson);
            formDataEdit.append('contact_phone_number', contactPhone);
            formDataEdit.append('contact_address', contactAddress);
            // formDataEdit.append('position', position);
            formDataEdit.append('direction_id', directionId);
            formDataEdit.append('exhibit_id', exhibitId);
            if (projectId) {
                formDataEdit.append('project_id', projectId);
            }
            formDataEdit.append('bedroom', bedroom);
            formDataEdit.append('living_room', livingroom);
            formDataEdit.append('wc', wc);
            formDataEdit.append('block_id', blockId);
            formDataEdit.append('construction_type_id', constructionType);
            formDataEdit.append('area_of_premises', aop);
            formDataEdit.append('area_of_use', aou);
            formDataEdit.append('width', width);
            formDataEdit.append('length', length);
            formDataEdit.append('width_lane', width_lane);
            formDataEdit.append('floor', floor);
            formDataEdit.append('price', price);
            formDataEdit.append('don_vi', donvi);
            formDataEdit.append('is_deal', isDeal);
            formDataEdit.append('gara', gara);
            formDataEdit.append('range_price_id', rangePrice);
            formDataEdit.append('map', map);
            formDataEdit.append('is_private', isPrivate);
            formDataEdit.append('link_video', linkVideo);
            if($('input[name=edit_public_site]').is(':checked')){
                formDataEdit.append('public_site', 1);
            }
            console.log(formDataEdit);

            showLoader();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            });
            $.ajax({
                url: '/ajax/update-detail-re/' + id,
                type: 'POST',
                data: formDataEdit,
                processData: false,
                contentType: false,
                success: function (res) {
                    // console.log('success change cover');
                    // console.log(res);
                    if (res.success) {
                        toastr.success(res.message);
                        const re = res.data.re;
                        re.detail = res.data.content;
                        displayValueAfterUpdate(re);
                        $('#street-id-hidden').val('');
                        $('#street-name-hidden').val('');
                        $.get('{{route('getPublicPostLeft')}}', {}, function(r){
                            $('#public_left').html(r);
                            $('#edit_public_left').html(r);
                            if(r<=0){
                                $('input[name=public_site]').attr('disabled', 'disabled');
                                $('input[name=editpublic_site]').attr('disabled', 'disabled');
                            } else {
                                $('input[name=public_site]').removeAttr('disabled');
                                $('input[name=editpublic_site]').removeAttr('disabled');
                            }
                        });
                        $('#modalEditRe').modal('hide');
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

        function displayValueAfterUpdate(data) {
            let panelRe = $('#'+data.id);

            let titleDOM = panelRe.find('.title');
            titleDOM.attr('href', '/tin/' + data.slug + '-' + data.id);
            titleDOM.text(data.title);

            let priceDOM = panelRe.find('.price');
            // if (priceDOM.html()) {
            if ($.trim(priceDOM.html())) {
                if (data.price) {
                    const price = DocTienBangChu(data.price);
                    let htmlPrice = '<b class="text-red"><span class="text-upper" style="font-size: 12px;">Giá:</span> <span class="price-val">' + price + '</span><span style="font-size: 12px;">VND</span></b>';
                    if (data.don_vi) {
                        htmlPrice = '<b class="text-red"><span class="text-upper" style="font-size: 12px;">Giá:</span> <span class="price-val">' + price + '</span><span style="font-size: 12px;">VND/' + data.don_vi + '</span></b>';
                    }
                    priceDOM.html(htmlPrice);
                } else {
                    priceDOM.html('<b class="text-red"><span class="text-upper" style="font-size: 12px;">Giá:</span> <span class="price-val">Thỏa thuận</span></b>');
                }
            } else {
                if (data.price) {
                    const price = DocTienBangChu(data.price);
                    let htmlPrice = '<b class="text-red"><span class="text-upper" style="font-size: 12px;">Giá:</span> <span class="price-val">' + price + '</span><span style="font-size: 12px;">VND</span></b>';
                    if (data.don_vi) {
                        htmlPrice = '<b class="text-red"><span class="text-upper" style="font-size: 12px;">Giá:</span> <span class="price-val">' + price + '</span><span style="font-size: 12px;">VND/' + data.don_vi + '</span></b>';
                    }
                    priceDOM.html(htmlPrice);
                } else {
                    let htmlPrice = '<b class="text-red"><span class="text-upper" style="font-size: 12px;">Giá:</span> <span class="price-val">Thỏa thuận</span></b>';
                    priceDOM.html(htmlPrice);
                }
            }

            let detailDOM = panelRe.find('.detail-item-wrap');
            detailDOM.html(data.detail);

            let districtDOM = panelRe.find('.district-val');
            const district = data.district;
            if (district) {
                districtDOM.text(district.name);
            } else {
                districtDOM.text('-');
            }

            let exhibitDOM = panelRe.find('.exhibit-val');
            const exhibit = data.exhibit;
            if (exhibit) {
                exhibitDOM.text(exhibit.name);
            } else {
                exhibitDOM.text('-');
            }

            let directionDOM = panelRe.find('.direction-val');
            const direction = data.direction;
            if (direction) {
                directionDOM.text(direction.name);
            } else {
                directionDOM.text('-');
            }

            let floorDOM = panelRe.find('.floor-val');
            if (data.floor) {
                floorDOM.text(data.floor);
            } else {
                floorDOM.html('');
            }

            let positionDOM = panelRe.find('.position-val');
            if (data.position) {
                positionDOM.text(data.position);
            } else {
                positionDOM.html('');
            }

            let categoryDOM = panelRe.find('.category-val');
            const category = data.re_category;
            if (category) {
                categoryDOM.html('<a href="/danh-muc-bds/' + category.slug + '-c' + category.id + '">' + category.name + '</a>');
            } else {
                categoryDOM.html('');
            }

            let roomDOM = panelRe.find('.room-wrap');
            let markup = '';
            if (data.bedroom) {
                markup += '<b>Phòng ngủ: </b>' + data.bedroom;
            }
            if (data.bedroom && data.living_room) {
                markup += ', ';
            }
            if (data.living_room) {
                markup += '<b>Phòng khách: </b>' + data.living_room
            }
            if ( (data.living_room && data.wc) || (data.bedroom && !data.living_room && data.wc)) {
                markup += ', ';
            }
            if (data.wc) {
                markup += '<b>WC: </b>' + data.wc
            }

            roomDOM.html(markup);

            let imagesDOM = panelRe.find('.images-wrap');
            const imgDf = {
                'link' : '/images/default_real_estate_image.jpg',
                'alt' : data.title,
                'thumb': '/images/default_thumb.jpg'
            };
            let images = $.parseJSON(data.images);
            images = images.length ? images : [imgDf];
            let imgMarkup = '';
            for (let image of images) {
                const alt = image.alt ? image.alt : data.title;
                imgMarkup += '<a href="' + image.link + '" title="' + alt + '" class="pg-item"><img src="' + image.link + '" width="122" height="91"></a>';
            }
            imagesDOM.html(imgMarkup);
        }

        $('#modalEditRe').on('hidden.bs.modal', function () {
            $('#is-edit').val('add');
        });

        function initMapEdit(lat, long) {
            let uLat = '{{auth()->user()->userinfo->province->lat}}';
            let uLong = '{{auth()->user()->userinfo->province->long}}';
            var myLatLng = {lat: parseFloat(uLat), lng: parseFloat(uLong)};
            if (lat && long) {
                myLatLng = {lat: parseFloat(lat), lng: parseFloat(long)};
            }

            var map = new google.maps.Map(document.getElementById('map-view-edit'), {
                zoom: 10,
                center: myLatLng
            });

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                draggable:true,
                title: 'Chọn vị trí'
            });
            // marker.addListener('drag', handleEvent);
            marker.addListener('dragend', handleEventMapEdit);
        }
        function handleEventMapEdit(event) {
            // console.log('map edit here');
            // console.log(event.latLng.lat());
            // console.log(event.latLng.lng());
            $('#map-edit').val(event.latLng.lat() + ',' + event.latLng.lng());
        }
    </script>
@endpush
