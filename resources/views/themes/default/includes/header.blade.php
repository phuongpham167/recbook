{{-- top page --}}
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
            <ul class="nav navbar-nav" id="mainmenu">
                <li class="active"><a href="{{ route('home') }}">{{ trans('header.navbar-item.home') }}</a></li>
                @php
                    $menuData = json_decode($menuData->data);
                @endphp
                @foreach($menuData as $md)
                    @if (isset($md->children) && $children = $md->children)
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ $md->name }}</a>
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
                <li class=""><a href="{{ route('contact') }}"> {{ trans('menu.contact') }}</a></li>
                <li class=""><a href="{{ route('get.create-real-estate') }}">{{ trans('menu.create_real_estate') }}</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (!auth()->check())
                    <li class=""><a href="{{ route('login') }}"><i class="fa fa-sign-in"></i> ĐĂNG NHẬP</a></li>
                    <li class=""><a href="{{ route('register') }}"><i class="fa fa-user-plus"></i> ĐĂNG KÝ</a></li>
                @else
                    <li class=""><a href="{{ route('recharge') }}"><i class="fa fa-credit-card"></i> <strong>Số dư: {{auth()->user()->credits}}</strong></li>
                    <li class=""><a href="{{ route('info') }}"><i class="fa fa-user"></i> <strong>{{auth()->user()->name}}</strong></li>
                    <li class=""><a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> ĐĂNG XUẤT</li>
                @endif
            </ul>
        </div>
    </div>
</nav>

{{-- end to page --}}
{{-- banner header --}}
<div class="banner-header">
    <div class="container">
        <div class="row">
            <div class="left col-xs-12 col-sm-3">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" class="img-responsive" alt="" style="max-width: 80%"/>
                </a>
            </div>
            <div class="right col-sm-8 hidden-xs">
                <form class="form-inline">
                    <div class="form-group col-md-3">
                        <label class="sr-only">Mã tin</label>
                        <input type="text" class="form-control" placeholder="mã tin" name="id" />
                    </div>
                    <div class="form-group col-md-3">
                        <label class="sr-only">Loại hình</label>
                        <select name="category" class="form-control" style="">
                            <option value="0">Loại hình</option>
                            @foreach(\App\ReCategory::all() as $cat)
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <select name="category" class="form-control" style="">
                            <option value="0">Tỉnh/thành phố</option>
                            @foreach(\App\Province::all() as $province)
                                <option value="{{$province->id}}">{{$province->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <select name="category" class="form-control" style="">
                            <option value="0">Hướng</option>
                            @foreach(\App\Direction::all() as $direction)
                                <option value="{{$direction->id}}">{{$direction->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-1">
                        <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
            {{--<div class="clearfix"></div>--}}
        </div>
    </div>
</div>
{{-- end banner header --}}

<div class="container"><img src="http://demo02.vinaweb.vn/dothihp/images/partner/9841slide.jpg" alt="Header" style="
    width: 100%;
"></div>