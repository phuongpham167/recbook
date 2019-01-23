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
        .chao-gia {
            -webkit-box-shadow: 0px 1px 4px 0px rgba(0,0,0,0.2);
            box-shadow: 0px 1px 4px 0px rgba(0, 0, 0, 0.2);
            background: #f7f7f7;
            margin-top: 20px;
            padding: 30px;
        }
        .rateStar{
            font-size: 14px;
            color: #0c4da2;
        }
        .job_show .detail .bid-freelancer .profile-job-left-bottom .title {
            margin-bottom: 10px;
            line-height: 20px;
            margin-top: 0px;
            font-family: 'Open Sans', sans-serif;
        }
        .profile-job-left-bottom .title a {
            font-size: 16px;
            font-weight: 600;
            display: inline-block;
            font-family: 'Open Sans', sans-serif;
        }
        .profile-job-left .work-title {
            line-height: 1.3em;
            color: #999;
            margin-bottom: 10px;
        }
        .profile-job-left-bottom .skill {
            margin-top: 15px;
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
            <h3>{{$data->title}}</h3>
            <div class="jumbotron" style="padding: 14px; margin-top: 10px">
                {{$data->short_description}}
            </div>
            <div class="freelancer-detail">
                {{$data->description}}
            </div>
            <div class="jumbotron" style="padding: 14px; margin-top: 10px">
                <b>Ghi chú: </b>{{$data->note}}
            </div>
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
                            <p class="rateStar">@for($i=1;$i<6;$i++)
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
        <div class="col-md-12 chao-gia">
            @include(theme(TRUE).'.includes.message')
            <form method="post" action="{{route('freelancerDeal', ['id'=>$data->id])}}">
                {{csrf_field()}}
                <h3 style="border-bottom: 1px dotted #333">Thông tin chào giá</h3>
                <hr/>
                <div class="col-md-5 col-sm-12">
                    <div class="block-amount-detail">
                        <div class="form-group">
                            <label>Chi phí đề xuất *</label>
                            <input type="text" class="form-control" id="price" name="price" />
                        </div>
                        <div class="form-group">
                            <label>Dự kiến hoàn thành trong *</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="days" placeholder="thời gian tới lúc hoàn thiện"
                                       aria-describedby="basic-addon2">
                                <span class="input-group-addon" id="basic-addon2">ngày</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-sm-12">
                    <div class="form-group">
                        <label>1.Bạn có những kinh nghiệm và kỹ năng nào phù hợp với dự án này? *</label>
                        <textarea type="text" class="form-control" id="selfIntro" name="selfIntro" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label>2.Bạn dự định thực hiện dự án này như thế nào? *</label>
                        <textarea type="text" class="form-control" id="road" name="road" rows="5"></textarea>
                    </div>
                    <h5>THÔNG TIN LIÊN HỆ</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user"></i></span>
                                <span class="form-control disabled">{{auth()->user()->userinfo?auth()->user()->userinfo->full_name:''}}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-phone-square"></i></span>
                                <span class="form-control disabled">{{auth()->user()->userinfo?auth()->user()->userinfo->phone:''}}</span>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin: 15px 0">
                            <button type="submit" class="btn btn-primary" style="width: 100%">Gửi chào giá</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        <div class="col-md-12 row" style="background: #f7f7f7; border-radius: 4px; margin-top: 20px; padding: 8px 5px">
                <div class="col-md-2">
                    <h5>Chào giá: <strong>{{$data->deals()->count()}}</strong></h5>
                </div>
                <div class="col-md-6">
                    <h5>Thấp nhất: <strong>{{$data->deals()->min('price')}}</strong> |
                    Trung bình: <strong>{{$data->deals()->average('price')}}</strong> |
                    Cao nhất: <strong>{{$data->deals()->max('price')}}</strong></h5>
                </div>
                <div class="col-md-4 text-right">
                    <h5>Trung bình: <strong>{{round($data->deals()->average('days'))}} ngày</strong></h5>
                </div>
        </div>
        @foreach($data->deals()->orderBy('created_at', 'DESC')->get() as $item)
        <div class="col-md-12 profile" style="margin-top: 20px">
            <div class="col-md-2">
                <img src="{{$data->user?$data->user->avatar():''}}" class="img-responsive"/>
                <p class="rateStar" style="text-align: center">@for($i=1;$i<6;$i++)
                        @if($data->user->owner_rate()>=$i)
                            <i class="fa fa-star"></i>
                        @elseif($i-$data->user->owner_rate() == 0.5)
                            <i class="fa fa-star-half-o"></i>
                        @else
                            <i class="fa fa-star" style="color: #ccc"></i>
                        @endif
                    @endfor</p>
                    <a class="btn btn-success"><i class="fa fa-check"></i> Chọn chào giá này</a>
            </div>
            <div class="col-md-6">
                <div class="profile-job-left-bottom">
                    <h3 class="title">
                        <a href="/freelancer/lam-trong-duc" title="">
                            {{$item->dealer()->first()->userinfo?$item->dealer()->first()->userinfo->full_name:$item->dealer()->first()->name}} </a>
                    </h3>
                    <div class="work-title">{{$item->dealer()->first()?$item->dealer()->first()->group->name:''}}</div>


                    <div class="skill">
                        <label>Giới thiệu:</label>
                        <div class="list-skill">
                            {{$item->dealer()->first()->userinfo?$item->dealer()->first()->userinfo->description:''}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <table class="table" style="margin-top: 10px">
                    <tr>
                        <td>Đến từ</td>
                        <th>{{$item->dealer->userinfo->province?$item->dealer->userinfo->province->name:''}}</th>
                    </tr>
                    <tr>
                        <td>Ngày gia nhập</td>
                        <th>{{Carbon\Carbon::parse($item->dealer->created_at)->format('d/m/Y')}}</th>
                    </tr>
                    <tr>
                        <td>Việc đã làm</td>
                        <th>{{\App\FLDeal::where('user_id', $item->user_id)->where('is_choosen', 1)->whereNotNull('finished_at')->count()}}</th>
                    </tr>
                    <tr>
                        <td>Thu nhập</td>
                        <th>{{\App\FLDeal::where('user_id', $item->user_id)->where('is_choosen', 1)->whereNotNull('finished_at')->sum('price')}}</th>
                    </tr>
                </table>
            </div>
        </div>
        @endforeach
    </div>
    <div class="container" style="margin-top: 30px">
        @foreach(\App\Banner::where('location', 5)->get() as $item)
            <img src="http://{{env('DOMAIN_BACKEND','recbook.net')}}{{$item->image}}" alt="{{$item->note}}" style="
    width: 100%;
">
        @endforeach
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
