@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Register Page" >
@endsection

@section('title')
    {{trans('real-estate.pageCreateTitle')}}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}"/>

@endsection

@section('content')
    @include(theme(TRUE).'.includes.header')

    <div class="container-vina">
        <script type="text/javascript" src="css/upload/jquery.uploadifive.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/upload/uploadifive.css">
        <script type="text/javascript" language="javascript" src="css/ckeditor/ckeditor.js"></script>

        <script type="text/javascript">
            function demKyTu(obj)
            {
                kt_toida = 150;
                giatri = $(obj).val();
                dodai = giatri.length;
                $("#save_charactor").text(kt_toida-dodai);
            }
        </script>


        <div class="row subpage">

            <!--Begin right-->
        @include(theme(TRUE).'.includes.left-menu')
        <!--End right-->

            <!--Begin left-->
            <div class="col-xs-9 right">

                <!--begin manage_page-->
                <div class="addA_land member_page">
                    <p class="title_boxM"><strong><i class="fa fa-file-pdf-o"></i> ĐĂNG TIN NHÀ ĐẤT</strong></p>
                    <div>


                        <!--begin _add_land-->
                        <div class="_form _add_land">
                            <form enctype="multipart/form-data" class="_check_validate" id="addbds-form" action="/dang-tin.htm" method="post">

                                <div class="row">
                                    <div class="col-xs-12">
                                        <dl>
                                            <dt class="txt_right">Tiêu đề tin <span class="required">*</span></dt>
                                            <dd>
                                                <input class="w100 _required" name="Land[title]" id="Land_title" type="text" maxlength="200">													                        	</dd>
                                        </dl>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-xs-12">
                                        <dl>
                                            <dt class="txt_right">Mô tả ngắn <span class="required">*</span></dt>
                                            <dd style="position: relative;">
                                                <input class="_required" maxlength="150" onkeypress="demKyTu(this);" name="Land[brief]" id="Land_brief" type="text">			                        	<p><span id="save_charactor">150</span> - (Không vượt quá 150 ký tự)</p>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-6">
                                        <dl>
                                            <dt class="txt_right">Người liên hệ <span class="required">*</span></dt>
                                            <dd>
                                                <input class="_required" name="Land[fullname]" id="Land_fullname" type="text" maxlength="50">													                        	</dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-6">
                                        <dl>
                                            <dt class="txt_right">Điện thoại liên hệ <span class="required">*</span></dt>
                                            <dd>
                                                <input class="_required" name="Land[mobile]" id="Land_mobile" type="text" maxlength="50">													                        	</dd>
                                        </dl>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <dl>
                                            <dt class="txt_right">Địa chỉ liên hệ <span class="required">*</span></dt>
                                            <dd>
                                                <input class="w100 _required" name="Land[address1]" id="Land_address1" type="text" maxlength="200">													                        	</dd>
                                        </dl>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-4">
                                        <dl>
                                            <dt class="txt_right">Danh mục <span class="required">*</span></dt>
                                            <dd>
                                                <select class=" _required" onchange="getCatPrice(this, #land_cat_id,#land_pricearea_id, /site/LoadCat)" name="Land[kind_id]" id="Land_kind_id">
                                                    <option value="">Vui lòng chọn...</option>
                                                    <option value="1">Cần bán</option>
                                                    <option value="5">Cho thuê</option>
                                                    <option value="4">Cần mua</option>
                                                    <option value="2">Cần thuê</option>
                                                </select>			                        	</dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-4">
                                        <dl>
                                            <dt class="txt_right">Loại BĐS <span class="required">*</span></dt>
                                            <dd>
                                                <select id="land_cat_id" class="_required" name="Land[cat_id]">
                                                    <option value="">Vui lòng chọn...</option>
                                                </select>			                        	</dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-4">
                                        <dl>
                                            <dt class="txt_right">Nơi rao <span class="required">*</span></dt>
                                            <dd>
                                                <select class="_required" name="Land[district_id]" id="Land_district_id">
                                                    <option value="">Vui lòng chọn...</option>
                                                    <option value="66">Lê Chân</option>
                                                    <option value="65">Ngô Quyền</option>
                                                    <option value="69">Hải An</option>
                                                    <option value="68">Hồng Bàng</option>
                                                    <option value="64">Dương Kinh</option>
                                                    <option value="76">Kiến An</option>
                                                    <option value="70">An Dương</option>
                                                    <option value="77">Cát Bà</option>
                                                    <option value="71">An Lão</option>
                                                    <option value="78">Cát Hải</option>
                                                    <option value="73">Thủy Nguyên</option>
                                                    <option value="67">Đồ Sơn</option>
                                                    <option value="72">Kiến Thụy</option>
                                                    <option value="74">Tiên Lãng</option>
                                                    <option value="75">Vĩnh Bảo</option>
                                                    <option value="79">Bạch Long Vĩ</option>
                                                    <option value="80">Quận/huyện khác</option>
                                                </select>																							                        	</dd>
                                        </dl>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <dl>
                                            <dt>Địa chỉ nhà đất <span class="required">*</span></dt>
                                            <dd>
                                                <input class="_required" name="Land[address]" id="Land_address" type="text" maxlength="200">													                        	</dd>
                                        </dl>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-4">
                                        <dl>
                                            <dt>Đường phố <span class="required">*</span></dt>
                                            <dd>
                                                <select class="_required" name="Land[street_id]" id="Land_street_id">
                                                    <option value="">Vui lòng chọn...</option>
                                                    <option value="264">An Dương</option>
                                                    <option value="193">An Kim Hải</option>
                                                    <option value="272">An Lư (Thủy Nguyên)</option>
                                                    <option value="273">An Sơn (Thủy Nguyên)</option>
                                                    <option value="23">An Đà</option>
                                                    <option value="16">Bạch Đằng</option>
                                                    <option value="249">Bãi Sậy</option>
                                                    <option value="228">Bến Láng</option>
                                                    <option value="241">Bình Kiều 1</option>
                                                    <option value="242">Bình Kiều 2</option>
                                                    <option value="227">Bùi Thị Từ Nhiên</option>
                                                    <option value="238">Cam Lộ</option>
                                                    <option value="274">Cao Nhân (Thủy Nguyên)</option>
                                                    <option value="212">Cao Thắng</option>
                                                    <option value="28">Cát Bi</option>
                                                    <option value="27">Cát Cụt</option>
                                                    <option value="226">Cát Vũ</option>
                                                    <option value="259">Cầu Bính</option>
                                                    <option value="258">Cầu Cáp</option>
                                                    <option value="2">Cầu Đất</option>
                                                    <option value="309">Chi Lăng</option>
                                                    <option value="275">Chính Mỹ (Thủy Nguyên)</option>
                                                    <option value="34">Chợ Con</option>
                                                    <option value="139">Chợ Cột Đèn</option>
                                                    <option value="188">Chợ Hàng</option>
                                                    <option value="85">Chợ Lũng</option>
                                                    <option value="129">Chợ Đôn</option>
                                                    <option value="29">Chu Văn An</option>
                                                    <option value="138">Chùa Hàng</option>
                                                    <option value="244">Cù Chính Lan</option>
                                                    <option value="230">Cựu Viên</option>
                                                    <option value="33">Dư Hàng</option>
                                                    <option value="276">Dương Quan (Thủy Nguyên)</option>
                                                    <option value="279">Gia Minh (Thủy Nguyên)</option>
                                                    <option value="278">Gia Đức (Thủy Nguyên)</option>
                                                    <option value="254">Hạ Lũng</option>
                                                    <option value="31">Hạ Lý</option>
                                                    <option value="201">Hạ Đoạn 1</option>
                                                    <option value="202">Hạ Đoạn 2</option>
                                                    <option value="203">Hạ Đoạn 3</option>
                                                    <option value="204">Hạ Đoạn 4</option>
                                                    <option value="41">Hai Bà Trưng (Cát Dài)</option>
                                                    <option value="144">Hàm Nghi</option>
                                                    <option value="47">Hàng Kênh</option>
                                                    <option value="237">Hào Khê (Cát Bi)</option>
                                                    <option value="106">Hào Khê (Lạch Tray)</option>
                                                    <option value="26">Hồ Sen</option>
                                                    <option value="222">Hồ Đông (Hoàng Thế Thiện)</option>
                                                    <option value="280">Hòa Bình (Thủy Nguyên)</option>
                                                    <option value="281">Hoa Động (Thủy Nguyên)</option>
                                                    <option value="243">Hoàng Công Khanh</option>
                                                    <option value="126">Hoàng Minh Thảo</option>
                                                    <option value="116">Hoàng Ngọc Phách</option>
                                                    <option value="136">Hoàng Quý</option>
                                                    <option value="18">Hoàng Văn Thụ</option>
                                                    <option value="282">Hoàng Động (Thủy Nguyên)</option>
                                                    <option value="283">Hợp Thành (Thủy Nguyên)</option>
                                                    <option value="155">Hùng Duệ Vương</option>
                                                    <option value="149">Hùng Vương</option>
                                                    <option value="114">Kênh Dương</option>
                                                    <option value="284">Kênh Giang (Thủy Nguyên)</option>
                                                    <option value="121">Khúc Thừa Dụ</option>
                                                    <option value="123">Khúc Thừa Dụ 2</option>
                                                    <option value="285">Kiền Bái (Thủy Nguyên)</option>
                                                    <option value="251">Kiều Hạ</option>
                                                    <option value="110">Kiều Sơn</option>
                                                    <option value="286">Kỳ Sơn (Thủy Nguyên)</option>
                                                    <option value="32">Kỳ Đồng</option>
                                                    <option value="19">Lạch Tray</option>
                                                    <option value="287">Lại Xuân (Thủy Nguyên)</option>
                                                    <option value="35">Lam Sơn</option>
                                                    <option value="137">Lâm Tường</option>
                                                    <option value="288">Lâm Động (Thủy Nguyên)</option>
                                                    <option value="36">Lán Bè</option>
                                                    <option value="40">Lãn Ông</option>
                                                    <option value="289">Lập Lễ (Thủy Nguyên)</option>
                                                    <option value="46">Lê Chân</option>
                                                    <option value="178">Lê Duẩn (CAMEN)</option>
                                                    <option value="1">Lê Hồng Phong</option>
                                                    <option value="43">Lê Lai</option>
                                                    <option value="52">Lê Lợi</option>
                                                    <option value="263">Lê Quốc Uy</option>
                                                    <option value="260">Lê Quýnh</option>
                                                    <option value="44">Lê Thánh Tông</option>
                                                    <option value="217">Lê Văn Thuyết</option>
                                                    <option value="39">Lê Đại Hành</option>
                                                    <option value="290">Liên Khê (Thủy Nguyên)</option>
                                                    <option value="95">Lực Hành</option>
                                                    <option value="87">Lũng Bắc</option>
                                                    <option value="91">Lũng Đông</option>
                                                    <option value="55">Lương Khánh Thiện</option>
                                                    <option value="291">Lưu Kiếm (Thủy Nguyên)</option>
                                                    <option value="292">Lưu Kỳ (Thủy Nguyên)</option>
                                                    <option value="45">Lý Thường Kiệt</option>
                                                    <option value="8">Lý Tự Trọng</option>
                                                    <option value="218">Mạc Đăng Doanh</option>
                                                    <option value="271">Mai Trung Thứ</option>
                                                    <option value="77">Máy Tơ</option>
                                                    <option value="73">Mê Linh</option>
                                                    <option value="48">Miếu Hai Xã</option>
                                                    <option value="20">Minh Khai</option>
                                                    <option value="294">Minh Tân (Thủy Nguyên)</option>
                                                    <option value="293">Minh Đức (Thủy Nguyên)</option>
                                                    <option value="295">Mỹ Đồng (Thủy Nguyên)</option>
                                                    <option value="262">Nam Pháp</option>
                                                    <option value="92">Ngô Gia Tự</option>
                                                    <option value="112">Ngô Kim Tài</option>
                                                    <option value="234">Ngô Quyền</option>
                                                    <option value="296">Ngũ Lão (Thủy Nguyên)</option>
                                                    <option value="111">Nguyễn Bình</option>
                                                    <option value="83">Nguyễn Bỉnh Khiêm</option>
                                                    <option value="134">Nguyễn Công Hòa</option>
                                                    <option value="194">Nguyễn Công Trứ</option>
                                                    <option value="142">Nguyên Hồng</option>
                                                    <option value="156">Nguyễn Hồng Quân</option>
                                                    <option value="219">Nguyễn Hữu Cầu</option>
                                                    <option value="50">Nguyễn Hữu Tuệ</option>
                                                    <option value="75">Nguyễn Khuyến</option>
                                                    <option value="181">Nguyễn Lương Bằng</option>
                                                    <option value="117">Nguyễn Tất Tố</option>
                                                    <option value="105">Nguyễn Thị Thuận</option>
                                                    <option value="53">Nguyễn Trãi</option>
                                                    <option value="246">Nguyễn Tường Loan</option>
                                                    <option value="256">Nguyễn Văn Hới</option>
                                                    <option value="82">Nguyễn Văn Linh</option>
                                                    <option value="214">Nguyễn Đồn</option>
                                                    <option value="11">Nguyễn Đức Cảnh</option>
                                                    <option value="297">Núi Đèo (thị trấn)</option>
                                                    <option value="298">Phả Lễ (Thủy Nguyên)</option>
                                                    <option value="130">Phạm Hữu Điều</option>
                                                    <option value="247">Phạm Huy Thông</option>
                                                    <option value="13">Phạm Minh Đức</option>
                                                    <option value="159">Phạm Phú Thứ</option>
                                                    <option value="240">Phạm Tử Nghi</option>
                                                    <option value="108">Phạm Văn Đồng</option>
                                                    <option value="65">Phan Bội Châu</option>
                                                    <option value="64">Phan Chu Trinh</option>
                                                    <option value="184">Phan Đăng Lưu</option>
                                                    <option value="51">Phố Cấm</option>
                                                    <option value="233">Phó Đức Chính</option>
                                                    <option value="299">Phù Ninh (Thủy Nguyên)</option>
                                                    <option value="235">Phủ Thượng Đoạn</option>
                                                    <option value="231">Phú Xá</option>
                                                    <option value="300">Phục Lễ (Thủy Nguyên) </option>
                                                    <option value="4">Phương Lưu</option>
                                                    <option value="5">Phương Lưu 2</option>
                                                    <option value="113">Quán Nam</option>
                                                    <option value="301">Quảng Thanh (Thủy Nguyên)</option>
                                                    <option value="60">Quang Trung</option>
                                                    <option value="223">Quang Đàm</option>
                                                    <option value="183">Quy Tức</option>
                                                    <option value="302">Tam Hưng (Thủy Nguyên)</option>
                                                    <option value="303">Tân Dương (Thủy Nguyên)</option>
                                                    <option value="164">Tân Hà</option>
                                                    <option value="225">Tây Sơn</option>
                                                    <option value="102">Thành Tô</option>
                                                    <option value="250">Thất Khê</option>
                                                    <option value="236">Thế Lữ</option>
                                                    <option value="304">Thiên Hương (Thủy Nguyên)</option>
                                                    <option value="17">Thiên Lôi</option>
                                                    <option value="207">Thư Trung</option>
                                                    <option value="306">Thủy Sơn (Thủy Nguyên)</option>
                                                    <option value="307">Thủy Triều (Thủy Nguyên)</option>
                                                    <option value="305">Thủy Đường (Thủy Nguyên)</option>
                                                    <option value="90">Tiền Phong</option>
                                                    <option value="3">Tô Hiệu</option>
                                                    <option value="140">Tôn Đức Thắng</option>
                                                    <option value="118">Trại Lẻ</option>
                                                    <option value="210">Trần Bình Trọng</option>
                                                    <option value="221">Trần Hoàn</option>
                                                    <option value="59">Trần Hưng Đạo</option>
                                                    <option value="54">Trần Khánh Dư</option>
                                                    <option value="177">Trần Kiên</option>
                                                    <option value="66">Trần Nguyên Hãn</option>
                                                    <option value="245">Trần Nhân Tông</option>
                                                    <option value="58">Trần Phú</option>
                                                    <option value="61">Trần Quang Khải</option>
                                                    <option value="257">Trần Tất Văn</option>
                                                    <option value="185">Trần Thành Ngọ</option>
                                                    <option value="255">Trần Văn Lan</option>
                                                    <option value="266">Tràng Cát</option>
                                                    <option value="124">Trực Cát</option>
                                                    <option value="308">Trung Hà (Thủy Nguyên)</option>
                                                    <option value="94">Trung Hành</option>
                                                    <option value="93">Trung Lực</option>
                                                    <option value="163">Trường Chinh</option>
                                                    <option value="229">Trương Văn Lực</option>
                                                    <option value="104">Văn Cao</option>
                                                    <option value="232">Vạn Kiếp</option>
                                                    <option value="6">Vĩnh Lưu</option>
                                                    <option value="187">Vĩnh Tiến</option>
                                                    <option value="120">Võ Nguyên Giáp</option>
                                                    <option value="267">Võ Thị Sáu</option>
                                                    <option value="131">Vũ Chí Thắng</option>
                                                    <option value="30">Đà Nẵng</option>
                                                    <option value="190">Đại Học Dân Lập</option>
                                                    <option value="141">Đại lộ Tôn Đức Thắng</option>
                                                    <option value="88">Đằng Hải</option>
                                                    <option value="115">Đặng Ma La</option>
                                                    <option value="119">Đào Nhuận</option>
                                                    <option value="7">Điện Biên Phủ</option>
                                                    <option value="248">Đinh Nhu</option>
                                                    <option value="14">Đinh Tiên Hoàng</option>
                                                    <option value="42">Đình Đông</option>
                                                    <option value="9">Đoạn Xá</option>
                                                    <option value="145">Đội Văn</option>
                                                    <option value="97">Đông An</option>
                                                    <option value="25">Đồng Hòa</option>
                                                    <option value="37">Đông Khê</option>
                                                    <option value="277">Đông Sơn (Thủy Nguyên)</option>
                                                    <option value="252">Đồng Thiện</option>
                                                    <option value="191">Đông Trà</option>
                                                    <option value="253">Đồng Xá</option>
                                                    <option value="224">Đường 208</option>
                                                    <option value="268">Đường 351</option>
                                                    <option value="265">Đường 356</option>
                                                    <option value="239">Đường bao Trần Hưng Đạo</option>
                                                    <option value="122">Đường Máng Nước</option>
                                                    <option value="270">Đường Tam Bạc</option>
                                                    <option value="195">Đường Vòng Cầu Niệm</option>
                                                    <option value="81">Đường Vòng Vạn Mỹ</option>
                                                    <option value="269">Đường World Bank</option>
                                                    <option value="213">Đường khác chưa nạp vào danh sách</option>
                                                </select>													                        	</dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-4">
                                        <dl>
                                            <dt>Hướng <span class="required">*</span></dt>
                                            <dd>
                                                <select class="_required" name="Land[direction_id]" id="Land_direction_id">
                                                    <option value="">Vui lòng chọn...</option>
                                                    <option value="16">Tây Tây Bắc</option>
                                                    <option value="18">Tây Tây Nam</option>
                                                    <option value="15">Đông Đông Bắc</option>
                                                    <option value="17">Đông Đông Nam</option>
                                                    <option value="1">Đông</option>
                                                    <option value="5">Tây</option>
                                                    <option value="2">Nam</option>
                                                    <option value="3">Bắc</option>
                                                    <option value="8">Đông Bắc</option>
                                                    <option value="4">Đông Nam</option>
                                                    <option value="7">Tây Bắc</option>
                                                    <option value="6">Tây Nam</option>
                                                    <option value="11">Bắc Đông Bắc</option>
                                                    <option value="10">Bắc Tây Bắc</option>
                                                    <option value="9">Nam Đông Nam</option>
                                                    <option value="13">Nam Tây Nam</option>
                                                    <option value="12">Liên hệ</option>
                                                    <option value="19">Đông ghé Bắc</option>
                                                    <option value="20">Bắc ghé Đông</option>
                                                    <option value="21">Đông ghé Nam</option>
                                                    <option value="22">Nam ghé Đông</option>
                                                    <option value="23">Nam ghé Tây</option>
                                                    <option value="24">Tây ghé Nam</option>
                                                    <option value="25">Tây ghé Bắc</option>
                                                    <option value="26">Bắc ghé Tây</option>
                                                    <option value="28">Tây Tứ Trạch (Tây, Tây Bắc, Tây Nam, Đông Bắc)</option>
                                                    <option value="27">Đông Tứ Trạch (Bắc, Đông, Nam, Đông Nam)</option>
                                                </select>													                        	</dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-4">
                                        <dl>
                                            <dt>Giấy tờ <span class="required">*</span></dt>
                                            <dd>
                                                <select class="_required" name="Land[status_id]" id="Land_status_id">
                                                    <option value="">Vui lòng chọn...</option>
                                                    <option value="1">Sổ đỏ Chính Chủ</option>
                                                    <option value="3">Sổ hồng Chính Chủ</option>
                                                    <option value="4">Sổ hồng Chính Chủ 2 quyền</option>
                                                    <option value="2">Chính Chủ</option>
                                                    <option value="5">Hợp đồng Dự án Chính Chủ</option>
                                                    <option value="6">Hợp lệ</option>
                                                    <option value="7">Trích đo</option>
                                                    <option value="8">Viết tay</option>
                                                    <option value="9">Hồ sơ thanh lý</option>
                                                    <option value="10">Liên hệ</option>
                                                </select>													                        	</dd>
                                        </dl>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-xs-4">
                                        <dl>
                                            <dt>Dự án <span class="required">*</span></dt>
                                            <dd>
                                                <select class="_required" name="Land[project]" id="Land_project">
                                                    <option value="">Vui lòng chọn...</option>
                                                    <option value="157">Khu Đô Thị Bắc Sông Cấm</option>
                                                    <option value="158">KĐT Quang Minh Green City</option>
                                                </select>
                                            </dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-4">
                                        <dl>
                                            <dt>Lô/Dãy</dt>
                                            <dd>
                                                <select id="ddl_loday" name="Land[loday_id]">
                                                    <option value="">Vui lòng chọn...</option>
                                                    <option value="1">Lô 1</option>
                                                </select>
                                            </dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-4">
                                        <dl>
                                            <dt>Kiểu xây</dt>
                                            <dd>
                                                <select name="Land[type_id]" id="Land_type_id">
                                                    <option value="">Vui lòng chọn...</option>
                                                    <option value="2">Xây liền kề</option>
                                                    <option value="3">Xây độc lập</option>
                                                </select>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-4">
                                        <dl>
                                            <dt>Chiều rộng</dt>
                                            <dd>
                                                <input name="Land[width]" id="Land_width" type="text" maxlength="50">														                        	</dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-4">
                                        <dl>
                                            <dt>Chiều dài</dt>
                                            <dd>
                                                <input name="Land[length]" id="Land_length" type="text" maxlength="50">													                        	</dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-4">
                                        <dl>
                                            <dt>Số ph.ngủ</dt>
                                            <dd>
                                                <input name="Land[bedroom]" id="Land_bedroom" type="text">													                        	</dd>
                                        </dl>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-4">
                                        <dl>
                                            <dt>DTMB <span class="required">*</span></dt>
                                            <dd>
                                                <input class="_required" name="Land[dtmb]" id="Land_dtmb" type="text">														                        	</dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-4">
                                        <dl>
                                            <dt>DTSD</dt>
                                            <dd>
                                                <input name="Land[dtsd]" id="Land_dtsd" type="text" maxlength="50">													                        	</dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-4">
                                        <dl>
                                            <dt>Số tầng</dt>
                                            <dd>
                                                <input name="Land[floor]" id="Land_floor" type="text" maxlength="50">														                        	</dd>
                                        </dl>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-xs-4">
                                        <dl>
                                            <dt>Giá</dt>
                                            <dd>
                                                <input class="w150" onkeyup="addCommas(this)" onkeypress="onlyNum()" autocomplete="off" name="Land[price]" id="Land_price" type="text" maxlength="20">				                        					                        	<p>
                                                    <input id="ytLand_thoathuan" type="hidden" value="0" name="Land[thoathuan]"><input name="Land[thoathuan]" id="Land_thoathuan" value="1" type="checkbox">					                        	<label for="Land_thoathuan">Có thỏa thuận</label>				                        	</p>
                                            </dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-4">
                                        <dl>
                                            <dt>Đơn vị</dt>
                                            <dd>
                                                <select class="_required" name="Land[unit_id]" id="Land_unit_id">
                                                    <option value="">Đơn vị</option>
                                                    <option value="1">VND</option>
                                                    <option value="2">USD</option>
                                                    <option value="3">LƯỢNG SGC</option>
                                                    <option value="4">VND/M2</option>
                                                    <option value="5">USD/M2</option>
                                                    <option value="6">VND/Tháng</option>
                                                    <option value="7">USD/THÁNG</option>
                                                </select>													                        	</dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-4">
                                        <dl>
                                            <dt>Khoảng giá</dt>
                                            <dd>
                                                <select id="land_pricearea_id" class="_required" name="Land[price_area_id]">
                                                    <option value="">Vui lòng chọn...</option>
                                                </select>													                        	</dd>
                                        </dl>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-6">
                                        <dl>
                                            <dt>Ngày đăng <span class="required">*</span></dt>
                                            <dd>
                                                <div><input class="_required" name="Land[created_date]" id="Land_created_date" type="text" value="2018-11-10 17:00:43">											</div>
                                            </dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-6">
                                        <dl>
                                            <dt>Ngày hết hạn</dt>
                                            <dd>
                                                <div><input id="datepicker-example1" class="_required" name="Land[expired_date]" type="text" readonly="readonly"><button type="button" class="Zebra_DatePicker_Icon Zebra_DatePicker_Icon_Inside" style="margin-left: -19px; margin-top: 7px;">Pick a date</button>											</div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>

                                <dl>
                                    <dt>Tải ảnh lên</dt>
                                    <dd>
                                        <div class="value box_image_product" style="border: 1px solid #ddd;">
                                            <input value="1541844044" name="Land[img_str]" id="Land_img_str" type="hidden">										<div id="queue">Chọn nhiều ảnh để thêm</div>
                                            <div id="uploadifive-file_upload" class="uploadifive-button" style="height: 30px; line-height: 30px; overflow: hidden; position: relative; text-align: center; width: 100px;">Chọn ảnh<input id="file_upload" name="file_upload" type="file" multiple="true" style="display: none;"><input type="file" style="font-size: 30px; opacity: 0; position: absolute; right: -3px; top: -3px; z-index: 999;" multiple="multiple"></div>

                                            <ul id="list_images">
                                            </ul>
                                            <script type="text/javascript">
                                                $(function() {

                                                    $('#file_upload').uploadifive({
                                                        'auto'             : true,
                                                        'formData'         : {
                                                            'timestamp' : '1541844044',
                                                            'token'     : '67e302525a3e5acbc19dea9d7358db3e',
                                                            'pid'		: '1541844044'
                                                        },
                                                        'queueID'          : 'queue',
                                                        'uploadScript'     : '/attachment/uploadImg',
                                                        'onUploadComplete' : function(file, data) {
                                                            if (data != '0')
                                                            {
                                                                str_li = '<li>' + data + '<a class="fa fa-times fa-2x" onclick="deleteImage(this); return false;"></a><label><input type="radio" name="default_img" onchange="changeDefault(this);" />Mặc định</label></li>';
                                                                $('#list_images').prepend(str_li);
                                                            }
                                                            else
                                                            {
                                                                alert(data);
                                                            }
                                                        }
                                                    });

                                                });

                                                function changeDefault(obj)
                                                {
                                                    id_img = $(obj).parents('li').children('img').attr('alt');
                                                    $.ajax({
                                                        method: "GET",
                                                        url: "/attachment/UpdateDefault",
                                                        data: {atta_id: id_img},
                                                        success: function(result) {
                                                            if(result == "0")
                                                                alert("Thiết lập ảnh mặc định không thành công");
                                                        }
                                                    });
                                                }

                                                function deleteImage(obj)
                                                {
                                                    id_img = $(obj).prev().attr('alt');
                                                    parent_li = $(obj).parent();
                                                    $.ajax({
                                                        method: "GET",
                                                        url: "/attachment/UpdateDelete",
                                                        data: {atta_id: id_img},
                                                        success: function(result) {
                                                            if(result == "1")
                                                            {
                                                                parent_li.remove();
                                                            }
                                                        }
                                                    });
                                                }
                                            </script>

                                            <div class="clearfix"></div>
                                        </div>
                                    </dd>
                                </dl>
                                <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBFmVtGqvNTqOk6vRBbD2mSG5Xi9qQ7kmk&amp;language=vi"></script>
                                <script type="text/javascript">
                                    function initialize()
                                    {
                                        var coor = new google.maps.LatLng(20.856923, 106.681817);
                                        var my_options = {
                                            center: coor,
                                            zoom: 12,
                                            mapTypeId: google.maps.MapTypeId.ROADMAP,
                                            mapTypeControl: true,
                                            navigationControl: true,
                                            navigationControlOptions: {
                                                style: google.maps.NavigationControlStyle.SMALL
                                            }
                                        };

                                        var map = new google.maps.Map(document.getElementById("map_box"), my_options);
                                        var marker = new google.maps.Marker({
                                            position: coor,
                                            map: map,
                                            draggable: true,
                                        });

                                        google.maps.event.addListener(marker, "dragend", function() {
                                            vt_point = marker.getPosition();
                                            str_vt = vt_point.lat() + ', ' + vt_point.lng();
                                            $('#set_map input[type="text"]').val(str_vt);
                                        });

                                    }

                                    google.maps.event.addDomListener(window, 'load', initialize);
                                </script>

                                <dl>
                                    <dt>Bản đồ</dt>
                                    <dd id="set_map">
                                        <input class="w100" name="Land[map]" id="Land_map" type="text" maxlength="200">																<p style="margin: 5px 0;"><em>(Nhấn và kéo điểm màu đỏ đến vị trí Bất động sản của bạn)</em></p>
                                        <div id="map_box" style="width: 100%; height: 250px; position: relative; overflow: hidden;"><div style="height: 100%; width: 100%; position: absolute; top: 0px; left: 0px; background-color: rgb(229, 227, 223);"><div class="gm-style" style="position: absolute; z-index: 0; left: 0px; top: 0px; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px;"><div tabindex="0" style="position: absolute; z-index: 0; left: 0px; top: 0px; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; cursor: url(&quot;http://maps.gstatic.com/mapfiles/openhand_8_8.cur&quot;), default; touch-action: pan-x pan-y;"><div style="z-index: 1; position: absolute; left: 50%; top: 50%; width: 100%; transform: translate(0px, 0px);"><div style="position: absolute; left: 0px; top: 0px; z-index: 100; width: 100%;"><div style="position: absolute; left: 0px; top: 0px; z-index: 0;"><div style="position: absolute; z-index: 988; transform: matrix(1, 0, 0, 1, -205, -70);"><div style="position: absolute; left: 256px; top: 0px; width: 256px; height: 256px;"><div style="width: 256px; height: 256px;"></div></div><div style="position: absolute; left: 0px; top: 0px; width: 256px; height: 256px;"><div style="width: 256px; height: 256px;"></div></div><div style="position: absolute; left: 0px; top: -256px; width: 256px; height: 256px;"><div style="width: 256px; height: 256px;"></div></div><div style="position: absolute; left: 256px; top: -256px; width: 256px; height: 256px;"><div style="width: 256px; height: 256px;"></div></div><div style="position: absolute; left: 512px; top: -256px; width: 256px; height: 256px;"><div style="width: 256px; height: 256px;"></div></div><div style="position: absolute; left: 512px; top: 0px; width: 256px; height: 256px;"><div style="width: 256px; height: 256px;"></div></div><div style="position: absolute; left: -256px; top: 0px; width: 256px; height: 256px;"><div style="width: 256px; height: 256px;"></div></div><div style="position: absolute; left: -256px; top: -256px; width: 256px; height: 256px;"><div style="width: 256px; height: 256px;"></div></div></div></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 101; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 102; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 103; width: 100%;"><div style="width: 27px; height: 43px; overflow: hidden; position: absolute; left: -14px; top: -43px; z-index: 0;"><img alt="" src="http://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi2.png" draggable="false" style="position: absolute; left: 0px; top: 0px; width: 27px; height: 43px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: -1;"><div style="position: absolute; z-index: 988; transform: matrix(1, 0, 0, 1, -205, -70);"><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 256px; top: 0px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 0px; top: 0px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 0px; top: -256px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 256px; top: -256px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 512px; top: -256px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 512px; top: 0px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: -256px; top: 0px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: -256px; top: -256px;"></div></div></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 0;"><div style="position: absolute; z-index: 988; transform: matrix(1, 0, 0, 1, -205, -70);"><div style="position: absolute; left: 256px; top: -256px; width: 256px; height: 256px; transition: opacity 200ms linear 0s;"><img draggable="false" alt="" role="presentation" src="http://maps.google.com/maps/vt?pb=!1m5!1m4!1i12!2i3262!3i1804!4i256!2m3!1e0!2sm!3i443148358!2m3!1e2!6m1!3e5!3m14!2svi!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcC5zOi02MHxwLmw6LTYw!4e0!23i1301875&amp;key=AIzaSyBFmVtGqvNTqOk6vRBbD2mSG5Xi9qQ7kmk&amp;token=3718" style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div><div style="position: absolute; left: 0px; top: -256px; width: 256px; height: 256px; transition: opacity 200ms linear 0s;"><img draggable="false" alt="" role="presentation" src="http://maps.google.com/maps/vt?pb=!1m5!1m4!1i12!2i3261!3i1804!4i256!2m3!1e0!2sm!3i443148358!2m3!1e2!6m1!3e5!3m14!2svi!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcC5zOi02MHxwLmw6LTYw!4e0!23i1301875&amp;key=AIzaSyBFmVtGqvNTqOk6vRBbD2mSG5Xi9qQ7kmk&amp;token=58742" style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div><div style="position: absolute; left: 512px; top: -256px; width: 256px; height: 256px; transition: opacity 200ms linear 0s;"><img draggable="false" alt="" role="presentation" src="http://maps.google.com/maps/vt?pb=!1m5!1m4!1i12!2i3263!3i1804!4i256!2m3!1e0!2sm!3i443148358!2m3!1e2!6m1!3e5!3m14!2svi!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcC5zOi02MHxwLmw6LTYw!4e0!23i1301875&amp;key=AIzaSyBFmVtGqvNTqOk6vRBbD2mSG5Xi9qQ7kmk&amp;token=79765" style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div><div style="position: absolute; left: 256px; top: 0px; width: 256px; height: 256px; transition: opacity 200ms linear 0s;"><img draggable="false" alt="" role="presentation" src="http://maps.google.com/maps/vt?pb=!1m5!1m4!1i12!2i3262!3i1805!4i256!2m3!1e0!2sm!3i443148358!2m3!1e2!6m1!3e5!3m14!2svi!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcC5zOi02MHxwLmw6LTYw!4e0!23i1301875&amp;key=AIzaSyBFmVtGqvNTqOk6vRBbD2mSG5Xi9qQ7kmk&amp;token=41504" style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div><div style="position: absolute; left: 512px; top: 0px; width: 256px; height: 256px; transition: opacity 200ms linear 0s;"><img draggable="false" alt="" role="presentation" src="http://maps.google.com/maps/vt?pb=!1m5!1m4!1i12!2i3263!3i1805!4i256!2m3!1e0!2sm!3i443148358!2m3!1e2!6m1!3e5!3m14!2svi!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcC5zOi02MHxwLmw6LTYw!4e0!23i1301875&amp;key=AIzaSyBFmVtGqvNTqOk6vRBbD2mSG5Xi9qQ7kmk&amp;token=117551" style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div><div style="position: absolute; left: -256px; top: 0px; width: 256px; height: 256px; transition: opacity 200ms linear 0s;"><img draggable="false" alt="" role="presentation" src="http://maps.google.com/maps/vt?pb=!1m5!1m4!1i12!2i3260!3i1805!4i256!2m3!1e0!2sm!3i443148334!2m3!1e2!6m1!3e5!3m14!2svi!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcC5zOi02MHxwLmw6LTYw!4e0!23i1301875&amp;key=AIzaSyBFmVtGqvNTqOk6vRBbD2mSG5Xi9qQ7kmk&amp;token=33973" style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div><div style="position: absolute; left: 0px; top: 0px; width: 256px; height: 256px; transition: opacity 200ms linear 0s;"><img draggable="false" alt="" role="presentation" src="http://maps.google.com/maps/vt?pb=!1m5!1m4!1i12!2i3261!3i1805!4i256!2m3!1e0!2sm!3i443148358!2m3!1e2!6m1!3e5!3m14!2svi!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcC5zOi02MHxwLmw6LTYw!4e0!23i1301875&amp;key=AIzaSyBFmVtGqvNTqOk6vRBbD2mSG5Xi9qQ7kmk&amp;token=96528" style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div><div style="position: absolute; left: -256px; top: -256px; width: 256px; height: 256px; transition: opacity 200ms linear 0s;"><img draggable="false" alt="" role="presentation" src="http://maps.google.com/maps/vt?pb=!1m5!1m4!1i12!2i3260!3i1804!4i256!2m3!1e0!2sm!3i443148334!2m3!1e2!6m1!3e5!3m14!2svi!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcC5zOi02MHxwLmw6LTYw!4e0!23i1301875&amp;key=AIzaSyBFmVtGqvNTqOk6vRBbD2mSG5Xi9qQ7kmk&amp;token=127258" style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div></div></div></div><div class="gm-style-pbc" style="z-index: 2; position: absolute; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; left: 0px; top: 0px; opacity: 0;"><p class="gm-style-pbt"></p></div><div style="z-index: 3; position: absolute; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; left: 0px; top: 0px; touch-action: pan-x pan-y;"><div style="z-index: 4; position: absolute; left: 50%; top: 50%; width: 100%; transform: translate(0px, 0px);"><div style="position: absolute; left: 0px; top: 0px; z-index: 104; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 105; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 106; width: 100%;"><div style="width: 27px; height: 43px; overflow: hidden; position: absolute; opacity: 0; touch-action: none; left: -14px; top: -43px; z-index: 0;"><img alt="" src="http://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi2.png" draggable="false" usemap="#gmimap0" style="position: absolute; left: 0px; top: 0px; width: 27px; height: 43px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"><map name="gmimap0" id="gmimap0"><area log="miw" coords="13.5,0,4,3.75,0,13.5,13.5,43,27,13.5,23,3.75" shape="poly" title="" style="cursor: pointer; touch-action: none;"></map></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 107; width: 100%;"></div></div></div></div><iframe aria-hidden="true" frameborder="0" style="z-index: -1; position: absolute; width: 100%; height: 100%; top: 0px; left: 0px; border: none;" src="about:blank"></iframe><div style="margin-left: 5px; margin-right: 5px; z-index: 1000000; position: absolute; left: 0px; bottom: 0px;"><a target="_blank" rel="noopener" href="https://maps.google.com/maps?ll=20.856923,106.681817&amp;z=12&amp;t=m&amp;hl=vi&amp;gl=US&amp;mapclient=apiv3" title="Nhấp để xem khu vực này trên Google Maps" style="position: static; overflow: visible; float: none; display: inline;"><div style="width: 66px; height: 26px; cursor: pointer;"><img alt="" src="http://maps.gstatic.com/mapfiles/api-3/images/google4.png" draggable="false" style="position: absolute; left: 0px; top: 0px; width: 66px; height: 26px; user-select: none; border: 0px; padding: 0px; margin: 0px;"></div></a></div><div style="background-color: white; padding: 15px 21px; border: 1px solid rgb(171, 171, 171); font-family: Roboto, Arial, sans-serif; color: rgb(34, 34, 34); box-sizing: border-box; box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 16px; z-index: 10000002; display: none; width: 300px; height: 180px; position: absolute; left: 209px; top: 35px;"><div style="padding: 0px 0px 10px; font-size: 16px;">Dữ liệu Bản đồ</div><div style="font-size: 13px;">Dữ liệu bản đồ ©2018 Google</div><button draggable="false" title="Close" aria-label="Close" type="button" class="gm-ui-hover-effect" style="background: none; display: block; border: 0px; margin: 0px; padding: 0px; position: absolute; cursor: pointer; user-select: none; top: 0px; right: 0px; width: 37px; height: 37px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224px%22%20height%3D%2224px%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22%23000000%22%3E%0A%20%20%20%20%3Cpath%20d%3D%22M19%206.41L17.59%205%2012%2010.59%206.41%205%205%206.41%2010.59%2012%205%2017.59%206.41%2019%2012%2013.41%2017.59%2019%2019%2017.59%2013.41%2012z%22%2F%3E%0A%20%20%20%20%3Cpath%20d%3D%22M0%200h24v24H0z%22%20fill%3D%22none%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="pointer-events: none; display: block; width: 13px; height: 13px; margin: 12px;"></button></div><div class="gmnoprint" style="z-index: 1000001; position: absolute; right: 215px; bottom: 0px; width: 143px;"><div draggable="false" class="gm-style-cc" style="user-select: none; height: 14px; line-height: 14px;"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right; vertical-align: middle; display: inline-block;"><a style="text-decoration: none; cursor: pointer; display: none;">Dữ liệu Bản đồ</a><span>Dữ liệu bản đồ ©2018 Google</span></div></div></div><div class="gmnoscreen" style="position: absolute; right: 0px; bottom: 0px;"><div style="font-family: Roboto, Arial, sans-serif; font-size: 11px; color: rgb(68, 68, 68); direction: ltr; text-align: right; background-color: rgb(245, 245, 245);">Dữ liệu bản đồ ©2018 Google</div></div><div class="gmnoprint gm-style-cc" draggable="false" style="z-index: 1000001; user-select: none; height: 14px; line-height: 14px; position: absolute; right: 115px; bottom: 0px;"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right; vertical-align: middle; display: inline-block;"><a href="https://www.google.com/intl/vi_US/help/terms_maps.html" target="_blank" rel="noopener" style="text-decoration: none; cursor: pointer; color: rgb(68, 68, 68);">Điều khoản sử dụng</a></div></div><button draggable="false" title="Chuyển đổi chế độ xem toàn màn hình" aria-label="Chuyển đổi chế độ xem toàn màn hình" type="button" class="gm-control-active gm-fullscreen-control" style="background: none rgb(255, 255, 255); border: 0px; margin: 10px; padding: 0px; position: absolute; cursor: pointer; user-select: none; border-radius: 2px; height: 40px; width: 40px; box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; overflow: hidden; top: 0px; right: 0px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218%22%20height%3D%2218%22%20viewBox%3D%220%20018%2018%22%3E%0A%20%20%3Cpath%20fill%3D%22%23666%22%20d%3D%22M0%2C0v2v4h2V2h4V0H2H0z%20M16%2C0h-4v2h4v4h2V2V0H16z%20M16%2C16h-4v2h4h2v-2v-4h-2V16z%20M2%2C12H0v4v2h2h4v-2H2V12z%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px; margin: 11px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218%22%20height%3D%2218%22%20viewBox%3D%220%200%2018%2018%22%3E%0A%20%20%3Cpath%20fill%3D%22%23333%22%20d%3D%22M0%2C0v2v4h2V2h4V0H2H0z%20M16%2C0h-4v2h4v4h2V2V0H16z%20M16%2C16h-4v2h4h2v-2v-4h-2V16z%20M2%2C12H0v4v2h2h4v-2H2V12z%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px; margin: 11px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218%22%20height%3D%2218%22%20viewBox%3D%220%200%2018%2018%22%3E%0A%20%20%3Cpath%20fill%3D%22%23111%22%20d%3D%22M0%2C0v2v4h2V2h4V0H2H0z%20M16%2C0h-4v2h4v4h2V2V0H16z%20M16%2C16h-4v2h4h2v-2v-4h-2V16z%20M2%2C12H0v4v2h2h4v-2H2V12z%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px; margin: 11px;"></button><div draggable="false" class="gm-style-cc" style="user-select: none; height: 14px; line-height: 14px; position: absolute; right: 0px; bottom: 0px;"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right; vertical-align: middle; display: inline-block;"><a target="_blank" rel="noopener" title="Báo cáo lỗi trong bản đồ đường hoặc hình ảnh đến Google" href="https://www.google.com/maps/@20.856923,106.681817,12z/data=!10m1!1e1!12b1?source=apiv3&amp;rapsrc=apiv3" style="font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); text-decoration: none; position: relative;">Báo cáo một lỗi bản đồ</a></div></div><div class="gmnoprint gm-bundled-control gm-bundled-control-on-bottom" draggable="false" controlwidth="40" controlheight="81" style="margin: 10px; user-select: none; position: absolute; bottom: 95px; right: 40px;"><div class="gmnoprint" controlwidth="40" controlheight="81" style="position: absolute; left: 0px; top: 0px;"><div draggable="false" style="user-select: none; box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; border-radius: 2px; cursor: pointer; background-color: rgb(255, 255, 255); width: 40px; height: 81px;"><button draggable="false" title="Phóng to" aria-label="Phóng to" type="button" class="gm-control-active" style="background: none; display: block; border: 0px; margin: 0px; padding: 0px; position: relative; cursor: pointer; user-select: none; overflow: hidden; width: 40px; height: 40px; top: 0px; left: 0px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218%22%20height%3D%2218%22%20viewBox%3D%220%200%2018%2018%22%3E%0A%20%20%3Cpolygon%20fill%3D%22%23666%22%20points%3D%2218%2C7%2011%2C7%2011%2C0%207%2C0%207%2C7%200%2C7%200%2C11%207%2C11%207%2C18%2011%2C18%2011%2C11%2018%2C11%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px; margin: 9px 11px 13px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218%22%20height%3D%2218%22%20viewBox%3D%220%200%2018%2018%22%3E%0A%20%20%3Cpolygon%20fill%3D%22%23333%22%20points%3D%2218%2C7%2011%2C7%2011%2C0%207%2C0%207%2C7%200%2C7%200%2C11%207%2C11%207%2C18%2011%2C18%2011%2C11%2018%2C11%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px; margin: 9px 11px 13px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218%22%20height%3D%2218%22%20viewBox%3D%220%200%2018%2018%22%3E%0A%20%20%3Cpolygon%20fill%3D%22%23111%22%20points%3D%2218%2C7%2011%2C7%2011%2C0%207%2C0%207%2C7%200%2C7%200%2C11%207%2C11%207%2C18%2011%2C18%2011%2C11%2018%2C11%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px; margin: 9px 11px 13px;"></button><div style="position: relative; overflow: hidden; width: 30px; height: 1px; margin: 0px 5px; background-color: rgb(230, 230, 230); top: 0px;"></div><button draggable="false" title="Thu nhỏ" aria-label="Thu nhỏ" type="button" class="gm-control-active" style="background: none; display: block; border: 0px; margin: 0px; padding: 0px; position: relative; cursor: pointer; user-select: none; overflow: hidden; width: 40px; height: 40px; top: 0px; left: 0px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218%22%20height%3D%2218%22%20viewBox%3D%220%200%2018%2018%22%3E%0A%20%20%3Cpath%20fill%3D%22%23666%22%20d%3D%22M0%2C7h18v4H0V7z%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px; margin: 13px 11px 9px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218%22%20height%3D%2218%22%20viewBox%3D%220%200%2018%2018%22%3E%0A%20%20%3Cpath%20fill%3D%22%23333%22%20d%3D%22M0%2C7h18v4H0V7z%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px; margin: 13px 11px 9px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218%22%20height%3D%2218%22%20viewBox%3D%220%200%2018%2018%22%3E%0A%20%20%3Cpath%20fill%3D%22%23111%22%20d%3D%22M0%2C7h18v4H0V7z%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px; margin: 13px 11px 9px;"></button></div></div><div class="gmnoprint" controlwidth="40" controlheight="40" style="display: none; position: absolute;"><div style="width: 40px; height: 40px;"><button draggable="false" title="Rotate map 90 degrees" aria-label="Rotate map 90 degrees" type="button" class="gm-control-active" style="background: none rgb(255, 255, 255); display: none; border: 0px; margin: 0px 0px 32px; padding: 0px; position: relative; cursor: pointer; user-select: none; width: 40px; height: 40px; top: 0px; left: 0px; overflow: hidden; box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; border-radius: 2px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2222%22%20viewBox%3D%220%200%2024%2022%22%3E%0A%20%20%3Cpath%20fill%3D%22%23666%22%20fill-rule%3D%22evenodd%22%20d%3D%22M20%2010c0-5.52-4.48-10-10-10s-10%204.48-10%2010v5h5v-5c0-2.76%202.24-5%205-5s5%202.24%205%205v5h-4l6.5%207%206.5-7h-4v-5z%22%20clip-rule%3D%22evenodd%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 28px; width: 28px; margin: 6px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2222%22%20viewBox%3D%220%200%2024%2022%22%3E%0A%20%20%3Cpath%20fill%3D%22%23333%22%20fill-rule%3D%22evenodd%22%20d%3D%22M20%2010c0-5.52-4.48-10-10-10s-10%204.48-10%2010v5h5v-5c0-2.76%202.24-5%205-5s5%202.24%205%205v5h-4l6.5%207%206.5-7h-4v-5z%22%20clip-rule%3D%22evenodd%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 28px; width: 28px; margin: 6px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2222%22%20viewBox%3D%220%200%2024%2022%22%3E%0A%20%20%3Cpath%20fill%3D%22%23111%22%20fill-rule%3D%22evenodd%22%20d%3D%22M20%2010c0-5.52-4.48-10-10-10s-10%204.48-10%2010v5h5v-5c0-2.76%202.24-5%205-5s5%202.24%205%205v5h-4l6.5%207%206.5-7h-4v-5z%22%20clip-rule%3D%22evenodd%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 28px; width: 28px; margin: 6px;"></button><button draggable="false" title="Tilt map" aria-label="Tilt map" type="button" class="gm-tilt gm-control-active" style="background: none rgb(255, 255, 255); display: block; border: 0px; margin: 0px; padding: 0px; position: relative; cursor: pointer; user-select: none; width: 40px; height: 40px; top: 0px; left: 0px; overflow: hidden; box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; border-radius: 2px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218px%22%20height%3D%2216px%22%20viewBox%3D%220%200%2018%2016%22%3E%0A%20%20%3Cpath%20fill%3D%22%23666%22%20d%3D%22M0%2C16h8V9H0V16z%20M10%2C16h8V9h-8V16z%20M0%2C7h8V0H0V7z%20M10%2C0v7h8V0H10z%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="width: 18px; height: 16px; margin: 12px 11px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218px%22%20height%3D%2216px%22%20viewBox%3D%220%200%2018%2016%22%3E%0A%20%20%3Cpath%20fill%3D%22%23333%22%20d%3D%22M0%2C16h8V9H0V16z%20M10%2C16h8V9h-8V16z%20M0%2C7h8V0H0V7z%20M10%2C0v7h8V0H10z%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="width: 18px; height: 16px; margin: 12px 11px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218px%22%20height%3D%2216px%22%20viewBox%3D%220%200%2018%2016%22%3E%0A%20%20%3Cpath%20fill%3D%22%23111%22%20d%3D%22M0%2C16h8V9H0V16z%20M10%2C16h8V9h-8V16z%20M0%2C7h8V0H0V7z%20M10%2C0v7h8V0H10z%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="width: 18px; height: 16px; margin: 12px 11px;"></button></div></div></div></div></div><div style="background-color: white; font-weight: 500; font-family: Roboto, sans-serif; padding: 15px 25px; box-sizing: border-box; top: 5px; border: 1px solid rgba(0, 0, 0, 0.12); border-radius: 5px; left: 50%; max-width: 375px; position: absolute; transform: translateX(-50%); width: calc(100% - 10px); z-index: 1;"><div><img alt="" src="http://maps.gstatic.com/mapfiles/api-3/images/google_gray.svg" draggable="false" style="padding: 0px; margin: 0px; border: 0px; height: 17px; vertical-align: middle; width: 52px; user-select: none;"></div><div style="line-height: 20px; margin: 15px 0px;"><span style="color: rgba(0, 0, 0, 0.87); font-size: 14px;">Trang này không thể tải Google Maps đúng cách.</span></div><table style="width: 100%;"><tr><td style="line-height: 16px; vertical-align: middle;"><a href="https://developers.google.com/maps/documentation/javascript/error-messages?utm_source=maps_js&amp;utm_medium=degraded&amp;utm_campaign=billing#api-key-and-billing-errors" target="_blank" rel="noopener" style="color: rgba(0, 0, 0, 0.54); font-size: 12px;">Do you own this website?</a></td><td style="text-align: right;"><button class="dismissButton">OK</button></td></tr></table></div></div>
                                    </dd>
                                </dl>

                                <dl>
                                    <dt>Nội dung chi tiết <span class="required">*</span></dt>
                                    <dd>
                                        <textarea id="detail_editor" rows="10" name="Land[detail]" style="visibility: hidden; display: none;"></textarea><div id="cke_detail_editor" class="cke_1 cke cke_reset cke_chrome cke_editor_detail_editor cke_ltr cke_browser_webkit" dir="ltr" lang="vi" role="application" aria-labelledby="cke_detail_editor_arialbl"><span id="cke_detail_editor_arialbl" class="cke_voice_label">Bộ soạn thảo văn bản có định dạng, detail_editor</span><div class="cke_inner cke_reset" role="presentation"><span id="cke_1_top" class="cke_top cke_reset_all" role="presentation" style="height: auto; user-select: none;"><span id="cke_9" class="cke_voice_label">Thanh công cụ</span><span id="cke_1_toolbox" class="cke_toolbox" role="group" aria-labelledby="cke_9" onmousedown="return false;"><span id="cke_14" class="cke_toolbar" aria-labelledby="cke_14_label" role="toolbar"><span id="cke_14_label" class="cke_voice_label">Tài liệu</span><span class="cke_toolbar_start"></span><span class="cke_toolgroup" role="presentation"><a id="cke_15" class="cke_button cke_button__source  cke_button_off" href="javascript:void('Mã HTML')" title="Mã HTML" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_15_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(2,event);" onfocus="return CKEDITOR.tools.callFunction(3,event);" onclick="CKEDITOR.tools.callFunction(4,this);return false;"><span class="cke_button_icon cke_button__source_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -1824px;background-size:auto;">&nbsp;</span><span id="cke_15_label" class="cke_button_label cke_button__source_label" aria-hidden="false">Mã HTML</span></a><span class="cke_toolbar_separator" role="separator"></span><a id="cke_16" class="cke_button cke_button__save  cke_button_off" href="javascript:void('Lưu')" title="Lưu" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_16_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(5,event);" onfocus="return CKEDITOR.tools.callFunction(6,event);" onclick="CKEDITOR.tools.callFunction(7,this);return false;"><span class="cke_button_icon cke_button__save_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -1704px;background-size:auto;">&nbsp;</span><span id="cke_16_label" class="cke_button_label cke_button__save_label" aria-hidden="false">Lưu</span></a><a id="cke_17" class="cke_button cke_button__newpage  cke_button_off" href="javascript:void('Trang mới')" title="Trang mới" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_17_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(8,event);" onfocus="return CKEDITOR.tools.callFunction(9,event);" onclick="CKEDITOR.tools.callFunction(10,this);return false;"><span class="cke_button_icon cke_button__newpage_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -1440px;background-size:auto;">&nbsp;</span><span id="cke_17_label" class="cke_button_label cke_button__newpage_label" aria-hidden="false">Trang mới</span></a><a id="cke_18" class="cke_button cke_button__preview  cke_button_off" href="javascript:void('Xem trước')" title="Xem trước" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_18_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(11,event);" onfocus="return CKEDITOR.tools.callFunction(12,event);" onclick="CKEDITOR.tools.callFunction(13,this);return false;"><span class="cke_button_icon cke_button__preview_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -1632px;background-size:auto;">&nbsp;</span><span id="cke_18_label" class="cke_button_label cke_button__preview_label" aria-hidden="false">Xem trước</span></a><a id="cke_19" class="cke_button cke_button__print  cke_button_off" href="javascript:void('In')" title="In" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_19_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(14,event);" onfocus="return CKEDITOR.tools.callFunction(15,event);" onclick="CKEDITOR.tools.callFunction(16,this);return false;"><span class="cke_button_icon cke_button__print_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -1656px;background-size:auto;">&nbsp;</span><span id="cke_19_label" class="cke_button_label cke_button__print_label" aria-hidden="false">In</span></a><span class="cke_toolbar_separator" role="separator"></span><a id="cke_20" class="cke_button cke_button__templates  cke_button_off" href="javascript:void('Mẫu dựng sẵn')" title="Mẫu dựng sẵn" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_20_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(17,event);" onfocus="return CKEDITOR.tools.callFunction(18,event);" onclick="CKEDITOR.tools.callFunction(19,this);return false;"><span class="cke_button_icon cke_button__templates_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -456px;background-size:auto;">&nbsp;</span><span id="cke_20_label" class="cke_button_label cke_button__templates_label" aria-hidden="false">Mẫu dựng sẵn</span></a></span><span class="cke_toolbar_end"></span></span><span id="cke_21" class="cke_toolbar" aria-labelledby="cke_21_label" role="toolbar"><span id="cke_21_label" class="cke_voice_label">Clipboard/Undo</span><span class="cke_toolbar_start"></span><span class="cke_toolgroup" role="presentation"><a id="cke_22" class="cke_button cke_button__cut cke_button_disabled " href="javascript:void('Cắt')" title="Cắt" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_22_label" aria-haspopup="false" aria-disabled="true" onkeydown="return CKEDITOR.tools.callFunction(20,event);" onfocus="return CKEDITOR.tools.callFunction(21,event);" onclick="CKEDITOR.tools.callFunction(22,this);return false;"><span class="cke_button_icon cke_button__cut_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -312px;background-size:auto;">&nbsp;</span><span id="cke_22_label" class="cke_button_label cke_button__cut_label" aria-hidden="false">Cắt</span></a><a id="cke_23" class="cke_button cke_button__copy cke_button_disabled " href="javascript:void('Sao chép')" title="Sao chép" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_23_label" aria-haspopup="false" aria-disabled="true" onkeydown="return CKEDITOR.tools.callFunction(23,event);" onfocus="return CKEDITOR.tools.callFunction(24,event);" onclick="CKEDITOR.tools.callFunction(25,this);return false;"><span class="cke_button_icon cke_button__copy_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -264px;background-size:auto;">&nbsp;</span><span id="cke_23_label" class="cke_button_label cke_button__copy_label" aria-hidden="false">Sao chép</span></a><a id="cke_24" class="cke_button cke_button__paste  cke_button_off" href="javascript:void('Dán')" title="Dán" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_24_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(26,event);" onfocus="return CKEDITOR.tools.callFunction(27,event);" onclick="CKEDITOR.tools.callFunction(28,this);return false;"><span class="cke_button_icon cke_button__paste_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -360px;background-size:auto;">&nbsp;</span><span id="cke_24_label" class="cke_button_label cke_button__paste_label" aria-hidden="false">Dán</span></a><a id="cke_25" class="cke_button cke_button__pastetext  cke_button_off" href="javascript:void('Dán theo định dạng văn bản thuần')" title="Dán theo định dạng văn bản thuần" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_25_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(29,event);" onfocus="return CKEDITOR.tools.callFunction(30,event);" onclick="CKEDITOR.tools.callFunction(31,this);return false;"><span class="cke_button_icon cke_button__pastetext_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -1536px;background-size:auto;">&nbsp;</span><span id="cke_25_label" class="cke_button_label cke_button__pastetext_label" aria-hidden="false">Dán theo định dạng văn bản thuần</span></a><a id="cke_26" class="cke_button cke_button__pastefromword  cke_button_off" href="javascript:void('Dán với định dạng Word')" title="Dán với định dạng Word" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_26_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(32,event);" onfocus="return CKEDITOR.tools.callFunction(33,event);" onclick="CKEDITOR.tools.callFunction(34,this);return false;"><span class="cke_button_icon cke_button__pastefromword_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -1584px;background-size:auto;">&nbsp;</span><span id="cke_26_label" class="cke_button_label cke_button__pastefromword_label" aria-hidden="false">Dán với định dạng Word</span></a><span class="cke_toolbar_separator" role="separator"></span><a id="cke_27" class="cke_button cke_button__undo cke_button_disabled " href="javascript:void('Khôi phục thao tác')" title="Khôi phục thao tác" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_27_label" aria-haspopup="false" aria-disabled="true" onkeydown="return CKEDITOR.tools.callFunction(35,event);" onfocus="return CKEDITOR.tools.callFunction(36,event);" onclick="CKEDITOR.tools.callFunction(37,this);return false;"><span class="cke_button_icon cke_button__undo_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -1992px;background-size:auto;">&nbsp;</span><span id="cke_27_label" class="cke_button_label cke_button__undo_label" aria-hidden="false">Khôi phục thao tác</span></a><a id="cke_28" class="cke_button cke_button__redo cke_button_disabled " href="javascript:void('Làm lại thao tác')" title="Làm lại thao tác" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_28_label" aria-haspopup="false" aria-disabled="true" onkeydown="return CKEDITOR.tools.callFunction(38,event);" onfocus="return CKEDITOR.tools.callFunction(39,event);" onclick="CKEDITOR.tools.callFunction(40,this);return false;"><span class="cke_button_icon cke_button__redo_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -1944px;background-size:auto;">&nbsp;</span><span id="cke_28_label" class="cke_button_label cke_button__redo_label" aria-hidden="false">Làm lại thao tác</span></a></span><span class="cke_toolbar_end"></span></span><span id="cke_29" class="cke_toolbar" aria-labelledby="cke_29_label" role="toolbar"><span id="cke_29_label" class="cke_voice_label">Chỉnh sửa</span><span class="cke_toolbar_start"></span><span class="cke_toolgroup" role="presentation"><a id="cke_30" class="cke_button cke_button__find  cke_button_off" href="javascript:void('Tìm kiếm')" title="Tìm kiếm" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_30_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(41,event);" onfocus="return CKEDITOR.tools.callFunction(42,event);" onclick="CKEDITOR.tools.callFunction(43,this);return false;"><span class="cke_button_icon cke_button__find_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -528px;background-size:auto;">&nbsp;</span><span id="cke_30_label" class="cke_button_label cke_button__find_label" aria-hidden="false">Tìm kiếm</span></a><a id="cke_31" class="cke_button cke_button__replace  cke_button_off" href="javascript:void('Thay thế')" title="Thay thế" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_31_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(44,event);" onfocus="return CKEDITOR.tools.callFunction(45,event);" onclick="CKEDITOR.tools.callFunction(46,this);return false;"><span class="cke_button_icon cke_button__replace_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -552px;background-size:auto;">&nbsp;</span><span id="cke_31_label" class="cke_button_label cke_button__replace_label" aria-hidden="false">Thay thế</span></a><span class="cke_toolbar_separator" role="separator"></span><a id="cke_32" class="cke_button cke_button__selectall  cke_button_off" href="javascript:void('Chọn tất cả')" title="Chọn tất cả" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_32_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(47,event);" onfocus="return CKEDITOR.tools.callFunction(48,event);" onclick="CKEDITOR.tools.callFunction(49,this);return false;"><span class="cke_button_icon cke_button__selectall_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -1728px;background-size:auto;">&nbsp;</span><span id="cke_32_label" class="cke_button_label cke_button__selectall_label" aria-hidden="false">Chọn tất cả</span></a><span class="cke_toolbar_separator" role="separator"></span><a id="cke_33" class="cke_button cke_button__scayt cke_button_off " href="javascript:void('Kiểm tra chính tả')" title="Kiểm tra chính tả" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_33_label" aria-haspopup="true" onkeydown="return CKEDITOR.tools.callFunction(50,event);" onfocus="return CKEDITOR.tools.callFunction(51,event);" onclick="CKEDITOR.tools.callFunction(52,this);return false;"><span class="cke_button_icon cke_button__scayt_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -1872px;background-size:auto;">&nbsp;</span><span id="cke_33_label" class="cke_button_label cke_button__scayt_label" aria-hidden="false">Kiểm tra chính tả ngay khi gõ chữ (SCAYT)</span><span class="cke_button_arrow"></span></a></span><span class="cke_toolbar_end"></span></span><span id="cke_34" class="cke_toolbar" aria-labelledby="cke_34_label" role="toolbar"><span id="cke_34_label" class="cke_voice_label">Bảng biểu</span><span class="cke_toolbar_start"></span><span class="cke_toolgroup" role="presentation"><a id="cke_35" class="cke_button cke_button__form  cke_button_off" href="javascript:void('Biểu mẫu')" title="Biểu mẫu" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_35_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(53,event);" onfocus="return CKEDITOR.tools.callFunction(54,event);" onclick="CKEDITOR.tools.callFunction(55,this);return false;"><span class="cke_button_icon cke_button__form_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -648px;background-size:auto;">&nbsp;</span><span id="cke_35_label" class="cke_button_label cke_button__form_label" aria-hidden="false">Biểu mẫu</span></a><a id="cke_36" class="cke_button cke_button__checkbox  cke_button_off" href="javascript:void('Nút kiểm')" title="Nút kiểm" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_36_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(56,event);" onfocus="return CKEDITOR.tools.callFunction(57,event);" onclick="CKEDITOR.tools.callFunction(58,this);return false;"><span class="cke_button_icon cke_button__checkbox_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -624px;background-size:auto;">&nbsp;</span><span id="cke_36_label" class="cke_button_label cke_button__checkbox_label" aria-hidden="false">Nút kiểm</span></a><a id="cke_37" class="cke_button cke_button__radio  cke_button_off" href="javascript:void('Nút chọn')" title="Nút chọn" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_37_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(59,event);" onfocus="return CKEDITOR.tools.callFunction(60,event);" onclick="CKEDITOR.tools.callFunction(61,this);return false;"><span class="cke_button_icon cke_button__radio_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -720px;background-size:auto;">&nbsp;</span><span id="cke_37_label" class="cke_button_label cke_button__radio_label" aria-hidden="false">Nút chọn</span></a><a id="cke_38" class="cke_button cke_button__textfield  cke_button_off" href="javascript:void('Trường văn bản')" title="Trường văn bản" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_38_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(62,event);" onfocus="return CKEDITOR.tools.callFunction(63,event);" onclick="CKEDITOR.tools.callFunction(64,this);return false;"><span class="cke_button_icon cke_button__textfield_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -864px;background-size:auto;">&nbsp;</span><span id="cke_38_label" class="cke_button_label cke_button__textfield_label" aria-hidden="false">Trường văn bản</span></a><a id="cke_39" class="cke_button cke_button__textarea  cke_button_off" href="javascript:void('Vùng văn bản')" title="Vùng văn bản" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_39_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(65,event);" onfocus="return CKEDITOR.tools.callFunction(66,event);" onclick="CKEDITOR.tools.callFunction(67,this);return false;"><span class="cke_button_icon cke_button__textarea_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -816px;background-size:auto;">&nbsp;</span><span id="cke_39_label" class="cke_button_label cke_button__textarea_label" aria-hidden="false">Vùng văn bản</span></a><a id="cke_40" class="cke_button cke_button__select  cke_button_off" href="javascript:void('Ô chọn')" title="Ô chọn" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_40_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(68,event);" onfocus="return CKEDITOR.tools.callFunction(69,event);" onclick="CKEDITOR.tools.callFunction(70,this);return false;"><span class="cke_button_icon cke_button__select_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -768px;background-size:auto;">&nbsp;</span><span id="cke_40_label" class="cke_button_label cke_button__select_label" aria-hidden="false">Ô chọn</span></a><a id="cke_41" class="cke_button cke_button__button  cke_button_off" href="javascript:void('Nút')" title="Nút" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_41_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(71,event);" onfocus="return CKEDITOR.tools.callFunction(72,event);" onclick="CKEDITOR.tools.callFunction(73,this);return false;"><span class="cke_button_icon cke_button__button_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -600px;background-size:auto;">&nbsp;</span><span id="cke_41_label" class="cke_button_label cke_button__button_label" aria-hidden="false">Nút</span></a><a id="cke_42" class="cke_button cke_button__imagebutton  cke_button_off" href="javascript:void('Nút hình ảnh')" title="Nút hình ảnh" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_42_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(74,event);" onfocus="return CKEDITOR.tools.callFunction(75,event);" onclick="CKEDITOR.tools.callFunction(76,this);return false;"><span class="cke_button_icon cke_button__imagebutton_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -696px;background-size:auto;">&nbsp;</span><span id="cke_42_label" class="cke_button_label cke_button__imagebutton_label" aria-hidden="false">Nút hình ảnh</span></a><a id="cke_43" class="cke_button cke_button__hiddenfield  cke_button_off" href="javascript:void('Trường ẩn')" title="Trường ẩn" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_43_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(77,event);" onfocus="return CKEDITOR.tools.callFunction(78,event);" onclick="CKEDITOR.tools.callFunction(79,this);return false;"><span class="cke_button_icon cke_button__hiddenfield_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -672px;background-size:auto;">&nbsp;</span><span id="cke_43_label" class="cke_button_label cke_button__hiddenfield_label" aria-hidden="false">Trường ẩn</span></a></span><span class="cke_toolbar_end"></span></span><span class="cke_toolbar_break"></span><span id="cke_44" class="cke_toolbar" aria-labelledby="cke_44_label" role="toolbar"><span id="cke_44_label" class="cke_voice_label">Kiểu cơ bản</span><span class="cke_toolbar_start"></span><span class="cke_toolgroup" role="presentation"><a id="cke_45" class="cke_button cke_button__bold  cke_button_off" href="javascript:void('Đậm')" title="Đậm" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_45_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(80,event);" onfocus="return CKEDITOR.tools.callFunction(81,event);" onclick="CKEDITOR.tools.callFunction(82,this);return false;"><span class="cke_button_icon cke_button__bold_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -24px;background-size:auto;">&nbsp;</span><span id="cke_45_label" class="cke_button_label cke_button__bold_label" aria-hidden="false">Đậm</span></a><a id="cke_46" class="cke_button cke_button__italic  cke_button_off" href="javascript:void('Nghiêng')" title="Nghiêng" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_46_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(83,event);" onfocus="return CKEDITOR.tools.callFunction(84,event);" onclick="CKEDITOR.tools.callFunction(85,this);return false;"><span class="cke_button_icon cke_button__italic_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -48px;background-size:auto;">&nbsp;</span><span id="cke_46_label" class="cke_button_label cke_button__italic_label" aria-hidden="false">Nghiêng</span></a><a id="cke_47" class="cke_button cke_button__underline  cke_button_off" href="javascript:void('Gạch chân')" title="Gạch chân" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_47_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(86,event);" onfocus="return CKEDITOR.tools.callFunction(87,event);" onclick="CKEDITOR.tools.callFunction(88,this);return false;"><span class="cke_button_icon cke_button__underline_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -144px;background-size:auto;">&nbsp;</span><span id="cke_47_label" class="cke_button_label cke_button__underline_label" aria-hidden="false">Gạch chân</span></a><a id="cke_48" class="cke_button cke_button__strike  cke_button_off" href="javascript:void('Gạch xuyên ngang')" title="Gạch xuyên ngang" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_48_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(89,event);" onfocus="return CKEDITOR.tools.callFunction(90,event);" onclick="CKEDITOR.tools.callFunction(91,this);return false;"><span class="cke_button_icon cke_button__strike_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -72px;background-size:auto;">&nbsp;</span><span id="cke_48_label" class="cke_button_label cke_button__strike_label" aria-hidden="false">Gạch xuyên ngang</span></a><a id="cke_49" class="cke_button cke_button__subscript  cke_button_off" href="javascript:void('Chỉ số dưới')" title="Chỉ số dưới" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_49_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(92,event);" onfocus="return CKEDITOR.tools.callFunction(93,event);" onclick="CKEDITOR.tools.callFunction(94,this);return false;"><span class="cke_button_icon cke_button__subscript_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -96px;background-size:auto;">&nbsp;</span><span id="cke_49_label" class="cke_button_label cke_button__subscript_label" aria-hidden="false">Chỉ số dưới</span></a><a id="cke_50" class="cke_button cke_button__superscript  cke_button_off" href="javascript:void('Chỉ số trên')" title="Chỉ số trên" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_50_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(95,event);" onfocus="return CKEDITOR.tools.callFunction(96,event);" onclick="CKEDITOR.tools.callFunction(97,this);return false;"><span class="cke_button_icon cke_button__superscript_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -120px;background-size:auto;">&nbsp;</span><span id="cke_50_label" class="cke_button_label cke_button__superscript_label" aria-hidden="false">Chỉ số trên</span></a><span class="cke_toolbar_separator" role="separator"></span><a id="cke_51" class="cke_button cke_button__removeformat  cke_button_off" href="javascript:void('Xoá định dạng')" title="Xoá định dạng" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_51_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(98,event);" onfocus="return CKEDITOR.tools.callFunction(99,event);" onclick="CKEDITOR.tools.callFunction(100,this);return false;"><span class="cke_button_icon cke_button__removeformat_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -1680px;background-size:auto;">&nbsp;</span><span id="cke_51_label" class="cke_button_label cke_button__removeformat_label" aria-hidden="false">Xoá định dạng</span></a></span><span class="cke_toolbar_end"></span></span><span id="cke_52" class="cke_toolbar" aria-labelledby="cke_52_label" role="toolbar"><span id="cke_52_label" class="cke_voice_label">Đoạn</span><span class="cke_toolbar_start"></span><span class="cke_toolgroup" role="presentation"><a id="cke_53" class="cke_button cke_button__numberedlist  cke_button_off" href="javascript:void('Chèn/Xoá Danh sách có thứ tự')" title="Chèn/Xoá Danh sách có thứ tự" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_53_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(101,event);" onfocus="return CKEDITOR.tools.callFunction(102,event);" onclick="CKEDITOR.tools.callFunction(103,this);return false;"><span class="cke_button_icon cke_button__numberedlist_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -1368px;background-size:auto;">&nbsp;</span><span id="cke_53_label" class="cke_button_label cke_button__numberedlist_label" aria-hidden="false">Chèn/Xoá Danh sách có thứ tự</span></a><a id="cke_54" class="cke_button cke_button__bulletedlist  cke_button_off" href="javascript:void('Chèn/Xoá Danh sách không thứ tự')" title="Chèn/Xoá Danh sách không thứ tự" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_54_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(104,event);" onfocus="return CKEDITOR.tools.callFunction(105,event);" onclick="CKEDITOR.tools.callFunction(106,this);return false;"><span class="cke_button_icon cke_button__bulletedlist_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -1320px;background-size:auto;">&nbsp;</span><span id="cke_54_label" class="cke_button_label cke_button__bulletedlist_label" aria-hidden="false">Chèn/Xoá Danh sách không thứ tự</span></a><span class="cke_toolbar_separator" role="separator"></span><a id="cke_55" class="cke_button cke_button__outdent cke_button_disabled " href="javascript:void('Dịch ra ngoài')" title="Dịch ra ngoài" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_55_label" aria-haspopup="false" aria-disabled="true" onkeydown="return CKEDITOR.tools.callFunction(107,event);" onfocus="return CKEDITOR.tools.callFunction(108,event);" onclick="CKEDITOR.tools.callFunction(109,this);return false;"><span class="cke_button_icon cke_button__outdent_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -1032px;background-size:auto;">&nbsp;</span><span id="cke_55_label" class="cke_button_label cke_button__outdent_label" aria-hidden="false">Dịch ra ngoài</span></a><a id="cke_56" class="cke_button cke_button__indent  cke_button_off" href="javascript:void('Dịch vào trong')" title="Dịch vào trong" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_56_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(110,event);" onfocus="return CKEDITOR.tools.callFunction(111,event);" onclick="CKEDITOR.tools.callFunction(112,this);return false;"><span class="cke_button_icon cke_button__indent_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -984px;background-size:auto;">&nbsp;</span><span id="cke_56_label" class="cke_button_label cke_button__indent_label" aria-hidden="false">Dịch vào trong</span></a><span class="cke_toolbar_separator" role="separator"></span><a id="cke_57" class="cke_button cke_button__blockquote  cke_button_off" href="javascript:void('Khối trích dẫn')" title="Khối trích dẫn" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_57_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(113,event);" onfocus="return CKEDITOR.tools.callFunction(114,event);" onclick="CKEDITOR.tools.callFunction(115,this);return false;"><span class="cke_button_icon cke_button__blockquote_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -216px;background-size:auto;">&nbsp;</span><span id="cke_57_label" class="cke_button_label cke_button__blockquote_label" aria-hidden="false">Khối trích dẫn</span></a><a id="cke_58" class="cke_button cke_button__creatediv  cke_button_off" href="javascript:void('Tạo khối các thành phần')" title="Tạo khối các thành phần" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_58_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(116,event);" onfocus="return CKEDITOR.tools.callFunction(117,event);" onclick="CKEDITOR.tools.callFunction(118,this);return false;"><span class="cke_button_icon cke_button__creatediv_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -480px;background-size:auto;">&nbsp;</span><span id="cke_58_label" class="cke_button_label cke_button__creatediv_label" aria-hidden="false">Tạo khối các thành phần</span></a><span class="cke_toolbar_separator" role="separator"></span><a id="cke_59" class="cke_button cke_button__justifyleft  cke_button_off" href="javascript:void('Canh trái')" title="Canh trái" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_59_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(119,event);" onfocus="return CKEDITOR.tools.callFunction(120,event);" onclick="CKEDITOR.tools.callFunction(121,this);return false;"><span class="cke_button_icon cke_button__justifyleft_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -1128px;background-size:auto;">&nbsp;</span><span id="cke_59_label" class="cke_button_label cke_button__justifyleft_label" aria-hidden="false">Canh trái</span></a><a id="cke_60" class="cke_button cke_button__justifycenter  cke_button_off" href="javascript:void('Canh giữa')" title="Canh giữa" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_60_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(122,event);" onfocus="return CKEDITOR.tools.callFunction(123,event);" onclick="CKEDITOR.tools.callFunction(124,this);return false;"><span class="cke_button_icon cke_button__justifycenter_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -1104px;background-size:auto;">&nbsp;</span><span id="cke_60_label" class="cke_button_label cke_button__justifycenter_label" aria-hidden="false">Canh giữa</span></a><a id="cke_61" class="cke_button cke_button__justifyright  cke_button_off" href="javascript:void('Canh phải')" title="Canh phải" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_61_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(125,event);" onfocus="return CKEDITOR.tools.callFunction(126,event);" onclick="CKEDITOR.tools.callFunction(127,this);return false;"><span class="cke_button_icon cke_button__justifyright_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -1152px;background-size:auto;">&nbsp;</span><span id="cke_61_label" class="cke_button_label cke_button__justifyright_label" aria-hidden="false">Canh phải</span></a><a id="cke_62" class="cke_button cke_button__justifyblock  cke_button_off" href="javascript:void('Canh đều')" title="Canh đều" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_62_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(128,event);" onfocus="return CKEDITOR.tools.callFunction(129,event);" onclick="CKEDITOR.tools.callFunction(130,this);return false;"><span class="cke_button_icon cke_button__justifyblock_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -1080px;background-size:auto;">&nbsp;</span><span id="cke_62_label" class="cke_button_label cke_button__justifyblock_label" aria-hidden="false">Canh đều</span></a><span class="cke_toolbar_separator" role="separator"></span><a id="cke_63" class="cke_button cke_button__bidiltr  cke_button_off" href="javascript:void('Văn bản hướng từ trái sang phải')" title="Văn bản hướng từ trái sang phải" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_63_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(131,event);" onfocus="return CKEDITOR.tools.callFunction(132,event);" onclick="CKEDITOR.tools.callFunction(133,this);return false;"><span class="cke_button_icon cke_button__bidiltr_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -168px;background-size:auto;">&nbsp;</span><span id="cke_63_label" class="cke_button_label cke_button__bidiltr_label" aria-hidden="false">Văn bản hướng từ trái sang phải</span></a><a id="cke_64" class="cke_button cke_button__bidirtl  cke_button_off" href="javascript:void('Văn bản hướng từ phải sang trái')" title="Văn bản hướng từ phải sang trái" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_64_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(134,event);" onfocus="return CKEDITOR.tools.callFunction(135,event);" onclick="CKEDITOR.tools.callFunction(136,this);return false;"><span class="cke_button_icon cke_button__bidirtl_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -192px;background-size:auto;">&nbsp;</span><span id="cke_64_label" class="cke_button_label cke_button__bidirtl_label" aria-hidden="false">Văn bản hướng từ phải sang trái</span></a><a id="cke_65" class="cke_button cke_button__language  cke_button_off" href="javascript:void('Thiết lập ngôn ngữ')" title="Thiết lập ngôn ngữ" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_65_label" aria-haspopup="true" onkeydown="return CKEDITOR.tools.callFunction(137,event);" onfocus="return CKEDITOR.tools.callFunction(138,event);" onclick="CKEDITOR.tools.callFunction(139,this);return false;"><span class="cke_button_icon cke_button__language_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -1176px;background-size:auto;">&nbsp;</span><span id="cke_65_label" class="cke_button_label cke_button__language_label" aria-hidden="false">Thiết lập ngôn ngữ</span><span class="cke_button_arrow"></span></a></span><span class="cke_toolbar_end"></span></span><span id="cke_66" class="cke_toolbar" aria-labelledby="cke_66_label" role="toolbar"><span id="cke_66_label" class="cke_voice_label">Liên kết</span><span class="cke_toolbar_start"></span><span class="cke_toolgroup" role="presentation"><a id="cke_67" class="cke_button cke_button__link  cke_button_off" href="javascript:void('Chèn/Sửa liên kết')" title="Chèn/Sửa liên kết" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_67_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(140,event);" onfocus="return CKEDITOR.tools.callFunction(141,event);" onclick="CKEDITOR.tools.callFunction(142,this);return false;"><span class="cke_button_icon cke_button__link_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -1248px;background-size:auto;">&nbsp;</span><span id="cke_67_label" class="cke_button_label cke_button__link_label" aria-hidden="false">Chèn/Sửa liên kết</span></a><a id="cke_68" class="cke_button cke_button__unlink cke_button_disabled " href="javascript:void('Xoá liên kết')" title="Xoá liên kết" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_68_label" aria-haspopup="false" aria-disabled="true" onkeydown="return CKEDITOR.tools.callFunction(143,event);" onfocus="return CKEDITOR.tools.callFunction(144,event);" onclick="CKEDITOR.tools.callFunction(145,this);return false;"><span class="cke_button_icon cke_button__unlink_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -1272px;background-size:auto;">&nbsp;</span><span id="cke_68_label" class="cke_button_label cke_button__unlink_label" aria-hidden="false">Xoá liên kết</span></a><a id="cke_69" class="cke_button cke_button__anchor  cke_button_off" href="javascript:void('Chèn/Sửa điểm neo')" title="Chèn/Sửa điểm neo" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_69_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(146,event);" onfocus="return CKEDITOR.tools.callFunction(147,event);" onclick="CKEDITOR.tools.callFunction(148,this);return false;"><span class="cke_button_icon cke_button__anchor_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -1224px;background-size:auto;">&nbsp;</span><span id="cke_69_label" class="cke_button_label cke_button__anchor_label" aria-hidden="false">Chèn/Sửa điểm neo</span></a></span><span class="cke_toolbar_end"></span></span><span id="cke_70" class="cke_toolbar" aria-labelledby="cke_70_label" role="toolbar"><span id="cke_70_label" class="cke_voice_label">Chèn</span><span class="cke_toolbar_start"></span><span class="cke_toolgroup" role="presentation"><a id="cke_71" class="cke_button cke_button__image  cke_button_off" href="javascript:void('Hình ảnh')" title="Hình ảnh" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_71_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(149,event);" onfocus="return CKEDITOR.tools.callFunction(150,event);" onclick="CKEDITOR.tools.callFunction(151,this);return false;"><span class="cke_button_icon cke_button__image_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -936px;background-size:auto;">&nbsp;</span><span id="cke_71_label" class="cke_button_label cke_button__image_label" aria-hidden="false">Hình ảnh</span></a><a id="cke_72" class="cke_button cke_button__flash  cke_button_off" href="javascript:void('Flash')" title="Flash" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_72_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(152,event);" onfocus="return CKEDITOR.tools.callFunction(153,event);" onclick="CKEDITOR.tools.callFunction(154,this);return false;"><span class="cke_button_icon cke_button__flash_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -576px;background-size:auto;">&nbsp;</span><span id="cke_72_label" class="cke_button_label cke_button__flash_label" aria-hidden="false">Flash</span></a><a id="cke_73" class="cke_button cke_button__table  cke_button_off" href="javascript:void('Bảng')" title="Bảng" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_73_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(155,event);" onfocus="return CKEDITOR.tools.callFunction(156,event);" onclick="CKEDITOR.tools.callFunction(157,this);return false;"><span class="cke_button_icon cke_button__table_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -1896px;background-size:auto;">&nbsp;</span><span id="cke_73_label" class="cke_button_label cke_button__table_label" aria-hidden="false">Bảng</span></a><a id="cke_74" class="cke_button cke_button__horizontalrule  cke_button_off" href="javascript:void('Chèn đường phân cách ngang')" title="Chèn đường phân cách ngang" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_74_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(158,event);" onfocus="return CKEDITOR.tools.callFunction(159,event);" onclick="CKEDITOR.tools.callFunction(160,this);return false;"><span class="cke_button_icon cke_button__horizontalrule_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -888px;background-size:auto;">&nbsp;</span><span id="cke_74_label" class="cke_button_label cke_button__horizontalrule_label" aria-hidden="false">Chèn đường phân cách ngang</span></a><a id="cke_75" class="cke_button cke_button__smiley  cke_button_off" href="javascript:void('Hình biểu lộ cảm xúc (mặt cười)')" title="Hình biểu lộ cảm xúc (mặt cười)" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_75_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(161,event);" onfocus="return CKEDITOR.tools.callFunction(162,event);" onclick="CKEDITOR.tools.callFunction(163,this);return false;"><span class="cke_button_icon cke_button__smiley_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -1056px;background-size:auto;">&nbsp;</span><span id="cke_75_label" class="cke_button_label cke_button__smiley_label" aria-hidden="false">Hình biểu lộ cảm xúc (mặt cười)</span></a><a id="cke_76" class="cke_button cke_button__specialchar  cke_button_off" href="javascript:void('Chèn ký tự đặc biệt')" title="Chèn ký tự đặc biệt" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_76_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(164,event);" onfocus="return CKEDITOR.tools.callFunction(165,event);" onclick="CKEDITOR.tools.callFunction(166,this);return false;"><span class="cke_button_icon cke_button__specialchar_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -1848px;background-size:auto;">&nbsp;</span><span id="cke_76_label" class="cke_button_label cke_button__specialchar_label" aria-hidden="false">Chèn ký tự đặc biệt</span></a><a id="cke_77" class="cke_button cke_button__pagebreak  cke_button_off" href="javascript:void('Chèn ngắt trang')" title="Chèn ngắt trang" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_77_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(167,event);" onfocus="return CKEDITOR.tools.callFunction(168,event);" onclick="CKEDITOR.tools.callFunction(169,this);return false;"><span class="cke_button_icon cke_button__pagebreak_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -1488px;background-size:auto;">&nbsp;</span><span id="cke_77_label" class="cke_button_label cke_button__pagebreak_label" aria-hidden="false">Chèn ngắt trang</span></a><a id="cke_78" class="cke_button cke_button__iframe  cke_button_off" href="javascript:void('Iframe')" title="Iframe" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_78_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(170,event);" onfocus="return CKEDITOR.tools.callFunction(171,event);" onclick="CKEDITOR.tools.callFunction(172,this);return false;"><span class="cke_button_icon cke_button__iframe_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -912px;background-size:auto;">&nbsp;</span><span id="cke_78_label" class="cke_button_label cke_button__iframe_label" aria-hidden="false">Iframe</span></a></span><span class="cke_toolbar_end"></span></span><span class="cke_toolbar_break"></span><span id="cke_79" class="cke_toolbar" aria-labelledby="cke_79_label" role="toolbar"><span id="cke_79_label" class="cke_voice_label">Kiểu</span><span class="cke_toolbar_start"></span><span id="cke_10" class="cke_combo cke_combo__styles  cke_combo_off" role="presentation"><span id="cke_10_label" class="cke_combo_label">Kiểu</span><a class="cke_combo_button" title="Phong cách định dạng" tabindex="-1" href="javascript:void('Phong cách định dạng')" hidefocus="true" role="button" aria-labelledby="cke_10_label" aria-haspopup="true" onkeydown="return CKEDITOR.tools.callFunction(174,event,this);" onfocus="return CKEDITOR.tools.callFunction(175,event);" onclick="CKEDITOR.tools.callFunction(173,this);return false;"><span id="cke_10_text" class="cke_combo_text cke_combo_inlinelabel">Kiểu</span><span class="cke_combo_open"><span class="cke_combo_arrow"></span></span></a></span><span id="cke_11" class="cke_combo cke_combo__format  cke_combo_off" role="presentation"><span id="cke_11_label" class="cke_combo_label">Định dạng</span><a class="cke_combo_button" title="Định dạng" tabindex="-1" href="javascript:void('Định dạng')" hidefocus="true" role="button" aria-labelledby="cke_11_label" aria-haspopup="true" onkeydown="return CKEDITOR.tools.callFunction(177,event,this);" onfocus="return CKEDITOR.tools.callFunction(178,event);" onclick="CKEDITOR.tools.callFunction(176,this);return false;"><span id="cke_11_text" class="cke_combo_text cke_combo_inlinelabel">Định dạng</span><span class="cke_combo_open"><span class="cke_combo_arrow"></span></span></a></span><span id="cke_12" class="cke_combo cke_combo__font  cke_combo_off" role="presentation"><span id="cke_12_label" class="cke_combo_label">Phông</span><a class="cke_combo_button" title="Phông" tabindex="-1" href="javascript:void('Phông')" hidefocus="true" role="button" aria-labelledby="cke_12_label" aria-haspopup="true" onkeydown="return CKEDITOR.tools.callFunction(180,event,this);" onfocus="return CKEDITOR.tools.callFunction(181,event);" onclick="CKEDITOR.tools.callFunction(179,this);return false;"><span id="cke_12_text" class="cke_combo_text cke_combo_inlinelabel">Phông</span><span class="cke_combo_open"><span class="cke_combo_arrow"></span></span></a></span><span id="cke_13" class="cke_combo cke_combo__fontsize  cke_combo_off" role="presentation"><span id="cke_13_label" class="cke_combo_label">Cỡ chữ</span><a class="cke_combo_button" title="Cỡ chữ" tabindex="-1" href="javascript:void('Cỡ chữ')" hidefocus="true" role="button" aria-labelledby="cke_13_label" aria-haspopup="true" onkeydown="return CKEDITOR.tools.callFunction(183,event,this);" onfocus="return CKEDITOR.tools.callFunction(184,event);" onclick="CKEDITOR.tools.callFunction(182,this);return false;"><span id="cke_13_text" class="cke_combo_text cke_combo_inlinelabel">Cỡ chữ</span><span class="cke_combo_open"><span class="cke_combo_arrow"></span></span></a></span><span class="cke_toolbar_end"></span></span><span id="cke_80" class="cke_toolbar" aria-labelledby="cke_80_label" role="toolbar"><span id="cke_80_label" class="cke_voice_label">Màu sắc</span><span class="cke_toolbar_start"></span><span class="cke_toolgroup" role="presentation"><a id="cke_81" class="cke_button cke_button__textcolor cke_button_off " href="javascript:void('Màu chữ')" title="Màu chữ" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_81_label" aria-haspopup="true" onkeydown="return CKEDITOR.tools.callFunction(185,event);" onfocus="return CKEDITOR.tools.callFunction(186,event);" onclick="CKEDITOR.tools.callFunction(187,this);return false;"><span class="cke_button_icon cke_button__textcolor_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -408px;background-size:auto;">&nbsp;</span><span id="cke_81_label" class="cke_button_label cke_button__textcolor_label" aria-hidden="false">Màu chữ</span><span class="cke_button_arrow"></span></a><a id="cke_82" class="cke_button cke_button__bgcolor cke_button_off " href="javascript:void('Màu nền')" title="Màu nền" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_82_label" aria-haspopup="true" onkeydown="return CKEDITOR.tools.callFunction(188,event);" onfocus="return CKEDITOR.tools.callFunction(189,event);" onclick="CKEDITOR.tools.callFunction(190,this);return false;"><span class="cke_button_icon cke_button__bgcolor_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -384px;background-size:auto;">&nbsp;</span><span id="cke_82_label" class="cke_button_label cke_button__bgcolor_label" aria-hidden="false">Màu nền</span><span class="cke_button_arrow"></span></a></span><span class="cke_toolbar_end"></span></span><span id="cke_83" class="cke_toolbar" aria-labelledby="cke_83_label" role="toolbar"><span id="cke_83_label" class="cke_voice_label">Công cụ</span><span class="cke_toolbar_start"></span><span class="cke_toolgroup" role="presentation"><a id="cke_84" class="cke_button cke_button__maximize  cke_button_off" href="javascript:void('Phóng to tối đa')" title="Phóng to tối đa" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_84_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(191,event);" onfocus="return CKEDITOR.tools.callFunction(192,event);" onclick="CKEDITOR.tools.callFunction(193,this);return false;"><span class="cke_button_icon cke_button__maximize_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -1392px;background-size:auto;">&nbsp;</span><span id="cke_84_label" class="cke_button_label cke_button__maximize_label" aria-hidden="false">Phóng to tối đa</span></a><a id="cke_85" class="cke_button cke_button__showblocks  cke_button_off" href="javascript:void('Hiển thị các khối')" title="Hiển thị các khối" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_85_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(194,event);" onfocus="return CKEDITOR.tools.callFunction(195,event);" onclick="CKEDITOR.tools.callFunction(196,this);return false;"><span class="cke_button_icon cke_button__showblocks_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 -1776px;background-size:auto;">&nbsp;</span><span id="cke_85_label" class="cke_button_label cke_button__showblocks_label" aria-hidden="false">Hiển thị các khối</span></a></span><span class="cke_toolbar_end"></span></span><span id="cke_86" class="cke_toolbar" aria-labelledby="cke_86_label" role="toolbar"><span id="cke_86_label" class="cke_voice_label">about</span><span class="cke_toolbar_start"></span><span class="cke_toolgroup" role="presentation"><a id="cke_87" class="cke_button cke_button__about  cke_button_off" href="javascript:void('Thông tin về CKEditor')" title="Thông tin về CKEditor" tabindex="-1" hidefocus="true" role="button" aria-labelledby="cke_87_label" aria-haspopup="false" onkeydown="return CKEDITOR.tools.callFunction(197,event);" onfocus="return CKEDITOR.tools.callFunction(198,event);" onclick="CKEDITOR.tools.callFunction(199,this);return false;"><span class="cke_button_icon cke_button__about_icon" style="background-image:url(http://nhadathaiphong.vn/css/ckeditor/plugins/icons.png?t=F0RD);background-position:0 0px;background-size:auto;">&nbsp;</span><span id="cke_87_label" class="cke_button_label cke_button__about_label" aria-hidden="false">Thông tin về CKEditor</span></a></span><span class="cke_toolbar_end"></span></span></span></span><div id="cke_1_contents" class="cke_contents cke_reset" role="presentation" style="height: 200px;"><span id="cke_92" class="cke_voice_label">Nhấn ALT + 0 để được giúp đỡ</span><iframe src="" frameborder="0" class="cke_wysiwyg_frame cke_reset" style="width: 100%; height: 100%;" title="Bộ soạn thảo văn bản có định dạng, detail_editor" aria-describedby="cke_92" tabindex="0" allowtransparency="true"></iframe></div><span id="cke_1_bottom" class="cke_bottom cke_reset_all" role="presentation" style="user-select: none;"><span id="cke_1_resizer" class="cke_resizer cke_resizer_vertical cke_resizer_ltr" title="Kéo rê để thay đổi kích cỡ" onmousedown="CKEDITOR.tools.callFunction(0, event)">◢</span><span id="cke_1_path_label" class="cke_voice_label">Nhãn thành phần</span><span id="cke_1_path" class="cke_path" role="group" aria-labelledby="cke_1_path_label"><span class="cke_path_empty">&nbsp;</span></span></span></div></div>								<script>
                                            CKEDITOR.replace( 'detail_editor', { customConfig: '/css/ckeditor/config_add.js' } );
                                        </script>
                                    </dd>
                                </dl>


                                <dl>
                                    <dt></dt>
                                    <dd>
                                        <button type="submit" name="add_new" class="_btn bg_red"><i class="fa fa-plus"></i> &nbsp;&nbsp;ĐĂNG TIN</button>
                                        <button type="submit" name="add_draft" value="1" class="_btn bg_black"><i class="fa fa-plus"></i> &nbsp;&nbsp;LƯU TIN</button>	                            </dd>
                                </dl>

                            </form>
                        </div>
                        <!--end _add_land-->



                    </div>
                </div>
                <!--end manage_page-->

            </div>
            <!--End left-->

        </div>
    </div>

    @include(theme(TRUE).'.includes.footer')
@endsection

@section('js')

@endsection