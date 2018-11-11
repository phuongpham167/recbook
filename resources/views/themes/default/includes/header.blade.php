{{-- top page --}}
<div class="top_page">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 welcome-text hidden-xs">
                <p>chào mừng quý khách đến với đô thị group - hotline: <span>0990.080.367</span></p>
            </div>

            <div class="col-xs-12 col-sm-4 user-action">
                @if (!Auth::user())
                <p class="pull-right">
                    <a href="{{ route('login') }}"><i class="fa fa-sign-in"></i> ĐĂNG NHẬP</a>
                    <a href="{{ route('register') }}"><i class="fa fa-user-plus"></i> ĐĂNG KÝ</a>
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
                    <img src="{{ asset('images/logo.png') }}" class="img-responsive" alt=""/>
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
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ trans('header.navbar-item.for-sale') }} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">{{ trans('header.navbar-item.all') }}</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ trans('header.navbar-item.for-rent') }} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">{{ trans('header.navbar-item.all') }}</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <form class="menu-search">
                    <div class="pull-right wrap">
                        <input class="form-control pull-left" type="text" placeholder="...">
                        <button class="pull-left"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </ul>
        </div>
    </div>
</nav>
