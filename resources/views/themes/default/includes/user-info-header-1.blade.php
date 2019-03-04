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
                        $tentinh = \App\Province::findOrFail(session('tinhthanhquantam', 0))?str_replace('Tỉnh ', '', str_replace('Thành phố', '', \App\Province::find(session('tinhthanhquantam'))->name)):'Tất cả';
                    else
                        $tentinh    =   'Tất cả';
                @endphp
                <li class=""><a href="{{ route('home') }}"><i class="fa fa-home"></i> Trang chủ</a></li>
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
                @if(auth()->check())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" title="Tin nhắn" id="drop-message"><i class="fa fa-comment font18" aria-hidden="true"></i>
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
                    <a class="dropdown-toggle" id="notify-bell" data-toggle="dropdown" href="#" title="Thông báo">
                        <i class="fa fa-bell font18" aria-hidden="true"></i>
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
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li >
                    <a href="#a" data-toggle="modal" data-target="#quantamtinhthanhModal">Khu vực: {{$tentinh}} <i class="fa fa-sort"></i></a>
                </li>
                <div class="menu-search">
                    <div class="pull-right wrap">
                    <form action="{{route('search')}}" method="get" style="float: left">
                        <input id="ip-kw" name="project_id" class="form-control pull-left" type="text" data-province="{{session('tinhthanhquantam', 0)}}" placeholder="Tìm theo tên dự án">
                        <input id="ip-keyword" name="txtkeyword" class="form-control pull-left" type="text" placeholder="{{trans('system.searchPlaceholder')}}">
                        <button type="submit" class="pull-left"><i class="fa fa-search"></i></button>
                    </form>
                        <div class="dropdown" style="float: left">
                            <a class="pull-left btn btn-sm btn-primary" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Tìm kiếm nâng cao
                                <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dLabel" style="background: #0856ac">
                                <div class="smart-search hidden-xs">
                                    <form action="{{route('smart-search')}}" method="get">
                                    <div class=" search-wrap">
                                        <div class="search_slide">
                                            <ul>
                                                @foreach($categories as $key => $category)
                                                    <li @if($key == 0) class="active" @endif>
                                                        <a href="{{ $category->id }}">{{$category->name}}</a><span></span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <div class="clearfix"></div>
                                            <form action="{{route('smart-search')}}" method="GET">
                                                @php
                                                    if($categories) {
                                                        $firstCat = $categories[0];
                                                    }
                                                @endphp
                                                <input name="Search[cat_id]" id="Search_kind_id" type="hidden" value="{{ $firstCat ? $firstCat->id : 1 }}">
                                                <div class="row search-select-wrap">
                                                    <div class="col-xs-2 item">
                                                        <select id="re-type" name="Search[type_id]">
                                                            <option value="0">Tất cả loại hình</option>
                                                            @foreach($reTypes as $reType)
                                                                <option value="{{$reType->id}}">{{$reType->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <input value="{{session('tinhthanhquantam', 0)}}" name="Search[province_id]" id="Search_province_id" type="hidden">
                                                    <div class="col-xs-2 item">
                                                        <select name="Search[district_id]" id="Search_district_id">
                                                            <option value="0">Tất cả quận huyện</option>
                                                            @foreach(\App\District::where('province_id', session('tinhthanhquantam', 0))->get() as $district)
                                                                <option value="{{$district->id}}">{{$district->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-xs-2 item">
                                                        <select name="Search[street_id]" id="Search_street_id">
                                                            <option value="0">Tất cả đường phố</option>
                                                            @foreach($streets as $street)
                                                                <option value="{{$street->id}}">{{$street->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-xs-2 item">
                                                        <select name="Search[direction_id]" id="Search_direction_id">
                                                            <option value="0">Tất cả các hướng</option>
                                                            @foreach($directions as $direction)
                                                                <option value="{{$direction->id}}">{{$direction->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-xs-2 item">
                                                        <select id="range-price" name="Search[range_price_id]">
                                                            <option value="0">Không lọc theo giá</option>
                                                            @foreach($rangePrices as $rangePrice)
                                                                <option value="{{$rangePrice->id}}">{{$rangePrice->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-xs-2 item">
                                                        <div class="input-group"> <input class="form-control" name="Search[keyword]" placeholder="Tên/SDT.." style="width: 100%;">
                                                            <span class="input-group-btn"> <button class="btn btn-default" type="submit" style="    height: 30px;top: 0;margin-bottom: 9px;">
                                                                    <i class="fa fa-search"></i></button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </ul>
        </div>
    </div>
</nav>

<style>
    .label {
        position: absolute;
        top: 9px;
        right: 7px;
        text-align: center;
        font-size: 9px;
        padding: 2px 3px;
        line-height: .9;
    }
    .font18 {
        font-size: 18px;
    }
</style>
