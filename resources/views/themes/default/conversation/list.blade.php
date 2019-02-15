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
    @include(theme(TRUE).'.includes.user-info-header')
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
                                        @php
                                            $f = $user->fuser1;
                                            if($user->user1 == auth()->user()->id){
                                                $f = $user->fuser2;
                                            }
                                        @endphp
                                        @if($f->group->chat_permission)
                                        <div class="row">
                                            <div class="col-md-6">
                                                {{$f->name}}
                                            </div>
                                            <div class="col-md-6 form-group">
                                                {{Form::open(['url'=>route('conversation.store')])}}
                                                {{Form::hidden('user_id',$f->id)}}
                                                {{Form::submit('Chat ngay',['class'=>'form-control btn btn-success'])}}
                                                {{Form::close()}}
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="panel panel-default">
                                <div class="panel-heading">Danh sách cuộc trò chuyện</div>

                                <div class="panel-body">
                                    @foreach($conversations as $conversation)
                                        <?php
                                        if(!empty($conversation->user1()->first()) && $conversation->user1()->first()->id == auth()->user()->id){
                                            $name   =   $conversation->user2()->first()?$conversation->user2()->first()->name:'Người dùng Recbook';
                                        }
                                        else {
                                            $name   =   $conversation->user1()->first()?$conversation->user1()->first()->name:'Người dùng Recbook';
                                        }
                                        ?>
                                        @if($name!='Người dùng Recbook')
                                        <a href="{{route('conversation.show',$conversation->id)}}">
                                            {{$name}}
                                        </a>
                                        @else
                                            {{$name}}
                                        @endif
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
