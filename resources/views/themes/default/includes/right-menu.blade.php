<div class="col-xs-3 right">
    <div class="right_box2">
        <p class="title_rbox"><strong>TÌM KIẾM THEO YÊU CẦU</strong></p>
        <div class="search_form">
            <form action="/tim-kiem-thong-minh.htm" method="GET">			<div class="row">

                    <div class="col-xs-12 item">
                        <select onchange="getCatPrice(this, &quot;#search_cat_id&quot;, &quot;#search_price_id&quot;, &quot;/site/LoadCat&quot;)" name="Search[kind_id]" id="Search_kind_id">
                            <option value="">Loại hình bất động sản</option>
                            <option value="1">Cần bán</option>
                            <option value="5">Cho thuê</option>
                            <option value="4">Cần mua</option>
                            <option value="2">Cần thuê</option>
                        </select>				</div>
                    <div class="col-xs-12 item">
                        <select id="search_cat_id" name="Search[cat_id]">
                            <option value="">Nhóm bất động sản</option>
                        </select>				</div>

                    <div class="col-xs-12 item">
                        <input value="1" name="Search[province_id]" id="Search_province_id" type="hidden"><select name="Search[district_id]" id="Search_district_id">
                            <option value="">Tất cả quận huyện</option>
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
                        </select>				</div>

                    <div class="col-xs-12 item">
                        <select name="Search[street_id]" id="Search_street_id">
                            <option value="">Tất cả các đường phố</option>
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
                        </select>				</div>

                    <div class="col-xs-12 item">
                        <select name="Search[direction_id]" id="Search_direction_id">
                            <option value="">Tất cả các hướng</option>
                            <option value="15,17,1,2,3,4,11,10,9,13,19,20,21,22,27">Đông tứ trạch (Đông nam, Nam, Bắc, Đông)</option>
                            <option value="16,18,5,8,7,6,23,24,25,26,28">Tây tứ trạch (Tây, Tây bắc, Tây nam, Đông bắc)</option>
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
                        </select>				</div>

                    <div class="col-xs-12 item">
                        <select id="search_price_id" name="Search[price_id]">
                            <option value="">Tất cả các giá</option>
                        </select>				</div>

                    <div class="col-xs-12 item">
                        <input placeholder="Tìm theo số điện thoại" name="Search[mobile]" id="Search_mobile" type="text" maxlength="50">				</div>

                    <div class="col-xs-3 item">
                        <span>DTMB từ</span>
                    </div>

                    <div class="col-xs-4 item">
                        <input size="4" maxlength="10" placeholder="vd: 40.5" name="Search[dtmb_from]" id="Search_dtmb_from" type="text">				</div>

                    <div class="col-xs-1 item"><span> ~ </span></div>

                    <div class="col-xs-4 item">
                        <input size="4" maxlength="10" placeholder="vd: 70.5" name="Search[dtmb_to]" id="Search_dtmb_to" type="text">				</div>

                    <div class="col-xs-12">
                        <p><button type="submit" class="_btn bg_red"><i class="fa fa-search fa-fw"></i> Tìm kiếm</button></p>
                    </div>

                </div>
            </form>	</div>
    </div>


    <div class="right_box2">
        <p class="title_rbox"><strong>TÌM KIẾM THEO DỰ ÁN</strong></p>
        <div class="search_form">
            <form action="/tim-kiem-thong-minh.htm" method="GET">			<div class="row">

                    <div class="col-xs-12 item">
                        <select name="Search[project_id]" id="Search_project_id">
                            <option value="">Tất cả các dự án, tên đường</option>
                            <option value="157">Khu Đô Thị Bắc Sông Cấm</option>
                            <option value="158">KĐT Quang Minh Green City</option>
                            <option value="138">Mặt đường 208</option>
                            <option value="143">Mặt đường 351</option>
                            <option value="137">Mặt đường 356</option>
                            <option value="109">Mặt đường An Đà</option>
                            <option value="80">Mặt đường Bạch Đằng</option>
                            <option value="133">Mặt đường Cam Lộ</option>
                            <option value="102">Mặt đường Cát Bi</option>
                            <option value="63">Mặt đường Cát Cụt</option>
                            <option value="54">Mặt đường Cầu Đất</option>
                            <option value="105">Mặt đường Chợ Con</option>
                            <option value="92">Mặt đường Chợ Hàng</option>
                            <option value="71">Mặt đường Chu Văn An</option>
                            <option value="86">Mặt đường Chùa Hàng</option>
                            <option value="87">Mặt đường Dư Hàng (Chợ cột đèn)</option>
                            <option value="64">Mặt đường Hai Bà Trưng (Cát Dài)</option>
                            <option value="85">Mặt đường Hàng Kênh</option>
                            <option value="106">Mặt đường Hồ Sen</option>
                            <option value="100">Mặt đường Hoàng Minh Thảo</option>
                            <option value="68">Mặt đường Hoàng Văn Thụ</option>
                            <option value="60">Mặt đường Kỳ Đồng</option>
                            <option value="32">Mặt đường Lạch Tray</option>
                            <option value="94">Mặt đường Lán Bè</option>
                            <option value="56">Mặt đường Lãn Ông</option>
                            <option value="141">Mặt đường Lê Duẩn (CAMEN)</option>
                            <option value="50">Mặt đường Lê Lai</option>
                            <option value="33">Mặt đường Lê Lợi</option>
                            <option value="135">Mặt đường Lê Quốc Uy</option>
                            <option value="99">Mặt đường Lê Thánh Tông</option>
                            <option value="59">Mặt đường Lê Đại Hành</option>
                            <option value="98">Mặt đường Lương Khánh Thiện</option>
                            <option value="69">Mặt đường Lý Thường Kiệt</option>
                            <option value="75">Mặt đường Lý Tự Trọng</option>
                            <option value="62">Mặt đường Mê Linh</option>
                            <option value="91">Mặt đường Miếu Hai Xã</option>
                            <option value="88">Mặt đường Minh Khai</option>
                            <option value="101">Mặt đường Ngô Gia Tự</option>
                            <option value="115">Mặt đường Nguyễn Bình</option>
                            <option value="93">Mặt đường Nguyễn Bỉnh Khiêm</option>
                            <option value="113">Mặt đường Nguyễn Công Hòa</option>
                            <option value="127">Mặt đường Nguyễn Công Trứ</option>
                            <option value="117">Mặt đường Nguyễn Hữu Tuệ</option>
                            <option value="65">Mặt đường Nguyễn Khuyến</option>
                            <option value="96">Mặt đường Nguyễn Trãi</option>
                            <option value="126">Mặt đường Nguyễn Tường Loan</option>
                            <option value="36">Mặt đường Nguyễn Văn Linh</option>
                            <option value="30">Mặt đường Nguyễn Đức Cảnh</option>
                            <option value="116">Mặt đường Phạm Minh Đức</option>
                            <option value="104">Mặt đường Phạm Văn Đồng (353)</option>
                            <option value="57">Mặt đường Phan Bội Châu</option>
                            <option value="134">Mặt đường Phó Đức Chính</option>
                            <option value="97">Mặt đường Phương Lưu</option>
                            <option value="29">Mặt đường Quang Trung</option>
                            <option value="95">Mặt đường Thiên Lôi</option>
                            <option value="28">Mặt đường Tô Hiệu</option>
                            <option value="107">Mặt đường Tôn Đức Thắng</option>
                            <option value="31">Mặt đường Trần Hưng Đạo</option>
                            <option value="73">Mặt đường Trần Khánh Dư</option>
                            <option value="37">Mặt đường Trần Nguyên Hãn</option>
                            <option value="111">Mặt đường Trần Nhân Tông</option>
                            <option value="66">Mặt đường Trần Phú</option>
                            <option value="38">Mặt đường Trần Quang Khải</option>
                            <option value="112">Mặt đường Trần Thành Ngọ</option>
                            <option value="103">Mặt đường Trung Hành</option>
                            <option value="47">Mặt đường Trung Lực</option>
                            <option value="110">Mặt đường Trường Chinh</option>
                            <option value="35">Mặt đường Văn Cao</option>
                            <option value="142">Mặt đường Võ Thị Sáu</option>
                            <option value="34">Mặt đường Đà Nẵng</option>
                            <option value="108">Mặt đường Đại lộ Tôn Đức Thắng</option>
                            <option value="120">Mặt đường Đằng Hải</option>
                            <option value="39">Mặt đường Điện Biên Phủ</option>
                            <option value="67">Mặt đường Đinh Tiên Hoàng</option>
                            <option value="90">Mặt đường Đình Đông</option>
                            <option value="114">Mặt đường Đông Khê</option>
                            <option value="136">Mặt đường Đông Trà</option>
                            <option value="52">Nhà đất mặt đường khác</option>
                            <option value="51">Nhà đất thổ cư trong ngõ</option>
                            <option value="156">Sông Giá Resort Complex</option>
                            <option value="155">VSIP Hải Phòng</option>
                            <option value="3">Dự án khu đô thị mới Ngã năm - Sân bay Cát Bi (đường Lê Hồng Phong)</option>
                            <option value="4">Khu tái định cư Đằng Lâm 1 - 2</option>
                            <option value="6">Dự án Gốc Lim - Đằng Hải - Hải An</option>
                            <option value="9">Dự án Sao Đỏ Cầu Rào (Cạnh khách sạn Pearl River)</option>
                            <option value="10">Dự án Sao Đỏ - Biệt thự Mộc (Cổng vào là đường Ngô Gia Tự)</option>
                            <option value="11">Khu nhà ở cao cấp Duyên Hải (Khu 81 Nguyễn Trãi)</option>
                            <option value="12">Khu nhà ở cao cấp Thảm Len (Cổng vào là đường Trần Phú)</option>
                            <option value="13">Khu Biệt thự - Nhà ở cao cấp 97 Bạch Đằng (Khu Bê Tông)</option>
                            <option value="14">Khu nhà ở cao cấp Đúc Tân Long (gần khu 97 Bạch Đằng)</option>
                            <option value="15">Khu Biệt thự Hồ Đông (gần Hồ điều hòa Phương Lưu)</option>
                            <option value="16">Dự án Water Front City (Cầu Rào 2 ven sông Lạch Tray)</option>
                            <option value="17">Dự án SHP Plaza - 12 Lạch Tray</option>
                            <option value="18">Dự án TD LAKESIDE (Đối diện BigC)</option>
                            <option value="19">Dự án Vườn Hồng (Bên lô 9 Lê Hồng Phong)</option>
                            <option value="20">Dự án Petrolimex (Đường Đà Nẵng đi vào)</option>
                            <option value="21">Dự án Ngã Tư Quán Mau (Ngã 4 Lạch Tray - Đình Đông)</option>
                            <option value="22">Khu nhà ở cao cấp Trại Cau - 125 Tô Hiệu</option>
                            <option value="23">Dự án Vincom Lê Thánh Tông</option>
                            <option value="25">Dự án Phúc Lộc Thọ (Bên cạnh Quận Ủy Hải An)</option>
                            <option value="26">Dự án Mê Linh Cầu Rào</option>
                            <option value="27">Dự án Nam Sông Lạch Tray (Chân Cầu Rào I)</option>
                            <option value="81">Khu nhà ở cao cấp 116 Nguyễn Đức Cảnh</option>
                            <option value="82">Khu nhà ở cao cấp 116 Cát Cụt</option>
                            <option value="84">Khu tái định cư Sao Sáng</option>
                            <option value="89">Dự án Quán Nam - Lê Chân</option>
                            <option value="118">Dự án Đầm Trung - Văn Cao</option>
                            <option value="121">Khu nhà ở cao cấp 97 Mê Linh</option>
                            <option value="122">Khu nhà ở cao cấp 280 Lê Lợi</option>
                            <option value="123">Khu Đô Thị Xi Măng - Vinhomes Imperia Hải Phòng</option>
                            <option value="124">Khu dân cư An Trang</option>
                            <option value="125">Phường Trại Chuối - Hồng Bàng</option>
                            <option value="128">Khu tái định cư Hồ Đá - Sở Dầu - Hồng Bàng</option>
                            <option value="130">Dự án 833 - Khu Bãi Cát, Văn Cao</option>
                            <option value="131">Khu tập thể Đổng Quốc Bình</option>
                            <option value="132">Tái định cư Khu đô thị Xi măng</option>
                            <option value="140">Khu đô thị Cựu Viên - Kiến An</option>
                            <option value="144">Dự án đất nền khu vực Nam Hải (Mặt đường World Bank), Hải An, Hải Phòng</option>
                            <option value="145">Dự án Khu chung cư Pruksa Town (Hoàng Huy), An Dương, Hải Phòng</option>
                            <option value="146">Dự án Khu đô thị ICC Quán Mau - Lạch Tray</option>
                            <option value="147">Dự án Khu dân cư Gò Gai - Thủy Nguyên</option>
                            <option value="119">Khu Tái Định Cư Nam Cầu</option>
                            <option value="53">Khu nhà ở cao cấp Hưng Phú - 81 Thiên Lôi</option>
                            <option value="45">Khu đô thị PG An Đồng - An Dương</option>
                            <option value="43">Khu Tái Định Cư Đằng Hải 1,2</option>
                            <option value="41">Khu tái định cư Vĩnh Niệm - Lê Chân</option>
                            <option value="148">Đất nền khu Metro - sau UBND quận Hồng Bàng mới</option>
                            <option value="149">Flamingo Cát Bà Beach Resort</option>
                            <option value="150">Tái Định Cư Đông Khê (Cái Hòm) gần Hồ Phương Lưu, Ngô Quyền, Hải Phòng</option>
                            <option value="151">Khu chung cư cao cấp SHP Plaza, Lạch Tray, Ngô Quyền, Hải Phòng</option>
                            <option value="152">Dự án Khu nhà ở phân lô dọc đường World Bank</option>
                            <option value="153">Khu Tái Định Cư đường Đông Khê 2</option>
                            <option value="154">Dự án Sông Cấm Hoàng Huy</option>
                            <option value="83">Nhà đất trong các khu Dự án, khu nhà ở, khu tái định cư khác</option>
                        </select>				</div>

                    <div class="col-xs-12 item">
                        <select id="loday_project" name="Search[loday_id]">
                            <option value="">Tất cả các lô/dãy</option>
                        </select>                </div>

                    <div class="col-xs-12 item">
                        <select onchange="getCatPrice(this, &quot;#timkiem_cat_id1&quot;, &quot;#timkiem_price_id1&quot;, &quot;/site/LoadCat&quot;)" name="Search[kind_id]" id="Search_kind_id">
                            <option value="">Loại hình bất động sản</option>
                            <option value="1">Cần bán</option>
                            <option value="5">Cho thuê</option>
                            <option value="4">Cần mua</option>
                            <option value="2">Cần thuê</option>
                        </select>				</div>

                    <div class="col-xs-12 item">
                        <select id="timkiem_cat_id1" name="Search[cat_id]">
                            <option value="">Nhóm bất động sản</option>
                        </select>				</div>

                    <div class="col-xs-12 item">
                        <select name="Search[direction_id]" id="Search_direction_id">
                            <option value="">Tất cả các hướng</option>
                            <option value="15,17,1,2,3,4,11,10,9,13,19,20,21,22,27">Đông tứ trạch (Đông nam, Nam, Bắc, Đông)</option>
                            <option value="16,18,5,8,7,6,23,24,25,26,28">Tây tứ trạch (Tây, Tây bắc, Tây nam, Đông bắc)</option>
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
                        </select>				</div>

                    <div class="col-xs-12 item">
                        <select id="timkiem_price_id1" name="Search[price_id]">
                            <option value="">Tất cả các giá</option>
                        </select>				</div>

                    <div class="col-xs-12 item">
                        <button type="submit" class="_btn bg_red"><i class="fa fa-search fa-fw"></i> Tìm kiếm</button>
                    </div>

                    <div class="col-xs-12 item"><p>Có 134 dự án trong Thành phố</p></div>

                </div>
            </form>	</div>
    </div>
</div>