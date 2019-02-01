@push('style')
    <link rel="stylesheet" href="{{ asset('css/right-sidebar.css') }}"/>
@endpush
@php
$filter = request()->all();
//dd($filter);
@endphp
<div class="right-sidebar-wrap">
    <div class="right-sidebar">
        <div class="block block-1">
            <p class="title-block">TÌM KIẾM THEO YÊU CẦU</p>
            <div class="right-search-form-wrap">
                <form class="right-search-form" role="form" action="{{route('smart-search')}}" method="GET">
                    <div class="row">
                        <div class="col-xs-12 item">
                            <div class="form-group">
                                <select class="form-control js-basic-single" name="Search[cat_id]"
                                        onchange="changeReCategory(this, 1)" id="search-category-id">
                                    <option value="">{{trans('real-estate.ssSelectFirstCat')}}</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{ ($filter && isset($filter['Search']['cat_id']) && $filter['Search']['cat_id'] == $category->id ) ?  'selected' : '' }}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 item">
                            <div class="form-group">
                                <select class="form-control js-basic-single" id="re-type1" name="Search[type_id]">
                                    <option value="">{{trans('real-estate.ssSelectFirstType')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 item">
                            <div class="form-group">
                                <select class="form-control js-basic-single"
                                        name="Search[province_id]" id="Search_province_id" onchange="changeProvince(this)">
                                    <option value="">{{trans('real-estate.ssSelectFirstProvince')}}</option>
                                    @foreach($provinces as $province)
                                        <option value="{{$province->id}}" {{ ($filter && isset($filter['Search']['province_id']) && $filter['Search']['province_id'] == $province->id ) ?  'selected' : '' }}>{{$province->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 item">
                            <div class="form-group">
                                <select class="form-control js-basic-single"
                                        name="Search[district_id]" id="Search_district_id" onchange="changeDistrict(this)">
                                    <option value="">{{trans('real-estate.ssSelectFirstDistrict')}}</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 item">
                            <div class="form-group">
                                <select class="form-control js-basic-single" name="Search[ward_id]" id="Search_ward_id" onchange="changeWard(this)">
                                    <option value="">{{trans('real-estate.ssSelectFirstWard')}}</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 item">
                            <div class="form-group">
                                <select class="form-control js-basic-single" name="Search[street_id]" id="Search_street_id">
                                    <option value="">{{trans('real-estate.ssSelectFirstStreet')}}</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 item">
                            <div class="form-group">
                                <select class="form-control js-basic-single" name="Search[direction_id]" id="Search_direction_id">
                                    <option value="">{{trans('real-estate.ssSelectFirstDirection')}}</option>
                                    @foreach($directions as $direction)
                                        <option value="{{$direction->id}}" {{ ($filter && isset($filter['Search']['direction_id']) && $filter['Search']['direction_id'] == $direction->id ) ?  'selected' : '' }}>{{$direction->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-12 item">
                            <div class="form-group">
                                <select class="form-control js-basic-single" id="range-price1" name="Search[range_price_id]">
                                    <option value="">{{trans('real-estate.ssSelectFirstPrice')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 item">
                            <div class="form-group">
                                <input class="form-control"
                                       placeholder="{{ trans('right-sidebar.searchForm.phonePlaceHolder') }}"
                                       name="Search[phone]" id="search-phone" type="text" maxlength="50"
                                        value="{{($filter && isset($filter['Search']['phone'])) ? $filter['Search']['phone'] : ''}}">
                            </div>
                        </div>
                        <div class="col-xs-12 item">
                            <div class="row form-group">
                                <span class="search-area-label">{{ trans('right-sidebar.searchForm.dtmdLabel') }}</span>
                                <div class="col-xs-4 no-padding-right padding-left-10">
                                    <input class="form-control" size="4" maxlength="10" placeholder="vd: 40.5"
                                           name="Search[dtmb_from]" id="search-dtmb-from" type="text"
                                           value="{{($filter && isset($filter['Search']['dtmb_from'])) ? $filter['Search']['dtmb_from'] : ''}}">
                                </div>
                                <span class="search-area-label-second">~</span>
                                <div class="col-xs-4 no-padding-left search-area-to-wrap">
                                    <input class="form-control" size="4" maxlength="10" placeholder="vd: 70.5"
                                           name="Search[dtmb_to]" id="search-dtmb-to" type="text"
                                           value="{{($filter && isset($filter['Search']['dtmb_to'])) ? $filter['Search']['dtmb_to'] : ''}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <button type="submit" class="search-btn-submit"><i
                                        class="fa fa-search fa-fw"></i> {{ trans('right-sidebar.searchForm.searchButtonText') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="block block-2">
            <p class="title-block">TÌM KIẾM THEO DỰ ÁN</p>
            <div class="right-search-form-wrap">
                <form class="right-search-form" role="form" action="{{route('smart-search')}}" method="GET">
                    <div class="row">
                        <div class="col-xs-12 item">
                            <div class="form-group">
                                <select class="form-control js-basic-single" name="Search[project_id]" id="Search_project_id">
                                    <option value="">{{trans('real-estate.ssSelectFirstProject')}}</option>
                                    @foreach($projects as $project)
                                        <option value="{{$project->id}}" {{ ($filter && isset($filter['Search']['project_id']) && $filter['Search']['project_id'] == $project->id ) ?  'selected' : '' }}>{{$project->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-12 item">
                            <div class="form-group">
                                <select class="form-control js-basic-single" id="loday_project" name="Search[block_id]">
                                    <option value="">{{trans('real-estate.ssSelectFirstBlock')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-12 item">
                            <div class="form-group">
                                <select class="form-control js-basic-single"
                                        onchange="changeReCategory(this, 2)"
                                        name="Search[cat_id]" id="Search_kind_id">
                                    <option value="">{{trans('real-estate.ssSelectFirstCat')}}</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{ ($filter && isset($filter['Search']['cat_id']) && $filter['Search']['cat_id'] == $category->id ) ?  'selected' : '' }}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-12 item">
                            <div class="form-group">
                                <select class="form-control js-basic-single" id="re-type2" name="Search[type_id]">
                                    <option value="">{{trans('real-estate.ssSelectFirstType')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-12 item">
                            <div class="form-group">
                                <select class="form-control js-basic-single" name="Search[direction_id]" id="Search_direction_id">
                                    <option value="">{{trans('real-estate.ssSelectFirstDirection')}}</option>
                                    @foreach($directions as $direction)
                                        <option value="{{$direction->id}}" {{ ($filter && isset($filter['Search']['direction_id']) && $filter['Search']['direction_id'] == $direction->id ) ?  'selected' : '' }}>{{$direction->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-12 item">
                            <div class="form-group">
                                <select class="form-control js-basic-single" id="range-price2" name="Search[range_price_id]">
                                    <option value="">{{trans('real-estate.ssSelectFirstPrice')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <button type="submit" class="search-btn-submit"><i
                                        class="fa fa-search fa-fw"></i> {{ trans('right-sidebar.searchForm.searchButtonText') }}
                                </button>
                            </div>
                        </div>
                        {{--<div class="col-xs-12">--}}
                            {{--<p>Có 135 dự án trong Thành phố</p>--}}
                        {{--</div>--}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    .js-basic-single {
        width: 100%;
    }
    .select2-selection__rendered{
        line-height: 25px !important;
    }
</style>
@push('js')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-basic-single').select2();
        });
        function changeReCategory(e, num) {
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
                        $('#re-type' + num).html(html);
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
                    $('#range-price'+num).html(html);
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
                    // console.log('success');
                    // console.log(result);
                    let html = '<option value="">{{trans('real-estate.selectFirstOpt')}}</option>';
                    if (result) {
                        for (let r of result) {
                            html += '<option value="'+ r.id +'">' + r.name + '</option>';
                        }
                    }
                    if (html) {
                        $('#Search_district_id').html(html);
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
                    // console.log('success');
                    // console.log(result);
                    let html = '<option value="">{{trans('real-estate.selectFirstOpt')}}</option>';
                    if (result) {
                        for (let r of result) {
                            html += '<option value="'+ r.id +'">' + r.name + '</option>';
                        }
                    }
                    if (html) {
                        $('#Search_ward_id').html(html);
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
                    // console.log('success');
                    // console.log(result);
                    let html = '';
                    if (result) {
                        for (let r of result) {
                            html += '<option value="'+ r.id +'">' + r.name + '</option>';
                        }
                    }
                    if (html) {
                        $('#Search_street_id').html(html);
                    }
                }
            });
        }
    </script>
@endpush
