
<ul class="nav nav-tabs">
    <li role="presentation" @if(url()->current() == asset('doanh-nghiep/khach-hang')) class="active" @endif><a class="freelancer_tab" href="{{asset('doanh-nghiep/khach-hang')}}">Danh sách khách hàng</a></li>
    <?php
        use Illuminate\Support\Facades\DB;
        $group = \App\CGroup::where('company_id',request('id'))->pluck('id');
        $group_id = DB::table('group_user')->whereIn('group_id',$group)->where('user_id',auth()->user()->id)->first();
    ?>
    @if(!empty($group_id))
    <li role="presentation" @if(url()->current() == asset('nhom')) class="active" @endif><a class="freelancer_tab" href="{{route('userListGroup')}}">Quản lý nhóm thành viên</a></li>
    @endif
    <li role="presentation" @if(url()->current() == asset('khach-hang/danh-sach-yeu-cau')) class="active" @endif><a class="freelancer_tab" href="{{asset('khach-hang/danh-sach-yeu-cau')}}">Quản lý yêu cầu</a></li>
</ul>