<style>
    .freelancer_tab {
        margin-bottom: 0px;
        margin-top: 0;
        background: #0c4da2;
        color: #fff;
        font-weight: 500;
        font-size: 13px;
        padding: 10px 15px;
        text-transform: uppercase;
    }
</style>
<ul class="nav nav-tabs">
    @if(is_admin($company_id))
        <li role="presentation" @if(request()->route()->getName() == 'companyDetail') class="active" @endif><a class="freelancer_tab" href="{{route('companyDetail',['id'=>$company_id])}}">Quản lý thành viên</a></li>
        <li role="presentation" @if(request()->route()->getName() == 'companyGroupList') class="active" @endif><a class="freelancer_tab" href="{{route('companyGroupList', ['id'=>$company_id])}}">Quản lý nhóm</a></li>
    @endif
    @if(get_role($company_id) == 'manager')
        <li role="presentation" @if(request()->route()->getName() == 'companyGroupDetail') class="active" @endif><a class="freelancer_tab" href="{{route('companyGroupDetail', ['id'=>find_group($company_id)->id])}}">Quản lý nhóm</a></li>
    @endif
    <li role="presentation" @if(url()->current() == asset('doanh-nghiep/khach-hang')) class="active" @endif><a class="freelancer_tab" href="{{asset('doanh-nghiep/khach-hang?id='.$company_id)}}">Danh sách khách hàng</a></li>

    <li role="presentation" @if(url()->current() == asset('doanh-nghiep/yeu-cau')) class="active" @endif><a class="freelancer_tab" href="{{asset('doanh-nghiep/yeu-cau?id='.$company_id)}}">Quản lý yêu cầu</a></li>
</ul>
