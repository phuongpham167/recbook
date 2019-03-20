
<ul class="nav nav-tabs">
    <li role="presentation" @if(url()->current() == asset('doanh-nghiep/khach-hang')) class="active" @endif><a class="freelancer_tab" href="{{asset('doanh-nghiep/khach-hang?id='.request('id'))}}">Danh sách khách hàng</a></li>
    <?php
        use Illuminate\Support\Facades\DB;
        $group = \App\CGroup::where('company_id',request('id'))->pluck('id');
        $group_id = DB::table('group_user')->whereIn('group_id',$group)->where('user_id',auth()->user()->id)->first()->group_id;
    ?>
    @if(!empty($group_id))
        <li role="presentation" @if(url()->current() == route('companyDetail',['id'=>$group_id])) class="active" @endif><a class="freelancer_tab" href="{{route('companyDetail',['id'=>$group_id])}}">Quản lý thành viên nhóm</a></li>
    @endif
    <li role="presentation" @if(url()->current() == asset('doanh-nghiep/yeu-cau')) class="active" @endif><a class="freelancer_tab" href="{{asset('doanh-nghiep/yeu-cau')}}">Quản lý yêu cầu</a></li>
</ul>