<!--begin _box-->
<div class="_boxM _manage_list">
    <p><i class="fa fa-list"></i> Danh mục quản lý</p>
    <div>
        <ul>
            <li><a href="/bat-dong-san/tao-moi"><i class="fa fa-angle-double-right"></i> Đăng mới tin rao</a></li>
            <li><a href="/bat-dong-san/"><i class="fa fa-angle-double-right"></i> Danh sách tin rao</a> <span>({{\App\RealEstate::where('approved', 1)->where('draft','0')->where('posted_by', \Auth::user()->id)->count()}})</span></li>
            <li><a href="/bat-dong-san/tin-rao-het-han"><i class="fa fa-angle-double-right"></i> Tin rao hết hạn</a> <span>({{\App\RealEstate::where(function($q){
                    $q->where('expire_date','<',Carbon\Carbon::createFromFormat('m/d/Y H:i A', Carbon\Carbon::now()->format('m/d/Y H:i A')))
                        ->orWhere('post_date', '<', Carbon\Carbon::createFromFormat('m/d/Y H:i A', Carbon\Carbon::now()->subDays(Settings('system_changenametime'))->format('m/d/Y H:i A')));
                })->where('posted_by', \Auth::user()->id)->count()}})</span></li>
            <li><a href="/bat-dong-san/tin-rao-cho-duyet"><i class="fa fa-angle-double-right"></i> Tin rao chờ duyệt</a> <span>({{\App\RealEstate::where('approved','0')->where('draft', 0)->where('expire_date','>=',Carbon\Carbon::createFromFormat('m/d/Y H:i A', Carbon\Carbon::now()->format('m/d/Y H:i A')))
                        ->Where('post_date', '>=', Carbon\Carbon::createFromFormat('m/d/Y H:i A', Carbon\Carbon::now()->subDays(Settings('system_changenametime'))->format('m/d/Y H:i A')))->where('posted_by', \Auth::user()->id)->count()}})</span>
            </li>
            <li><a href="/bat-dong-san/tin-rao-nhap"><i class="fa fa-angle-double-right"></i> Tin rao nháp</a> <span>({{\App\RealEstate::where('draft','1')->where('expire_date','>=',Carbon\Carbon::createFromFormat('m/d/Y H:i A', Carbon\Carbon::now()->format('m/d/Y H:i A')))
                        ->Where('post_date', '>=', Carbon\Carbon::createFromFormat('m/d/Y H:i A', Carbon\Carbon::now()->subDays(Settings('system_changenametime'))->format('m/d/Y H:i A')))->where('posted_by', \Auth::user()->id)->count()}})</span></li>
            <li><a href="/bat-dong-san/tin-rao-da-xoa"><i class="fa fa-angle-double-right"></i> Tin rao đã xóa</a> <span>({{\App\RealEstate::onlyTrashed()->where('posted_by', \Auth::user()->id)->count()}})</span></li>
            <li><a href="/lich-su-giao-dich"><i class="fa fa-angle-double-right"></i> Lịch sử giao dịch</a></li>
            <li><a href="/frontend"><i class="fa fa-angle-double-right"></i> Danh sách website</a></li>
        </ul>
    </div>
</div>
<!--end _box-->

<!--begin _box-->
<div class="_boxM _manage_list">
    <p class="title-box-manage"><i class="fa fa-cog"></i> Quản lý tài khoản</p>
    <div>
        <ul>
            <li><a href="{{route('user.info', [\Auth::user()->id])}}"><i class="fa fa-angle-double-right"></i> Trang cá nhân</a></li>
            @if (\Auth::user()->group->chat_permission)
            <li><a href="{{ route('chat') }}"><i class="fa fa-angle-double-right"></i> Tin nhắn</a></li>
            @endif
            <li><a href="/doi-mat-khau"><i class="fa fa-angle-double-right"></i> Thay đổi mật khẩu</a></li>
            <li><a href="/thong-tin-thanh-vien"><i class="fa fa-angle-double-right"></i> Thông tin thành viên</a></li>
            <li><a href="/nap-tien"><i class="fa fa-angle-double-right"></i> Nạp tiền</a></li>
            <li><a href="/dang-xuat"><i class="fa fa-angle-double-right"></i> Thoát khỏi hệ thống</a></li>
        </ul>
    </div>
</div>
<!--end _box-->
