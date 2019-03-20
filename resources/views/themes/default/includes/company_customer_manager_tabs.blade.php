
<ul class="nav nav-tabs">
    @if(is_admin($company_id))
        <li role="presentation" @if(request()->route()->getName() == 'companyDetail') class="active" @endif><a class="freelancer_tab" href="{{route('companyDetail',['id'=>$company_id])}}">Quản lý thành viên</a></li>
        <li role="presentation" @if(request()->route()->getName() == 'companyGroupList') class="active" @endif><a class="freelancer_tab" href="{{route('companyGroupList', ['id'=>$company_id])}}">Quản lý nhóm</a></li>
    @endif
    <li role="presentation" @if(url()->current() == asset('doanh-nghiep/khach-hang')) class="active" @endif><a class="freelancer_tab" href="{{asset('doanh-nghiep/khach-hang?id='.request('id'))}}">Danh sách khách hàng</a></li>

    <li role="presentation" @if(url()->current() == asset('doanh-nghiep/yeu-cau')) class="active" @endif><a class="freelancer_tab" href="{{asset('doanh-nghiep/yeu-cau')}}">Quản lý yêu cầu</a></li>
</ul>
