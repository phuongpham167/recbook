@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Danh sách tin bất động sản" >
@endsection

@section('title')
    Danh sách tin bất động sản
@endsection

@push('style')
    {{-- Link css for page here --}}
    <link rel="stylesheet" href="{{ asset('css/list-real-estate.css') }}"/>
@endpush

@section('content')
    {{-- Include Header --}}
    @include(theme(TRUE).'.includes.header')
    {{--Page html content --}}
    <div class="content-body">
        <div class="container padding-top-30 padding-bottom-30">
            <div class="row">
                <div class="col-xs-12 col-md-9 list-content-wrap">
                    <p class="title_box">
                        <strong>
                            Tin nhắn
                        </strong>
                    </p>
                    <div class="row chat-list">
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">Danh sách thành viên</div>

                                <div class="panel-body">
                                    @foreach($users as $user)
                                        <div class="row">
                                            <div class="col-md-6">
                                                {{$user->name}}
                                            </div>
                                            <div class="col-md-6 form-group">
                                                {{Form::open(['url'=>route('conversation.store')])}}
                                                {{Form::hidden('user_id',$user->id)}}
                                                {{Form::submit('Chat ngay',['class'=>'form-control btn btn-success'])}}
                                                {{Form::close()}}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="panel panel-default">
                                <div class="panel-heading">Danh sách cuộc trò chuyện</div>

                                <div class="panel-body">
                                    @foreach($conversations as $conversation)
                                        <a href="{{route('conversation.show',$conversation->id)}}">
                                            {{($conversation->user1()->first()->id==Auth::user()->id)?$conversation->user2()->first()->name:$conversation->user1()->first()->name}}
                                        </a>
                                        @if(count($conversations)>1)
                                        <hr/>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3">
                    @include(theme(TRUE).'.includes.right-sidebar')
                    @include(theme(TRUE).'.includes.vip-slide')
                </div>
            </div>
        </div>
    </div>
    {{-- Include footer --}}
    @include(theme(TRUE).'.includes.footer')
@endsection

@push('js')
    <script>

    </script>
@endpush
