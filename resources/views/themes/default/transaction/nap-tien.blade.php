@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Recharge" >
@endsection

@section('title')
    Nạp tiền
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}
    <link rel="https://s3-us-west-2.amazonaws.com/s.cdpn.io/11219/woorks-style.css">
    {{--    <link rel="stylesheet" href="{{ asset('css/user.css') }}"/>--}}
    <style>

        ul.bankList {
            clear: both;
            height: 202px;
            width: 636px;
        }
        ul.bankList li {
            list-style-position: outside;
            list-style-type: none;
            cursor: pointer;
            float: left;
            margin-right: 0;
            padding: 5px 2px;
            text-align: center;
            width: 90px;
        }
        .list-content li {
            list-style: none outside none;
            margin: 0 0 10px;
        }

        .list-content li .boxContent {
            display: none;
            width: 636px;
            border:1px solid #cccccc;
            padding:10px;
        }
        .list-content li.active .boxContent {
            display: block;
        }
        .list-content li .boxContent ul {
            height:280px;
        }

        i.VISA, i.MASTE, i.AMREX, i.JCB, i.VCB, i.TCB, i.MB, i.VIB, i.ICB, i.EXB, i.ACB, i.HDB, i.MSB, i.NVB, i.DAB, i.SHB, i.OJB, i.SEA, i.TPB, i.PGB, i.BIDV, i.AGB, i.SCB, i.VPB, i.VAB, i.GPB, i.SGB,i.NAB,i.BAB
        { width:80px; height:30px; display:block; background:url(https://www.nganluong.vn/webskins/skins/nganluong/checkout/version3/images/bank_logo.png) no-repeat;}
        i.MASTE { background-position:0px -31px}
        i.AMREX { background-position:0px -62px}
        i.JCB { background-position:0px -93px;}
        i.VCB { background-position:0px -124px;}
        i.TCB { background-position:0px -155px;}
        i.MB { background-position:0px -186px;}
        i.VIB { background-position:0px -217px;}
        i.ICB { background-position:0px -248px;}
        i.EXB { background-position:0px -279px;}
        i.ACB { background-position:0px -310px;}
        i.HDB { background-position:0px -341px;}
        i.MSB { background-position:0px -372px;}
        i.NVB { background-position:0px -403px;}
        i.DAB { background-position:0px -434px;}
        i.SHB { background-position:0px -465px;}
        i.OJB { background-position:0px -496px;}
        i.SEA { background-position:0px -527px;}
        i.TPB { background-position:0px -558px;}
        i.PGB { background-position:0px -589px;}
        i.BIDV { background-position:0px -620px;}
        i.AGB { background-position:0px -651px;}
        i.SCB { background-position:0px -682px;}
        i.VPB { background-position:0px -713px;}
        i.VAB { background-position:0px -744px;}
        i.GPB { background-position:0px -775px;}
        i.SGB { background-position:0px -806px;}
        i.NAB { background-position:0px -837px;}
        i.BAB { background-position:0px -868px;}

        ul.cardList li {
            cursor: pointer;
            float: left;
            margin-right: 0;
            padding: 5px 4px;
            text-align: center;
            width: 90px;
        }
    </style>

@endpush

@section('content')
    @include(theme(TRUE).'.includes.user-info-header')

    <div class="container-vina">
        <div class="row subpage">
            <div class="col-xs-6 col-xs-offset-3">
                @include('themes.default.includes.message')
                <div class="_form dangnhap_page bg_fdfdfd">
                    <form class="_check_validate" id="dangnhap-form" method="post">
                        {{csrf_field()}}
                        <h3 class="title_form"><i class="fa fa-credit-card"></i> NẠP TIỀN TÀI KHOẢN</h3>

                        <em><span style="color:#ff5a00;font-weight:bold;text-decoration:underline;">Lưu ý:</span> Điền đầy đủ các thông tin sau</em>

                        <dl>
                            <dt>Số tiền nạp: <span class="required">*</span></dt>
                            <dd>
                                <input type="text" name="total_amount" class="form-control" required placeholder="Số tiền nạp" />
                            </dd>
                        </dl>

                        <dl>
                            <dt>Họ tên: <span class="required">*</span></dt>
                            <dd>
                                <input type="text" name="buyer_fullname" class="form-control" value="{{auth()->user()->name}}" disabled />
                            </dd>
                        </dl>
                        <dl>
                            <dt>Email: <span class="required">*</span></dt>
                            <dd>
                                <input type="text" name="buyer_email" class="form-control" value="{{auth()->user()->email}}" disabled />
                            </dd>
                        </dl>
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                            Thanh toán bằng Ví điện tử NgânLượng
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <input type="radio" value="NL"  name="bankcode" checked >
                                        <p>
                                            Thanh toán trực tuyến AN TOÀN và ĐƯỢC BẢO VỆ, sử dụng thẻ ngân hàng trong và ngoài nước hoặc nhiều hình thức tiện lợi khác.
                                            Được bảo hộ & cấp phép bởi NGÂN HÀNG NHÀ NƯỚC, ví điện tử duy nhất được cộng đồng ƯA THÍCH NHẤT 2 năm liên tiếp, Bộ Thông tin Truyền thông trao giải thưởng Sao Khuê
                                            <br/>Giao dịch. Đăng ký ví NgânLượng.vn miễn phí <a href="https://www.nganluong.vn/?portal=nganluong&amp;page=user_register" target="_blank">tại đây</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                            Thanh toán online bằng thẻ ngân hàng nội địa
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p><i>
                                                <span style="color:#ff5a00;font-weight:bold;text-decoration:underline;">Lưu ý</span>: Bạn cần đăng ký Internet-Banking hoặc dịch vụ thanh toán trực tuyến tại ngân hàng trước khi thực hiện.</i></p>
                                        <ul class="cardList clearfix">
                                            <li class="bank-online-methods ">
                                                <label for="vcb_ck_on">
                                                    <i class="BIDV" title="Ngân hàng TMCP Đầu tư &amp; Phát triển Việt Nam"></i>
                                                    <input type="radio" value="ATM_ONLINE_BIDV"  name="bankcode" >

                                                </label></li>
                                            <li class="bank-online-methods ">
                                                <label for="vcb_ck_on">
                                                    <i class="VCB" title="Ngân hàng TMCP Ngoại Thương Việt Nam"></i>
                                                    <input type="radio" value="ATM_ONLINE_VCB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="vnbc_ck_on">
                                                    <i class="DAB" title="Ngân hàng Đông Á"></i>
                                                    <input type="radio" value="ATM_ONLINE_DAB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="tcb_ck_on">
                                                    <i class="TCB" title="Ngân hàng Kỹ Thương"></i>
                                                    <input type="radio" value="ATM_ONLINE_TCB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="sml_atm_mb_ck_on">
                                                    <i class="MB" title="Ngân hàng Quân Đội"></i>
                                                    <input type="radio" value="ATM_ONLINE_MB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="sml_atm_vib_ck_on">
                                                    <i class="VIB" title="Ngân hàng Quốc tế"></i>
                                                    <input type="radio" value="ATM_ONLINE_VIB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="sml_atm_vtb_ck_on">
                                                    <i class="ICB" title="Ngân hàng Công Thương Việt Nam"></i>
                                                    <input type="radio" value="ATM_ONLINE_ICB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="sml_atm_exb_ck_on">
                                                    <i class="EXB" title="Ngân hàng Xuất Nhập Khẩu"></i>
                                                    <input type="radio" value="ATM_ONLINE_EXB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="sml_atm_acb_ck_on">
                                                    <i class="ACB" title="Ngân hàng Á Châu"></i>
                                                    <input type="radio" value="ATM_ONLINE_ACB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="sml_atm_hdb_ck_on">
                                                    <i class="HDB" title="Ngân hàng Phát triển Nhà TPHCM"></i>
                                                    <input type="radio" value="ATM_ONLINE_HDB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="sml_atm_msb_ck_on">
                                                    <i class="MSB" title="Ngân hàng Hàng Hải"></i>
                                                    <input type="radio" value="ATM_ONLINE_MSB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="sml_atm_nvb_ck_on">
                                                    <i class="NVB" title="Ngân hàng Nam Việt"></i>
                                                    <input type="radio" value="ATM_ONLINE_NVB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="sml_atm_vab_ck_on">
                                                    <i class="VAB" title="Ngân hàng Việt Á"></i>
                                                    <input type="radio" value="ATM_ONLINE_VAB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="sml_atm_vpb_ck_on">
                                                    <i class="VPB" title="Ngân Hàng Việt Nam Thịnh Vượng"></i>
                                                    <input type="radio" value="ATM_ONLINE_VPB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="sml_atm_scb_ck_on">
                                                    <i class="SCB" title="Ngân hàng Sài Gòn Thương tín"></i>
                                                    <input type="radio" value="ATM_ONLINE_SCB"  name="bankcode" >

                                                </label></li>



                                            <li class="bank-online-methods ">
                                                <label for="bnt_atm_pgb_ck_on">
                                                    <i class="PGB" title="Ngân hàng Xăng dầu Petrolimex"></i>
                                                    <input type="radio" value="ATM_ONLINE_PGB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="bnt_atm_gpb_ck_on">
                                                    <i class="GPB" title="Ngân hàng TMCP Dầu khí Toàn Cầu"></i>
                                                    <input type="radio" value="ATM_ONLINE_GPB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="bnt_atm_agb_ck_on">
                                                    <i class="AGB" title="Ngân hàng Nông nghiệp &amp; Phát triển nông thôn"></i>
                                                    <input type="radio" value="ATM_ONLINE_AGB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="bnt_atm_sgb_ck_on">
                                                    <i class="SGB" title="Ngân hàng Sài Gòn Công Thương"></i>
                                                    <input type="radio" value="ATM_ONLINE_SGB"  name="bankcode" >

                                                </label></li>
                                            <li class="bank-online-methods ">
                                                <label for="sml_atm_bab_ck_on">
                                                    <i class="BAB" title="Ngân hàng Bắc Á"></i>
                                                    <input type="radio" value="ATM_ONLINE_BAB"  name="bankcode" >

                                                </label></li>
                                            <li class="bank-online-methods ">
                                                <label for="sml_atm_bab_ck_on">
                                                    <i class="TPB" title="Tền phong bank"></i>
                                                    <input type="radio" value="ATM_ONLINE_TPB"  name="bankcode" >

                                                </label></li>
                                            <li class="bank-online-methods ">
                                                <label for="sml_atm_bab_ck_on">
                                                    <i class="NAB" title="Ngân hàng Nam Á"></i>
                                                    <input type="radio" value="ATM_ONLINE_NAB"  name="bankcode" >

                                                </label></li>
                                            <li class="bank-online-methods ">
                                                <label for="sml_atm_bab_ck_on">
                                                    <i class="SHB" title="Ngân hàng TMCP Sài Gòn - Hà Nội (SHB)"></i>
                                                    <input type="radio" value="ATM_ONLINE_SHB"  name="bankcode" >

                                                </label></li>
                                            <li class="bank-online-methods ">
                                                <label for="sml_atm_bab_ck_on">
                                                    <i class="OJB" title="Ngân hàng TMCP Đại Dương (OceanBank)"></i>
                                                    <input type="radio" value="ATM_ONLINE_OJB"  name="bankcode" >

                                                </label></li>





                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                            Thanh toán bằng IB
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p><i>
                                                <span style="color:#ff5a00;font-weight:bold;text-decoration:underline;">Lưu ý</span>: Bạn cần đăng ký Internet-Banking hoặc dịch vụ thanh toán trực tuyến tại ngân hàng trước khi thực hiện.</i></p>

                                        <ul class="cardList clearfix">
                                            <li class="bank-online-methods ">
                                                <label for="vcb_ck_on">
                                                    <i class="BIDV" title="Ngân hàng TMCP Đầu tư &amp; Phát triển Việt Nam"></i>
                                                    <input type="radio" value="IB_ONLINE_BIDV"  name="bankcode" >

                                                </label></li>
                                            <li class="bank-online-methods ">
                                                <label for="vcb_ck_on">
                                                    <i class="VCB" title="Ngân hàng TMCP Ngoại Thương Việt Nam"></i>
                                                    <input type="radio" value="IB_ONLINE_VCB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="vnbc_ck_on">
                                                    <i class="DAB" title="Ngân hàng Đông Á"></i>
                                                    <input type="radio" value="IB_ONLINE_DAB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="tcb_ck_on">
                                                    <i class="TCB" title="Ngân hàng Kỹ Thương"></i>
                                                    <input type="radio" value="IB_ONLINE_TCB"  name="bankcode" >

                                                </label></li>


                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                            Thanh toán atm offline
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFour" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="cardList clearfix">
                                            <li class="bank-online-methods ">
                                                <label for="vcb_ck_on">
                                                    <i class="BIDV" title="Ngân hàng TMCP Đầu tư &amp; Phát triển Việt Nam"></i>
                                                    <input type="radio" value="ATM_OFFLINE_BIDV"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="vcb_ck_on">
                                                    <i class="VCB" title="Ngân hàng TMCP Ngoại Thương Việt Nam"></i>
                                                    <input type="radio" value="ATM_OFFLINE_VCB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="vnbc_ck_on">
                                                    <i class="DAB" title="Ngân hàng Đông Á"></i>
                                                    <input type="radio" value="ATM_OFFLINE_DAB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="tcb_ck_on">
                                                    <i class="TCB" title="Ngân hàng Kỹ Thương"></i>
                                                    <input type="radio" value="ATM_OFFLINE_TCB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="sml_atm_mb_ck_on">
                                                    <i class="MB" title="Ngân hàng Quân Đội"></i>
                                                    <input type="radio" value="ATM_OFFLINE_MB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="sml_atm_vtb_ck_on">
                                                    <i class="ICB" title="Ngân hàng Công Thương Việt Nam"></i>
                                                    <input type="radio" value="ATM_OFFLINE_ICB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="sml_atm_acb_ck_on">
                                                    <i class="ACB" title="Ngân hàng Á Châu"></i>
                                                    <input type="radio" value="ATM_OFFLINE_ACB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="sml_atm_msb_ck_on">
                                                    <i class="MSB" title="Ngân hàng Hàng Hải"></i>
                                                    <input type="radio" value="ATM_OFFLINE_MSB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="sml_atm_scb_ck_on">
                                                    <i class="SCB" title="Ngân hàng Sài Gòn Thương tín"></i>
                                                    <input type="radio" value="ATM_OFFLINE_SCB"  name="bankcode" >

                                                </label></li>
                                            <li class="bank-online-methods ">
                                                <label for="bnt_atm_pgb_ck_on">
                                                    <i class="PGB" title="Ngân hàng Xăng dầu Petrolimex"></i>
                                                    <input type="radio" value="ATM_OFFLINE_PGB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="bnt_atm_agb_ck_on">
                                                    <i class="AGB" title="Ngân hàng Nông nghiệp &amp; Phát triển nông thôn"></i>
                                                    <input type="radio" value="ATM_OFFLINE_AGB"  name="bankcode" >

                                                </label></li>
                                            <li class="bank-online-methods ">
                                                <label for="sml_atm_bab_ck_on">
                                                    <i class="SHB" title="Ngân hàng TMCP Sài Gòn - Hà Nội (SHB)"></i>
                                                    <input type="radio" value="ATM_OFFLINE_SHB"  name="bankcode" >

                                                </label></li>




                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                                            Thanh toán tại văn phòng ngân hàng
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFive" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="cardList clearfix">
                                            <li class="bank-online-methods ">
                                                <label for="vcb_ck_on">
                                                    <i class="BIDV" title="Ngân hàng TMCP Đầu tư &amp; Phát triển Việt Nam"></i>
                                                    <input type="radio" value="NH_OFFLINE_BIDV"  name="bankcode" >

                                                </label></li>
                                            <li class="bank-online-methods ">
                                                <label for="vcb_ck_on">
                                                    <i class="VCB" title="Ngân hàng TMCP Ngoại Thương Việt Nam"></i>
                                                    <input type="radio" value="NH_OFFLINE_VCB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="vnbc_ck_on">
                                                    <i class="DAB" title="Ngân hàng Đông Á"></i>
                                                    <input type="radio" value="NH_OFFLINE_DAB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="tcb_ck_on">
                                                    <i class="TCB" title="Ngân hàng Kỹ Thương"></i>
                                                    <input type="radio" value="NH_OFFLINE_TCB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="sml_atm_mb_ck_on">
                                                    <i class="MB" title="Ngân hàng Quân Đội"></i>
                                                    <input type="radio" value="NH_OFFLINE_MB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="sml_atm_vib_ck_on">
                                                    <i class="VIB" title="Ngân hàng Quốc tế"></i>
                                                    <input type="radio" value="NH_OFFLINE_VIB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="sml_atm_vtb_ck_on">
                                                    <i class="ICB" title="Ngân hàng Công Thương Việt Nam"></i>
                                                    <input type="radio" value="NH_OFFLINE_ICB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="sml_atm_acb_ck_on">
                                                    <i class="ACB" title="Ngân hàng Á Châu"></i>
                                                    <input type="radio" value="NH_OFFLINE_ACB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="sml_atm_msb_ck_on">
                                                    <i class="MSB" title="Ngân hàng Hàng Hải"></i>
                                                    <input type="radio" value="NH_OFFLINE_MSB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="sml_atm_scb_ck_on">
                                                    <i class="SCB" title="Ngân hàng Sài Gòn Thương tín"></i>
                                                    <input type="radio" value="NH_OFFLINE_SCB"  name="bankcode" >

                                                </label></li>



                                            <li class="bank-online-methods ">
                                                <label for="bnt_atm_pgb_ck_on">
                                                    <i class="PGB" title="Ngân hàng Xăng dầu Petrolimex"></i>
                                                    <input type="radio" value="NH_OFFLINE_PGB"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="bnt_atm_agb_ck_on">
                                                    <i class="AGB" title="Ngân hàng Nông nghiệp &amp; Phát triển nông thôn"></i>
                                                    <input type="radio" value="NH_OFFLINE_AGB"  name="bankcode" >

                                                </label></li>
                                            <li class="bank-online-methods ">
                                                <label for="sml_atm_bab_ck_on">
                                                    <i class="TPB" title="Tền phong bank"></i>
                                                    <input type="radio" value="NH_OFFLINE_TPB"  name="bankcode" >

                                                </label></li>



                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
                                            Thanh toán bằng thẻ Visa hoặc MasterCard
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseSix" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p><span style="color:#ff5a00;font-weight:bold;text-decoration:underline;">Lưu ý</span>:Visa hoặc MasterCard.</p>
                                        <ul class="cardList clearfix">
                                            <li class="bank-online-methods ">
                                                <label for="vcb_ck_on">
                                                    Visa:
                                                    <input type="radio" value="VISA"  name="bankcode" >

                                                </label></li>

                                            <li class="bank-online-methods ">
                                                <label for="vnbc_ck_on">
                                                    Master:<input type="radio" value="MASTER"  name="bankcode" >
                                                </label></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="nlpayment" value="thanh toán" class="_btn bg_red"> NẠP TIỀN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include(theme(TRUE).'.includes.footer')
@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/df678b889c.js"></script>
    <script>
        (function($) {
            'use strict';
            $('#collapseOne, #collapseTwo, #collapseThree').on({
                'show.bs.collapse': function() {
                    $('a[href="#' + this.id + '"] span.glyphicons-chevron-down')
                        .removeClass('glyphicons-chevron-down')
                        .addClass('glyphicons-chevron-up');
                },
                'hide.bs.collapse': function() {
                    $('a[href="#' + this.id + '"] span.glyphicon-chevron-up')
                        .removeClass('glyphicons-chevron-up')
                        .addClass('glyphicons-chevron-down');
                }
            });
        })(jQuery);
    </script>
@endsection

