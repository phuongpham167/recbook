
<ul class="nav nav-tabs">
    <li role="presentation" @if(url()->current() == asset('khach-hang')) class="active" @endif><a class="freelancer_tab" href="/khach-hang">Danh sách khách hàng</a></li>
    <li role="presentation" @if(url()->current() == asset('khach-hang/lich-hen')) class="active" @endif><a class="freelancer_tab" href="/khach-hang/lich-hen">Danh sách lịch hẹn</a></li>
    <li role="presentation" @if(url()->current() == asset('nhom')) class="active" @endif><a class="freelancer_tab" href="{{route('userListGroup')}}">Quản lý nhóm thành viên</a></li>
    <li role="presentation" @if(url()->current() == asset('khach-hang/danh-sach-yeu-cau')) class="active" @endif><a class="freelancer_tab" href="{{asset('khach-hang/danh-sach-yeu-cau')}}">Quản lý yêu cầu</a></li>
</ul>