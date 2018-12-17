<div class="col-xs-3 right">
    <div class="right_box2">
        <p class="title_rbox"><strong>TÌM KIẾM THEO YÊU CẦU</strong></p>
        <div class="search_form">
            <form action="{{route('smart-search')}}" method="GET">
                <div class="row">
                    <div class="col-xs-12 item">
                        <select
                            onchange=""
                            name="Search[kind_id]" id="Search_kind_id">
                            <option value="">{{trans('real-estate.ssSelectFirstCat')}}</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-12 item">
                        <select id="search_cat_id" name="Search[cat_id]">
                            <option value="">{{trans('real-estate.ssSelectFirstType')}}</option>
                        </select>
                    </div>

                    <div class="col-xs-12 item">
                        <input value="1" name="Search[province_id]" id="Search_province_id" type="hidden">
                        <select
                            name="Search[district_id]" id="Search_district_id">
                            <option value="">Tất cả quận huyện</option>
                        </select>
                    </div>

                    <div class="col-xs-12 item">
                        <select name="Search[street_id]" id="Search_street_id">
                            <option value="">Tat ca cac duong</option>
                        </select>
                    </div>

                    <div class="col-xs-12 item">
                        <select name="Search[direction_id]" id="Search_direction_id">
                            <option value="">Tất cả các hướng</option>

                        </select>
                    </div>

                    <div class="col-xs-12 item">
                        <select id="search_price_id" name="Search[price_id]">
                            <option value="">Tất cả các giá</option>
                        </select></div>

                    <div class="col-xs-12 item">
                        <input placeholder="Tìm theo số điện thoại" name="Search[mobile]" id="Search_mobile" type="text"
                               maxlength="50">
                    </div>

                    <div class="col-xs-3 item">
                        <span>DTMB từ</span>
                    </div>

                    <div class="col-xs-4 item">
                        <input size="4" maxlength="10" placeholder="vd: 40.5" name="Search[dtmb_from]"
                               id="Search_dtmb_from" type="text">
                    </div>

                    <div class="col-xs-1 item"><span> ~ </span></div>

                    <div class="col-xs-4 item">
                        <input size="4" maxlength="10" placeholder="vd: 70.5" name="Search[dtmb_to]" id="Search_dtmb_to"
                               type="text">
                    </div>

                    <div class="col-xs-12">
                        <p>
                            <button type="submit" class="_btn bg_red"><i class="fa fa-search fa-fw"></i> Tìm kiếm
                            </button>
                        </p>
                    </div>

                </div>
            </form>
        </div>
    </div>


    <div class="right_box2">
        <p class="title_rbox"><strong>TÌM KIẾM THEO DỰ ÁN</strong></p>
        <div class="search_form">
            <form action="{{route('smart-search')}}" method="GET">
                <div class="row">

                    <div class="col-xs-12 item">
                        <select name="Search[project_id]" id="Search_project_id">
                            <option value="">Tất cả các dự án, tên đường</option>
                        </select>
                    </div>

                    <div class="col-xs-12 item">
                        <select id="loday_project" name="Search[loday_id]">
                            <option value="">Tất cả các lô/dãy</option>
                        </select></div>

                    <div class="col-xs-12 item">
                        <select
                            onchange=""
                            name="Search[kind_id]" id="Search_kind_id">
                            <option value="">Loại hình bất động sản</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-xs-12 item">
                        <select id="timkiem_cat_id1" name="Search[cat_id]">
                            <option value="">Nhóm bất động sản</option>
                        </select>
                    </div>

                    <div class="col-xs-12 item">
                        <select name="Search[direction_id]" id="Search_direction_id">
                            <option value="">Tất cả các hướng</option>
                        </select>
                    </div>

                    <div class="col-xs-12 item">
                        <select id="timkiem_price_id1" name="Search[price_id]">
                            <option value="">Tất cả các giá</option>
                        </select>
                    </div>

                    <div class="col-xs-12 item">
                        <button type="submit" class="_btn bg_red"><i class="fa fa-search fa-fw"></i> Tìm kiếm</button>
                    </div>

                    <div class="col-xs-12 item"><p>Có 134 dự án trong Thành phố</p></div>

                </div>
            </form>
        </div>
    </div>
</div>
