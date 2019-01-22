@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Danh sách dự án" >
@endsection

@section('title')
    {{$data->title}} - {{$data->category->name}}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/user-info.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/news.css') }}"/>
    <style>
        .profile{
            -webkit-box-shadow: 0px 1px 4px 0px rgba(0,0,0,0.2);
            box-shadow: 0px 1px 4px 0px rgba(0, 0, 0, 0.2);
            padding: 14px;
            padding-bottom: 10px;
            background: #fff;
        }
        .profile table td{
            width: 30%;
            color: #aaa;
        }
    </style>
@endpush

@section('content')
    @include(theme(TRUE).'.includes.header')
@php
\Carbon\Carbon::setLocale('vi');
@endphp
    <div class="container">
        <ol class="breadcrumb" style="margin: 20px 0">
            <li><a>Dự án</a></li>
            <li><a href="#">{{$data->category->name}}</a></li>
        </ol>
        <div class="col-md-7">

        </div>
        <div class="col-md-4 col-md-offset-1">
            <div class="profile">
                <h4>Thông tin dự án</h4>
                <table class="table" style="margin-top: 10px">
                    <tr>
                        <td>ID dự án</td>
                        <th>{{$data->id}}</th>
                    </tr>
                    <tr>
                        <td>Ngày đăng</td>
                        <th>{{Carbon\Carbon::parse($data->created_at)->diffForHumans(\Carbon\Carbon::now())}}</th>
                    </tr>
                    <tr>
                        <td>Hết hạn</td>
                        <th>{{Carbon\Carbon::parse($data->end_at)->diffForHumans(\Carbon\Carbon::now())}}</th>
                    </tr>
                    <tr>
                        <td>Địa điểm</td>
                        <th>{{$data->district?$data->district->name.' -':''}} {{$data->province?$data->province->name:''}}</th>
                    </tr>
                </table>
                <h4>Thông tin khách hàng</h4>
                <table class="table" style="margin-top: 10px">
                    <tr>
                        <td>
                            <img src="{{$data->user?$data->user->avatar():''}}" class="img-responsive"/>
                        </td>
                        <th>
                            <h5 style="padding: 4px 0">{{$data->user->userinfo?$data->user->userinfo->full_name:$data->user->name}}</h5>
                            <p style="padding: 4px 0">{{$data->user?$data->user->group->name:''}}</p>
                            <p>@for($i=1;$i<6;$i++)
                                    @if($data->user->owner_rate()>=$i)
                                        <i class="fa fa-star"></i>
                                    @elseif($i-$data->user->owner_rate() == 0.5)
                                        <i class="fa fa-star-half-o"></i>
                                    @else
                                        <i class="fa fa-star" style="color: #ccc"></i>
                                    @endif
                                @endfor</p>
                        </th>
                    </tr>

                    <tr>
                        <td>Đến từ</td>
                        <th>{{$data->user->userinfo->province?$data->user->userinfo->province->name:''}}</th>
                    </tr>
                    <tr>
                        <td>Việc đã đăng</td>
                        <th>{{$data->user->owner()->count()}}</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    @include(theme(TRUE).'.includes.footer')
@endsection

@push('js')
    <script>
        $('#myTabs a').click(function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    </script>
@endpush
