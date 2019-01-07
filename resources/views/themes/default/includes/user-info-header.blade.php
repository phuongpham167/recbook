{{-- top page --}}
<div class="top_page">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 welcome-text hidden-xs">
                <p>chào mừng quý khách đến với đô thị group - hotline: <span>0989.186.179</span></p>
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
<nav class="navbar navbar-inverse main-menu main-menu-user-info">
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
                <li>
                    <form class="menu-search" action="{{route('search')}}" method="get">
                        <div class="pull-right wrap">
                            <input id="ip-kw" name="txtkeyword" class="form-control pull-left" type="text" placeholder="{{trans('system.searchPlaceholder')}}">
                            <button type="submit" class="pull-left"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (auth()->check())
                    <li>
                        @php
                            $avatar = auth()->user()->userinfo->avatar ? auth()->user()->userinfo->avatar : '/images/default-avatar.png';
                        @endphp
                        <a href="{{route('user.info', [auth()->user()->id])}}" title="{{auth()->user()->userinfo->full_name}}">
                            <img class="img-responsive header-avatar" src="{{$avatar}}" > <span class="header-name">{{auth()->user()->userinfo->full_name}}</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" title="Lời mời kết bạn"><i class="fa fa-users" aria-hidden="true"></i></a>
                        <ul class="dropdown-menu friend-request-list">
                            @php
                                $authUser = \Auth::user();
                                $authFriendRequestLists = \App\Friend::where('user2', $authUser->id)->where('confirmed', 0)->get();
                            @endphp
                            @if(count($authFriendRequestLists) > 0)
                                @foreach($authFriendRequestLists as $authFriendRequest)
                                <li><a>{{$authFriendRequest->fuser1->userinfo->full_name}}</a> <a href="{{route('friend.confirm.request', [$authFriendRequest->fuser1->id])}}" class="btn btn-primary pull-right btn-accept-rq"><i class="fa fa-plus"></i> Chấp nhận</a></li>
                                @endforeach
                            @else
                                <li><a>Không có lời mời kết bạn nào</a></li>
                            @endif
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="{{ route('chat') }}" title="Tin nhắn"><i class="fa fa-comment" aria-hidden="true"></i></a>
                        {{--<ul class="dropdown-menu">--}}
                        {{--</ul>--}}
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" title="Thông báo"><i class="fa fa-bell" aria-hidden="true"></i></a>

                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" title="Thêm"><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> ĐĂNG XUẤT</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
