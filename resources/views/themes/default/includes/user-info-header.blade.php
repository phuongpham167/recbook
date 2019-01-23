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
                <li class="active"><a href="{{ route('home') }}"><i class="fa fa-home fa-lg fa-fw"></i></a></li>
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
                    <li class="home-link"><a href="{{ route('home') }}" style="text-transform: capitalize">{{ trans('header.navbar-item.home') }}</a></li>
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
                                <li><a class="dropdown1">Không có lời mời kết bạn nào</a></li>
                            @endif
                        </ul>
                    </li>
                    <li class="dropdown">
                        {{--<a href="{{ route('chat') }}" title="Tin nhắn"><i class="fa fa-comment" aria-hidden="true"></i></a>--}}
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" title="Tin nhắn"><i class="fa fa-comment" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 4 messages</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul>
                                    <li><!-- start message -->
                                        <a class="dropdown1" href="#">
                                            <div class="pull-left">
                                                <img width="50px" height="50px" src="/images/default-avatar.png" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                Support Team
                                                <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <!-- end message -->
                                    <li>
                                        <a class="dropdown1" href="#">
                                            <div class="pull-left">
                                                <img width="50px" height="50px" src="/images/default-avatar.png" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                AdminLTE Design Team
                                                <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown1" href="#">
                                            <div class="pull-left">
                                                <img width="50px" height="50px" src="/images/default-avatar.png" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                Developers
                                                <small><i class="fa fa-clock-o"></i> Today</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown1" href="#">
                                            <div class="pull-left">
                                                <img width="50px" height="50px" src="/images/default-avatar.png" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                Sales Department
                                                <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown1" href="#">
                                            <div class="pull-left">
                                                <img width="50px" height="50px" src="/images/default-avatar.png" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                Reviewers
                                                <small><i class="fa fa-clock-o"></i> 2 days</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer"><a href="#">See All Messages</a></li>
                        </ul>
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
<style>
   .dropdown-menu>li .menu>li>a {
        margin: 0;
        padding: 10px 10px;
    }
    .dropdown-menu>li .menu>li>a, .dropdown-menu>li .menu>li>a, .dropdown-menu>li .menu>li>a {
        display: block;
        white-space: nowrap;
        border-bottom: 1px solid #f4f4f4;
    }
    .dropdown-menu>li h4 p{
        padding: 0;
        margin: -35px 0 0 60px;
        color: #444444;
        font-size: 15px;
        position: relative;
    }
</style>
