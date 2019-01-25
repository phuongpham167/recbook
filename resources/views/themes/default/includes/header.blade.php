{{-- top page --}}
<div class="top_page">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 welcome-text hidden-xs">
                <p>{{get_config('homeHeader', 'CHÀO MỪNG QUÝ KHÁCH ĐẾN VỚI RECBOOK.VN - HOTLINE: 0989.186.179')}}</p>
            </div>

            <div class="col-xs-12 col-sm-4 user-action">
                @if (!auth()->check())
                    <p class="pull-right">
                        <a href="{{ route('login') }}"><i class="fa fa-sign-in"></i> ĐĂNG NHẬP</a>
                        <a href="{{ route('register') }}"><i class="fa fa-user-plus"></i> ĐĂNG KÝ</a>
                    </p>
                @else
                    <p class="pull-right">
                        <a href="{{ route('recharge') }}"><i class="fa fa-credit-card"></i> <strong>Số dư: {{auth()->user()->credits}}</strong></a>
                        <a href="{{ route('info') }}"><i class="fa fa-user"></i> <strong>{{auth()->user()->name}}</strong></a>
                        <a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> ĐĂNG XUẤT</a>
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>
{{-- end to page --}}
{{-- banner header --}}
<div class="banner-header">
    <div class="container">
        <div class="row">
            <div class="left col-xs-12 col-sm-4">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" class="img-responsive" alt="" style="max-height: 128px"/>
                </a>
            </div>
            <div class="right col-sm-8 hidden-xs">
                <a href="">
                    <img src="{{ asset('images/banner/banner-header.gif') }}" class="img-responsive" alt="" />
                </a>
            </div>
            {{--<div class="clearfix"></div>--}}
        </div>
    </div>
</div>
{{-- end banner header --}}
<nav class="navbar navbar-inverse main-menu">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand visible-xs" href="{{ route('home') }}">DoThiGroup</a>
        </div>
        <div class="collapse navbar-collapse main-menu-list" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{ route('home') }}"><i class="fa fa-home fa-lg fa-fw"></i> {{ trans('header.navbar-item.home') }}</a></li>
                @php
                    $menuData = json_decode($menuData->data);
                @endphp
                @foreach($menuData as $md)
                    @if (isset($md->children) && $children = $md->children)
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ $md->name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                @foreach($children as $child)
                                    <li><a href="{{ route('danh-muc', ['tag' => $child->path]) }}">{{ $child->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li class=""><a href="{{ route('danh-muc', ['tag' => $md->path]) }}"> {{ $md->name }}</a></li>
                    @endif
                @endforeach
                <li class=""><a href="{{ route('freelancerList') }}"> Yêu cầu dịch vụ</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <form class="menu-search" action="{{route('smart-search')}}" method="get">
                    <div class="pull-right wrap">
                        <select class="form-control" name="Search[cat_id]">
                            <option value="">Loại BĐS</option>
                            @foreach(\App\ReCategory::get() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        <select class="form-control" name="Search[direction_id]">
                            <option value="">Hướng</option>
                            @foreach(\App\Direction::get() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        <select class="form-control" name="Search[range_price_id]">
                            <option value="0">Giá</option>
                            @foreach(\App\RangePrice::get() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        <input id="ip-kw" name="txtkeyword" class="form-control pull-left" type="text" placeholder="{{trans('system.searchPlaceholder')}}" style="width: 200px" />
                        <button type="submit" class="pull-left"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </ul>
        </div>
    </div>
</nav>
