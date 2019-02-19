{{-- top page --}}
<div class="top_page">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 welcome-text hidden-xs">
                <p>{{get_config('homeHeader', 'CHÀO MỪNG QUÝ KHÁCH ĐẾN VỚI RECBOOK.VN - HOTLINE: 0989.186.179')}}</p>
            </div>

            <div class="col-xs-12 col-sm-6 user-action">
                @if (!auth()->check())
                    <p class="pull-right">
                        <a href="{{ route('login') }}"><i class="fa fa-sign-in"></i> ĐĂNG NHẬP</a>
                        <a href="{{ route('register') }}"><i class="fa fa-user-plus"></i> ĐĂNG KÝ</a>
                    </p>
                @else
                    <p class="pull-right">
                        <a href="{{ route('recharge') }}"><i class="fa fa-credit-card"></i> <strong>Số dư: {{number_format(auth()->user()->credits).' '.\App\Currency::where('default',1)->first()->icon}}</strong></a>
                        <a href="{{route('user.info', [auth()->user()->id])}}"><i class="fa fa-user"></i> <strong>{{auth()->user()->userinfo->full_name}}</strong></a>
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
                @foreach(\App\Banner::where('location', 8)->where('province_id', 0)->get() as $item)
                    @if($item->type==1)
                        <a href="{{$item->url}}">
                            <img src="http://{{env('DOMAIN_BACKEND', 'recbook.net')}}/{{$item->image}}" class="img-responsive" alt="{{$item->note}}">
                        </a>
                    @else
                        {!! $item->content !!}
                    @endif
                @endforeach
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
            <a class="navbar-brand visible-xs" href="{{ route('home') }}">Recbook.vn</a>
        </div>
        <div class="main-menu-list" id="myNavbar">
            <ul class="nav navbar-nav">
                @php
                    $menuData = json_decode($menuData->data);
                    $quantam    =   session('tinhthanhquantam',0);
                    if($quantam!=0)
                        $tentinh = \App\Province::findOrFail(session('tinhthanhquantam', 1))?str_replace('Tỉnh ', '', str_replace('Thành phố', '', \App\Province::find(session('tinhthanhquantam'))->name)):'Tất cả';
                    else
                        $tentinh    =   'Tất cả';
                @endphp
                <li class="active">
                    <a href="#a" data-toggle="modal" data-target="#myModal">Khu vực: {{$tentinh}} <i class="fa fa-sort"></i></a>
                </li>
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
                {{--<li class=""><a href="{{ route('contact') }}"> {{ trans('menu.contact') }}</a></li>--}}
                {{--<li class=""><a href="{{ route('get.create-real-estate') }}">{{ trans('menu.create_real_estate') }}</a></li>--}}
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
                        <input id="ip-kw" name="txtkeyword" class="form-control pull-left" type="text" placeholder="{{trans('system.searchPlaceholder')}}">
                        <button type="submit" class="pull-left"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </ul>
        </div>
    </div>
</nav>
