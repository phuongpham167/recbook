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
                    </div>

                    <div class="form-group clearfix collapse" id="catSelectEdit">
                        <label
                            class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.reCategory')}}</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="re-category-edit" name="re_category_id_edit"
                                    onchange="changeReCategoryEdit(this)"
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
                            <select class="form-control" id="re-type-edit" name="re_type_id_edit">
                                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                            </select>
                            <p class="text-red error"></p>
                        </div>
                    </div>
                    <div class="form-group clearfix collapse" id="addressSelectEdit">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.district')}} </label>
                        <div class="col-sm-4">
                            <select class="form-control" id="district-edit" name="district_id_edit"
                                    onchange="changeDistrictEdit(this)"
                            >
                                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                @foreach($districtByUProvince as $d)
                                    <option value="{{$d->id}}">{{$d->name}}</option>
                                @endforeach
                            </select>
                            <p class="text-red error"></p>
                        </div>
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.ward')}} </label>
                        <div class="col-sm-4">
                            <select class="form-control" id="ward-edit" name="ward_id_edit"
                                    onchange="changeWardEdit(this)">
                                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                            </select>
                            <p class="text-red error"></p>
                        </div>
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.street')}} </label>
                        <div class="col-sm-4">
                            <select class="form-control" id="street-edit" name="street_id_edit">
                                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                            </select>
                            <p class="text-red error"></p>
                        </div>
                    </div>


                    <div class="form-group clearfix collapse" id="nearByEdit">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.position')}}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="position_edit" id="position-edit"
                                   placeholder="VD: gần chợ 200m,"/>
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
                    <div class="form-group clearfix collapse" id="projectSelectEdit">

                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.project')}} </label>
                        <div class="col-sm-4">
                            <select class="form-control" id="project-edit" name="project_id_edit">
                                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                @foreach($projectByUProvince as $p)
                                    <option value="{{$p->id}}">{{$p->name}}</option>
                                @endforeach
                            </select>
                            <p class="text-red error"></p>
                        </div>
                    </div>
                    <div class="form-group clearfix collapse" id="roomEdit">
                        <div class="row">
                            <div class="col-xs-12">
                                <label
                                    class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.bedroom')}}</label>

                                <div class="col-sm-4">
                                    <input type="number" class="form-control" name="bedroom_edit" id="bedroom-edit"/>
                                </div>
                                <label
                                    class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.living_room')}}</label>

                                <div class="col-sm-4">
                                    <input type="number" class="form-control" name="living_room_edit"
                                           id="living-room-edit"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <label
                                    class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.wc')}}</label>

                                <div class="col-sm-4">
                                    <input type="number" class="form-control" name="wc_edit" id="wc-edit"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix collapse" id="areaEdit">

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
                        </div>

                    </div>
                    <div class="form-group clearfix collapse" id="floorSelectEdit">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.floor')}}</label>

                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="floor_edit" id="floor-edit"/>
                        </div>
                    </div>
                    <div class="form-group clearfix collapse" id="priceSelectEdit">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.price')}}</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="price_edit" id="price-edit" step="1"/>
                        </div>
                        <div class="col-sm-10 col-sm-offset-2">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="is-deal-edit"
                                           name="is_deal_edit" {{ old('is_deal') == 'on' ? 'checked' : '' }}>
                                    {{trans('real-estate.formCreateLabel.isDeal')}}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix collapse" id="mapSelectEdit">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.map')}}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="map_edit" id="map-edit"/>
                            <span class="help-block"><i>{{trans('real-estate.formCreateLabel.mapHelpBlock')}}</i></span>
                        </div>
                        <div class="col-sm-12">
                            <div id="map-view" style="width: 100%; height: 250px;"></div>
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
                    <div class="form-group clearfix">
                        <div class="col-xs-12">
                            <button type="button" class="btn btn-default btn-collapse" data-target="#catSelectEdit">Danh
                                mục
                            </button>
                            <button type="button" class="btn btn-default btn-collapse" data-target="#addressSelectEdit">
                                <i class="fa fa-road" aria-hidden="true"></i> Khu vực
                            </button>
                            <button type="button" class="btn btn-default btn-collapse" data-target="#nearByEdit">Gần
                            </button>
                            <button type="button" class="btn btn-default btn-collapse"
                                    data-target="#directionSelectEdit">Hướng
                            </button>
                            <button type="button" class="btn btn-default btn-collapse" data-target="#exhibitSelectEdit">
                                Giấy tờ
                            </button>
                            <button type="button" class="btn btn-default btn-collapse" data-target="#projectSelectEdit">
                                Dự án
                            </button>
                            <button type="button" class="btn btn-default btn-collapse" data-target="#roomEdit"><i
                                    class="fa fa-bed" aria-hidden="true"></i> Phòng
                            </button>
                            <button type="button" class="btn btn-default btn-collapse" data-target="#areaEdit"><i
                                    class="fa fa-area-chart" aria-hidden="true"></i> Diện tích
                            </button>
                            <button type="button" class="btn btn-default btn-collapse" data-target="#floorSelectEdit">Số
                                tầng
                            </button>
                            <button type="button" class="btn btn-default btn-collapse" data-target="#priceSelectEdit">
                                Giá
                            </button>
                            <button type="button" class="btn btn-default btn-collapse" data-target="#mapSelectEdit"><i
                                    class="fa fa-map-marker"></i> Vị ví
                            </button>
                            <button type="button" class="btn btn-default btn-collapse" data-target="#imageSelectEdit"><i
                                    class="fa fa-picture-o"></i> Hình ảnh
                            </button>
                        </div>
                    </div>
                    <div class="form-group clearfix">
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
        $(function () {
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

        function changeDistrictEdit(e) {
            // console.log($(e).val());
            let districtId = $(e).val();

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

            let reTypeId = $('#re-type-edit').val();

            let districtId = $('#district-edit').val();

            let wardId = $('#ward-edit').val();

            let streetId = $('#street-edit').val();

            let position = $('#position-edit').val();

            let directionId = $('#direction-edit').val();

            let exhibitId = $('#exhibit-edit').val();

            let projectId = $('#project-edit').val();

            let bedroom = $('#bedroom-edit').val();

            let livingroom = $('#living-room-edit').val();

            let wc = $('#wc-edit').val();

            let aop = $('#area-of-premises-edit').val();

            let aou = $('#area-of-use-edit').val();

            let floor = $('#floor-edit').val();

            let price = $('#price-edit').val();

            let isDeal = $('#is-deal-edit').is(":checked") ? 1 : 0;

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
            formDataEdit.append('re_type_id', reTypeId);
            formDataEdit.append('district_id', districtId);
            formDataEdit.append('ward_id', wardId);
            formDataEdit.append('street_id', streetId);
            formDataEdit.append('position', position);
            formDataEdit.append('direction_id', directionId);
            formDataEdit.append('exhibit_id', exhibitId);
            formDataEdit.append('project_id', projectId);
            formDataEdit.append('bedroom', bedroom);
            formDataEdit.append('living_room', livingroom);
            formDataEdit.append('wc', wc);
            formDataEdit.append('area_of_premises', aop);
            formDataEdit.append('area_of_use', aou);
            formDataEdit.append('floor', floor);
            formDataEdit.append('price', price);
            formDataEdit.append('is_deal', isDeal);
            formDataEdit.append('map', map);
            formDataEdit.append('is_private', isPrivate);

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
                        displayValueAfterUpdate(re);
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
            if (priceDOM.html()) {
                if (data.price) {
                    priceDOM.find('.price-val').text(data.price);
                } else {
                    priceDOM.html('');
                }
            } else {
                if (data.price) {
                    priceDOM.html('Giá: <span class="price-val">' + data.price + '</span>');
                }
            }

            let districtDOM = panelRe.find('.district-wrap');
            const district = data.district;
            if (districtDOM.html()) {
                if (district) {
                    districtDOM.find('.district-val').text(district.name);
                } else {
                    districtDOM.html('');
                }
            } else {
                if (district) {
                    districtDOM.html('<div class="col-xs-12 col-md-4 ">Khu vực: <span class="district-val">' + district.name + '</span></div>');
                }
            }

            let floorDOM = panelRe.find('.floor-wrap');
            if (floorDOM.html()) {
                if (data.floor) {
                    floorDOM.find('.floor-val').text(data.floor);
                } else {
                    floorDOM.html('');
                }
            } else {
                if (data.floor) {
                    floorDOM.html('<div class="col-xs-12 col-md-2 ">Số tầng: <span class="floor-val">' + data.floor + '<span></div>');
                }
            }

            let positionDOM = panelRe.find('.position-wrap');
            if (positionDOM.html()) {
                if (data.position) {
                    positionDOM.find('.position-val').text(data.position);
                } else {
                    positionDOM.html('');
                }
            } else {
                if (data.position) {
                    positionDOM.html('<div class="col-xs-12 col-md-6 ">Gần: <span class="position-val">' + data.position + '<span></div>');
                }
            }

            let categoryDOM = panelRe.find('.category-wrap');
            const category = data.re_category;
            if (categoryDOM.html()) {
                if (category) {
                    categoryDOM.find('.category-val').text(category.name);
                } else {
                    categoryDOM.html('');
                }
            } else {
                if (category) {
                    categoryDOM.html('<div class="col-xs-12 col-md-3 "><span class="category-val">' + category.name + '</span></div>');
                }
            }

            let roomDOM = panelRe.find('.room-wrap');
            if (roomDOM.html()) {
                let markup = '<div class="col-xs-12 col-md-9">';
                if (data.bedroom) {
                    markup += 'Phòng ngủ: ' + data.bedroom;
                }
                if (data.bedroom && data.living_room) {
                    markup += ', ';
                }
                if (data.living_room) {
                    markup += 'Phòng khách: ' + data.living_room
                }
                if (data.living_room && data.wc) {
                    markup += ', ';
                }
                if (data.wc) {
                    markup += 'WC: ' + data.wc
                }
                markup += '</div>';

                roomDOM.html(markup);
            }

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
    </script>
@endpush
