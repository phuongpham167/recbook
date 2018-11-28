@push('style')
    <link rel="stylesheet" href="{{ asset('css/right-sidebar.css') }}"/>
@endpush

<div class="right-sidebar-wrap">
    <div class="right-sidebar">
        <div class="block block-1">
            <p class="title-block">TÌM KIẾM THEO YÊU CẦU</p>
            <div class="right-search-form-wrap">
                <form class="right-search-form" role="form" action="" method="POST">
                    <div class="row">
                        <div class="col-xs-12 item">
                            <div class="form-group">
                                <select class="form-control" name="search[re_category_id]" id="search-category-id">
                                    <option value="">Loại hình bất động sản</option>
                                    <option value="1" selected="selected">Cần bán</option>
                                    <option value="5">Cho thuê</option>
                                    <option value="4">Cần mua</option>
                                    <option value="2">Cần thuê</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 item">
                            <div class="form-group">
                                <select class="form-control" id="search-type-id" name="search[re_type_id]">
                                    <option value="">Nhóm bất động sản</option>
                                    <option value="72">Condotel - Căn hộ Khách sạn</option>
                                    <option value="76">Tòa nhà - căn hộ</option>
                                    <option value="7">Nhà mặt đường</option>
                                    <option value="8">Nhà trong ngõ</option>
                                    <option value="9">Nhà trong khu Dự án phân lô - Tái định cư</option>
                                    <option value="24">Nhà vườn - Biệt thự</option>
                                    <option value="25">Căn hộ chung cư - Nhà tập thể </option>
                                    <option value="26">Nhà nghỉ- Khách sạn</option>
                                    <option value="27">Nhà xưởng - Kho bãi</option>
                                    <option value="28">Kiot - Cửa hàng</option>
                                    <option value="29">Đất thổ cư</option>
                                    <option value="30">Đất nền Dự án - Tái định cư</option>
                                    <option value="31">Đất Doanh nghiệp - Dự án giao thuê</option>
                                    <option value="32">Sang nhượng cửa hàng - Kiot</option>
                                    <option value="33">Bất động sản khác</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 item">
                            <div class="form-group">
                                <input class="form-control" placeholder="{{ trans('right-sidebar.searchForm.phonePlaceHolder') }}" name="search[phone]" id="search-phone" type="text" maxlength="50">
                            </div>
                        </div>
                        <div class="col-xs-12 item">
                            <div class="row form-group">
                                <span class="search-area-label">{{ trans('right-sidebar.searchForm.dtmdLabel') }}</span>
                                <div class="col-xs-4 no-padding-right padding-left-10">
                                    <input class="form-control" size="4" maxlength="10" placeholder="vd: 40.5" name="search[dtmb_from]" id="search-dtmb-from" type="text">
                                </div>
                                <span class="search-area-label-second">~</span>
                                <div class="col-xs-4 no-padding-left search-area-to-wrap">
                                    <input class="form-control" size="4" maxlength="10" placeholder="vd: 70.5" name="search[dtmb_to]" id="search-dtmb-to" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <button type="submit" class="search-btn-submit"><i class="fa fa-search fa-fw"></i> {{ trans('right-sidebar.searchForm.searchButtonText') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="block block-2">
            <p class="title-block">TÌM KIẾM THEO DỰ ÁN</p>
            <div class="right-search-form-wrap">
                <form class="right-search-form" role="form" action="" method="POST">
                    <div class="row">
                        <div class="col-xs-12 item">
                            <div class="form-group">
                                <select class="form-control" name="search[re_category_id]" id="search-category-id">
                                    <option value="">Loại hình bất động sản</option>
                                    <option value="1" selected="selected">Cần bán</option>
                                    <option value="5">Cho thuê</option>
                                    <option value="4">Cần mua</option>
                                    <option value="2">Cần thuê</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 item">
                            <div class="form-group">
                                <select class="form-control" id="search-type-id" name="search[re_type_id]">
                                    <option value="">Nhóm bất động sản</option>
                                    <option value="72">Condotel - Căn hộ Khách sạn</option>
                                    <option value="76">Tòa nhà - căn hộ</option>
                                    <option value="7">Nhà mặt đường</option>
                                    <option value="8">Nhà trong ngõ</option>
                                    <option value="9">Nhà trong khu Dự án phân lô - Tái định cư</option>
                                    <option value="24">Nhà vườn - Biệt thự</option>
                                    <option value="25">Căn hộ chung cư - Nhà tập thể </option>
                                    <option value="26">Nhà nghỉ- Khách sạn</option>
                                    <option value="27">Nhà xưởng - Kho bãi</option>
                                    <option value="28">Kiot - Cửa hàng</option>
                                    <option value="29">Đất thổ cư</option>
                                    <option value="30">Đất nền Dự án - Tái định cư</option>
                                    <option value="31">Đất Doanh nghiệp - Dự án giao thuê</option>
                                    <option value="32">Sang nhượng cửa hàng - Kiot</option>
                                    <option value="33">Bất động sản khác</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <button type="submit" class="search-btn-submit"><i class="fa fa-search fa-fw"></i> {{ trans('right-sidebar.searchForm.searchButtonText') }}</button>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <p>Có 135 dự án trong Thành phố</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
