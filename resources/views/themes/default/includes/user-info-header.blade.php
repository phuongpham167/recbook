@php
    \Carbon\Carbon::setLocale('vi');
@endphp
<nav class="navbar navbar-inverse main-menu main-menu-user-info">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand visible-xs" href="{{ route('home') }}">Recbook.vn</a>
        </div>
        <div class="collapse navbar-collapse main-menu-list" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="{{ route('home') }}"><i class="fa fa-home fa-lg fa-fw"></i></a></li>
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
                    <li><a href="{{ route('home') }}" style="text-transform: capitalize">{{ trans('header.navbar-item.home') }}</a></li>
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
                                <li><a style="color: white !important">{{($authFriendRequest->fuser1->userinfo->full_name)? ($authFriendRequest->fuser1->userinfo->full_name):''}}</a> <a href="{{route('friend.confirm.request', [($authFriendRequest->fuser1->id)?($authFriendRequest->fuser1->id):''])}}" class="btn btn-primary pull-right btn-accept-rq"><i class="fa fa-plus"></i> Chấp nhận</a></li>
                                @endforeach
                            @else
                                <li><a class="notice_dropdown" style="color: white !important">Không có lời mời kết bạn nào</a></li>
                            @endif
                        </ul>
                    </li>
                    <li class="dropdown">
                        {{--<a href="{{ route('chat') }}" title="Tin nhắn"><i class="fa fa-comment" aria-hidden="true"></i></a>--}}
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" title="Tin nhắn" id="drop-message"><i class="fa fa-comment" aria-hidden="true"></i>
                            <?php $unseen_conversation = \App\Conversation::whereHas('messages', function ($q) {$q->where('user_id','<>',auth()->user()->id)->where('is_read',0);})->where(function ($q) {
                                $q->where('user1',auth()->user()->id)->orWhere('user2',auth()->user()->id);
                            })->count() ?>
                            @if( $unseen_conversation!= 0)
                                <span class="label label-success">{{$unseen_conversation}}</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu message_dropdown">
                            <li class="spin-message"><i class="fa fa-spinner fa-spin" style="font-size:24px"></i></li>
                            <li class="header" id="unread-inform" style="color: #fff">Bạn có <span id="unread-count">{{$unseen_conversation}}</span> tin nhắn chưa đọc</li>

                            <div class="unread-message-wrap" style="padding: 0 25px;">

                            </div>

                            <li class="footer"><a style="color: white" href="{{asset('tin-nhan')}}">Xem tất cả tin nhắn</a></li>
                        </ul>
                        {{--<ul class="dropdown-menu">--}}
                        {{--</ul>--}}
                    </li>
                    <li class="dropdown">
                        @php
                            $unread_notify  =   \App\Notification::where('user_id', auth()->user()->id)->where('is_read', 0)->orderBy('id', 'DESC')->get();
                        @endphp
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" title="Thông báo">
                            <i class="fa fa-bell" aria-hidden="true"></i>
                            @if($unread_notify->count() > 0)<span class="label label-success" id="unread_label">{{$unread_notify->count()}}</span> @endif
                        </a>
                        <ul class="dropdown-menu notify_dropdown">

                            @if($unread_notify->count() >0)
                            @foreach($unread_notify as $noti)
                            <li class="notification" style="color: #fff; border-bottom: 1px dotted; padding: 0">
                                <a href="{{route('readNotification', ['id'=>$noti->id])}}">
                                    <div class="media" style="line-height: 26px">
                                        <div class="media-body">
                                            <strong class="notification-title">{{$noti->title}}</strong>
                                            <p class="notification-desc">{{text_limit($noti->content, 12)}}</p>
                                            <div class="notification-meta">
                                                <small class="timestamp">{{\Carbon\Carbon::parse($noti->created_at)->diffForHumans(\Carbon\Carbon::now())}}</small>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                            </li>
                                @endforeach
                            @else
                                <li class="footer"><a style="color: white" href="#">Không có thông báo nào chưa đọc</a></li>
                            @endif
                        </ul>
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
   .dropdown-menu>li{
        margin: 0;
        padding: 10px 10px;
   }
   .dropdown-menu>li .menu>li>a, .dropdown-menu>li .menu>li>a, .dropdown-menu>li .menu>li>a {
        display: block;
        white-space: nowrap;
        border-bottom: 1px solid #f4f4f4;
   }
   .label {
        position: absolute;
        top: 9px;
        right: 7px;
        text-align: center;
        font-size: 9px;
        padding: 2px 3px;
        line-height: .9;
   }
    .notification-desc {
        margin-bottom: 0;
        line-height: 12px;
    }
    .notification a {
        background: none;
        padding: none;
    }
    .notification a:hover{
        background-color: #0856ac !important;
    }
</style>

@push('js')
    @if(auth()->check())
    <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
    <script>
        function showNotification(data){
            id  =   data.id;
            title   =   data.title;
            content     =   data.content;
            $('.notify_dropdown').prepend('<li class="notification" style="color: #fff; border-bottom: 1px dotted; padding: 0">\n' +
                '                                <a href="{{route('readNotification')}}/'+id+'">\n' +
                '                                    <div class="media" style="line-height: 26px">\n' +
                '                                        <div class="media-body">\n' +
                '                                            <strong class="notification-title">'+title+'</strong>\n' +
                '                                            <p class="notification-desc">'+content+'</p>\n' +
                '                                            <div class="notification-meta">\n' +
                '                                                <small class="timestamp">Vừa xong</small>\n' +
                '                                            </div>\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '                                </a>\n' +
                '\n' +
                '                            </li>');
            var current_unread  =   $('#unread_label').html();
            console.log(current_unread);
            if(current_unread!='undefined')
                $('#unread_label').html(parseInt($('#unread_label').html())+1);
            else
                $('.fa.fa-bell').parent().append('<span class="label label-success" id="unread_label">1</span>');
        }

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('04784854461e84909088', {
            cluster: 'ap1',
            forceTLS: true
        });

        var channel = pusher.subscribe('user-channel-{{auth()->user()->id}}');
        channel.bind('new_notification', function(data) {
            showNotification(data);
        });
    </script>
    @endif
    <script>
        $('#drop-message').on('click', function (e) {
            $('.spin-message').removeClass('hidden');
            $('.unread-message-wrap').html('');
            if (!$('#unread-inform').hasClass('hidden')) {
                $('#unread-inform').addClass('hidden');
            }
            $.ajax({
                url: '/ajax/get-unread-message',
                method: 'GET',
                success: function (data) {
                    if (data.success) {
                        $('.spin-message').addClass('hidden');
                        $('#unread-inform').removeClass('hidden');
                        $('#unread-count').text(data.data.unreadCount);
                        let unreadMessageMarkup = '';
                        for (let u of data.data.listUnread) {
                            console.log(u);
                            let uDis = u.unreadMessage.user ? u.unreadMessage.user.name : u.unreadMessage.user_id;
                            let text = u.unreadMessage.text.length > 40 ? u.unreadMessage.text.substr(0, 40) + '...' : u.unreadMessage.text;
                            moment.locale('vi');
                            let timeAgo = moment(u.unreadMessage.created_at).fromNow();
                            unreadMessageMarkup += '<li class="row" style="border-bottom: 1px solid #dddfe2;">' +
                                    '<a role="button" class="notice_dropdown" style="padding: 0 !important; display: block" href="/conversation' + '/' + u.id + '">' +
                                        '<div class="pull-left">' +
                                            '<img width="50px" src="/images/default-avatar.png" class="img-circle" alt="User Image">' +
                                        '</div>' +
                                        '<div class="pull-left" style="margin-left: 10px; display: block; width: 80%;color: #fff;">' +
                                            '<p>' +
                                                uDis +
                                                '<small class="pull-right" style="margin-right: 10px; color: #cacaca"> <i class="fa fa-clock-o"></i>' +
                                                    timeAgo +
                                                '</small>' +
                                            '</p>' +
                                            '<span style="font-size: 12px">' +
                                                text +
                                            '</span>' +
                                        '</div>' +
                                    '</a>' +
                                '</li>';
                        }
                        console.log(unreadMessageMarkup);
                        $('.unread-message-wrap').html(unreadMessageMarkup);
                    }
                },
                error: function (err) {
                    // console.log(err);
                }
            });
        });

    </script>
@endpush
